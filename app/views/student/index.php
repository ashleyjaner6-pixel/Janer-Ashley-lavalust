<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LavaLust Student Hub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --ink: #17252b; --paper: #f7f3eb; --coral: #ee6b4d; --mint: #b8e0d2; --line: #cfd5ce; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; color: var(--ink); font-family: "Space Grotesk", sans-serif; background: var(--paper); }
        body::before { content: ""; position: fixed; inset: 0; pointer-events: none; opacity: .35; background-image: linear-gradient(135deg, rgba(23,37,43,.05) 1px, transparent 1px), linear-gradient(45deg, rgba(23,37,43,.035) 1px, transparent 1px); background-size: 28px 28px; }
        header, main { width: min(1080px, calc(100% - 40px)); margin: auto; }
        header { display: flex; justify-content: space-between; align-items: center; padding: 28px 0; border-bottom: 1px solid var(--line); }
        .brand { font-weight: 700; letter-spacing: .04em; text-transform: uppercase; }
        .brand span { color: var(--coral); }
        nav { display: flex; gap: 24px; font-family: "DM Mono", monospace; font-size: .75rem; }
        nav a { color: var(--ink); text-decoration: none; }
        nav a:hover { color: var(--coral); }
        main { display: grid; grid-template-columns: 1.25fr .75fr; gap: 72px; align-items: center; min-height: calc(100vh - 100px); padding: 72px 0; }
        .eyebrow { color: var(--coral); font: 500 .75rem "DM Mono", monospace; letter-spacing: .12em; text-transform: uppercase; }
        h1 { max-width: 680px; margin: 16px 0 24px; font-size: clamp(3.5rem, 8vw, 7.5rem); line-height: .88; letter-spacing: -.06em; }
        .intro { max-width: 520px; color: #526168; font-size: 1.1rem; line-height: 1.7; }
        .profile-link { display: inline-flex; align-items: center; gap: 14px; margin-top: 22px; padding: 15px 20px; color: var(--paper); background: var(--ink); text-decoration: none; font-weight: 600; }
        .profile-link:hover { background: var(--coral); }
        .profile-link::after { content: "->"; font-family: "DM Mono", monospace; }
        .spotlight { position: relative; padding: 30px; background: var(--mint); border: 1px solid var(--ink); box-shadow: 12px 12px 0 var(--coral); transform: rotate(2deg); }
        .spotlight::before { content: "STUDENT RECORD"; display: block; margin-bottom: 60px; font: 500 .7rem "DM Mono", monospace; letter-spacing: .14em; }
        .spotlight h2 { margin: 0 0 8px; font-size: 2.2rem; line-height: 1; }
        .spotlight p { margin: 0; line-height: 1.6; }
        .access-note { margin-top: 24px; padding: 12px 14px; border-left: 3px solid var(--coral); background: rgba(238,107,77,.12); font-size: .9rem; }
        @media (max-width: 760px) { header, main { width: min(100% - 28px, 560px); } header { padding: 20px 0; } nav { gap: 12px; } main { display: block; padding: 64px 0; } h1 { font-size: clamp(3.5rem, 17vw, 6rem); } .spotlight { margin: 70px 12px 20px 0; } }
    </style>
</head>
<body>
    <header>
        <div class="brand">Lava<span>Lust</span> / Student Hub</div>
        <nav><a href="<?= site_url('student'); ?>">Home</a><?php if (($_GET['access'] ?? '') !== 'required'): ?><a href="<?= site_url('student/profile'); ?>">Profile</a><?php endif; ?></nav>
    </header>
    <main>
        <section>
            <div class="eyebrow">Personal academic space / 2026</div>
            <h1>Make your mark.</h1>
            <p class="intro">A focused student information page built with LavaLust routing, controllers, views, and middleware.</p>
            <?php if (($_GET['access'] ?? '') === 'required'): ?>
                <div class="access-note">Profile access requires entering through Student Hub.</div>
            <?php else: ?>
                <a href="<?= site_url('student/profile?access=granted'); ?>" class="profile-link">View student profile</a>
            <?php endif; ?>
        </section>
        <aside class="spotlight">
            <h2><?= htmlspecialchars($name ?? $_SESSION['student']['name'] ?? 'Ashley Rhiene G. Janer'); ?></h2>
            <p><?= htmlspecialchars($course ?? $_SESSION['student']['course'] ?? 'BS Information Technology'); ?></p>
            <p><?= htmlspecialchars($section ?? $_SESSION['student']['section'] ?? '3-F4'); ?> / <?= htmlspecialchars($year_level ?? $_SESSION['student']['year_level'] ?? '3rd Year'); ?></p>
        </aside>
    </main>
</body>
</html>