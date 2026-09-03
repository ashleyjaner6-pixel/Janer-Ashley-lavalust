<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$version = config_item('VERSION') ?? '4.6.0';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LavaLust is a lightweight, expressive PHP MVC framework.">
    <title>LavaLust / PHP framework</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root { --paper:#f5f1e9; --ink:#20201e; --muted:#77746d; --line:#d8d2c7; --red:#d94d35; --yellow:#e8b84a; --white:#fffdf8; --mono:'DM Mono',monospace; --sans:'DM Sans',sans-serif; --display:'Manrope',sans-serif; }
        * { box-sizing:border-box; margin:0; padding:0; }
        html { scroll-behavior:smooth; }
        body { background:var(--paper); color:var(--ink); font-family:var(--sans); overflow-x:hidden; }
        body::before { content:''; position:fixed; inset:0; pointer-events:none; opacity:.3; background-image:radial-gradient(#b7afa1 .7px, transparent .7px); background-size:18px 18px; mask-image:linear-gradient(to bottom, black, transparent 70%); }
        a { color:inherit; }
        .shell { max-width:1180px; margin:auto; padding:0 32px; position:relative; }
        header { border-bottom:1px solid var(--line); position:relative; z-index:2; }
        nav { min-height:78px; display:flex; align-items:center; justify-content:space-between; }
        .brand { display:flex; align-items:center; gap:11px; text-decoration:none; font-family:var(--display); font-size:18px; letter-spacing:-.04em; }
        .brand-mark { width:32px; height:32px; background:var(--red); color:var(--white); display:grid; place-items:center; font-family:var(--mono); font-size:15px; border-radius:7px 7px 7px 2px; transform:rotate(-7deg); }
        .nav-links { display:flex; align-items:center; gap:25px; font-family:var(--mono); font-size:12px; color:var(--muted); }
        .nav-links a { text-decoration:none; transition:color .2s; }
        .nav-links a:hover { color:var(--red); }
        .nav-cta { padding:10px 15px; border:1px solid var(--ink); border-radius:4px; color:var(--ink); }
        .nav-cta:hover { background:var(--ink); color:var(--white) !important; }
        .hero { display:grid; grid-template-columns:1.02fr .98fr; gap:70px; align-items:center; padding:100px 0 92px; }
        .eyebrow, .kicker { color:var(--red); font:500 11px var(--mono); letter-spacing:.12em; text-transform:uppercase; }
        .eyebrow { display:flex; align-items:center; gap:10px; margin-bottom:23px; }
        .eyebrow::before { content:''; width:26px; height:1px; background:var(--red); }
        h1 { font:800 clamp(48px, 7vw, 91px)/.95 var(--display); letter-spacing:-.085em; max-width:630px; }
        h1 em { color:var(--red); font-style:normal; }
        .hero-copy { color:var(--muted); font-size:18px; line-height:1.6; max-width:450px; margin:27px 0 31px; }
        .actions { display:flex; gap:12px; flex-wrap:wrap; }
        .button { display:inline-flex; align-items:center; gap:12px; padding:14px 18px; border-radius:4px; text-decoration:none; font:600 13px var(--sans); transition:transform .2s, box-shadow .2s, background .2s; }
        .button:hover { transform:translateY(-3px); box-shadow:0 8px 18px #20201e1c; }
        .button-primary { background:var(--red); color:white; }
        .button-secondary { border:1px solid var(--line); background:var(--white); }
        .button-secondary:hover { background:#fff; }
        .blueprint { background:var(--ink); color:var(--white); min-height:410px; padding:27px; border-radius:5px; position:relative; overflow:hidden; box-shadow:16px 17px 0 var(--yellow); }
        .blueprint::after { content:'MVC'; position:absolute; right:-26px; bottom:-48px; color:#ffffff09; font:800 180px var(--display); letter-spacing:-.12em; }
        .blueprint-top { display:flex; justify-content:space-between; color:#9f9d94; font:11px var(--mono); border-bottom:1px solid #ffffff18; padding-bottom:18px; }
        .live { color:#a8d77a; }
        .live::before { content:'●'; margin-right:7px; }
        .diagram { display:grid; grid-template-columns:1fr 36px 1fr 36px 1fr; align-items:center; gap:4px; margin-top:59px; position:relative; z-index:1; }
        .node { border:1px solid #ffffff2b; padding:19px 12px; background:#2a2a27; }
        .node strong { display:block; color:var(--yellow); font:500 12px var(--mono); margin-bottom:11px; }
        .node span { color:#b6b5af; font-size:11px; line-height:1.5; }
        .arrow { color:var(--red); font:20px var(--mono); text-align:center; }
        .terminal { position:absolute; bottom:25px; left:27px; color:#77786f; font:11px var(--mono); z-index:1; }
        .terminal b { color:#a8d77a; font-weight:400; }
        .stats { border-top:1px solid var(--line); border-bottom:1px solid var(--line); display:grid; grid-template-columns:repeat(4,1fr); }
        .stat { padding:23px 0; border-right:1px solid var(--line); }
        .stat:not(:first-child) { padding-left:30px; }
        .stat:last-child { border:0; }
        .stat strong { display:block; font:800 25px var(--display); letter-spacing:-.06em; }
        .stat span { color:var(--muted); font:11px var(--mono); text-transform:uppercase; letter-spacing:.07em; }
        .features { padding:105px 0 112px; display:grid; grid-template-columns:.8fr 1.2fr; gap:90px; }
        .kicker { margin-bottom:18px; }
        h2 { font:800 clamp(31px, 4vw, 50px)/1.03 var(--display); letter-spacing:-.075em; max-width:380px; }
        .features-intro p { color:var(--muted); line-height:1.65; max-width:330px; margin-top:22px; }
        .feature-list { display:grid; grid-template-columns:1fr 1fr; border-top:1px solid var(--line); }
        .feature { padding:24px 18px 23px 0; border-bottom:1px solid var(--line); }
        .feature:nth-child(even) { padding-left:24px; border-left:1px solid var(--line); }
        .feature b { display:flex; gap:10px; font-size:15px; margin-bottom:9px; }
        .feature b::before { content:'+'; color:var(--red); font-family:var(--mono); }
        .feature p { color:var(--muted); font-size:13px; line-height:1.6; }
        footer { border-top:1px solid var(--line); padding:25px 0; color:var(--muted); font:11px var(--mono); }
        .footer-row { display:flex; justify-content:space-between; gap:18px; }
        @keyframes rise { from { opacity:0; transform:translateY(16px); } to { opacity:1; transform:none; } }
        .hero-copy, .eyebrow, h1, .actions { animation:rise .65s both; } .hero-copy{animation-delay:.1s} h1{animation-delay:.18s} .actions{animation-delay:.28s}
        @media (max-width:760px) { .shell{padding:0 20px} .nav-links{gap:12px}.nav-links a:first-child{display:none} .nav-cta{padding:8px 10px} .hero{grid-template-columns:1fr; gap:56px; padding:67px 0 80px} h1{font-size:clamp(47px,15vw,75px)} .blueprint{box-shadow:9px 10px 0 var(--yellow); min-height:370px}.diagram{margin-top:46px; grid-template-columns:1fr 20px 1fr 20px 1fr}.node{padding:14px 8px}.node strong{font-size:10px}.node span{font-size:9px}.stats{grid-template-columns:1fr 1fr}.stat,.stat:not(:first-child){padding:19px 0 19px 15px}.stat:nth-child(2){border-right:0}.stat strong{font-size:21px}.features{padding:76px 0; grid-template-columns:1fr; gap:48px}.feature-list{grid-template-columns:1fr}.feature:nth-child(even){padding-left:0;border-left:0}.footer-row{flex-direction:column} }
+    </style>
+</head>
+<body>
+<header><nav class="shell"><a class="brand" href="<?= base_url() ?>"><span class="brand-mark">//</span>LavaLust</a><div class="nav-links"><a href="#features">Toolkit</a><a href="https://lavalust.netlify.app/docs/" target="_blank" rel="noopener">Docs</a><a href="<?= base_url('users') ?>" class="nav-cta">View users <span aria-hidden="true">↗</span></a></div></nav></header>
+<main>
+    <section class="hero shell">
+        <div><div class="eyebrow">PHP MVC framework / v<?= htmlspecialchars($version, ENT_QUOTES, 'UTF-8') ?></div><h1>Build with<br><em>less noise.</em></h1><p class="hero-copy">A lightweight, expressive PHP framework for projects that need a clear shape and room to grow.</p><div class="actions"><a class="button button-primary" href="https://lavalust.netlify.app/docs/" target="_blank" rel="noopener">Read the docs <span>↗</span></a><a class="button button-secondary" href="https://github.com/ronmarasigan/LavaLust" target="_blank" rel="noopener">View on GitHub</a></div></div>
+        <div class="blueprint" aria-label="LavaLust MVC architecture diagram"><div class="blueprint-top"><span>lavalust.app</span><span class="live">system ready</span></div><div class="diagram"><div class="node"><strong>MODEL</strong><span>Data layer<br>Queries + rules</span></div><div class="arrow">→</div><div class="node"><strong>VIEW</strong><span>Presentation<br>Clean output</span></div><div class="arrow">→</div><div class="node"><strong>CTRL</strong><span>App logic<br>Routes + flow</span></div></div><div class="terminal"><b>></b> composer create-project lavalust/app_</div></div>
+    </section>
+    <section class="stats shell"><div class="stat"><strong>4.6.0</strong><span>Current release</span></div><div class="stat"><strong>PHP 7.4+</strong><span>Built for PHP</span></div><div class="stat"><strong>MVC +</strong><span>Architecture</span></div><div class="stat"><strong>REST</strong><span>API ready</span></div></section>
+    <section class="features shell" id="features"><div class="features-intro"><div class="kicker">01 / The toolkit</div><h2>Small surface.<br>Serious leverage.</h2><p>Everything is where you expect it to be, with enough built in to keep momentum high.</p></div><div class="feature-list"><article class="feature"><b>Clear MVC core</b><p>Keep application logic, data, and presentation in their proper places.</p></article><article class="feature"><b>Flexible routing</b><p>Map requests to expressive controller actions without ceremony.</p></article><article class="feature"><b>Useful libraries</b><p>Sessions, validation, email, uploads, caching, and more when you need them.</p></article><article class="feature"><b>Modular by nature</b><p>Grow from a focused prototype into a structured application.</p></article></div></section>
+</main>
+<footer><div class="shell footer-row"><span>LavaLust / open-source PHP framework</span><span>Made for thoughtful builders</span></div></footer>
+</body>
+</html>
