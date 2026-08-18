<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/auth.php';

requireLogin();

$userName = $_SESSION['user_name'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Welcome | Project Continuum</title>
</head>

<body>

    <h1>Project Continuum</h1>

    <h2>Welcome back, <?= htmlspecialchars($userName) ?>.</h2>

    <p>You are successfully logged in.</p>

    <a href="logout.php">Log out</a>

</body>
</html>