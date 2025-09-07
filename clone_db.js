const dbName = "essence_life";
const dbVersion = 1;

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

// Record local changes
async function recordChange(tableName, row, type) {
  const db = await openDatabase({});
  const tx1 = db.transaction(tableName, "readwrite");
  const store = tx1.objectStore(tableName);

  const now = new Date().toISOString();
  row.updated_at = now;
  if (type === "delete") row.deleted_at = now;

  if (type === "insert" || type === "update") store.put(row);
  if (type === "delete") store.delete(row[store.keyPath]);

  const tx2 = db.transaction("sync_queue", "readwrite");
  tx2.objectStore("sync_queue").add({ tableName, row, type, timestamp: now });
}

// Offline-aware two-way sync
async function syncDatabase() {
  if (!navigator.onLine) return console.log("Offline, will sync later.");

  const lastSync = localStorage.getItem("lastSync") || "1970-01-01 00:00:00";

  const res = await fetch(`export_db.php?lastSync=${encodeURIComponent(lastSync)}`);
  const databaseData = await res.json();
  const db = await openDatabase(databaseData);

  for (const tableName in databaseData) {
    const { rows } = databaseData[tableName];
    const tx = db.transaction(tableName, "readwrite");
    const store = tx.objectStore(tableName);

    rows.forEach(row => {
      const getReq = store.get(row[store.keyPath]);
      getReq.onsuccess = e => {
        const localRow = e.target.result;
        if (!localRow || new Date(row.updated_at) > new Date(localRow.updated_at)) {
          if (row.deleted_at) store.delete(row[store.keyPath]);
          else store.put(row);
        }
      };
    });
  }

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

// Auto-sync
setInterval(syncDatabase, 5 * 60 * 1000);
window.addEventListener("online", syncDatabase);
syncDatabase();
