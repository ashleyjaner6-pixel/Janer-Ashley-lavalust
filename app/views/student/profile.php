<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LavaLust Student Record</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --ink: #17252b; --paper: #f7f3eb; --coral: #ee6b4d; --mint: #b8e0d2; --line: #cfd5ce; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; color: var(--ink); font-family: "Space Grotesk", sans-serif; background: var(--paper); }
        header, main { width: min(1080px, calc(100% - 40px)); margin: auto; }
        header { display: flex; justify-content: space-between; align-items: center; padding: 28px 0; border-bottom: 1px solid var(--line); }
        .brand { font-weight: 700; letter-spacing: .04em; text-transform: uppercase; }
        .brand span { color: var(--coral); }
        nav { display: flex; gap: 24px; font: .75rem "DM Mono", monospace; }
        nav a { color: var(--ink); text-decoration: none; }
        nav a:hover { color: var(--coral); }
        main { padding: 72px 0; }
        .eyebrow { color: var(--coral); font: 500 .75rem "DM Mono", monospace; letter-spacing: .12em; text-transform: uppercase; }
        h1 { margin: 14px 0 42px; font-size: clamp(3rem, 8vw, 6.5rem); line-height: .9; letter-spacing: -.06em; }
        .record { display: grid; grid-template-columns: .8fr 1.2fr; gap: 0; border: 1px solid var(--ink); box-shadow: 12px 12px 0 var(--coral); }
        .identity { padding: 34px; background: var(--mint); border-right: 1px solid var(--ink); }
        .identity-mark { display: grid; place-items: center; width: 86px; height: 86px; margin-bottom: 80px; border: 1px solid var(--ink); border-radius: 50%; font-size: 2rem; font-weight: 700; }
        .identity h2 { margin: 0 0 10px; font-size: 2.2rem; line-height: 1; }
        .identity p { margin: 6px 0; color: #3e5558; }
        .facts { padding: 20px 30px; background: rgba(255,255,255,.55); }
        .fact { display: grid; grid-template-columns: 150px 1fr; gap: 20px; padding: 18px 0; border-bottom: 1px solid var(--line); }
        .fact:last-child { border-bottom: 0; }
        .fact-label { color: #607174; font: .7rem "DM Mono", monospace; text-transform: uppercase; }
        .subjects { margin-top: 68px; }
        .subjects h2 { font-size: 1.5rem; }
        .subjects ul { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; padding: 0; list-style: none; }
        .subjects li { padding: 16px; border: 1px solid var(--line); background: white; }
        @media (max-width: 760px) { header, main { width: min(100% - 28px, 560px); } header { padding: 20px 0; } nav { gap: 12px; } main { padding: 54px 0; } .record { display: block; } .identity { border-right: 0; border-bottom: 1px solid var(--ink); } .identity-mark { margin-bottom: 40px; } .fact { grid-template-columns: 112px 1fr; gap: 12px; } .subjects ul { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <header>
        <div class="brand">Lava<span>Lust</span> / Student Hub</div>
        <nav><a href="<?= site_url('student'); ?>">Home</a><a href="<?= site_url('student/profile'); ?>">Profile</a></nav>
    </header>
    <main>
        <div class="eyebrow">Confidential academic record / 01</div>
        <h1>Student profile.</h1>
        <section class="record">
            <div class="identity">
                <div class="identity-mark">AJ</div>
                <h2><?= htmlspecialchars($name ?? $_SESSION['student']['name'] ?? 'Ashley Rhiene G. Janer'); ?></h2>
                <p><?= htmlspecialchars($course ?? $_SESSION['student']['course'] ?? 'BS Information Technology'); ?></p>
                <p><?= htmlspecialchars($section ?? $_SESSION['student']['section'] ?? '3-F4'); ?> / <?= htmlspecialchars($year_level ?? $_SESSION['student']['year_level'] ?? '3rd Year'); ?></p>
            </div>
            <div class="facts">
                <div class="fact"><div class="fact-label">Student No.</div><div><?= htmlspecialchars($student_no ?? $_SESSION['student']['student_no'] ?? '2024-00172'); ?></div></div>
                <div class="fact"><div class="fact-label">Name</div><div><?= htmlspecialchars($name ?? $_SESSION['student']['name'] ?? 'Ashley Rhiene G. Janer'); ?></div></div>
                <div class="fact"><div class="fact-label">Course</div><div><?= htmlspecialchars($course ?? $_SESSION['student']['course'] ?? 'BS Information Technology'); ?></div></div>
                <div class="fact"><div class="fact-label">Year / Section</div><div><?= htmlspecialchars($year_level ?? $_SESSION['student']['year_level'] ?? '3rd Year'); ?> / <?= htmlspecialchars($section ?? $_SESSION['student']['section'] ?? '3-F4'); ?></div></div>
                <div class="fact"><div class="fact-label">Email</div><div><?= htmlspecialchars($email ?? $_SESSION['student']['email'] ?? 'ashleyjaner6@gmail.com'); ?></div></div>
                <div class="fact"><div class="fact-label">Address</div><div><?= htmlspecialchars($address ?? $_SESSION['student']['address'] ?? 'Tawiran, Calapan City, Oriental Mindoro'); ?></div></div>
            </div>
        </section>
        <section class="subjects">
            <div class="eyebrow">Current subjects</div>
            <h2>What I am learning</h2>
            <ul><?php foreach (($subjects ?? ['Web Systems and Technologies', 'Database Management', 'Object-Oriented Programming']) as $subject): ?><li><?= htmlspecialchars($subject); ?></li><?php endforeach; ?></ul>
        </section>
    </main>
</body>
</html>
