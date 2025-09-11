<?php
include 'dbconnections.php';
$user_id = $_SESSION['user_id'] ?? 1;

$action = $_GET['action'] ?? '';

if ($action === 'list') {
    $stmt = $conn->prepare("SELECT * FROM playlists WHERE user_id=? ORDER BY created_at DESC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    echo json_encode($stmt->get_result()->fetch_all(MYSQLI_ASSOC));
    exit;
}

if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    if ($name) {
        $stmt = $conn->prepare("INSERT INTO playlists (user_id, name) VALUES (?,?)");
        $stmt->bind_param("is", $user_id, $name);
        $stmt->execute();
    }
    exit;
}

if ($action === 'delete') {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM playlists WHERE id=? AND user_id=?");
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();
    exit;
}

if ($action === 'all_audios') {
    $res = $conn->query("SELECT * FROM contents ORDER BY created_at DESC");
    echo json_encode($res->fetch_all(MYSQLI_ASSOC));
    exit;
}

if ($action === 'add_audio') {
    $playlist_id = intval($_GET['playlist_id']);
    $audio_id = intval($_GET['audio_id']);
    $stmt = $conn->prepare("INSERT IGNORE INTO playlist_audios (playlist_id,audio_id) VALUES (?,?)");
    $stmt->bind_param("ii", $playlist_id, $audio_id);
    $stmt->execute();
    exit;
}
