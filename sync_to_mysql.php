<?php
require_once 'dbconnections.php';

// Read JSON payload from client
$payload = json_decode(file_get_contents("php://input"), true);

foreach ($payload as $table => $rows) {
    // Get primary keys
    $pkResult = $conn->query("SHOW KEYS FROM `$table` WHERE Key_name = 'PRIMARY'");
    $primaryKeys = [];
    while ($pkRow = $pkResult->fetch_assoc()) $primaryKeys[] = $pkRow['Column_name'];

    foreach ($rows as $row) {
        $where = [];
        foreach ($primaryKeys as $key) {
            $where[] = "`$key`='" . $conn->real_escape_string($row[$key]) . "'";
        }
        $whereSQL = implode(" AND ", $where);

        $exists = $conn->query("SELECT * FROM `$table` WHERE $whereSQL")->fetch_assoc();

        if (isset($row['deleted_at']) && $row['deleted_at']) {
            // Soft delete
            if ($exists) $conn->query("UPDATE `$table` SET deleted_at='" . $row['deleted_at'] . "' WHERE $whereSQL");
        } else {
            if ($exists) {
                // Update only if newer
                if (strtotime($row['updated_at']) > strtotime($exists['updated_at'])) {
                    $fields = [];
                    foreach ($row as $col => $val) {
                        $fields[] = "`$col`='" . $conn->real_escape_string($val) . "'";
                    }
                    $conn->query("UPDATE `$table` SET " . implode(",", $fields) . " WHERE $whereSQL");
                }
            } else {
                // Insert new row
                $cols = implode(",", array_map(fn($c) => "`$c`", array_keys($row)));
                $vals = implode(",", array_map(fn($v) => "'" . $conn->real_escape_string($v) . "'", array_values($row)));
                $conn->query("INSERT INTO `$table` ($cols) VALUES ($vals)");
            }
        }
    }
}

echo json_encode(["status" => "success"]);
$conn->close();
