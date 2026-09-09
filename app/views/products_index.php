<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$is_admin = (($_SESSION['role'] ?? null) === 'admin');
$product_count = count($products ?? []);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | LavaLust Console</title>
    <style>
        :root { --ink: #17302f; --muted: #70817d; --paper: #f5f1e8; --panel: #fffdf8; --line: #e3ded3; --teal: #176b67; --teal-dark: #0f4545; --coral: #df765b; --yellow: #f2c75b; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; color: var(--ink); background: var(--paper); font-family: Arial, sans-serif; }
        .shell { min-height: 100vh; display: grid; grid-template-columns: 225px minmax(0, 1fr); }
        aside { display: flex; flex-direction: column; padding: 28px 18px; color: #cfe1da; background: var(--teal-dark); }
        .brand { display: flex; align-items: center; gap: 11px; margin: 0 10px 62px; color: #fff; font: 700 1rem Georgia, serif; text-decoration: none; }
        .mark { display: grid; width: 36px; height: 36px; place-items: center; color: var(--ink); background: var(--yellow); border-radius: 9px; font-weight: 700; }
        .nav-label { margin: 0 12px 10px; color: #82a9a1; font-size: .68rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; }
        nav { display: grid; gap: 6px; }
        nav a { padding: 12px; color: #a9c5c1; border-radius: 5px; font-size: .86rem; text-decoration: none; }
        nav a:hover, nav a.active { color: #fff; background: #215f5d; }
        .sidebar-foot { margin: auto 12px 0; padding-top: 18px; color: #82a9a1; border-top: 1px solid rgba(255,255,255,.14); font-size: .75rem; line-height: 1.5; }
        main { width: min(1220px, 100%); padding: 44px clamp(22px, 5vw, 70px) 64px; }
        .topline { display: flex; align-items: flex-end; justify-content: space-between; gap: 20px; margin-bottom: 30px; }
        .eyebrow { margin: 0 0 10px; color: var(--coral); font: 700 .7rem Arial, sans-serif; letter-spacing: .15em; text-transform: uppercase; }
        h1 { margin: 0; font: 400 clamp(2.3rem, 5vw, 4.2rem)/.95 Georgia, serif; letter-spacing: -.06em; }
        .intro { margin: 13px 0 0; color: var(--muted); font-size: .88rem; }
        .actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; justify-content: flex-end; }
        .user { color: var(--muted); font-size: .78rem; }
        .user strong { color: var(--ink); }
        .role { display: inline-block; margin-left: 5px; padding: 3px 7px; color: var(--teal); background: #dcece5; border-radius: 3px; font-size: .68rem; font-weight: 700; text-transform: uppercase; }
        .button { display: inline-block; padding: 11px 14px; color: #fff; background: var(--teal); border: 0; border-radius: 4px; cursor: pointer; font: 700 .78rem Arial, sans-serif; text-decoration: none; }
        .button:hover { background: #0f5956; }
        .button.ghost { color: var(--ink); background: transparent; border: 1px solid var(--line); }
        .button.danger { color: #a34536; background: transparent; border: 1px solid #e8b9ad; }
        .button.small { padding: 7px 9px; font-size: .72rem; }
        .msg { margin-bottom: 22px; padding: 12px 14px; border-left: 3px solid; font-size: .84rem; }
        .msg.success { color: #356143; background: #e8f3e8; border-color: #5f9a68; }
        .msg.error { color: #8d3e31; background: #fbe9e3; border-color: var(--coral); }
        .summary { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 12px; margin-bottom: 24px; }
        .stat { padding: 17px 18px; background: var(--panel); border: 1px solid var(--line); border-radius: 5px; }
        .stat span { display: block; color: var(--muted); font-size: .72rem; text-transform: uppercase; letter-spacing: .08em; }
        .stat strong { display: block; margin-top: 8px; font: 400 1.65rem Georgia, serif; }
        .table-panel { overflow: hidden; background: var(--panel); border: 1px solid var(--line); border-radius: 5px; box-shadow: 0 16px 38px rgba(44, 66, 59, .07); }
        .table-head { display: flex; align-items: center; justify-content: space-between; gap: 15px; padding: 18px 20px; border-bottom: 1px solid var(--line); }
        .table-title { font: 700 1rem Georgia, serif; }
        .table-count { color: var(--muted); font-size: .78rem; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; min-width: 760px; border-collapse: collapse; }
        th, td { padding: 15px 20px; text-align: left; border-bottom: 1px solid var(--line); }
        th { color: var(--muted); background: #faf8f2; font-size: .68rem; letter-spacing: .1em; text-transform: uppercase; }
        td { font-size: .84rem; }
        tbody tr:hover { background: #fff8e8; }
        tbody tr:last-child td { border-bottom: 0; }
        .product-name { font-weight: 700; }
        .product-id { margin-right: 8px; color: var(--teal); font-size: .72rem; }
        .desc { max-width: 280px; color: var(--muted); line-height: 1.4; }
        .numeric { white-space: nowrap; }
        .price { font-weight: 700; }
        .row-actions { display: flex; gap: 7px; }
        .inline { display: inline; }
        .empty { padding: 45px 20px; color: var(--muted); text-align: center; }
        @media (max-width: 820px) { .shell { display: block; } aside { padding: 18px 16px; } .brand { margin-bottom: 20px; } .nav-label, .sidebar-foot { display: none; } nav { grid-template-columns: repeat(2, 1fr); } main { padding: 32px 16px 45px; } .topline { align-items: flex-start; flex-direction: column; } .actions { justify-content: flex-start; } }
        @media (max-width: 560px) { .summary { grid-template-columns: 1fr; } .user { width: 100%; } .table-head { align-items: flex-start; flex-direction: column; } }
    </style>
</head>
<body>
<div class="shell">
    <aside>
        <a class="brand" href="<?= base_url(); ?>"><span class="mark">L</span> LavaLust Console</a>
        <p class="nav-label">Workspace</p>
        <nav aria-label="Main navigation"><a class="active" href="<?= base_url('products'); ?>" aria-current="page">Products</a><a href="<?= base_url('users'); ?>">Members</a></nav>
        <p class="sidebar-foot">A clear desk for the work ahead.</p>
    </aside>
    <main>
        <div class="topline"><div><p class="eyebrow">Inventory / overview</p><h1>Product desk.</h1><p class="intro">A focused view of everything your team keeps moving.</p></div><div class="actions"><span class="user">Signed in as <strong><?= htmlspecialchars($_SESSION['username'] ?? ''); ?></strong><?php if (!$is_admin): ?><span class="role">View only</span><?php endif; ?></span><?php if ($is_admin): ?><a class="button" href="<?= base_url('products/create'); ?>">Add product</a><?php endif; ?><a class="button ghost" href="<?= base_url('logout'); ?>">Sign out</a></div></div>
+        <?php if (!empty($success)): ?><div class="msg success" role="status"><?= htmlspecialchars($success); ?></div><?php endif; ?>
+        <?php if (!empty($error)): ?><div class="msg error" role="alert"><?= htmlspecialchars($error); ?></div><?php endif; ?>
+        <section class="summary" aria-label="Inventory summary"><div class="stat"><span>Catalog items</span><strong><?= $product_count; ?></strong></div><div class="stat"><span>Access level</span><strong><?= $is_admin ? 'Admin' : 'Viewer'; ?></strong></div><div class="stat"><span>Workspace</span><strong>Live</strong></div></section>
+        <section class="table-panel" aria-label="Product inventory"><div class="table-head"><span class="table-title">All products</span><span class="table-count"><?= $product_count; ?> <?= $product_count === 1 ? 'item' : 'items'; ?></span></div><div class="table-wrap"><table><thead><tr><th>Product</th><th>Description</th><th>Price</th><th>Quantity</th><th>Created</th><?php if ($is_admin): ?><th>Actions</th><?php endif; ?></tr></thead><tbody>
+            <?php if (!empty($products)): ?>
+                <?php foreach ($products as $product): ?><tr><td><span class="product-id">#<?= htmlspecialchars($product['id']); ?></span><span class="product-name"><?= htmlspecialchars($product['product_name']); ?></span></td><td class="desc"><?= htmlspecialchars($product['description']); ?></td><td class="numeric price">&#8369;<?= number_format((float) $product['price'], 2); ?></td><td class="numeric"><?= htmlspecialchars($product['quantity']); ?></td><td class="numeric"><?= htmlspecialchars($product['created_at'] ?? ''); ?></td><?php if ($is_admin): ?><td><div class="row-actions"><a class="button ghost small" href="<?= base_url('products/edit/' . $product['id']); ?>">Edit</a><form class="inline" method="post" action="<?= base_url('products/delete/' . $product['id']); ?>" onsubmit="return confirm('Delete this product?');"><button type="submit" class="button danger small">Delete</button></form></div></td><?php endif; ?></tr><?php endforeach; ?>
+            <?php else: ?><tr><td colspan="<?= $is_admin ? 6 : 5; ?>" class="empty"><?= $is_admin ? 'No products yet. Add the first item to your catalog.' : 'No products have been added yet.'; ?></td></tr><?php endif; ?>
+        </tbody></table></div></section>
+    </main>
+</div>
+</body>
+</html>
