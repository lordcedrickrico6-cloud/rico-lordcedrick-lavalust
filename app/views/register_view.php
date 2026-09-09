<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create account | LavaLust Console</title>
    <style>
        :root { --ink: #17302f; --muted: #70817d; --paper: #f5f1e8; --line: #e3ded3; --teal: #176b67; --teal-dark: #0f4545; --coral: #df765b; --yellow: #f2c75b; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; color: var(--ink); background: var(--paper); font-family: Georgia, serif; }
        .page { display: grid; min-height: 100vh; grid-template-columns: minmax(0, 1.05fr) minmax(380px, .95fr); }
        .story { display: flex; flex-direction: column; justify-content: space-between; padding: clamp(28px, 6vw, 82px); color: #e8f0e9; background: var(--teal-dark); }
        .brand { display: flex; align-items: center; gap: 11px; color: #fff; font-weight: 700; text-decoration: none; }
        .mark { display: grid; width: 36px; height: 36px; place-items: center; color: var(--ink); background: var(--yellow); border-radius: 9px; }
        .story-copy { max-width: 500px; padding: 40px 0; }
        .eyebrow { margin: 0 0 18px; color: var(--yellow); font: 700 .72rem Arial, sans-serif; letter-spacing: .16em; text-transform: uppercase; }
        h1 { margin: 0; font-size: clamp(2.8rem, 6vw, 6.5rem); line-height: .94; letter-spacing: -.055em; }
        .story-copy p:last-child { max-width: 370px; margin: 25px 0 0; color: #a9c5c1; font: 1rem/1.65 Arial, sans-serif; }
        .quote { margin: 0; color: #8db0aa; font: .78rem Arial, sans-serif; }
        .form-side { display: grid; place-items: center; padding: 30px; background: #fbf9f4; }
        .card { width: min(100%, 420px); }
        .card-header { margin-bottom: 28px; }
        .card-header h2 { margin: 0 0 8px; font-size: 2rem; letter-spacing: -.04em; }
        .card-header p { margin: 0; color: var(--muted); font: .9rem/1.5 Arial, sans-serif; }
        .msg { margin-bottom: 18px; padding: 12px 14px; color: #8d3e31; background: #fbe9e3; border-left: 3px solid var(--coral); font: .84rem/1.45 Arial, sans-serif; }
        label { display: block; margin: 18px 0 8px; font: 700 .75rem Arial, sans-serif; letter-spacing: .08em; text-transform: uppercase; }
        input { width: 100%; padding: 13px 14px; color: var(--ink); background: #fff; border: 1px solid var(--line); border-radius: 5px; outline: 0; font: 1rem Georgia, serif; }
        input:focus { border-color: var(--teal); box-shadow: 0 0 0 3px rgba(23, 107, 103, .12); }
        .hint { margin: 8px 0 0; color: var(--muted); font: .75rem Arial, sans-serif; }
        button { width: 100%; margin-top: 25px; padding: 14px 16px; color: #fff; background: var(--teal); border: 0; border-radius: 5px; cursor: pointer; font: 700 .9rem Arial, sans-serif; }
        .footer-link { margin-top: 24px; color: var(--muted); text-align: center; font: .84rem Arial, sans-serif; }
        .footer-link a { color: var(--teal); font-weight: 700; text-decoration: none; }
        @media (max-width: 760px) { .page { display: block; } .story { min-height: 290px; padding: 25px 22px; } .story-copy { padding: 38px 0 10px; } h1 { font-size: clamp(2.7rem, 13vw, 4.8rem); } .quote { display: none; } .form-side { padding: 42px 22px 55px; } }
    </style>
</head>
<body>
<div class="page">
    <section class="story" aria-label="LavaLust Console">
        <a class="brand" href="<?= base_url(); ?>"><span class="mark">L</span> LavaLust Console</a>
        <div class="story-copy"><p class="eyebrow">Make your space</p><h1>Start with a clean slate.</h1><p>Create your account and bring your product workflow into focus.</p></div>
        <p class="quote">Private workspace / Built for your team</p>
    </section>
    <main class="form-side">
        <div class="card">
            <header class="card-header"><h2>Create your account.</h2><p>A few details, then you are ready to go.</p></header>
            <?php if (!empty($error)): ?><div class="msg" role="alert"><?= htmlspecialchars($error); ?></div><?php endif; ?>
            <form method="post" action="<?= base_url('register'); ?>">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" autocomplete="username" required autofocus>
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" autocomplete="email" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" autocomplete="new-password" minlength="6" required>
                <p class="hint">Use at least 6 characters.</p>
                <button type="submit">Create account</button>
            </form>
            <div class="footer-link">Already have an account? <a href="<?= base_url('login'); ?>">Sign in</a></div>
        </div>
    </main>
</div>
</body>
</html>
