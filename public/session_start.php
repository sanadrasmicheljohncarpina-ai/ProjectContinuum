<?php
require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../app/auth.php';
requireLogin();
$projectId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$projectId) { header('Location: projects.php'); exit; }
$stmt = $pdo->prepare('SELECT id FROM projects WHERE id = ? AND user_id = ? LIMIT 1');
$stmt->execute([$projectId, $_SESSION['user_id']]);
if (!$stmt->fetch()) { header('Location: projects.php'); exit; }
$stmt = $pdo->prepare('SELECT id FROM sessions WHERE project_id = ? AND ended_at IS NULL ORDER BY started_at DESC LIMIT 1');
$stmt->execute([$projectId]); $session = $stmt->fetch();
if ($session) { header('Location: session.php?id=' . (int) $session['id']); exit; }
$stmt = $pdo->prepare('INSERT INTO sessions (project_id, started_at) VALUES (?, NOW())');
$stmt->execute([$projectId]);
header('Location: session.php?id=' . (int) $pdo->lastInsertId()); exit;
