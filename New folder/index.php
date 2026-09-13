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

    <title>Dashboard | Project Continuum</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #1f2937;
        }

        .navbar {
            background: #1f2937;
            color: white;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            margin: 0;
            font-size: 22px;
        }

        .logout {
            color: white;
            text-decoration: none;
            background: #dc2626;
            padding: 9px 15px;
            border-radius: 6px;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .welcome {
            margin-bottom: 30px;
        }

        .welcome h2 {
            margin-bottom: 8px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .card h3 {
            margin-top: 0;
        }

        .card p {
            color: #6b7280;
        }
    </style>
</head>

<body>

    <header class="navbar">
        <h1>Project Continuum</h1>

        <a class="logout" href="logout.php">Log out</a>
    </header>

    <main class="container">

        <section class="welcome">
            <h2>Welcome back, <?= htmlspecialchars($userName) ?>.</h2>
            <p>Let's continue where you left off.</p>
        </section>

        <section class="cards">

            <div class="card">
                <h3>Projects</h3>
                <p>Manage and track your projects.</p>
            </div>

            <div class="card">
                <h3>Goals</h3>
                <p>Set goals and keep track of your progress.</p>
            </div>

            <div class="card">
                <h3>Progress</h3>
                <p>See how far you've come.</p>
            </div>

        </section>

    </main>

</body>
</html>
