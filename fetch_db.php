<?php
require_once 'dbconnections.php';

$database_data = [];
$tables_result = $conn->query("SHOW TABLES");

while ($row = $tables_result->fetch_array()) {
    $table_name = $row[0];

    // Primary key
    $pk_result = $conn->query("SHOW KEYS FROM `$table_name` WHERE Key_name = 'PRIMARY'");
    $primary_key = ($pk_result->num_rows > 0) ? $pk_result->fetch_assoc()['Column_name'] : null;

    // Foreign keys
    $fk_result = $conn->query("
        SELECT COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
        FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
        WHERE TABLE_SCHEMA='$dbname' AND TABLE_NAME='$table_name' AND REFERENCED_TABLE_NAME IS NOT NULL
    ");

    $foreign_keys = [];
    while ($fk = $fk_result->fetch_assoc()) {
        $foreign_keys[] = $fk;
    }

    // Table rows
    $rows = [];
    $result = $conn->query("SELECT * FROM `$table_name`");
    while ($data = $result->fetch_assoc()) {
        $rows[] = $data;
    }

    $database_data[$table_name] = [
        'primaryKey' => $primary_key,
        'foreignKeys' => $foreign_keys,
        'rows' => $rows
    ];
}

header('Content-Type: application/json');
echo json_encode($database_data);

$conn->close();
