const dbName = "essence_life";
const dbVersion = 1;

// Open IndexedDB dynamically
async function openDatabase(tablesData = {}) {
  return new Promise((resolve, reject) => {
    const request = indexedDB.open(dbName, dbVersion);

    request.onupgradeneeded = function(event) {
      const db = event.target.result;

      for (const tableName in tablesData) {
        const { primaryKeys, columns } = tablesData[tableName];
        let keyPath = primaryKeys.length === 1 ? primaryKeys[0] : (primaryKeys.length > 1 ? primaryKeys : 'id');

        if (!db.objectStoreNames.contains(tableName)) {
          const store = db.createObjectStore(tableName, { keyPath });
          columns.forEach(col => {
            if (Array.isArray(keyPath) ? keyPath.includes(col) : keyPath === col) return;
            store.createIndex(col, col, { unique: false });
          });
        }
      }

      if (!db.objectStoreNames.contains("sync_queue")) {
        db.createObjectStore("sync_queue", { autoIncrement: true });
      }
    };

    request.onsuccess = e => resolve(e.target.result);
    request.onerror = e => reject(e.target.error);
  });
}

// Offline-aware full clone
async function syncDatabase() {
  if (!navigator.onLine) return console.log("Offline, will sync later.");

  // Force full clone if first load
  let lastSync = localStorage.getItem("lastSync") || '';
  const res = await fetch(`export_db.php?lastSync=${encodeURIComponent(lastSync)}`);
  const databaseData = await res.json();
  const db = await openDatabase(databaseData);

  // Apply data to IndexedDB
  for (const tableName in databaseData) {
    const { rows } = databaseData[tableName];
    const tx = db.transaction(tableName, "readwrite");
    const store = tx.objectStore(tableName);

    rows.forEach(row => {
      store.put(row); // put will insert or update automatically
    });
  }

  // Sync local changes back to MySQL (if any)
  const txQueue = db.transaction("sync_queue", "readonly");
  const allChanges = await txQueue.objectStore("sync_queue").getAll();

  if (allChanges.length) {
    await fetch("sync_to_mysql.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(allChanges.reduce((acc, item) => {
        acc[item.tableName] = acc[item.tableName] || [];
        acc[item.tableName].push(item.row);
        return acc;
      }, {}))
    });

    const txClear = db.transaction("sync_queue", "readwrite");
    txClear.objectStore("sync_queue").clear();
  }

  localStorage.setItem("lastSync", new Date().toISOString());
}

// Auto-sync on load and periodically
window.addEventListener("load", syncDatabase);
setInterval(syncDatabase, 5 * 60 * 1000);
window.addEventListener("online", syncDatabase);
