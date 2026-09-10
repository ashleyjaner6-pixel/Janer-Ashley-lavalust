<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in | Product Ledger</title>
    <style>
        :root { --ink:#172026; --muted:#66727a; --paper:#f7f6f1; --accent:#dd5b35; --line:#d8d9d4; }
        * { box-sizing:border-box; } body { margin:0; min-height:100vh; display:grid; place-items:center; background:linear-gradient(135deg,#e8eee8,#f8f6ef 55%,#eaded2); color:var(--ink); font:16px Georgia,serif; }
        main { width:min(420px,calc(100% - 32px)); background:rgba(255,255,255,.85); border:1px solid rgba(23,32,38,.12); padding:42px; box-shadow:12px 16px 0 rgba(23,32,38,.08); }
        .kicker { color:var(--accent); font:700 12px Arial,sans-serif; letter-spacing:.14em; text-transform:uppercase; } h1 { font-size:42px; line-height:1; margin:12px 0; } p { color:var(--muted); line-height:1.5; } label { display:block; font:700 13px Arial,sans-serif; margin:22px 0 7px; } input { width:100%; padding:13px 14px; border:1px solid var(--line); background:#fff; font:16px Georgia,serif; } button { width:100%; margin-top:26px; padding:14px; border:0; background:var(--ink); color:#fff; font:700 14px Arial,sans-serif; cursor:pointer; } .error { padding:12px; border-left:4px solid var(--accent); background:#fff0e9; color:#8a321b; }
    </style>
</head>
<body>
<main>
    <div class="kicker">Laboratory Exercise 05</div>
    <h1>Product Ledger</h1>
    <p>Sign in to manage the inventory stored in your Aiven database.</p>
    <?php if ($error): ?><div class="error"><?= html_escape($error) ?></div><?php endif; ?>
    <form method="post" action="<?= site_url('/login') ?>">
        <label for="email">Email</label>
        <input id="email" name="email" type="email" required autocomplete="email">
        <label for="password">Password</label>
        <input id="password" name="password" type="password" required autocomplete="current-password">
        <button type="submit">Sign in</button>
    </form>
</main>
</body>
</html>
