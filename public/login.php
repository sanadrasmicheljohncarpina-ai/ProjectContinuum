<?php
require_once __DIR__ . '/../database/database.php';
if (session_status() === PHP_SESSION_NONE) session_start();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') { $email = trim($_POST['email'] ?? ''); $password = $_POST['password'] ?? ''; if ($email === '' || $password === '') $error = 'Please enter your email and password.'; else { $stmt = $pdo->prepare('SELECT id,name,email,password FROM users WHERE email=? LIMIT 1'); $stmt->execute([$email]); $user = $stmt->fetch(); if ($user && password_verify($password, $user['password'])) { session_regenerate_id(true); $_SESSION['user_id']=$user['id']; $_SESSION['user_name']=$user['name']; $_SESSION['user_email']=$user['email']; header('Location: index.php'); exit; } $error = 'Invalid email or password.'; } }
?><!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Login | Project Continuum</title><link rel="stylesheet" href="../assets/css/app.css">
<style>
.password-field{position:relative}
.password-field input{padding-right:2.75rem}
.password-toggle{position:absolute;top:50%;right:0.75rem;transform:translateY(-50%);background:none;border:none;padding:4px;margin:0;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#6b7280;line-height:0}
.password-toggle:hover{color:#374151}
.password-toggle svg{width:20px;height:20px}
.password-toggle .icon-eye-off{display:none}
.password-toggle.is-visible .icon-eye{display:none}
.password-toggle.is-visible .icon-eye-off{display:block}
</style>
</head><body class="auth-page"><main class="auth-card"><a class="brand auth-brand" href="login.php"><span class="brand-mark">∞</span><span>Project<br>Continuum</span></a><h1>Welcome back!</h1><p>Continue your progress exactly where you left off.</p><?php if($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?><form method="post"><div class="field"><label for="email">Email</label><input type="email" id="email" name="email" placeholder="you@example.com" required></div><div class="field"><label for="password">Password</label><div class="password-field"><input type="password" id="password" name="password" placeholder="Enter your password" required><button type="button" class="password-toggle" id="togglePassword" aria-label="Show password" aria-pressed="false"><svg class="icon-eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z"/><circle cx="12" cy="12" r="3"/></svg><svg class="icon-eye-off" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a21.8 21.8 0 0 1 5.06-6.06M9.9 4.24A10.4 10.4 0 0 1 12 4c7 0 11 8 11 8a21.7 21.7 0 0 1-2.61 3.94M14.12 14.12a3 3 0 1 1-4.24-4.24"/><path d="M1 1l22 22"/></svg></button></div></div><button class="button" type="submit">Login</button></form></main></body><script>
(function(){
  var input = document.getElementById('password');
  var toggle = document.getElementById('togglePassword');
  if(!input || !toggle) return;
  toggle.addEventListener('click', function(){
    var isVisible = input.type === 'text';
    input.type = isVisible ? 'password' : 'text';
    toggle.classList.toggle('is-visible', !isVisible);
    toggle.setAttribute('aria-pressed', String(!isVisible));
    toggle.setAttribute('aria-label', isVisible ? 'Show password' : 'Hide password');
  });
})();
</script></html>
