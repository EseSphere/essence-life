<?php
require_once 'dbconnections.php';

$lastSync = $_GET['lastSync'] ?? '';

$tablesResult = $conn->query("SHOW TABLES");
$databaseData = [];

while ($row = $tablesResult->fetch_array()) {
    $table = $row[0];

    // Get columns
    $colsResult = $conn->query("SHOW COLUMNS FROM `$table`");
    $columns = [];
    while ($col = $colsResult->fetch_assoc()) $columns[] = $col['Field'];

    // Get primary keys
    $pkResult = $conn->query("SHOW KEYS FROM `$table` WHERE Key_name = 'PRIMARY'");
    $primaryKeys = [];
    while ($pk = $pkResult->fetch_assoc()) $primaryKeys[] = $pk['Column_name'];

    // If lastSync is empty, fetch ALL rows
    if (empty($lastSync)) {
        $rowsResult = $conn->query("SELECT * FROM `$table`");
    } else {
        $rowsResult = $conn->query("SELECT * FROM `$table` WHERE updated_at >= '$lastSync' OR deleted_at >= '$lastSync'");
    }

    $rows = [];
    while ($r = $rowsResult->fetch_assoc()) $rows[] = $r;

    $databaseData[$table] = [
        'columns' => $columns,
        'primaryKeys' => $primaryKeys,
        'rows' => $rows
    ];
}

header('Content-Type: application/json');
echo json_encode($databaseData);
$conn->close();
