<?php

require_once __DIR__ . '/../database/database.php';

$name = 'Hannah';
$email = 'hannah@example.com';
$password = 'ChangeThisPassword123!';

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare(
    "INSERT INTO users (name, email, password)
     VALUES (?, ?, ?)"
);

$stmt->execute([
    $name,
    $email,
    $hashedPassword
]);

echo "Development user created successfully.";