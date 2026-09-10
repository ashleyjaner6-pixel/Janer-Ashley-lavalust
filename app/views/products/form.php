<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); $editing = !empty($product); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title><?= html_escape($heading) ?> | Product Ledger</title>
    <style>
        :root { --ink:#172026; --muted:#66727a; --paper:#f7f6f1; --accent:#dd5b35; --line:#d8d9d4; } * { box-sizing:border-box; } body { margin:0; background:linear-gradient(135deg,#f7f6f1,#e8eee8); color:var(--ink); font:16px Georgia,serif; } main { width:min(700px,calc(100% - 32px)); margin:70px auto; } .back { color:var(--accent); text-decoration:none; font:700 13px Arial,sans-serif; } h1 { font-size:46px; margin:14px 0 28px; } form { background:#fff; border:1px solid var(--line); padding:30px; } label { display:block; margin:18px 0 7px; font:700 13px Arial,sans-serif; } input,textarea { display:block; width:100%; padding:13px 14px; border:1px solid var(--line); background:#fff; font:16px Georgia,serif; } textarea { min-height:130px; resize:vertical; } .grid { display:grid; grid-template-columns:1fr 1fr; gap:18px; } .error { padding:12px; border-left:4px solid var(--accent); background:#fff0e9; color:#8a321b; } .actions { display:flex; gap:12px; align-items:center; margin-top:28px; } button { padding:13px 20px; border:0; background:var(--ink); color:#fff; font:700 13px Arial,sans-serif; cursor:pointer; } .cancel { color:var(--muted); font:13px Arial,sans-serif; } @media (max-width:560px) { h1 { font-size:38px; } .grid { grid-template-columns:1fr; gap:0; } }
    </style>
</head>
<body><main>
    <a class="back" href="<?= site_url('/products') ?>">← Back to products</a><h1><?= html_escape($heading) ?></h1>
    <?php if ($error): ?><div class="error"><?= html_escape($error) ?></div><?php endif; ?>
    <form method="post" action="<?= $editing ? site_url('/products/edit/' . (int) $product['id']) : site_url('/products/create') ?>">
        <label for="product_name">Product name</label><input id="product_name" name="product_name" maxlength="100" required value="<?= html_escape($product['product_name'] ?? '') ?>">
        <label for="description">Description</label><textarea id="description" name="description"><?= html_escape($product['description'] ?? '') ?></textarea>
        <div class="grid"><div><label for="price">Price</label><input id="price" name="price" type="number" min="0" step="0.01" required value="<?= html_escape($product['price'] ?? '0.00') ?>"></div><div><label for="quantity">Quantity</label><input id="quantity" name="quantity" type="number" min="0" step="1" required value="<?= html_escape($product['quantity'] ?? '0') ?>"></div></div>
        <div class="actions"><button type="submit"><?= $editing ? 'Save changes' : 'Create product' ?></button><a class="cancel" href="<?= site_url('/products') ?>">Cancel</a></div>
    </form>
</main></body></html>
