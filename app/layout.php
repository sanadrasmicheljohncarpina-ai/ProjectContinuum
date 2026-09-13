<?php

function continuumIcon(string $icon): string
{
    $icons = [
        'dashboard' => '⌂', 'projects' => '▣', 'sessions' => '◷', 'goals' => '✓',
        'calendar' => '□', 'notes' => '▤', 'analytics' => '▥', 'settings' => '⚙',
    ];

    return $icons[$icon] ?? '•';
}

function renderSidebar(string $active = ''): void
{
    $items = [
        'dashboard' => ['Dashboard', 'index.php'],
        'projects' => ['Projects', 'projects.php'],
        'sessions' => ['Sessions', 'sessions.php'],
        'goals' => ['Goals', 'projects.php'],
        'calendar' => ['Calendar', 'projects.php'],
        'notes' => ['Notes', 'projects.php'],
        'analytics' => ['Analytics', 'projects.php'],
        'settings' => ['Settings', 'projects.php'],
    ];
    ?>
    <aside class="sidebar">
        <a class="brand" href="index.php"><span class="brand-mark">∞</span><span>Project<br>Continuum</span></a>
        <nav class="nav-menu">
            <?php foreach ($items as $key => [$label, $href]): ?>
                <a class="nav-link <?= $active === $key ? 'is-active' : '' ?>" href="<?= $href ?>"><span><?= continuumIcon($key) ?></span><?= $label ?></a>
            <?php endforeach; ?>
        </nav>
        <div class="sidebar-footer">
            <div class="user-mini"><div class="avatar"><?= htmlspecialchars(strtoupper(substr($_SESSION['user_name'] ?? 'U', 0, 1))) ?></div><div><strong><?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?></strong><small>Focus · Progress · Continuity</small></div></div>
            <a class="logout-link" href="logout.php">↪ &nbsp;Logout</a>
        </div>
    </aside>
    <?php
}

function statusClass(?string $status): string
{
    return match (strtolower((string) $status)) {
        'completed', 'complete', 'done' => 'completed',
        'planning', 'pending' => 'planning',
        'on hold', 'paused' => 'on-hold',
        default => 'in-progress',
    };
}

function statusLabel(?string $status): string
{
    return ucfirst(str_replace('_', ' ', (string) ($status ?: 'In progress')));
}
