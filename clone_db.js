document.addEventListener("DOMContentLoaded", async () => {
    const statusEl = document.getElementById("status");

    function updateStatus(msg) {
        if (statusEl) statusEl.innerText = msg;
    }

    try {
        updateStatus("Fetching data from server...");
        const res = await fetch('clone_db.php');
        const dbData = await res.json();

        if (dbData.error) throw new Error(dbData.error);

        const dbPromise = new Promise((resolve, reject) => {
            const req = indexedDB.open("essence_life", 1);
            req.onupgradeneeded = e => {
                const db = e.target.result;
                for (const table in dbData) {
                    if (!db.objectStoreNames.contains(table)) {
                        db.createObjectStore(table, { keyPath: "id", autoIncrement: true });
                    }
                }
            };
            req.onsuccess = e => resolve(e.target.result);
            req.onerror = e => reject(e.target.error);
        });

        const db = await dbPromise;

        for (const table in dbData) {
            const records = dbData[table];
            if (!records || !records.length) continue;

            updateStatus(`Cloning table "${table}" (${records.length} records)...`);

            const tx = db.transaction(table, "readwrite");
            const store = tx.objectStore(table);

            records.forEach(record => store.add(record));

            await new Promise(resolve => tx.oncomplete = () => resolve());
        }

        updateStatus("✅ All tables cloned successfully!");

    } catch (err) {
        console.error(err);
        updateStatus("❌ Error cloning database: " + err.message);
    }
});
