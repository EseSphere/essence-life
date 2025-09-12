<?php
session_start();
header('Content-Type: application/json');

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$hashedPassword = base64_encode($password);

// Replace this function with real DB queries
function getUserByEmail($email)
{
    $users = [
        ['id' => 1, 'email' => 'test@example.com', 'password' => base64_encode('password123')]
    ];
    foreach ($users as $user) {
        if ($user['email'] === $email) return $user;
    }
    return null;
}

$user = getUserByEmail($email);

if ($user && $user['password'] === $hashedPassword) {
    $_SESSION['user_id'] = $user['id'];
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Email or password is incorrect']);
}
