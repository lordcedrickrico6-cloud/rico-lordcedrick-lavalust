<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$name = $name ?? '';
$denied = $denied ?? false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - Home</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root { --accent: #f05a28; --bg: #0d0e10; --panel: #15171a; --line: rgba(255,255,255,0.1); --text: #f5f4f0; --muted: #92949a; --mono: 'DM Mono', monospace; --sans: 'Manrope', sans-serif; }
        body { font-family: var(--sans); background: var(--bg); color: var(--text); min-height: 100vh; overflow-x: hidden; }
        body::before { content: ''; position: fixed; width: 520px; height: 520px; top: -260px; right: -120px; background: var(--accent); opacity: 0.1; filter: blur(100px); pointer-events: none; }
        .shell { max-width: 1180px; margin: 0 auto; padding: 0 2rem; position: relative; }
        nav { display: flex; justify-content: space-between; align-items: center; padding: 1.5rem 0; border-bottom: 1px solid var(--line); }
        .brand, nav a { text-decoration: none; }
        .brand { color: var(--text); font-weight: 800; letter-spacing: -0.04em; }
        .brand span { color: var(--accent); }
        .nav-links { display: flex; gap: 0.35rem; }
        nav a { color: var(--muted); font-size: 0.78rem; font-weight: 700; padding: 0.6rem 0.9rem; border-radius: 6px; }
        nav a:hover, nav a.active { color: var(--text); background: rgba(255,255,255,0.07); }
        main { padding: 6rem 0 5rem; }
        .eyebrow { color: var(--accent); font-family: var(--mono); font-size: 0.7rem; letter-spacing: 0.14em; text-transform: uppercase; margin-bottom: 1.2rem; }
        .layout { display: grid; grid-template-columns: minmax(0, 1.15fr) minmax(300px, 0.85fr); gap: 7rem; align-items: center; }
        h1 { max-width: 680px; font-size: clamp(2.8rem, 7vw, 5.8rem); line-height: 0.98; letter-spacing: -0.07em; }
        h1 span { color: var(--accent); }
        .sub { max-width: 520px; color: var(--muted); line-height: 1.8; margin: 1.8rem 0 2.2rem; font-size: 1rem; }
        .actions { display: flex; align-items: center; gap: 1rem; flex-wrap: wrap; }
        .btn { display: inline-flex; align-items: center; gap: 0.6rem; color: #fff; background: var(--accent); padding: 0.85rem 1.2rem; border-radius: 6px; font-weight: 800; font-size: 0.8rem; text-decoration: none; transition: transform 0.2s, background 0.2s; }
        .btn:hover { background: #ff6f38; transform: translateY(-2px); }
        .quiet { color: var(--muted); text-decoration: none; font-size: 0.8rem; font-weight: 700; }
        .quiet:hover { color: var(--text); }
        .snapshot { background: var(--panel); border: 1px solid var(--line); padding: 2rem; position: relative; }
        .snapshot::before { content: ''; position: absolute; inset: 10px -10px -10px 10px; border: 1px solid rgba(240,90,40,0.25); z-index: -1; }
        .snapshot-top { display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 1px solid var(--line); padding-bottom: 1.5rem; margin-bottom: 1.5rem; }
        .badge-icon { width: 52px; height: 52px; display: grid; place-items: center; background: var(--accent); color: #fff; font-weight: 800; font-size: 1.2rem; }
        .status { color: #9ed6ae; font-family: var(--mono); font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.08em; }
        .snapshot h2 { font-size: 1.1rem; margin-bottom: 0.35rem; }
        .snapshot p { color: var(--muted); font-size: 0.78rem; line-height: 1.6; }
        .notice { color: #ffad91; background: rgba(240,90,40,0.1); border-left: 2px solid var(--accent); padding: 0.8rem 1rem; font-size: 0.75rem; line-height: 1.6; margin-bottom: 1.5rem; }
        .meta { display: flex; justify-content: space-between; color: var(--muted); font-family: var(--mono); font-size: 0.68rem; }
        @media (max-width: 760px) { .shell { padding: 0 1.2rem; } nav { align-items: flex-start; gap: 1rem; } .nav-links { flex-wrap: wrap; justify-content: flex-end; } main { padding: 4rem 0 3rem; } .layout { grid-template-columns: 1fr; gap: 4rem; } h1 { font-size: clamp(3rem, 15vw, 5rem); } }
    </style>
</head>
<body>

<div class="shell">
    <nav>
        <a class="brand" href="<?= site_url('student'); ?>">LAVA<span>/</span>STUDENT</a>
        <div class="nav-links">
            <a class="active" href="<?= site_url('student'); ?>">Home</a>
            <a href="<?= site_url('student/profile'); ?>">Profile</a>
        </div>
    </nav>
    <main>
        <div class="layout">
            <section>
                <p class="eyebrow">Student portal / 01</p>
                <h1>Welcome back,<br><span><?= htmlspecialchars($name); ?></span></h1>
                <p class="sub">Your personal academic space is ready. Check your student record, review your information, and keep moving forward.</p>
                <div class="actions">
                    <a class="btn" href="<?= site_url('student/profile'); ?>">Open profile <span aria-hidden="true">&#8594;</span></a>
                    <a class="quiet" href="<?= site_url('student/profile'); ?>">View student record</a>
                </div>
            </section>
            <aside class="snapshot">
                <div class="snapshot-top">
                    <div class="badge-icon">LS</div>
                    <span class="status">Access active</span>
                </div>
                <h2>Portal access granted</h2>
                <p>Your temporary access badge is active for the student profile area.</p>
                <?php if ($denied): ?>
                    <div class="notice">Your first profile request needed a badge. This visit has activated it for you.</div>
                <?php endif; ?>
                <div class="meta"><span>SESSION 01</span><span>READY</span></div>
            </aside>
        </div>
    </main>
</div>
</body>
</html>
