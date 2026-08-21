<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$student_id = $student_id ?? '';
$name = $name ?? '';
$course = $course ?? '';
$year = $year ?? '';
$section = $section ?? '';
$email = $email ?? '';
$address = $address ?? '';
$contact = $contact ?? '';
$skills = $skills ?? '';
$bio = $bio ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile - <?= htmlspecialchars($name); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root { --accent: #f05a28; --bg: #0d0e10; --panel: #15171a; --line: rgba(255,255,255,0.1); --text: #f5f4f0; --muted: #92949a; --mono: 'DM Mono', monospace; --sans: 'Manrope', sans-serif; }
        body { font-family: var(--sans); background: var(--bg); color: var(--text); min-height: 100vh; overflow-x: hidden; }
        body::before { content: ''; position: fixed; width: 520px; height: 520px; top: -260px; left: -160px; background: var(--accent); opacity: 0.1; filter: blur(100px); pointer-events: none; }
        .shell { max-width: 1180px; margin: 0 auto; padding: 0 2rem; position: relative; }
        nav { display: flex; justify-content: space-between; align-items: center; padding: 1.5rem 0; border-bottom: 1px solid var(--line); }
        .brand, nav a { text-decoration: none; }
        .brand { color: var(--text); font-weight: 800; letter-spacing: -0.04em; }
        .brand span { color: var(--accent); }
        .nav-links { display: flex; gap: 0.35rem; }
        nav a { color: var(--muted); font-size: 0.78rem; font-weight: 700; padding: 0.6rem 0.9rem; border-radius: 6px; }
        nav a:hover, nav a.active { color: var(--text); background: rgba(255,255,255,0.07); }
        main { padding: 5rem 0; }
        .eyebrow { color: var(--accent); font-family: var(--mono); font-size: 0.7rem; letter-spacing: 0.14em; text-transform: uppercase; margin-bottom: 1rem; }
        .profile-layout { display: grid; grid-template-columns: 270px minmax(0, 1fr); gap: 4rem; align-items: start; }
        .profile-intro { position: sticky; top: 2rem; }
        .avatar { width: 112px; height: 112px; display: grid; place-items: center; background: var(--accent); color: #fff; font-size: 2.8rem; font-weight: 800; margin-bottom: 1.5rem; }
        .profile-intro h1 { font-size: 2rem; line-height: 1.05; letter-spacing: -0.06em; margin-bottom: 0.6rem; }
        .role { color: var(--muted); font-size: 0.85rem; line-height: 1.6; }
        .back { display: inline-block; color: var(--muted); text-decoration: none; font-size: 0.75rem; font-weight: 700; margin-top: 2rem; }
        .back:hover { color: var(--text); }
        .details { background: var(--panel); border: 1px solid var(--line); padding: 2.2rem; }
        .details-heading { display: flex; justify-content: space-between; align-items: end; gap: 1rem; border-bottom: 1px solid var(--line); padding-bottom: 1.5rem; margin-bottom: 0.5rem; }
        .details-heading h2 { font-size: 1.25rem; }
        .record { color: var(--muted); font-family: var(--mono); font-size: 0.65rem; }
        .info-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); column-gap: 3rem; }
        .row { display: flex; flex-direction: column; gap: 0.4rem; padding: 1.2rem 0; border-bottom: 1px solid var(--line); }
        .label { color: var(--accent); font-family: var(--mono); font-size: 0.62rem; text-transform: uppercase; letter-spacing: 0.08em; }
        .value { color: var(--text); font-size: 0.88rem; line-height: 1.5; overflow-wrap: anywhere; }
        .bio { margin-top: 1.8rem; padding: 1.3rem 1.5rem; border-left: 2px solid var(--accent); background: rgba(240,90,40,0.08); color: #d5d3ce; line-height: 1.7; font-size: 0.85rem; }
        @media (max-width: 760px) { .shell { padding: 0 1.2rem; } nav { align-items: flex-start; gap: 1rem; } .nav-links { flex-wrap: wrap; justify-content: flex-end; } main { padding: 3.5rem 0; } .profile-layout { grid-template-columns: 1fr; gap: 2.5rem; } .profile-intro { position: static; } .info-grid { grid-template-columns: 1fr; } .details { padding: 1.4rem; } }
    </style>
</head>
<body>

<div class="shell">
    <nav>
        <a class="brand" href="<?= site_url('student'); ?>">LAVA<span>/</span>STUDENT</a>
        <div class="nav-links">
            <a href="<?= site_url('student'); ?>">Home</a>
            <a class="active" href="<?= site_url('student/profile'); ?>">Profile</a>
        </div>
    </nav>
    <main>
        <div class="profile-layout">
            <aside class="profile-intro">
                <p class="eyebrow">Student record / 02</p>
                <div class="avatar"><?= htmlspecialchars(strtoupper(substr($name, 0, 1))); ?></div>
                <h1><?= htmlspecialchars($name); ?></h1>
                <p class="role"><?= htmlspecialchars($course); ?> / <?= htmlspecialchars($year); ?><br>Section <?= htmlspecialchars($section); ?></p>
                <a class="back" href="<?= site_url('student'); ?>">&#8592; Back to portal</a>
            </aside>
            <section class="details">
                <div class="details-heading"><h2>Personal information</h2><span class="record">ID <?= htmlspecialchars($student_id); ?></span></div>
                <div class="info-grid">
                    <div class="row"><span class="label">Full name</span><span class="value"><?= htmlspecialchars($name); ?></span></div>
                    <div class="row"><span class="label">Student ID</span><span class="value"><?= htmlspecialchars($student_id); ?></span></div>
                    <div class="row"><span class="label">Course</span><span class="value"><?= htmlspecialchars($course); ?></span></div>
                    <div class="row"><span class="label">Year level</span><span class="value"><?= htmlspecialchars($year); ?></span></div>
                    <div class="row"><span class="label">Section</span><span class="value"><?= htmlspecialchars($section); ?></span></div>
                    <div class="row"><span class="label">Email</span><span class="value"><?= htmlspecialchars($email); ?></span></div>
                    <div class="row"><span class="label">Address</span><span class="value"><?= htmlspecialchars($address); ?></span></div>
                    <div class="row"><span class="label">Contact</span><span class="value"><?= htmlspecialchars($contact); ?></span></div>
                    <div class="row"><span class="label">Skills</span><span class="value"><?= htmlspecialchars($skills); ?></span></div>
                </div>
                <p class="bio">&quot;<?= htmlspecialchars($bio); ?>&quot;</p>
            </section>
        </div>
    </main>
</div>
</body>
</html>
