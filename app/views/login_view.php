<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in | LavaLust Console</title>
    <style>
        :root { --ink: #17302f; --muted: #70817d; --paper: #f5f1e8; --panel: #fffdf8; --line: #e3ded3; --teal: #176b67; --teal-dark: #0f4545; --coral: #df765b; --yellow: #f2c75b; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; color: var(--ink); background: var(--paper); font-family: Georgia, serif; }
        .page { display: grid; min-height: 100vh; grid-template-columns: minmax(0, 1.05fr) minmax(380px, .95fr); }
        .story { display: flex; flex-direction: column; justify-content: space-between; padding: clamp(28px, 6vw, 82px); color: #e8f0e9; background: var(--teal-dark); }
        .brand { display: flex; align-items: center; gap: 11px; color: #fff; font: 700 1rem/1 Georgia, serif; text-decoration: none; }
        .mark { display: grid; width: 36px; height: 36px; place-items: center; color: var(--ink); background: var(--yellow); border-radius: 9px; font-weight: 700; }
        .story-copy { max-width: 500px; padding: 40px 0; }
        .eyebrow { margin: 0 0 18px; color: var(--yellow); font: 700 .72rem/1 Arial, sans-serif; letter-spacing: .16em; text-transform: uppercase; }
        h1 { max-width: 560px; margin: 0; font-size: clamp(2.8rem, 6vw, 6.5rem); line-height: .94; letter-spacing: -.055em; }
        .story-copy p:last-child { max-width: 370px; margin: 25px 0 0; color: #a9c5c1; font: 1rem/1.65 Arial, sans-serif; }
        .quote { margin: 0; color: #8db0aa; font: .78rem/1.5 Arial, sans-serif; }
        .form-side { display: grid; place-items: center; padding: 30px; background: #fbf9f4; }
        .card { width: min(100%, 420px); }
        .card-header { margin-bottom: 28px; }
        .card-header h2 { margin: 0 0 8px; font-size: 2rem; letter-spacing: -.04em; }
        .card-header p { margin: 0; color: var(--muted); font: .9rem/1.5 Arial, sans-serif; }
        .msg { margin-bottom: 18px; padding: 12px 14px; border-left: 3px solid; font: .84rem/1.45 Arial, sans-serif; }
        .msg.info { color: #315b65; background: #e6f2f0; border-color: var(--teal); }
        .msg.success { color: #356143; background: #e8f3e8; border-color: #5f9a68; }
        .msg.error { color: #8d3e31; background: #fbe9e3; border-color: var(--coral); }
        label { display: block; margin: 18px 0 8px; font: 700 .75rem/1 Arial, sans-serif; letter-spacing: .08em; text-transform: uppercase; }
        input { width: 100%; padding: 13px 14px; color: var(--ink); background: #fff; border: 1px solid var(--line); border-radius: 5px; outline: 0; font: 1rem Georgia, serif; }
        input:focus { border-color: var(--teal); box-shadow: 0 0 0 3px rgba(23, 107, 103, .12); }
        button { width: 100%; margin-top: 25px; padding: 14px 16px; color: #fff; background: var(--teal); border: 0; border-radius: 5px; cursor: pointer; font: 700 .9rem Arial, sans-serif; }
        button:hover { background: #0f5956; }
        .footer-link { margin-top: 24px; color: var(--muted); text-align: center; font: .84rem Arial, sans-serif; }
        .footer-link a { color: var(--teal); font-weight: 700; text-decoration: none; }
        @media (max-width: 760px) { .page { display: block; } .story { min-height: 290px; padding: 25px 22px; } .story-copy { padding: 38px 0 10px; } h1 { font-size: clamp(2.7rem, 13vw, 4.8rem); } .quote { display: none; } .form-side { padding: 42px 22px 55px; } }
    </style>
</head>
<body>
<div class="page">
    <section class="story" aria-label="LavaLust Console">
        <a class="brand" href="<?= base_url(); ?>"><span class="mark">L</span> LavaLust Console</a>
        <div class="story-copy"><p class="eyebrow">A calmer inventory desk</p><h1>Make room for good work.</h1><p>Keep your product catalog clear, current, and ready for the next decision.</p></div>
        <p class="quote">Private workspace / Built for your team</p>
    </section>
    <main class="form-side">
        <div class="card">
            <header class="card-header"><h2>Welcome back.</h2><p>Sign in to continue to your product workspace.</p></header>
            <?php if (!empty($denied)): ?><div class="msg info" role="status">Please sign in to continue.</div><?php endif; ?>
            <?php if (!empty($registered)): ?><div class="msg success" role="status">Account created. You can now sign in.</div><?php endif; ?>
            <?php if (!empty($error)): ?><div class="msg error" role="alert"><?= htmlspecialchars($error); ?></div><?php endif; ?>
            <form method="post" action="<?= base_url('login'); ?>">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" autocomplete="username" required autofocus>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" autocomplete="current-password" required>
                <button type="submit">Enter workspace</button>
            </form>
            <div class="footer-link">New to the workspace? <a href="<?= base_url('register'); ?>">Create an account</a></div>
        </div>
    </main>
</div>
</body>
</html>
<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Product Manager</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #f4f7fb 0%, #e8edf5 100%);
            color: #1f2937;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }
        .card {
            background: #fff;
            width: 100%;
            max-width: 380px;
            padding: 2.25rem 2rem;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        h1 { font-size: 1.4rem; margin-bottom: .35rem; }
        p.subtitle { color: #6b7280; font-size: .88rem; margin-bottom: 1.5rem; }
        label { display: block; font-size: .85rem; font-weight: 600; margin-bottom: .35rem; }
        input {
            width: 100%;
            padding: .65rem .8rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: .95rem;
            margin-bottom: 1rem;
        }
        input:focus { outline: none; border-color: #2563eb; }
        button {
            width: 100%;
            padding: .7rem;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: .95rem;
            font-weight: 600;
            cursor: pointer;
        }
        button:hover { background: #1d4ed8; }
        .msg {
            padding: .7rem .9rem;
            border-radius: 8px;
            font-size: .85rem;
            margin-bottom: 1rem;
        }
        .msg.error { background: #fee2e2; color: #991b1b; }
        .msg.info { background: #dbeafe; color: #1e40af; }
        .msg.success { background: #dcfce7; color: #166534; }
        .footer-link { text-align: center; margin-top: 1.25rem; font-size: .85rem; color: #6b7280; }
        .footer-link a { color: #2563eb; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
<div class="card">
    <h1>Welcome back</h1>
    <p class="subtitle">Sign in to manage your products.</p>

    <?php if (!empty($denied)): ?>
        <div class="msg info">Please log in to continue.</div>
    <?php endif; ?>
    <?php if (!empty($registered)): ?>
        <div class="msg success">Account created. You can now log in.</div>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <div class="msg error"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('login'); ?>">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" autocomplete="username" required autofocus>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" autocomplete="current-password" required>

        <button type="submit">Log In</button>
    </form>

    <div class="footer-link">
        Don't have an account? <a href="<?= base_url('register'); ?>">Register</a>
    </div>
</div>
</body>
</html>
