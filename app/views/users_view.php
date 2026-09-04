<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$users = $users ?? [];
$user_count = count($users);
$active_count = $user_count;
$esc = static function ($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members | LavaLust</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --canvas: #f4f0e8; --paper: #fffdf8; --ink: #1d2928; --muted: #73807b; --line: #e4e0d7; --teal: #176b67; --teal-dark: #0e4e4d; --yellow: #f4c95d; --coral: #e27b5f; --shadow: 0 18px 45px rgba(33, 48, 45, .08); }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; color: var(--ink); background: var(--canvas); font-family: 'DM Sans', sans-serif; }
        .shell { min-height: 100vh; display: grid; grid-template-columns: 220px minmax(0, 1fr); }
        aside { display: flex; flex-direction: column; padding: 28px 18px; color: #dcece5; background: var(--teal-dark); }
        .brand { display: flex; align-items: center; gap: 10px; margin: 0 10px 64px; color: #fff; text-decoration: none; }
        .brand-mark { display: grid; width: 34px; height: 34px; place-items: center; color: var(--ink); background: var(--yellow); border-radius: 10px; font-family: 'Space Grotesk', sans-serif; font-weight: 700; }
        .brand-name { font-family: 'Space Grotesk', sans-serif; font-size: 1.08rem; font-weight: 700; letter-spacing: -.03em; }
        .nav-label { margin: 0 12px 10px; color: #7fa7a0; font-size: .68rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; }
        nav { display: grid; gap: 6px; }
        nav a { display: flex; align-items: center; gap: 12px; padding: 12px; color: #a9c5c1; border-radius: 9px; font-size: .88rem; text-decoration: none; }
        nav a:hover, nav a.active { color: #fff; background: #215f5d; }
        nav svg { width: 18px; height: 18px; }
        .sidebar-foot { margin-top: auto; padding: 16px 12px 0; color: #83aaa4; border-top: 1px solid rgba(255,255,255,.12); font-size: .76rem; line-height: 1.5; }
        main { width: min(1180px, 100%); padding: 42px clamp(24px, 5vw, 72px) 60px; }
        .eyebrow { margin: 0 0 10px; color: var(--coral); font-size: .72rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; }
        h1 { margin: 0; font-family: 'Space Grotesk', sans-serif; font-size: clamp(2rem, 4vw, 3.25rem); letter-spacing: -.06em; line-height: 1; }
        .intro { display: flex; align-items: end; justify-content: space-between; gap: 24px; margin-bottom: 34px; }
        .intro-copy { max-width: 570px; }
        .subtitle { margin: 14px 0 0; color: var(--muted); font-size: .95rem; }
        .date { color: var(--muted); font-size: .78rem; text-align: right; }
        .date strong { color: var(--ink); }
        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 28px; }
        .stat { padding: 19px 20px; background: var(--paper); border: 1px solid var(--line); border-radius: 8px; box-shadow: 0 8px 24px rgba(33, 48, 45, .04); }
        .stat-label { color: var(--muted); font-size: .75rem; font-weight: 600; }
        .stat-value { display: block; margin-top: 8px; font-family: 'Space Grotesk', sans-serif; font-size: 1.8rem; }
        .stat:nth-child(2) .stat-value { color: var(--teal); }
        .stat:nth-child(3) .stat-value { color: var(--coral); }
        .directory { overflow: hidden; background: var(--paper); border: 1px solid var(--line); border-radius: 8px; box-shadow: var(--shadow); }
        .directory-head { display: flex; align-items: center; justify-content: space-between; gap: 18px; padding: 20px 24px; border-bottom: 1px solid var(--line); }
        .directory-title { font-family: 'Space Grotesk', sans-serif; font-size: 1.05rem; font-weight: 600; }
        .directory-count { margin-left: 7px; color: var(--muted); font-size: .78rem; }
        .search { display: flex; align-items: center; gap: 9px; width: min(260px, 100%); padding: 9px 12px; color: var(--muted); background: #f7f5ef; border: 1px solid var(--line); border-radius: 6px; }
        .search svg { flex: 0 0 auto; width: 16px; }
        .search input { width: 100%; color: var(--ink); background: transparent; border: 0; outline: 0; font: inherit; font-size: .8rem; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { padding: 14px 24px; color: var(--muted); background: #faf8f2; font-size: .68rem; font-weight: 700; letter-spacing: .1em; text-align: left; text-transform: uppercase; }
        td { padding: 16px 24px; border-top: 1px solid var(--line); font-size: .86rem; white-space: nowrap; }
        tbody tr { transition: background .2s ease; }
        tbody tr:hover { background: #fff8e8; }
        .person { display: flex; align-items: center; gap: 11px; }
        .avatar { display: grid; width: 34px; height: 34px; place-items: center; color: var(--teal-dark); background: #dcece5; border-radius: 50%; font-size: .7rem; font-weight: 700; }
        tbody tr:nth-child(3n) .avatar { color: #8a4936; background: #f5ddd4; }
        .name { font-weight: 600; }
        .email, .username { color: var(--muted); }
        .id { color: var(--teal); font-family: 'Space Grotesk', sans-serif; font-size: .78rem; }
        .empty { padding: 42px 24px; color: var(--muted); text-align: center; }
        .no-results { display: none; }
        @media (max-width: 720px) {
            .shell { display: block; }
            aside { padding: 18px 16px; }
            .brand { margin-bottom: 20px; }
            .nav-label, .sidebar-foot { display: none; }
            nav { grid-template-columns: repeat(2, 1fr); }
            main { padding: 30px 16px 40px; }
            .intro { display: block; margin-bottom: 26px; }
            .date { margin-top: 16px; text-align: left; }
            .stats { gap: 8px; }
            .stat { padding: 14px 12px; }
            .stat-value { font-size: 1.4rem; }
            .directory-head { align-items: stretch; flex-direction: column; padding: 18px; }
            .search { width: 100%; }
            th, td { padding-right: 18px; padding-left: 18px; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <aside>
            <a class="brand" href="<?= $esc(base_url()); ?>"><span class="brand-mark">L</span><span class="brand-name">LavaLust</span></a>
            <p class="nav-label">Workspace</p>
            <nav aria-label="Main navigation">
                <a href="<?= $esc(base_url()); ?>"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m3 11 9-8 9 8v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-9Z"/><path d="M9 21v-6h6v6"/></svg>Overview</a>
                <a class="active" href="<?= $esc(base_url('users')); ?>" aria-current="page"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>Members</a>
            </nav>
            <p class="sidebar-foot">A considered place for your community.</p>
        </aside>
        <main>
            <div class="intro"><div class="intro-copy"><p class="eyebrow">Community / directory</p><h1>Meet the members.</h1><p class="subtitle">Keep an eye on the people shaping your LavaLust space.</p></div><p class="date">Updated today<br><strong><?= $esc(date('F j, Y')); ?></strong></p></div>
            <section class="stats" aria-label="Member statistics">
                <div class="stat"><span class="stat-label">Total members</span><strong class="stat-value"><?= $user_count; ?></strong></div>
                <div class="stat"><span class="stat-label">Active profiles</span><strong class="stat-value"><?= $active_count; ?></strong></div>
                <div class="stat"><span class="stat-label">Directory status</span><strong class="stat-value">Open</strong></div>
            </section>
            <section class="directory" aria-label="Users list">
                <div class="directory-head"><div><span class="directory-title">All members</span><span class="directory-count" id="result-count"><?= $user_count; ?> results</span></div><label class="search" for="user-search"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg><input id="user-search" type="search" placeholder="Search members..." autocomplete="off"></label></div>
                <div class="table-wrap"><table><thead><tr><th scope="col">Member</th><th scope="col">Email</th><th scope="col">Username</th><th scope="col">Member ID</th></tr></thead><tbody id="user-rows">
                    <?php foreach ($users as $user): ?>
                        <?php $initials = strtoupper(substr($user['firstname'] ?? '', 0, 1) . substr($user['lastname'] ?? '', 0, 1)); ?>
                        <tr data-search="<?= $esc(($user['firstname'] ?? '') . ' ' . ($user['lastname'] ?? '') . ' ' . ($user['email'] ?? '') . ' ' . ($user['username'] ?? '')); ?>"><td><div class="person"><span class="avatar"><?= $esc($initials); ?></span><span class="name"><?= $esc(($user['firstname'] ?? '') . ' ' . ($user['lastname'] ?? '')); ?></span></div></td><td class="email"><?= $esc($user['email'] ?? ''); ?></td><td class="username">@<?= $esc($user['username'] ?? ''); ?></td><td class="id">#<?= $esc($user['id'] ?? ''); ?></td></tr>
                    <?php endforeach; ?>
                    <tr class="no-results" id="no-results"><td colspan="4" class="empty">No members match your search.</td></tr>
                    <?php if (!$users): ?><tr><td colspan="4" class="empty">No users found.</td></tr><?php endif; ?>
                </tbody></table></div>
            </section>
        </main>
    </div>
    <script>
        const search = document.getElementById('user-search');
        const rows = [...document.querySelectorAll('#user-rows tr[data-search]')];
        const resultCount = document.getElementById('result-count');
        const noResults = document.getElementById('no-results');
        search.addEventListener('input', function () {
            const query = this.value.trim().toLowerCase();
            let visible = 0;
            rows.forEach(function (row) { const matches = row.dataset.search.toLowerCase().includes(query); row.hidden = !matches; if (matches) visible++; });
            noResults.style.display = visible || !rows.length ? 'none' : 'table-row';
            resultCount.textContent = visible + (visible === 1 ? ' result' : ' results');
        });
    </script>
</body>
</html>
