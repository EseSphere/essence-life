<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IndexedDB to SQL Exporter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        input,
        button {
            padding: 8px;
            margin: 5px 0;
        }

        pre {
            background: #f4f4f4;
            padding: 10px;
            max-height: 300px;
            overflow: auto;
        }
    </style>
</head>

<body>
    <h1>IndexedDB → SQL Exporter</h1>

    <label for="dbName">Database Name:</label>
    <input type="text" id="dbName" placeholder="Enter DB name"><br>

    <button id="exportBtn">Export Database as SQL</button>

    <h2>Status</h2>
    <pre id="status"></pre>

    <script>
        function escapeSQL(value) {
            if (value === null || value === undefined) return 'NULL';
            if (typeof value === 'number') return value;
            if (typeof value === 'boolean') return value ? 1 : 0;
            return `'${String(value).replace(/'/g, "''")}'`;
        }

        async function exportIndexedDBAsSQL(dbName) {
            const statusEl = document.getElementById('status');
            statusEl.textContent = '';

            return new Promise((resolve, reject) => {
                const request = indexedDB.open(dbName);
                request.onerror = (e) => {
                    statusEl.textContent += `Error opening database: ${e.target.error}\n`;
                    reject(e);
                };
                request.onsuccess = (e) => {
                    const db = e.target.result;
                    const storeNames = Array.from(db.objectStoreNames);

                    if (storeNames.length === 0) {
                        statusEl.textContent += "No object stores found.\n";
                        resolve();
                        return;
                    }

                    let sql = '';
                    let completedStores = 0;

                    storeNames.forEach(storeName => {
                        const transaction = db.transaction(storeName, 'readonly');
                        const store = transaction.objectStore(storeName);
                        const allData = [];

                        store.openCursor().onsuccess = (event) => {
                            const cursor = event.target.result;
                            if (cursor) {
                                allData.push(cursor.value);
                                cursor.continue();
                            } else {
                                // Determine columns
                                const columnsSet = new Set();
                                allData.forEach(item => Object.keys(item).forEach(k => columnsSet.add(k)));
                                const columns = Array.from(columnsSet);

                                // Create table
                                sql += `CREATE TABLE IF NOT EXISTS ${storeName} (\n`;
                                columns.forEach((col, i) => {
                                    sql += `  ${col} TEXT${i < columns.length - 1 ? ',' : ''}\n`;
                                });
                                sql += `);\n\n`;

                                // Insert rows
                                allData.forEach(row => {
                                    const values = columns.map(col => escapeSQL(row[col])).join(', ');
                                    sql += `INSERT INTO ${storeName} (${columns.join(', ')}) VALUES (${values});\n`;
                                });

                                sql += '\n';
                                statusEl.textContent += `Processed "${storeName}" (${allData.length} records)\n`;

                                completedStores++;
                                if (completedStores === storeNames.length) {
                                    // All stores done, download SQL
                                    const blob = new Blob([sql], {
                                        type: "text/sql"
                                    });
                                    const url = URL.createObjectURL(blob);
                                    const a = document.createElement("a");
                                    a.href = url;
                                    a.download = `${dbName}.sql`;
                                    document.body.appendChild(a);
                                    a.click();
                                    document.body.removeChild(a);
                                    resolve();
                                }
                            }
                        };
                    });
                };
            });
        }

        document.getElementById('exportBtn').addEventListener('click', () => {
            const dbName = document.getElementById('dbName').value.trim();
            if (!dbName) {
                alert('Please enter a database name');
                return;
            }
            exportIndexedDBAsSQL(dbName).catch(err => {
                console.error(err);
                alert('Failed to export database. See console for details.');
            });
        });
    </script>
</body>

</html>