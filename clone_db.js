const dbName = "RelationalCloneDB";
let db;

// Open DB
let request = indexedDB.open(dbName, 1);

request.onupgradeneeded = function(event) {
    db = event.target.result;
};

request.onsuccess = function(event) {
    db = event.target.result;
    fetchDataAndClone();
};

request.onerror = function(event) {
    console.error("IndexedDB error:", event.target.errorCode);
};

function fetchDataAndClone() {
    fetch('fetch_db.php') // PHP file URL
        .then(res => res.json())
        .then(data => {
            const tableNames = Object.keys(data);
            let version = db.version + 1;
            db.close();

            const requestUpgrade = indexedDB.open(dbName, version);
            
            requestUpgrade.onupgradeneeded = function(event) {
                db = event.target.result;
                tableNames.forEach(table => {
                    if (!db.objectStoreNames.contains(table)) {
                        const tableInfo = data[table];
                        const store = db.createObjectStore(table, { keyPath: tableInfo.primaryKey || "id" });

                        // Create indexes for foreign keys
                        tableInfo.foreignKeys.forEach(fk => {
                            store.createIndex(fk.COLUMN_NAME, fk.COLUMN_NAME, { unique: false });
                        });
                    }
                });
            };

            requestUpgrade.onsuccess = function(event) {
                db = event.target.result;
                tableNames.forEach(table => {
                    const transaction = db.transaction(table, "readwrite");
                    const store = transaction.objectStore(table);

                    data[table].rows.forEach(item => store.put(item));

                    transaction.oncomplete = () => console.log(`Table ${table} cloned successfully with relations!`);
                    transaction.onerror = (e) => console.error(`Error cloning ${table}:`, e.target.error);
                });
            };
        })
        .catch(err => console.error("Fetch error:", err));
}
