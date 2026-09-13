<?php
require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../app/auth.php';
requireLogin();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: projects.php'); exit; }
$goalId = filter_input(INPUT_POST, 'goal_id', FILTER_VALIDATE_INT); $projectId = filter_input(INPUT_POST, 'project_id', FILTER_VALIDATE_INT);
if (!$goalId || !$projectId) { header('Location: projects.php'); exit; }
$stmt = $pdo->prepare('SELECT g.id, g.status FROM goals g JOIN projects p ON p.id = g.project_id WHERE g.id = ? AND g.project_id = ? AND p.user_id = ? LIMIT 1');
$stmt->execute([$goalId, $projectId, $_SESSION['user_id']]); $goal = $stmt->fetch();
if ($goal) { $completed = strtolower($goal['status']) === 'completed'; $stmt = $pdo->prepare('UPDATE goals SET status = ?, completed_at = ? WHERE id = ?'); $stmt->execute([$completed ? 'active' : 'completed', $completed ? null : date('Y-m-d H:i:s'), $goalId]); }
header('Location: project.php?id=' . $projectId . '#goals'); exit;
