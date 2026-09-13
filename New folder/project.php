<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/auth.php';

requireLogin();

$userId = $_SESSION['user_id'];

$projectId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$projectId) {
    header('Location: projects.php');
    exit;
}

$stmt = $pdo->prepare("
    SELECT id, name, description, status, created_at
    FROM projects
    WHERE id = ? AND user_id = ?
    LIMIT 1
");

$stmt->execute([$projectId, $userId]);

$project = $stmt->fetch();

if (!$project) {
    header('Location: projects.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($project['name']) ?> | Project Continuum</title>

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

        .back {
            color: white;
            text-decoration: none;
            background: #374151;
            padding: 9px 15px;
            border-radius: 6px;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .project-header {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .project-header h2 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .description {
            color: #6b7280;
            margin-bottom: 20px;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            background: #e5e7eb;
        }

        .section {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .section h3 {
            margin-top: 0;
        }

        .empty {
            color: #6b7280;
        }
    </style>
</head>

<body>

<header class="navbar">

    <h1>Project Continuum</h1>

    <a class="back" href="projects.php">
        ← My Projects
    </a>

</header>

<main class="container">

    <div class="project-header">

        <h2>
            <?= htmlspecialchars($project['name']) ?>
        </h2>

        <p class="description">
            <?= htmlspecialchars(
                $project['description'] ?? 'No description.'
            ) ?>
        </p>

        <span class="status">
            <?= htmlspecialchars($project['status']) ?>
        </span>

    </div>

    <div class="section">

        <h3>Goals</h3>

        <p class="empty">
            No goals have been added to this project yet.
        </p>

    </div>

</main>

</body>
</html>