<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$is_edit = ($mode === 'edit');
$form_action = $is_edit ? base_url('products/edit/' . $product['id']) : base_url('products/create');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $is_edit ? 'Edit' : 'Add'; ?> product | LavaLust Console</title>
    <style>
        :root { --ink: #17302f; --muted: #70817d; --paper: #f5f1e8; --panel: #fffdf8; --line: #e3ded3; --teal: #176b67; --coral: #df765b; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; color: var(--ink); background: var(--paper); font-family: Arial, sans-serif; }
        main { width: min(760px, calc(100% - 32px)); margin: 0 auto; padding: 45px 0 65px; }
        .back { color: var(--teal); font-size: .78rem; font-weight: 700; text-decoration: none; }
        .heading { display: flex; align-items: end; justify-content: space-between; gap: 20px; margin: 27px 0 28px; }
        .eyebrow { margin: 0 0 10px; color: var(--coral); font: 700 .7rem Arial, sans-serif; letter-spacing: .15em; text-transform: uppercase; }
        h1 { margin: 0; font: 400 clamp(2.5rem, 6vw, 4.5rem)/.95 Georgia, serif; letter-spacing: -.06em; }
        .heading-note { max-width: 190px; margin: 0; color: var(--muted); font-size: .82rem; line-height: 1.5; text-align: right; }
        .form-panel { padding: clamp(22px, 5vw, 40px); background: var(--panel); border: 1px solid var(--line); border-radius: 5px; box-shadow: 0 16px 38px rgba(44, 66, 59, .07); }
        .msg { margin-bottom: 20px; padding: 12px 14px; color: #8d3e31; background: #fbe9e3; border-left: 3px solid var(--coral); font-size: .84rem; }
        .msg.success { color: #356143; background: #e8f3e8; border-color: #5f9a68; }
        label { display: block; margin: 20px 0 8px; font-size: .74rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; }
        label:first-of-type { margin-top: 0; }
        input, textarea { width: 100%; padding: 13px 14px; color: var(--ink); background: #fff; border: 1px solid var(--line); border-radius: 4px; outline: 0; font: 1rem Arial, sans-serif; }
        textarea { min-height: 135px; resize: vertical; line-height: 1.5; }
        input:focus, textarea:focus { border-color: var(--teal); box-shadow: 0 0 0 3px rgba(23, 107, 103, .12); }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .actions { display: flex; justify-content: flex-end; gap: 9px; margin-top: 30px; }
        .button { padding: 12px 15px; color: #fff; background: var(--teal); border: 0; border-radius: 4px; cursor: pointer; font: 700 .78rem Arial, sans-serif; text-decoration: none; }
        .button:hover { background: #0f5956; }
        .button.cancel { color: var(--ink); background: transparent; border: 1px solid var(--line); }
        @media (max-width: 560px) { main { padding-top: 30px; } .heading { align-items: flex-start; flex-direction: column; } .heading-note { max-width: none; text-align: left; } .grid { grid-template-columns: 1fr; gap: 0; } .actions { justify-content: stretch; } .actions .button { flex: 1; text-align: center; } }
    </style>
</head>
<body>
<main>
    <a class="back" href="<?= base_url('products'); ?>">&larr; Back to product desk</a>
    <div class="heading"><div><p class="eyebrow">Inventory / <?= $is_edit ? 'update' : 'new item'; ?></p><h1><?= $is_edit ? 'Edit product.' : 'Add a product.'; ?></h1></div><p class="heading-note">Keep the catalog useful with a clear name, honest description, and current stock.</p></div>
    <section class="form-panel">
        <?php if (!empty($error)): ?><div class="msg" role="alert"><?= htmlspecialchars($error); ?></div><?php endif; ?>
        <?php if (!empty($success)): ?><div class="msg success" role="status"><?= htmlspecialchars($success); ?></div><?php endif; ?>
        <form method="post" action="<?= $form_action; ?>">
            <label for="product_name">Product name</label>
            <input type="text" id="product_name" name="product_name" maxlength="100" required value="<?= htmlspecialchars($product['product_name'] ?? ''); ?>" autofocus>
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="What should your team know about this item?"><?= htmlspecialchars($product['description'] ?? ''); ?></textarea>
            <div class="grid"><div><label for="price">Price</label><input type="number" id="price" name="price" step="0.01" min="0" required value="<?= htmlspecialchars($product['price'] ?? ''); ?>"></div><div><label for="quantity">Quantity</label><input type="number" id="quantity" name="quantity" step="1" min="0" required value="<?= htmlspecialchars($product['quantity'] ?? ''); ?>"></div></div>
            <div class="actions"><a class="button cancel" href="<?= base_url('products'); ?>">Cancel</a><button class="button" type="submit"><?= $is_edit ? 'Save changes' : 'Create product'; ?></button></div>
        </form>
    </section>
</main>
</body>
</html>
