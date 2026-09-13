<?php

require_once __DIR__ . '/../database/database.php';

$email = 'hannah@example.com';
$newPassword = 'ContinuumDev123!';

$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

$stmt = $pdo->prepare(
    "UPDATE users
     SET password = ?
     WHERE email = ?"
);

$stmt->execute([
    $hashedPassword,
    $email
]);

echo "Development password reset successfully.";