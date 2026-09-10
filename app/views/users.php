<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$escape = static fn($value) => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users / LavaLust</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root{--paper:#f5f1e9;--ink:#20201e;--muted:#77746d;--line:#d8d2c7;--red:#d94d35;--white:#fffdf8;--mono:'DM Mono',monospace;--sans:'DM Sans',sans-serif;--display:'Manrope',sans-serif}*{box-sizing:border-box;margin:0;padding:0}body{background:var(--paper);color:var(--ink);font-family:var(--sans);min-height:100vh}body:before{content:'';position:fixed;inset:0;pointer-events:none;opacity:.3;background-image:radial-gradient(#b7afa1 .7px,transparent .7px);background-size:18px 18px}.shell{max-width:1100px;margin:auto;padding:0 28px;position:relative}header{border-bottom:1px solid var(--line)}nav{min-height:78px;display:flex;align-items:center;justify-content:space-between}.brand{display:flex;align-items:center;gap:11px;text-decoration:none;font:800 18px var(--display);letter-spacing:-.04em}.mark{width:32px;height:32px;background:var(--red);color:white;display:grid;place-items:center;font:15px var(--mono);border-radius:7px 7px 7px 2px;transform:rotate(-7deg)}.back{color:var(--muted);font:12px var(--mono);text-decoration:none}.back:hover{color:var(--red)}main{padding:74px 0 100px}.kicker{color:var(--red);font:500 11px var(--mono);letter-spacing:.12em;text-transform:uppercase;margin-bottom:17px}.heading{display:flex;align-items:end;justify-content:space-between;gap:24px;margin-bottom:36px}h1{font:800 clamp(40px,6vw,68px)/.95 var(--display);letter-spacing:-.08em}h1 em{font-style:normal;color:var(--red)}.count{font:12px var(--mono);color:var(--muted);padding-bottom:7px}.table-wrap{overflow-x:auto;background:var(--white);border:1px solid var(--line);box-shadow:10px 10px 0 #e8b84a}.table{width:100%;border-collapse:collapse;min-width:650px}.table th{text-align:left;font:500 11px var(--mono);color:var(--muted);letter-spacing:.08em;text-transform:uppercase;background:#efebe3;padding:16px 18px;border-bottom:1px solid var(--line)}.table td{padding:19px 18px;border-bottom:1px solid var(--line);font-size:14px}.table tr:last-child td{border-bottom:0}.table td:first-child{font:12px var(--mono);color:var(--red)}.username{font-weight:600}.empty{padding:45px;text-align:center;color:var(--muted)}footer{border-top:1px solid var(--line);padding:25px 0;color:var(--muted);font:11px var(--mono)}@media(max-width:650px){.shell{padding:0 20px}main{padding:54px 0 80px}.heading{display:block}.count{margin-top:17px}}
+    </style>
+</head>
+<body>
+<header><nav class="shell"><a class="brand" href="<?= base_url() ?>"><span class="mark">//</span>LavaLust</a><a class="back" href="<?= base_url() ?>">← Back home</a></nav></header>
+<main class="shell"><div class="kicker">02 / Application data</div><div class="heading"><h1>Project <em>users.</em></h1><div class="count"><?= count($users) ?> registered account<?= count($users) === 1 ? '' : 's' ?></div></div><div class="table-wrap"><table class="table"><thead><tr><th>ID</th><th>First name</th><th>Last name</th><th>Email</th><th>Username</th></tr></thead><tbody><?php if (empty($users)): ?><tr><td colspan="5" class="empty">No users found.</td></tr><?php else: ?><?php foreach ($users as $user): ?><tr><td><?= $escape($user['id'] ?? '') ?></td><td><?= $escape($user['firstname'] ?? '') ?></td><td><?= $escape($user['lastname'] ?? '') ?></td><td><?= $escape($user['email'] ?? '') ?></td><td class="username"><?= $escape($user['username'] ?? '') ?></td></tr><?php endforeach; ?><?php endif; ?></tbody></table></div></main>
+<footer><div class="shell">LavaLust / open-source PHP framework</div></footer>
+</body>
+</html>
