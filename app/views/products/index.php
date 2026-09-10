<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products | Product Ledger</title>
    <style>
        :root { --ink:#172026; --muted:#66727a; --paper:#f7f6f1; --accent:#dd5b35; --line:#d8d9d4; } * { box-sizing:border-box; } body { margin:0; background:var(--paper); color:var(--ink); font:16px Georgia,serif; } header,main { width:min(1080px,calc(100% - 32px)); margin:auto; } header { padding:34px 0 24px; display:flex; justify-content:space-between; align-items:end; border-bottom:2px solid var(--ink); } .kicker { color:var(--accent); font:700 12px Arial,sans-serif; letter-spacing:.14em; text-transform:uppercase; } h1 { margin:8px 0 0; font-size:46px; } .user { color:var(--muted); text-align:right; font:13px Arial,sans-serif; } a,button { color:inherit; } .button { display:inline-block; padding:11px 16px; background:var(--ink); color:#fff; text-decoration:none; font:700 13px Arial,sans-serif; } main { padding:34px 0 70px; } .toolbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:18px; } .count { color:var(--muted); } .table-wrap { overflow-x:auto; background:#fff; border:1px solid var(--line); } table { width:100%; border-collapse:collapse; min-width:720px; } th,td { padding:16px; text-align:left; border-bottom:1px solid var(--line); } th { background:#edf0eb; font:700 12px Arial,sans-serif; text-transform:uppercase; letter-spacing:.08em; } td { line-height:1.4; } .price { font-variant-numeric:tabular-nums; } .actions { white-space:nowrap; } .actions a { color:var(--accent); font:700 13px Arial,sans-serif; text-decoration:none; margin-right:12px; } .actions button { padding:0; border:0; background:none; color:#9b3c24; font:700 13px Arial,sans-serif; cursor:pointer; } .empty { padding:42px; text-align:center; color:var(--muted); }
    </style>
</head>
<body>
<header><div><div class="kicker">Inventory management</div><h1>Products</h1></div><div class="user"><?= html_escape($user_name) ?><br><a href="<?= site_url('/logout') ?>">Sign out</a></div></header>
<main>
    <div class="toolbar"><span class="count"><?= count($products) ?> product<?= count($products) === 1 ? '' : 's' ?></span><a class="button" href="<?= site_url('/products/create') ?>">Add product</a></div>
    <div class="table-wrap">
    <?php if (!$products): ?><div class="empty">No products yet. Add the first item to your ledger.</div><?php else: ?>
    <table><thead><tr><th>Product</th><th>Description</th><th>Price</th><th>Quantity</th><th>Created</th><th></th></tr></thead><tbody>
    <?php foreach ($products as $product): ?><tr>
        <td><strong><?= html_escape($product['product_name']) ?></strong></td>
        <td><?= html_escape($product['description']) ?></td>
        <td class="price">$<?= number_format((float) $product['price'], 2) ?></td>
        <td><?= (int) $product['quantity'] ?></td>
        <td><?= html_escape($product['created_at']) ?></td>
        <td class="actions"><a href="<?= site_url('/products/edit/' . (int) $product['id']) ?>">Edit</a><form method="post" action="<?= site_url('/products/delete/' . (int) $product['id']) ?>" style="display:inline" onsubmit="return confirm('Delete this product?')"><button type="submit">Delete</button></form></td>
    </tr><?php endforeach; ?></tbody></table>
    <?php endif; ?></div>
</main>
</body>
</html>
