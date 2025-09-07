<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "essence_life";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$lastSync = $_GET['lastSync'] ?? '1970-01-01 00:00:00';
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

    // Get rows updated or deleted since last sync
    $rowsResult = $conn->query("SELECT * FROM `$table` WHERE updated_at >= '$lastSync' OR deleted_at >= '$lastSync'");
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
