<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MealMemo Dashboard - Overview of Malaysian food metadata, visitor analytics, and cultural recipe repository.">
    <meta name="keywords" content="MealMemo, Malaysian food, dashboard, recipe, IMS566, food culture, analytics">
    <meta name="author" content="IMS566 MealMemo Project">
    <title>Dashboard - MealMemo.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --accent-orange: #d97706;
            --slate-navy: #0b1528;
            --sidebar-width: 260px;
            --topbar-height: 65px;
            --bg-page: #f0f2f5;
            --bg-card: rgba(255,255,255,0.82);
            --bg-sidebar: rgba(255,255,255,0.90);
            --bg-topbar: rgba(255,255,255,0.90);
            --border-color: rgba(0,0,0,0.07);
            --text-primary: #0b1528;
            --text-muted: #6b7280;
            --text-label: #9ca3af;
            --card-shadow: 0 1px 6px rgba(0,0,0,0.07);
            --bg-active-nav: #ffffff;
            --bg-hover-nav: rgba(0,0,0,0.04);
            --meter-track: #e5e7eb;
            --input-bg: rgba(255,255,255,0.65);
        }
        [data-theme="dark"] {
            --bg-page: #0d1117;
            --bg-card: rgba(22,28,36,0.92);
            --bg-sidebar: rgba(14,20,28,0.97);
            --bg-topbar: rgba(14,20,28,0.97);
            --border-color: rgba(255,255,255,0.07);
            --text-primary: #e5e7eb;
            --text-muted: #9ca3af;
            --text-label: #6b7280;
            --card-shadow: 0 1px 6px rgba(0,0,0,0.3);
            --bg-active-nav: rgba(217,119,6,0.15);
            --bg-hover-nav: rgba(255,255,255,0.05);
            --meter-track: #1f2937;
            --input-bg: rgba(255,255,255,0.06);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-page);
            color: var(--text-primary);
            min-height: 100vh;
            transition: background 0.3s, color 0.3s;
        }

        /* ── SIDEBAR ── */
        #sidebar {
            position: fixed; top: 0; left: 0;
            width: var(--sidebar-width); height: 100vh;
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            backdrop-filter: blur(20px);
            display: flex; flex-direction: column;
            z-index: 1040; overflow-y: auto;
            transition: transform 0.3s ease, background 0.3s;
        }
        .sidebar-brand {
            padding: 22px 24px 20px;
            font-size: 20px; font-weight: 700;
            color: var(--text-primary);
            border-bottom: 1px solid var(--border-color);
            display: flex; align-items: center; gap: 10px;
            flex-shrink: 0;
        }
        .sidebar-brand i { color: var(--accent-orange); font-size: 22px; }
        .sidebar-section-label {
            font-size: 10px; font-weight: 700;
            letter-spacing: 1px; color: var(--text-label);
            text-transform: uppercase;
            padding: 20px 24px 8px;
        }
        .nav-item-link {
            display: flex; align-items: center; justify-content: space-between;
            padding: 10px 24px;
            font-size: 13.5px; font-weight: 600;
            color: var(--text-muted); text-decoration: none;
            transition: background 0.18s, color 0.18s;
        }
        .nav-item-link:hover { background: var(--bg-hover-nav); color: var(--text-primary); }
        .nav-item-link.active {
            background: var(--bg-active-nav); color: var(--accent-orange);
            box-shadow: var(--card-shadow); border-radius: 10px;
            margin: 0 12px; padding: 10px 12px;
        }
        .nav-item-link .nav-left { display: flex; align-items: center; gap: 10px; }
        .nav-item-link i { font-size: 16px; }
        .sidebar-footer {
            margin-top: auto; padding: 16px 16px 20px;
            border-top: 1px solid var(--border-color); flex-shrink: 0;
        }
        .btn-logout {
            width: 100%; background: var(--slate-navy); color: #fff;
            border: none; border-radius: 12px; padding: 10px 16px;
            font-size: 13px; font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex; align-items: center; justify-content: center;
            gap: 8px; cursor: pointer; transition: background 0.2s;
        }
        .btn-logout:hover { background: #1a2d4a; }

        /* ── TOPBAR ── */
        #topbar {
            position: fixed; top: 0;
            left: var(--sidebar-width); right: 0;
            height: var(--topbar-height);
            background: var(--bg-topbar);
            border-bottom: 1px solid var(--border-color);
            backdrop-filter: blur(20px);
            display: flex; align-items: center;
            padding: 0 28px; gap: 16px;
            z-index: 1030; transition: left 0.3s, background 0.3s;
        }
        .hamburger-btn {
            background: none; border: none;
            color: var(--text-muted); font-size: 20px;
            cursor: pointer; padding: 4px 8px;
            border-radius: 8px; display: none;
            transition: background 0.2s;
        }
        .hamburger-btn:hover { background: var(--bg-hover-nav); }
        .topbar-search {
            flex: 1; max-width: 380px; position: relative;
        }
        .topbar-search i {
            position: absolute; left: 12px; top: 50%;
            transform: translateY(-50%);
            color: var(--text-label); font-size: 14px;
        }
        .topbar-search input {
            width: 100%; background: var(--input-bg);
            border: 1px solid var(--border-color);
            border-radius: 10px; padding: 8px 12px 8px 36px;
            font-size: 13px; font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-primary); outline: none;
            transition: border-color 0.2s, background 0.3s;
        }
        .topbar-search input::placeholder { color: var(--text-label); }
        .topbar-search input:focus { border-color: var(--accent-orange); }
        .topbar-right { margin-left: auto; display: flex; align-items: center; gap: 12px; }
        .topbar-icon-btn {
            width: 38px; height: 38px;
            background: var(--input-bg);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: var(--text-muted); font-size: 17px;
            transition: background 0.2s, color 0.2s;
            position: relative; flex-shrink: 0;
        }
        .topbar-icon-btn:hover { background: var(--bg-hover-nav); color: var(--text-primary); }
        /* Beeping notification dot */
        .notif-dot {
            position: absolute; top: 6px; right: 6px;
            width: 9px; height: 9px;
            background: #ef4444; border-radius: 50%;
            border: 2px solid var(--bg-topbar);
        }
        @keyframes beep {
            0%   { transform: scale(1);   opacity: 1; }
            25%  { transform: scale(1.6); opacity: 0.5; }
            50%  { transform: scale(1);   opacity: 1; }
            75%  { transform: scale(1.6); opacity: 0.5; }
            100% { transform: scale(1);   opacity: 1; }
        }
        .notif-dot { animation: beep 1.6s ease-in-out infinite; }
        .topbar-user {
            display: flex; align-items: center; gap: 8px;
            cursor: pointer; padding: 4px 10px;
            border-radius: 10px; transition: background 0.2s;
        }
        .topbar-user:hover { background: var(--bg-hover-nav); }
        .topbar-avatar {
            width: 34px; height: 34px;
            background: var(--accent-orange); border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700; color: #fff; flex-shrink: 0;
        }
        .topbar-username { font-size: 13px; font-weight: 600; color: var(--text-primary); }

        /* ── MAIN ── */
        #main-content {
            margin-left: var(--sidebar-width);
            padding-top: var(--topbar-height);
            min-height: 100vh; transition: margin-left 0.3s;
        }
        .content-inner { padding: 28px 28px 80px; }

        /* ── CARDS ── */
        .mm-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 18px; box-shadow: var(--card-shadow);
            backdrop-filter: blur(12px);
            transition: background 0.3s, border-color 0.3s;
        }
        .stat-card { padding: 22px 24px; }
        .stat-label {
            font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.8px;
            color: var(--text-label); margin-bottom: 8px;
        }
        .stat-value {
            font-size: 26px; font-weight: 700;
            color: var(--text-primary); line-height: 1; margin-bottom: 6px;
        }
        .stat-delta {
            font-size: 11px; font-weight: 600;
            display: inline-flex; align-items: center; gap: 3px;
        }
        .delta-up   { color: #16a34a; }
        .delta-down { color: #ef4444; }
        .stat-vs { font-size: 11px; color: var(--text-muted); }

        /* Active visitor dot */
        @keyframes activeBeep {
            0%,100% { box-shadow: 0 0 0 0 rgba(16,185,129,0.6); }
            50%      { box-shadow: 0 0 0 6px rgba(16,185,129,0); }
        }
        .active-dot {
            display: inline-block; width: 10px; height: 10px;
            background: #10b981; border-radius: 50%;
            animation: activeBeep 1.4s ease-in-out infinite;
            flex-shrink: 0;
        }

        /* ── CHART CARD ── */
        .chart-card { padding: 24px; }
        .chart-tab-btn {
            background: none; border: none;
            padding: 5px 12px; border-radius: 8px;
            font-size: 12px; font-weight: 600;
            color: var(--text-muted); cursor: pointer;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: background 0.18s, color 0.18s;
        }
        .chart-tab-btn.active {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        }

        /* ── CULTURE CARDS ── */
        .culture-card { perspective: 1000px; cursor: pointer; height: 190px; }
        .culture-inner { position:relative; width:100%; height:100%; transition:transform 0.6s cubic-bezier(.4,0,.2,1); transform-style:preserve-3d; }
        .culture-card:hover .culture-inner, .culture-card.flipped .culture-inner { transform:rotateY(180deg); }
        .culture-front, .culture-back { position:absolute; width:100%; height:100%; backface-visibility:hidden; border-radius:18px; overflow:hidden; }
        .culture-front {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            display:flex; flex-direction:column; align-items:center; justify-content:center;
            padding:16px; text-align:center;
        }
        .culture-back { transform:rotateY(180deg); background:#0b1528; color:white; display:flex; flex-direction:column; justify-content:center; padding:16px; }

        /* ── METER ── */
        .meter-fill { width:0%; transition:width 1.2s cubic-bezier(.4,0,.2,1); }

        /* ── NOTIFICATION PANEL ── */
        #notifPanel {
            display: none; position: absolute;
            top: calc(var(--topbar-height) + 4px); right: 28px;
            width: 300px; background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            padding: 16px; z-index: 2000; backdrop-filter: blur(20px);
        }
        #notifPanel.show { display: block; }
        @keyframes slideIn { from{opacity:0;transform:translateX(16px)} to{opacity:1;transform:translateX(0)} }
        .notif-new { animation: slideIn 0.32s ease forwards; }

        /* ── HERO BANNER ── */
        .hero-banner {
            background: linear-gradient(135deg, #0b1528 0%, #1a2d4a 100%);
            border-radius: 22px; padding: 34px 40px;
            position: relative; overflow: hidden; color: white;
        }
        [data-theme="dark"] .hero-banner { background: linear-gradient(135deg, #0d1a2d 0%, #0b1528 100%); }

        /* ── BACK TO TOP ── */
        #backToTop {
            position: fixed; bottom: 28px; right: 28px;
            width: 42px; height: 42px;
            background: var(--accent-orange); color: white;
            border: none; border-radius: 12px; font-size: 18px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; z-index: 9999;
            opacity: 0; transform: translateY(12px);
            transition: opacity 0.3s, transform 0.3s;
            pointer-events: none;
            box-shadow: 0 4px 14px rgba(217,119,6,0.4);
        }
        #backToTop.visible { opacity:1; transform:translateY(0); pointer-events:all; }
        #backToTop:hover { background: #b45309; }

        /* ── SIDEBAR OVERLAY ── */
        #sidebarOverlay {
            display:none; position:fixed; inset:0;
            background:rgba(0,0,0,0.4); z-index:1039;
        }

        .section-title {
            font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.8px;
            color: var(--text-label); margin-bottom: 14px;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 991.98px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.open { transform: translateX(0); }
            #sidebarOverlay.open { display: block; }
            #main-content { margin-left: 0; }
            #topbar { left: 0; }
            .hamburger-btn { display: flex !important; }
        }

        @keyframes flicker {
            0%   { opacity: 1;   transform: scaleY(1)   rotate(-3deg); }
            50%  { opacity: 0.75; transform: scaleY(1.1) rotate(2deg); }
            100% { opacity: 0.9;  transform: scaleY(0.95) rotate(-1deg); }
        }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.12); border-radius: 99px; }
        [data-theme="dark"] ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); }

        /* ── USER DROPDOWN ── */
        .user-dropdown-wrap { position: relative; }
        .user-dropdown-menu {
            display: none; position: absolute; top: calc(100% + 8px); right: 0;
            background: var(--bg-card); border: 1px solid var(--border-color);
            border-radius: 12px; box-shadow: 0 8px 28px rgba(0,0,0,0.12);
            min-width: 180px; z-index: 3000; overflow: hidden;
            backdrop-filter: blur(20px);
        }
        .user-dropdown-menu.open { display: block; }
        .user-dropdown-item {
            display: flex; align-items: center; gap: 10px;
            padding: 11px 16px; font-size: 13px; font-weight: 600;
            color: var(--text-muted); text-decoration: none;
            transition: background 0.15s, color 0.15s; cursor: pointer;
        }
        .user-dropdown-item:hover { background: var(--bg-hover-nav); color: var(--text-primary); }
        .user-dropdown-item i { font-size: 14px; }
        .user-dropdown-divider { height: 1px; background: var(--border-color); margin: 4px 0; }

    </style>
</head>
<body>

<!-- ══════════════ SIDEBAR ══════════════ -->
<nav id="sidebar">
    <div class="sidebar-brand">
        <i class="bi bi-egg-fried"></i> MealMemo.
    </div>
    <div class="sidebar-section-label">Menu</div>
    <a href="dashboard.php" class="nav-item-link active">
        <span class="nav-left"><i class="bi bi-grid-1x2-fill"></i> Overview</span>
    </a>
    <a href="catalog.php" class="nav-item-link">
        <span class="nav-left"><i class="bi bi-book"></i> Catalog</span>
    </a>
    <a href="cooklist.php" class="nav-item-link">
        <span class="nav-left"><i class="bi bi-journal-check"></i> Cooklist</span>
        <span id="sidebarCooklistBadge" class="badge rounded-pill" style="background:var(--accent-orange);font-size:10px;">0</span>
    </a>
    <a href="calorie-evaluation.php" class="nav-item-link">
        <span class="nav-left"><i class="bi bi-calculator"></i> Calorie Evaluation</span>
    </a>
    <div class="sidebar-section-label" style="margin-top:8px;">Support</div>
    <a href="help.php" class="nav-item-link">
        <span class="nav-left"><i class="bi bi-chat-dots-fill"></i> Contact Us</span>
    </a>
    <div class="sidebar-footer">
        <button class="btn-logout" onclick="handleLogout()">
            <i class="bi bi-box-arrow-left"></i> Log Out
        </button>
    </div>
</nav>

<div id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- ══════════════ TOPBAR ══════════════ -->
<header id="topbar">
    <button class="hamburger-btn" onclick="toggleSidebar()"><i class="bi bi-list"></i></button>
    <div class="topbar-right">
        <div class="topbar-icon-btn" onclick="toggleTheme()" title="Toggle theme">
            <i id="themeIcon" class="bi bi-moon"></i>
        </div>
        <div class="topbar-icon-btn" onclick="toggleNotifPanel()" id="bellBtn" title="Notifications">
            <i class="bi bi-bell"></i>
            <span class="notif-dot" id="notifDot"></span>
        </div>
        <div style="width:1px;height:22px;background:var(--border-color);"></div>
        <div class="user-dropdown-wrap" id="userDropdownWrap">
            <div class="topbar-user" onclick="toggleUserDropdown()" style="cursor:pointer;">
                <div class="topbar-avatar" id="avatarInitials">G</div>
                <span class="topbar-username" id="userGreetingField">Guest</span>
                <i class="bi bi-chevron-down" style="font-size:11px;color:var(--text-muted);margin-left:2px;"></i>
            </div>
            <div class="user-dropdown-menu" id="userDropdownMenu">
                <a href="password.php" class="user-dropdown-item"><i class="bi bi-key"></i> Change Password</a>
                <div class="user-dropdown-divider"></div>
                <div class="user-dropdown-item" onclick="handleLogout()"><i class="bi bi-box-arrow-left"></i> Log Out</div>
            </div>
        </div>
    </div>
</header>

<!-- Notification Panel -->
<div id="notifPanel">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p style="font-weight:700;font-size:13px;color:var(--text-primary);">Notifications</p>
        <button onclick="clearAllNotif()" style="background:none;border:none;font-size:11px;color:var(--text-label);cursor:pointer;">Clear all</button>
    </div>
    <div id="notifList" style="display:flex;flex-direction:column;gap:8px;max-height:280px;overflow-y:auto;">
        <p style="font-size:12px;color:var(--text-label);text-align:center;padding:16px 0;">No notifications yet.</p>
    </div>
</div>

<!-- ══════════════ MAIN CONTENT ══════════════ -->
<main id="main-content">
    <div class="content-inner">

        <!-- PAGE HEADER -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 style="font-size:20px;font-weight:700;color:var(--text-primary);margin:0;">Welcome Back</h1>
                <p style="font-size:12px;color:var(--text-muted);margin:4px 0 0;">MealMemo. The Art of Malaysian Cuisine</p>
            </div>
            <span style="background:#fef3c7;color:#92400e;font-size:10px;font-weight:700;padding:5px 12px;border-radius:99px;letter-spacing:0.5px;">IMS566 Company</span>
        </div>

        <!-- ── ALL 8 STAT CARDS — single row, all equal height ── -->
        <div class="row g-3 mb-4">

            <div class="col-6 col-xl-3 d-flex">
                <div class="mm-card stat-card w-100">
                    <p class="stat-label">Unique Visitors</p>
                    <p class="stat-value">24.7K</p>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="stat-delta delta-up"><i class="bi bi-arrow-up-short"></i>+20%</span>
                        <span class="stat-vs">Vs last month</span>
                    </div>
                </div>
            </div>

            <div class="col-6 col-xl-3 d-flex">
                <div class="mm-card stat-card w-100">
                    <p class="stat-label">Total Pageviews</p>
                    <p class="stat-value">55.9K</p>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="stat-delta delta-up"><i class="bi bi-arrow-up-short"></i>+4%</span>
                        <span class="stat-vs">Vs last month</span>
                    </div>
                </div>
            </div>

            <div class="col-6 col-xl-3 d-flex">
                <div class="mm-card stat-card w-100">
                    <p class="stat-label">Active Visitors</p>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <p class="stat-value" style="margin-bottom:0;" id="activeVisitorCount">138</p>
                        <span class="active-dot" title="Live"></span>
                    </div>
                    <span class="stat-vs">Live right now</span>
                </div>
            </div>

            <div class="col-6 col-xl-3 d-flex">
                <div class="mm-card stat-card w-100">
                    <p class="stat-label">Visit Duration</p>
                    <p class="stat-value">2m 56s</p>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="stat-delta delta-up"><i class="bi bi-arrow-up-short"></i>+7%</span>
                        <span class="stat-vs">Vs last month</span>
                    </div>
                </div>
            </div>

            <div class="col-6 col-xl-3 d-flex">
                <div class="mm-card stat-card w-100">
                    <p class="stat-label">Total Menus</p>
                    <p class="stat-value">124</p>
                    <span style="background:#fef3c7;color:#92400e;font-size:10px;font-weight:600;padding:2px 8px;border-radius:99px;">+12 this month</span>
                </div>
            </div>

            <div class="col-6 col-xl-3 d-flex">
                <div class="mm-card stat-card w-100">
                    <p class="stat-label">Cultures</p>
                    <p class="stat-value">5</p>
                    <span style="background:#f0fdf4;color:#166534;font-size:10px;font-weight:600;padding:2px 8px;border-radius:99px;">Local Heritage</span>
                </div>
            </div>

            <div class="col-6 col-xl-3 d-flex">
                <div class="mm-card stat-card w-100">
                    <p class="stat-label">System Status</p>
                    <p class="stat-value" style="font-size:22px;color:#059669;">Operational</p>
                    <div style="width:100%;background:var(--meter-track);border-radius:99px;height:5px;margin-top:6px;">
                        <div style="width:100%;height:100%;border-radius:99px;background:#059669;"></div>
                    </div>
                </div>
            </div>

            <!-- 🔥 Trending Menu — Nasi Lemak -->
            <div class="col-6 col-xl-3 d-flex">
                <div class="mm-card stat-card w-100" style="background:linear-gradient(135deg,#1a0800 0%,#3d1600 55%,#78240a 100%);border:1px solid rgba(217,119,6,0.35);position:relative;overflow:hidden;">
                    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 85% 110%,rgba(251,146,60,0.28) 0%,transparent 65%);pointer-events:none;"></div>
                    <div style="position:absolute;bottom:-14px;right:-14px;width:90px;height:90px;background:radial-gradient(circle,rgba(251,146,60,0.4) 0%,transparent 70%);pointer-events:none;"></div>
                    <p class="stat-label" style="color:rgba(251,191,36,0.65);position:relative;z-index:2;margin-bottom:6px;">🔥 Trending Menu</p>
                    <p class="stat-value" style="color:#fff;position:relative;z-index:2;font-size:20px;margin-bottom:2px;">Nasi Lemak</p>
                    <p style="font-size:10px;color:rgba(255,255,255,0.45);margin-bottom:8px;position:relative;z-index:2;">Malaysia's #1 Dish</p>
                    <div style="position:relative;z-index:2;display:flex;align-items:center;gap:5px;">
                        <span style="font-size:16px;">🍛</span>
                        <span style="font-size:16px;animation:flicker 0.85s ease-in-out infinite alternate;">🔥</span>
                        <span style="font-size:16px;animation:flicker 1.15s ease-in-out infinite alternate-reverse;">🔥</span>
                        <span style="background:rgba(217,119,6,0.85);color:#fff;font-size:9px;font-weight:700;padding:2px 8px;border-radius:99px;letter-spacing:0.5px;margin-left:2px;">HOT TODAY</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- ── ROW 3: HERO BANNER ── -->
        <div class="hero-banner mb-4">
            <div style="position:relative;z-index:2;max-width:62%;">
                <h2 style="font-size:22px;font-weight:700;color:#fff;margin-bottom:8px;">The Art of Malaysian Cuisine</h2>
                <p style="font-size:12px;color:rgba(255,255,255,0.5);line-height:1.7;margin:0;">A timeless collection of traditional flavours, cultural stories, and authentic recipes inspired by the rich heritage of Malaysia.</p>
            </div>
            <div style="position:absolute;top:-40px;right:-40px;width:220px;height:220px;border-radius:50%;border:1px solid rgba(255,255,255,0.06);z-index:1;"></div>
            <div style="position:absolute;top:20px;right:40px;width:120px;height:120px;border-radius:50%;border:1px solid rgba(255,255,255,0.05);z-index:1;"></div>
        </div>

        <!-- ── ROW 4: VISITOR ANALYTICS CHART (full width) ── -->
        <div class="mm-card chart-card mb-4">
            <div class="d-flex align-items-start justify-content-between flex-wrap gap-3 mb-4">
                <div>
                    <p style="font-weight:700;font-size:17px;color:var(--text-primary);margin:0 0 3px;">Analytics</p>
                    <p style="font-size:12px;color:var(--text-muted);margin:0;" id="chartSubtitle">Visitor analytics of last 30 days</p>
                </div>
                <!-- Tab buttons matching TailAdmin style -->
                <div style="display:flex;align-items:center;gap:4px;background:var(--bg-page);border:1px solid var(--border-color);border-radius:10px;padding:4px;">
                    <button class="chart-tab-btn active" onclick="switchTab(this,'30days')">30 days</button>
                    <button class="chart-tab-btn" onclick="switchTab(this,'7days')">7 days</button>
                    <button class="chart-tab-btn" onclick="switchTab(this,'24hours')">24 hours</button>
                </div>
            </div>
            <div style="position:relative;height:260px;">
                <canvas id="visitorBarChart" aria-label="Bar chart showing visitor analytics."></canvas>
            </div>
        </div>

        <!-- ── ROW 5: CULTURE CARDS ── -->
        <div class="mb-4">
            <p class="section-title">Malaysian Food Culture</p>
            <div class="row g-3">
                <div class="col-6 col-sm-4 col-xl">
                    <div class="culture-card" onclick="this.classList.toggle('flipped')">
                        <div class="culture-inner">
                            <div class="culture-front">
                                <div style="font-size:36px;margin-bottom:8px;">🍛</div>
                                <p style="font-weight:700;font-size:13px;color:var(--text-primary);margin:0;">Malay</p>
                                <p style="font-size:10px;color:var(--text-muted);margin:4px 0 0;">4 recipes</p>
                            </div>
                            <div class="culture-back">
                                <p style="font-weight:700;color:#fbbf24;font-size:11px;margin-bottom:6px;">🍛 Malay</p>
                                <p style="font-size:11px;color:#d1d5db;line-height:1.6;margin:0;">Malay cuisine is rich in flavour and tradition, featuring spicy, savoury, and aromatic dishes that reflect Malaysia’s cultural heritage and unique local ingredients.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-xl">
                    <div class="culture-card" onclick="this.classList.toggle('flipped')">
                        <div class="culture-inner">
                            <div class="culture-front">
                                <div style="font-size:36px;margin-bottom:8px;">🥢</div>
                                <p style="font-weight:700;font-size:13px;color:var(--text-primary);margin:0;">Chinese</p>
                                <p style="font-size:10px;color:var(--text-muted);margin:4px 0 0;">4 recipes</p>
                            </div>
                            <div class="culture-back">
                                <p style="font-weight:700;color:#fbbf24;font-size:11px;margin-bottom:6px;">🥢 Chinese</p>
                                <p style="font-size:11px;color:#d1d5db;line-height:1.6;margin:0;">Chinese cuisine in Malaysia combines traditional Chinese cooking styles with local flavours, creating delicious dishes that are rich, comforting, and diverse.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-xl">
                    <div class="culture-card" onclick="this.classList.toggle('flipped')">
                        <div class="culture-inner">
                            <div class="culture-front">
                                <div style="font-size:36px;margin-bottom:8px;">🫓</div>
                                <p style="font-weight:700;font-size:13px;color:var(--text-primary);margin:0;">Indian</p>
                                <p style="font-size:10px;color:var(--text-muted);margin:4px 0 0;">4 recipes</p>
                            </div>
                            <div class="culture-back">
                                <p style="font-weight:700;color:#fbbf24;font-size:11px;margin-bottom:6px;">🫓 Indian</p>
                                <p style="font-size:11px;color:#d1d5db;line-height:1.6;margin:0;">Indian cuisine is known for its bold spices, creamy curries, and aromatic dishes that bring vibrant flavours and cultural traditions to Malaysian food culture.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-xl">
                    <div class="culture-card" onclick="this.classList.toggle('flipped')">
                        <div class="culture-inner">
                            <div class="culture-front">
                                <div style="font-size:36px;margin-bottom:8px;">🍖</div>
                                <p style="font-weight:700;font-size:13px;color:var(--text-primary);margin:0;">Iban / Dayak</p>
                                <p style="font-size:10px;color:var(--text-muted);margin:4px 0 0;">4 recipes</p>
                            </div>
                            <div class="culture-back">
                                <p style="font-weight:700;color:#fbbf24;font-size:11px;margin-bottom:6px;">🍖 Iban / Dayak</p>
                                <p style="font-size:11px;color:#d1d5db;line-height:1.6;margin:0;">Iban/Dayak cuisine represents the heritage of indigenous communities in Malaysia, featuring natural ingredients, smoked meats, and traditional cooking methods inspired by nature.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-xl">
                    <div class="culture-card" onclick="this.classList.toggle('flipped')">
                        <div class="culture-inner">
                            <div class="culture-front">
                                <div style="font-size:36px;margin-bottom:8px;">🍜</div>
                                <p style="font-weight:700;font-size:13px;color:var(--text-primary);margin:0;">Nyonya</p>
                                <p style="font-size:10px;color:var(--text-muted);margin:4px 0 0;">4 recipes</p>
                            </div>
                            <div class="culture-back">
                                <p style="font-weight:700;color:#fbbf24;font-size:11px;margin-bottom:6px;">🍜 Nyonya</p>
                                <p style="font-size:11px;color:#d1d5db;line-height:1.6;margin:0;">Nyonya cuisine blends Chinese and Malay influences, producing unique dishes with rich flavours, fragrant herbs, and colourful cultural heritage.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p style="font-size:10px;color:var(--text-label);text-align:center;margin-top:10px;">Click on a card to read the cultural story</p>
        </div>

        <!-- ── ROW 6: RECIPE METER (full width) ── -->
        <div class="mm-card chart-card mb-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <p class="stat-label" style="margin-bottom:2px;">Recipe Meter</p>
                    <p style="font-weight:700;font-size:15px;color:var(--text-primary);margin:0;">Total Menus by Culture</p>
                </div>
                <p style="font-size:11px;color:var(--text-muted);margin:0;">Total: <span style="font-weight:700;color:var(--text-primary);" id="meterTotal">20</span> recipes</p>
            </div>
            <div class="d-flex flex-column gap-3" id="meterBars"></div>
        </div>

    </div><!-- /content-inner -->
</main>

<!-- Back To Top -->
<button id="backToTop" title="Back to top">
    <i class="bi bi-chevron-up"></i>
</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    /* ── AUTH ── */
    function handleLogout() { localStorage.removeItem('currentUser'); window.location.href = "login.php"; }
    const username = localStorage.getItem('currentUser');
    if (username) {
        document.getElementById('userGreetingField').innerText = username;
        document.getElementById('avatarInitials').innerText = username.charAt(0).toUpperCase();
    }

    /* ── COOKLIST BADGE — read from localStorage ── */
    (function updateCooklistBadge() {
        const trolley = JSON.parse(localStorage.getItem('mealmemo_trolley')) || [];
        const total = trolley.reduce((s, i) => s + (parseInt(i.quantity) || 1), 0);
        document.getElementById('sidebarCooklistBadge').innerText = total;
    })();

    /* ── SIDEBAR ── */
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('sidebarOverlay').classList.toggle('open');
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebarOverlay').classList.remove('open');
    }

    /* ── THEME ── */
    const html = document.documentElement;
    const savedTheme = localStorage.getItem('mmTheme') || 'light';
    html.setAttribute('data-theme', savedTheme);
    updateThemeIcon(savedTheme);
    function toggleTheme() {
        const next = html.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
        html.setAttribute('data-theme', next);
        localStorage.setItem('mmTheme', next);
        updateThemeIcon(next);
    }
    function updateThemeIcon(t) {
        document.getElementById('themeIcon').className = t === 'dark' ? 'bi bi-sun' : 'bi bi-moon';
    }

    /* ── NOTIFICATION PANEL ── */
    function toggleNotifPanel() {
        document.getElementById('notifPanel').classList.toggle('show');
    }
    document.addEventListener('click', function(e) {
        const panel = document.getElementById('notifPanel');
        if (!panel.contains(e.target) && !document.getElementById('bellBtn').contains(e.target)) {
            panel.classList.remove('show');
        }
    });
    function clearAllNotif() {
        document.getElementById('notifList').innerHTML = '<p style="font-size:12px;color:var(--text-label);text-align:center;padding:16px 0;">No notifications yet.</p>';
    }

    /* ── ACTIVE VISITOR LIVE COUNTER ── */
    let liveCount = 138;
    setInterval(() => {
        liveCount += Math.floor(Math.random() * 7) - 3;
        liveCount = Math.max(80, Math.min(250, liveCount));
        document.getElementById('activeVisitorCount').innerText = liveCount;
    }, 2500);

    /* ── METER BARS — 5 cultures, 4 recipes each ── */
    const meterData = [
        { label:'Malay',              count:4, color:'#d97706' },
        { label:'Chinese',            count:4, color:'#0b1528' },
        { label:'Indian',             count:4, color:'#7c3aed' },
        { label:'Baba Nyonya',        count:4, color:'#db2777' },
        { label:'Indigenous / Borneo',count:4, color:'#059669' },
    ];
    const meterContainer = document.getElementById('meterBars');
    const maxCount = 4;
    let meterTotal = 0;
    meterData.forEach(d => {
        meterTotal += d.count;
        const pct = Math.round((d.count / maxCount) * 100);
        meterContainer.innerHTML += `
            <div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span style="font-size:13px;font-weight:600;color:var(--text-primary);">${d.label}</span>
                    <span style="font-size:11px;color:var(--text-muted);">${d.count} recipes</span>
                </div>
                <div style="width:100%;background:var(--meter-track);border-radius:99px;height:8px;overflow:hidden;">
                    <div class="meter-fill" data-width="${pct}" style="background:${d.color};height:100%;border-radius:99px;"></div>
                </div>
            </div>`;
    });
    document.getElementById('meterTotal').innerText = meterTotal;
    setTimeout(() => {
        document.querySelectorAll('.meter-fill').forEach(b => b.style.width = b.dataset.width + '%');
    }, 300);

    /* ── VISITOR BAR CHART ── */
    const chartDatasets = {
        '30days': {
            labels: Array.from({length:30}, (_,i) => i+1),
            data: [160,370,195,290,160,175,280,100,210,370,130,120,205,250,180,250,300,170,100,370,105,220,270,165,280,285,100,350,280,100],
            subtitle: 'Visitor analytics of last 30 days'
        },
        '7days': {
            labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
            data: [220,315,280,340,190,370,250],
            subtitle: 'Visitor analytics of last 7 days'
        },
        '24hours': {
            labels: ['12am','2am','4am','6am','8am','10am','12pm','2pm','4pm','6pm','8pm','10pm'],
            data: [40,20,15,55,140,210,280,320,270,190,155,90],
            subtitle: 'Visitor analytics of last 24 hours'
        }
    };

    let barChart;
    function buildChart(key) {
        const ds = chartDatasets[key];
        const ctx = document.getElementById('visitorBarChart').getContext('2d');
        if (barChart) barChart.destroy();
        barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ds.labels,
                datasets: [{
                    label: 'Visitors',
                    data: ds.data,
                    backgroundColor: ds.data.map(v => v === Math.max(...ds.data) ? '#4f46e5' : '#818cf8'),
                    borderRadius: 5,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0b1528',
                        titleColor: '#fff',
                        bodyColor: '#d1d5db',
                        padding: 10,
                        cornerRadius: 8
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font:{ size:11 }, color:'#9ca3af',
                            maxTicksLimit: key === '30days' ? 15 : 12 }
                    },
                    y: {
                        grid: { color:'rgba(0,0,0,0.04)' },
                        ticks: { font:{ size:11 }, color:'#9ca3af' },
                        beginAtZero: true
                    }
                }
            }
        });
    }

    function switchTab(btn, key) {
        document.querySelectorAll('.chart-tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById('chartSubtitle').innerText = chartDatasets[key].subtitle;
        buildChart(key);
    }

    buildChart('30days');

    /* ── BACK TO TOP ── */
    const bttBtn = document.getElementById('backToTop');
    bttBtn.onclick = () => window.scrollTo({ top:0, behavior:'smooth' });
    window.addEventListener('scroll', () => {
        bttBtn.classList.toggle('visible', window.scrollY > 300);
    });

    /* ── LOGIN NOTIFICATION ── */
    function injectLoginNotif() {
        const loginTime = localStorage.getItem('mealmemo_loginTime');
        if (!loginTime) return;
        const user = localStorage.getItem('currentUser') || 'User';
        const notifList = document.getElementById('notifList');
        if (!notifList) return;
        if (notifList.querySelector('.login-notif')) return;
        const d = new Date(loginTime);
        const dateStr = d.toLocaleDateString('en-MY', { day:'2-digit', month:'short', year:'numeric' });
        const timeStr = d.toLocaleTimeString('en-MY', { hour:'2-digit', minute:'2-digit', second:'2-digit' });
        if (notifList.querySelector('p')) notifList.innerHTML = '';
        const item = document.createElement('div');
        item.className = 'login-notif';
        item.style.cssText = 'background:var(--input-bg);border:1px solid var(--border-color);border-radius:10px;padding:10px 12px;display:flex;align-items:flex-start;gap:10px;';
        item.innerHTML = `
            <div style="width:32px;height:32px;background:#f0fdf4;border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="bi bi-person-check-fill" style="color:#059669;font-size:14px;"></i>
            </div>
            <div>
                <p style="font-size:12px;font-weight:700;color:var(--text-primary);margin:0 0 1px;">Welcome back, ${user}!</p>
                <p style="font-size:11px;color:var(--text-muted);margin:0;">${dateStr} &nbsp;·&nbsp; ${timeStr}</p>
            </div>`;
        notifList.prepend(item);
    }
    injectLoginNotif();
      function toggleUserDropdown() {
        var dropdown = document.getElementById('userDropdownMenu');
        dropdown.classList.toggle('open');
    }


</script>

<!-- ══════════════ FOOTER ══════════════ -->
<footer id="pageFooter" style="margin-left:var(--sidebar-width);background:var(--bg-topbar);border-top:1px solid var(--border-color);padding:18px 28px;display:flex;align-items:center;justify-content:space-between;transition:margin-left 0.3s,background 0.3s;">
    <span style="font-size:12px;color:var(--text-muted);">&copy; 2026 <strong style="color:var(--text-primary);">IMS566 Company</strong>. All rights reserved.</span>
    <div style="display:flex;align-items:center;gap:14px;">
        <a href="https://www.instagram.com/uitm.official/" target="_blank" rel="noopener" title="UiTM Instagram"
           style="color:var(--text-muted);font-size:20px;text-decoration:none;transition:color 0.2s;"
           onmouseover="this.style.color='#e1306c'" onmouseout="this.style.color='var(--text-muted)'">
            <i class="bi bi-instagram"></i>
        </a>
        <a href="https://www.facebook.com/uitmrasmi/?locale=ms_MY" target="_blank" rel="noopener" title="UiTM Facebook"
           style="color:var(--text-muted);font-size:20px;text-decoration:none;transition:color 0.2s;"
           onmouseover="this.style.color='#1877f2'" onmouseout="this.style.color='var(--text-muted)'">
            <i class="bi bi-facebook"></i>
        </a>
    </div>
</footer>
<script>
/* Keep footer margin in sync when sidebar toggles on mobile */
(function(){
    var footer = document.getElementById("pageFooter");
    if(!footer) return;
    var orig = document.getElementById("sidebar");
    if(!orig) return;
    var obs = new MutationObserver(function(){
        footer.style.marginLeft = orig.classList.contains("open") ? "var(--sidebar-width)" : (window.innerWidth < 992 ? "0" : "var(--sidebar-width)");
    });
    obs.observe(orig, {attributes:true, attributeFilter:["class"]});
    window.addEventListener("resize", function(){
        footer.style.marginLeft = window.innerWidth < 992 ? "0" : "var(--sidebar-width)";
    });
})();
</script>
</body>
</html>