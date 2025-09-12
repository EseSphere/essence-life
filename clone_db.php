<?php
header('Content-Type: application/json');
include 'dbconnections.php';

try {
    $tables_res = $conn->query("SHOW TABLES");
    $tables = [];
    while ($row = $tables_res->fetch_array()) {
        $tables[] = $row[0];
    }

    $data = [];

    foreach ($tables as $table) {
        $columns_res = $conn->query("SHOW COLUMNS FROM `$table`");
        $columns = [];
        while ($col = $columns_res->fetch_assoc()) {
            if (strtolower($col['Field']) !== 'id') { // Exclude id
                $columns[] = $col['Field'];
            }
        }

        if (empty($columns)) continue;

        $cols = implode(",", $columns);
        $rows_res = $conn->query("SELECT $cols FROM `$table`");
        $rows = $rows_res->fetch_all(MYSQLI_ASSOC);
        $data[$table] = $rows;
    }

    echo json_encode($data);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
