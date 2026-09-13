<?php

require_once __DIR__ . '/../app/auth.php';

logoutUser();

header('Location: login.php');
exit;