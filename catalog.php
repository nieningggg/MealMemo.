<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MealMemo Recipe Catalog - Browse and filter authentic Malaysian recipes across multiple cultural traditions.">
    <meta name="keywords" content="MealMemo, recipe catalog, Malaysian cuisine, Malay, Chinese, Indian, Nyonya, Borneo, IMS566">
    <meta name="author" content="IMS566 MealMemo Project">
    <title>Catalog - MealMemo.</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts - Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* CSS Variables for Light/Dark Theme */
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
            --input-bg: rgba(255,255,255,0.65);
        }
        
        /* Dark Theme Variables */
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
            --input-bg: rgba(255,255,255,0.06);
        }
        
        /* Reset & Base Styles */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: var(--bg-page); 
            color: var(--text-primary); 
            min-height: 100vh; 
            transition: background 0.3s, color 0.3s; 
        }

        /* ========== SIDEBAR STYLES ========== */
        #sidebar { 
            position: fixed; top: 0; left: 0; 
            width: var(--sidebar-width); height: 100vh; 
            background: var(--bg-sidebar); 
            border-right: 1px solid var(--border-color); 
            backdrop-filter: blur(20px); 
            display: flex; flex-direction: column; 
            z-index: 1040; overflow-y: auto; 
            transition: background 0.3s; 
        }
        
        /* Sidebar Brand / Logo */
        .sidebar-brand { 
            padding: 22px 24px 20px; 
            font-size: 20px; font-weight: 700; 
            color: var(--text-primary); 
            border-bottom: 1px solid var(--border-color); 
            display: flex; align-items: center; gap: 10px; 
            flex-shrink: 0; 
        }
        .sidebar-brand i { color: var(--accent-orange); font-size: 22px; }
        
        /* Sidebar Section Label */
        .sidebar-section-label { 
            font-size: 10px; font-weight: 700; 
            letter-spacing: 1px; color: var(--text-label); 
            text-transform: uppercase; 
            padding: 20px 24px 8px; 
        }
        
        /* Navigation Links */
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
        
        /* Sidebar Footer with Logout Button */
        .sidebar-footer { 
            margin-top: auto; padding: 16px 16px 20px; 
            border-top: 1px solid var(--border-color); 
            flex-shrink: 0; 
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

        /* ========== TOPBAR STYLES ========== */
        #topbar { 
            position: fixed; top: 0; left: var(--sidebar-width); right: 0; 
            height: var(--topbar-height); 
            background: var(--bg-topbar); 
            border-bottom: 1px solid var(--border-color); 
            backdrop-filter: blur(20px); 
            display: flex; align-items: center; 
            padding: 0 28px; gap: 16px; 
            z-index: 1030; transition: left 0.3s, background 0.3s; 
        }
        
        /* Topbar Right Icons & User Menu */
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
        
        /* Notification Dot Animation */
        @keyframes beep { 
            0%,100%{transform:scale(1);opacity:1} 
            25%,75%{transform:scale(1.6);opacity:0.5} 
        }
        .notif-dot { 
            position: absolute; top: 6px; right: 6px; 
            width: 9px; height: 9px; 
            background: #ef4444; border-radius: 50%; 
            border: 2px solid var(--bg-topbar); 
            animation: beep 1.6s ease-in-out infinite; 
        }
        
        /* User Avatar & Name */
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
            font-size: 13px; font-weight: 700; color: #fff; 
            flex-shrink: 0; 
        }
        .topbar-username { font-size: 13px; font-weight: 600; color: var(--text-primary); }

        /* ========== USER DROPDOWN MENU ========== */
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

        /* ========== MAIN CONTENT ========== */
        #main-content { 
            margin-left: var(--sidebar-width); 
            padding-top: var(--topbar-height); 
            min-height: 100vh; 
            transition: margin-left 0.3s; 
        }
        .content-inner { padding: 28px 28px 80px; }

        /* ========== FILTER BAR ========== */
        .filter-bar { 
            background: var(--bg-card); 
            border: 1px solid var(--border-color); 
            border-radius: 16px; 
            padding: 16px 20px; 
            display: flex; align-items: center; 
            flex-wrap: wrap; gap: 10px; 
            box-shadow: var(--card-shadow); 
            margin-bottom: 24px; 
        }
        .filter-pill { 
            padding: 7px 16px; 
            border-radius: 99px; 
            font-size: 12px; font-weight: 600; 
            cursor: pointer; 
            border: 1px solid var(--border-color); 
            background: var(--input-bg); 
            color: var(--text-muted); 
            transition: all 0.18s; 
            white-space: nowrap; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
        }
        .filter-pill:hover { border-color: var(--accent-orange); color: var(--accent-orange); }
        .filter-pill.active { background: var(--accent-orange); color: #fff; border-color: var(--accent-orange); }
        
        /* Filter Search Bar */
        .filter-search { flex: 1; min-width: 180px; max-width: 280px; position: relative; }
        .filter-search i { 
            position: absolute; left: 11px; top: 50%; 
            transform: translateY(-50%); 
            color: var(--text-label); font-size: 13px; 
        }
        .filter-search input { 
            width: 100%; background: var(--input-bg); 
            border: 1px solid var(--border-color); 
            border-radius: 10px; 
            padding: 7px 12px 7px 32px; 
            font-size: 12px; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            color: var(--text-primary); outline: none; 
            transition: border-color 0.2s; 
        }
        .filter-search input::placeholder { color: var(--text-label); }
        .filter-search input:focus { border-color: var(--accent-orange); }
        
        /* Result Count */
        .result-count { margin-left: auto; font-size: 11px; color: var(--text-muted); font-weight: 600; white-space: nowrap; }

        /* ========== RECIPE CARDS ========== */
        .recipe-col { display: flex; }
        .recipe-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 20px; overflow: hidden;
            box-shadow: var(--card-shadow);
            display: flex; flex-direction: column;
            width: 100%;
            transition: box-shadow 0.2s, transform 0.2s, background 0.3s;
        }
        .recipe-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.1); transform: translateY(-2px); }
        
        /* Recipe Image */
        .recipe-img-wrap { position: relative; flex-shrink: 0; height: 180px; overflow: hidden; }
        .recipe-img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .recipe-culture-badge { 
            position: absolute; top: 10px; right: 10px; 
            background: #d97706; color: #fff; 
            font-size: 9px; font-weight: 700; 
            padding: 3px 10px; border-radius: 99px; 
            letter-spacing: 0.5px; text-transform: uppercase; 
        }
        
        /* Recipe Body */
        .recipe-body { padding: 14px 16px; flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .recipe-top { flex-shrink: 0; margin-bottom: 10px; }
        .recipe-id { font-size: 10px; font-family: monospace; color: var(--text-label); font-weight: 700; }
        .recipe-name { font-size: 15px; font-weight: 700; color: var(--text-primary); margin: 2px 0 5px; }
        .recipe-kcal { font-size: 11px; font-weight: 600; color: var(--text-muted); display: flex; align-items: center; gap: 4px; }
        .recipe-kcal i { color: var(--accent-orange); }
        
        /* Scrollable Ingredients & Steps */
        .recipe-scroll { flex: 1; overflow-y: auto; padding-right: 2px; min-height: 0; }
        .recipe-scroll::-webkit-scrollbar { width: 3px; }
        .recipe-scroll::-webkit-scrollbar-thumb { background: var(--border-color); border-radius: 99px; }
        .recipe-divider { border: none; border-top: 1px solid var(--border-color); margin: 10px 0; }
        .recipe-section-label { 
            font-size: 10px; font-weight: 700; text-transform: uppercase; 
            letter-spacing: 0.6px; color: var(--text-label); 
            display: flex; align-items: center; gap: 5px; 
            margin-bottom: 7px; 
        }
        .recipe-section-label i { color: var(--accent-orange); }
        
        /* Ingredients Grid */
        .ingredient-list { 
            list-style: none; padding: 0; 
            display: grid; grid-template-columns: 1fr 1fr; 
            gap: 3px 8px; 
        }
        .ingredient-list li { 
            font-size: 11px; color: var(--text-muted); 
            display: flex; align-items: flex-start; gap: 4px; 
        }
        .ingredient-list li i { color: var(--accent-orange); font-size: 11px; margin-top: 1px; flex-shrink: 0; }
        
        /* Steps List */
        .steps-list { list-style: none; padding: 0; display: flex; flex-direction: column; gap: 4px; }
        .steps-list li { font-size: 11px; color: var(--text-muted); line-height: 1.5; }
        .steps-list li span { font-weight: 700; color: var(--text-primary); }
        
        /* Recipe Footer with Add Button */
        .recipe-footer { padding: 12px 16px 14px; flex-shrink: 0; border-top: 1px solid var(--border-color); }
        .btn-add-cooklist { 
            width: 100%; background: var(--slate-navy); color: #fff; 
            border: none; border-radius: 12px; padding: 10px; 
            font-size: 12px; font-weight: 700; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            display: flex; align-items: center; justify-content: center; 
            gap: 6px; cursor: pointer; transition: background 0.2s; 
        }
        .btn-add-cooklist:hover { background: #1a2d4a; }
        .btn-add-cooklist.added { background: #059669; }

        /* ========== EMPTY STATE ========== */
        .empty-state { text-align: center; padding: 60px 20px; color: var(--text-muted); width: 100%; }
        .empty-state i { font-size: 48px; opacity: 0.2; display: block; margin-bottom: 12px; }

        /* ========== NOTIFICATION PANEL ========== */
        #notifPanel { 
            display: none; position: absolute; 
            top: calc(var(--topbar-height) + 4px); right: 28px; 
            width: 320px; background: var(--bg-card); 
            border: 1px solid var(--border-color); 
            border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,0.12); 
            padding: 16px; z-index: 2000; 
            backdrop-filter: blur(20px); 
        }
        #notifPanel.show { display: block; }

        /* ========== TOAST NOTIFICATION ========== */
        #toast { 
            position: fixed; bottom: 28px; left: 50%; 
            transform: translateX(-50%) translateY(16px); 
            background: #0b1528; color: #fff; 
            padding: 10px 20px; border-radius: 12px; 
            font-size: 12px; font-weight: 600; 
            opacity: 0; pointer-events: none; 
            transition: opacity 0.3s, transform 0.3s; 
            z-index: 9999; white-space: nowrap; 
            display: flex; align-items: center; gap: 8px; 
        }
        #toast.show { opacity: 1; transform: translateX(-50%) translateY(0); pointer-events: all; }
        #toast i { color: #34d399; }

        /* ========== BACK TO TOP BUTTON ========== */
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
        #backToTop.visible { opacity: 1; transform: translateY(0); pointer-events: all; }
        #backToTop:hover { background: #b45309; }

        /* ========== SIDEBAR OVERLAY (mobile) ========== */
        #sidebarOverlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 1039; }

        /* ========== RESPONSIVE DESIGN ========== */
        @media (max-width: 991.98px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.open { transform: translateX(0); }
            #sidebarOverlay.open { display: block; }
            #main-content { margin-left: 0; }
            #topbar { left: 0; }
            #pageFooter { margin-left: 0 !important; }
        }
        
        /* Scrollbar Styling */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.12); border-radius: 99px; }
        [data-theme="dark"] ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); }
    </style>
</head>
<body>

<!-- ========== SIDEBAR ========== -->
<nav id="sidebar">
    <div class="sidebar-brand"><i class="bi bi-egg-fried"></i> MealMemo.</div>
    <div class="sidebar-section-label">Menu</div>
    
    <!-- Navigation Links -->
    <a href="dashboard.php" class="nav-item-link"><span class="nav-left"><i class="bi bi-grid-1x2-fill"></i> Overview</span></a>
    <a href="catalog.php" class="nav-item-link active"><span class="nav-left"><i class="bi bi-book"></i> Catalog</span></a>
    <a href="cooklist.php" class="nav-item-link">
        <span class="nav-left"><i class="bi bi-journal-check"></i> Cooklist</span>
        <span id="sidebarCooklistBadge" class="badge rounded-pill" style="background:var(--accent-orange);font-size:10px;">0</span>
    </a>
    <a href="calorie-evaluation.php" class="nav-item-link"><span class="nav-left"><i class="bi bi-calculator"></i> Calorie Evaluation</span></a>
    
    <div class="sidebar-section-label" style="margin-top:8px;">Support</div>
    <a href="help.php" class="nav-item-link"><span class="nav-left"><i class="bi bi-chat-dots-fill"></i> Contact Us</span></a>
    
    <!-- Sidebar Footer with Logout Button -->
    <div class="sidebar-footer">
        <button class="btn-logout" onclick="handleLogout()"><i class="bi bi-box-arrow-left"></i> Log Out</button>
    </div>
</nav>

<!-- Mobile Sidebar Overlay -->
<div id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- ========== TOPBAR ========== -->
<header id="topbar">
    <div class="topbar-right" style="margin-left:auto;">
        <!-- Theme Toggle Button -->
        <div class="topbar-icon-btn" onclick="toggleTheme()" title="Toggle theme">
            <i id="themeIcon" class="bi bi-moon"></i>
        </div>
        
        <!-- Notification Bell Button -->
        <div class="topbar-icon-btn" onclick="toggleNotifPanel()" id="bellBtn" title="Notifications">
            <i class="bi bi-bell"></i>
            <span class="notif-dot" id="notifDot"></span>
        </div>
        
        <div style="width:1px;height:22px;background:var(--border-color);"></div>
        
        <!-- User Dropdown Menu -->
        <div class="user-dropdown-wrap" id="userDropdownWrap">
            <div class="topbar-user" onclick="toggleUserDropdown()" style="cursor:pointer;">
                <div class="topbar-avatar" id="avatarInitials">G</div>
                <span class="topbar-username" id="userGreetingField">Guest</span>
                <i class="bi bi-chevron-down" style="font-size:11px;color:var(--text-muted);"></i>
            </div>
            <div class="user-dropdown-menu" id="userDropdownMenu">
                <a href="password.php" class="user-dropdown-item"><i class="bi bi-key"></i> Change Password</a>
                <div class="user-dropdown-divider"></div>
                <div class="user-dropdown-item" onclick="handleLogout()"><i class="bi bi-box-arrow-left"></i> Log Out</div>
            </div>
        </div>
    </div>
</header>

<!-- ========== NOTIFICATION PANEL ========== -->
<div id="notifPanel">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p style="font-weight:700;font-size:13px;color:var(--text-primary);">Notifications</p>
        <button onclick="clearAllNotif()" style="background:none;border:none;font-size:11px;color:var(--text-label);cursor:pointer;">Clear all</button>
    </div>
    <div id="notifList" style="display:flex;flex-direction:column;gap:8px;max-height:300px;overflow-y:auto;">
        <p style="font-size:12px;color:var(--text-label);text-align:center;padding:16px 0;">No notifications yet.</p>
    </div>
</div>

<!-- ========== MAIN CONTENT ========== -->
<main id="main-content">
    <div class="content-inner">

        <!-- Page Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 style="font-size:20px;font-weight:700;color:var(--text-primary);margin:0;">Recipe Catalog</h1>
                <p style="font-size:12px;color:var(--text-muted);margin:4px 0 0;">Browse and manage all food metadata records</p>
            </div>
            <span style="background:#fef3c7;color:#92400e;font-size:10px;font-weight:700;padding:5px 12px;border-radius:99px;letter-spacing:0.5px;">IMS566 Company</span>
        </div>

        <!-- ========== FILTER BAR ========== -->
        <div class="filter-bar">
            <!-- Culture Filter Pills -->
            <button class="filter-pill active" onclick="setCulture(this,'All')">All Cultures</button>
            <button class="filter-pill" onclick="setCulture(this,'Malay')">🍛 Malay</button>
            <button class="filter-pill" onclick="setCulture(this,'Chinese')">🥢 Chinese</button>
            <button class="filter-pill" onclick="setCulture(this,'Indian')">🫓 Indian</button>
            <button class="filter-pill" onclick="setCulture(this,'Baba Nyonya')">🍜 Baba Nyonya</button>
            <button class="filter-pill" onclick="setCulture(this,'Indigenous / Borneo')">🍖 Borneo</button>
            
            <div style="width:1px;height:24px;background:var(--border-color);flex-shrink:0;"></div>
            
            <!-- Search Bar -->
            <div class="filter-search">
                <i class="bi bi-search"></i>
                <input type="text" id="recipeSearchBar" onkeyup="filterRecipes()" placeholder="Search by name or ID...">
            </div>
            
            <!-- Result Count -->
            <span class="result-count" id="resultCount">20 records</span>
        </div>

        <!-- ========== RECIPE GRID ========== -->
        <div class="row g-4" id="recipe-container"></div>

    </div>
</main>

<!-- ========== TOAST NOTIFICATION ========== -->
<div id="toast"><i class="bi bi-check-circle-fill"></i> <span id="toastMsg"></span></div>

<!-- ========== BACK TO TOP BUTTON ========== -->
<button id="backToTop" title="Back to top"><i class="bi bi-chevron-up"></i></button>

<!-- ========== FOOTER ========== -->
<footer id="pageFooter" style="margin-left:var(--sidebar-width);background:var(--bg-topbar);border-top:1px solid var(--border-color);padding:18px 28px;display:flex;align-items:center;justify-content:space-between;transition:margin-left 0.3s,background 0.3s;">
    <span style="font-size:12px;color:var(--text-muted);">&copy; 2026 <strong style="color:var(--text-primary);">IMS566 Company</strong>. All rights reserved.</span>
    <div style="display:flex;align-items:center;gap:14px;">
        <a href="https://www.instagram.com/uitm.official/" target="_blank" rel="noopener" style="color:var(--text-muted);font-size:20px;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#e1306c'" onmouseout="this.style.color='var(--text-muted)'"><i class="bi bi-instagram"></i></a>
        <a href="https://www.facebook.com/uitmrasmi/?locale=ms_MY" target="_blank" rel="noopener" style="color:var(--text-muted);font-size:20px;text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#1877f2'" onmouseout="this.style.color='var(--text-muted)'"><i class="bi bi-facebook"></i></a>
    </div>
</footer>

<!-- ========== JAVASCRIPT ========== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    /* ========== RECIPE DATA ========== */
    const recipes = [
        { id:"MAL001", name:"Nasi Lemak", culture:"Malay", calories:644, image:"https://images.unsplash.com/photo-1570275239925-4af0aa93a0dc?q=80&w=600&auto=format&fit=crop", ingredients:["2 cups rice","1 cup coconut milk","1 cup water","2 pandan leaves","1 tsp salt","2 boiled eggs","½ cup fried anchovies","½ cup peanuts","4 tbsp sambal"], instructions:["Wash the rice until clean.","Put rice into rice cooker.","Add coconut milk, water, pandan leaves, and salt.","Cook the rice.","Boil the eggs and cut into halves.","Serve rice with sambal, anchovies, peanuts, and eggs."] },
        { id:"MAL002", name:"Fried Noodle", culture:"Malay", calories:512, image:"https://images.unsplash.com/photo-1645696329525-8ec3bee460a9?w=600&auto=format&fit=crop&q=60", ingredients:["400g yellow noodles","2 cloves garlic (chopped)","1 egg","1 cup vegetables","2 tbsp chili sauce","2 tbsp soy sauce","2 tbsp oil"], instructions:["Heat oil in a pan.","Fry garlic until fragrant.","Add egg and scramble it.","Add vegetables and cook for 2 minutes.","Add noodles, chili sauce, and soy sauce.","Stir-fry for 3–5 minutes and serve hot."] },
        { id:"MAL003", name:"Satay", culture:"Malay", calories:365, image:"https://images.unsplash.com/photo-1742808838159-1848c1a36209?w=600&auto=format&fit=crop&q=60", ingredients:["500g chicken pieces","1 tsp turmeric powder","2 cloves garlic","1 tbsp sugar","1 tsp salt","Satay sticks"], instructions:["Blend garlic with turmeric powder, sugar, and salt.","Marinate chicken for 30 minutes.","Put chicken onto satay sticks.","Grill for 10–15 minutes while turning occasionally.","Serve with peanut sauce."] },
        { id:"MAL004", name:"Bubur Cha Cha", culture:"Malay", calories:290, image:"https://static.cdntap.com/tap-assets-prod/wp-content/uploads/sites/6/2024/08/MixCollage-13-Aug-2024-04-00-PM-848.jpg?width=700&quality=80", ingredients:["1 sweet potato (cubed)","½ cup sago pearls","2 cups coconut milk","3 tbsp sugar","2 pandan leaves","3 cups water"], instructions:["Boil water and cook sweet potatoes until soft.","Add sago pearls and cook until transparent.","Add sugar and pandan leaves.","Pour in coconut milk and stir gently.","Serve warm or chilled."] },
        { id:"CHN001", name:"Fried Rice", culture:"Chinese", calories:450, image:"https://images.unsplash.com/photo-1603133872878-684f208fb84b?q=80&w=600&auto=format&fit=crop", ingredients:["2 cups cooked rice","2 eggs","2 cloves garlic","1 cup mixed vegetables","2 tbsp soy sauce","2 tbsp oil"], instructions:["Heat oil in a wok.","Fry garlic until fragrant.","Add eggs and scramble them.","Add vegetables and cook for 2 minutes.","Add rice and soy sauce.","Stir well and serve hot."] },
        { id:"CHN002", name:"Spring Rolls", culture:"Chinese", calories:180, image:"https://plus.unsplash.com/premium_photo-1695756121533-3f60bee7ba7b?w=600&auto=format&fit=crop&q=60", ingredients:["10 spring roll wrappers","1 cup shredded vegetables","2 cloves garlic","2 tbsp oil"], instructions:["Heat oil and fry garlic.","Add vegetables and cook for 3 minutes.","Put filling into wrappers and roll tightly.","Fry rolls until golden brown.","Drain oil and serve hot."] },
        { id:"CHN003", name:"Steamed Egg", culture:"Chinese", calories:120, image:"https://media.istockphoto.com/id/640929388/photo/steamed-egg-with-green-onion.jpg?s=612x612&w=0&k=20&c=qzeTWcYZDPg19A1NtTQ0Wq2ycH9NGkm6n9roTRMTzwI=", ingredients:["2 eggs","1 cup warm water","1 tsp soy sauce","Spring onion slices"], instructions:["Beat eggs in a bowl.","Add warm water and mix gently.","Steam for 10–15 minutes.","Add soy sauce and spring onion before serving."] },
        { id:"CHN004", name:"Sweet and Sour Chicken", culture:"Chinese", calories:520, image:"https://images.unsplash.com/photo-1525755662778-989d0524087e?q=80&w=600&auto=format&fit=crop", ingredients:["300g chicken pieces","½ onion","½ cup pineapple chunks","½ bell pepper","3 tbsp tomato sauce","2 tbsp oil"], instructions:["Heat oil and fry chicken until cooked.","Add onion and bell pepper.","Add pineapple and tomato sauce.","Stir well for 3 minutes.","Serve with rice."] },
        { id:"IND001", name:"Chapati", culture:"Indian", calories:360, image:"https://images.unsplash.com/photo-1599232288126-7dbd2127db14?w=600&auto=format&fit=crop&q=60", ingredients:["2 cups flour","¾ cup water","1 tsp salt","2 tbsp butter"], instructions:["Mix flour, salt, water, and butter into dough.","Knead until smooth.","Rest dough for 30 minutes.","Flatten and fold dough.","Cook on hot pan until golden brown."] },
        { id:"IND002", name:"Chicken Curry", culture:"Indian", calories:545, image:"https://images.unsplash.com/photo-1708782344490-9026aaa5eec7?w=600&auto=format&fit=crop&q=60", ingredients:["500g chicken","2 tbsp curry powder","1 onion (sliced)","2 potatoes","1 cup coconut milk","2 tbsp oil"], instructions:["Heat oil and fry onions.","Add curry powder and stir well.","Add chicken and potatoes.","Pour water and cook for 15 minutes.","Add coconut milk and simmer for 5 minutes.","Serve hot with rice."] },
        { id:"IND003", name:"Tosai", culture:"Indian", calories:210, image:"https://images.unsplash.com/photo-1668236543090-82eba5ee5976?q=80&w=600&auto=format&fit=crop", ingredients:["1 cup rice flour","½ cup lentils","2 cups water","1 tsp salt"], instructions:["Blend ingredients into smooth batter.","Leave batter overnight.","Pour batter onto hot pan.","Spread thinly and cook until crispy.","Fold and serve hot."] },
        { id:"IND004", name:"Payasam", culture:"Indian", calories:315, image:"https://cdn.indiaphile.info/wp-content/uploads/2025/02/payasam-8921.jpg?width=1200&crop_gravity=center&aspect_ratio=auto&q=75", ingredients:["1 cup vermicelli","3 cups milk","4 tbsp sugar","½ tsp cardamom powder","2 tbsp raisins"], instructions:["Heat milk in a pot.","Add vermicelli and cook until soft.","Add sugar and cardamom powder.","Stir in raisins.","Serve warm."] },
        { id:"BBY001", name:"Laksa Nyonya", culture:"Baba Nyonya", calories:589, image:"https://media.istockphoto.com/id/864951294/photo/nyonya-curry-laksa.jpg?s=612x612&w=0&k=20&c=t3Ghk8Gwgdu5QOQ1kGLGUHJYvsoWtCBIGJDVXSSpJqA=", ingredients:["200g rice noodles","2 cups coconut milk","3 tbsp laksa paste","200g shrimp","1 cup bean sprouts"], instructions:["Cook laksa paste in a pot for 2 minutes.","Add coconut milk and 2 cups water.","Add shrimp and cook until pink.","Prepare noodles in bowls.","Pour soup over noodles.","Top with bean sprouts and serve."] },
        { id:"BBY002", name:"Ayam Pongteh", culture:"Baba Nyonya", calories:430, image:"https://plus.unsplash.com/premium_photo-1661265946882-e2a01db641d4?q=80&w=600&auto=format&fit=crop", ingredients:["500g chicken","2 potatoes","2 tbsp soybean paste","3 cloves garlic","2 tbsp soy sauce","2 cups water"], instructions:["Fry garlic until fragrant.","Add chicken and potatoes.","Add soybean paste and soy sauce.","Pour water and simmer for 20 minutes.","Serve hot with rice."] },
        { id:"BBY003", name:"Nyonya Asam Pedas", culture:"Baba Nyonya", calories:350, image:"https://media.istockphoto.com/id/1319506071/photo/spicy-acid.jpg?s=612x612&w=0&k=20&c=CDgJdGaoikEiShWXyCqke34-AV5dmeHsTkd12ssfb5g=", ingredients:["Fish (mackerel)","Tamarind paste","Chili paste","Shallots","Garlic","Ginger","Salt"], instructions:["Sauté blended ingredients until fragrant.","Add water and tamarind paste.","Add fish and simmer until cooked.","Season with salt and sugar.","Serve hot."] },
        { id:"BBY004", name:"Cendol", culture:"Baba Nyonya", calories:320, image:"https://images.unsplash.com/photo-1603955813288-c89f4ad8b1e1?w=600&auto=format&fit=crop&q=60", ingredients:["1 cup cendol jelly","1 cup coconut milk","½ cup gula Melaka syrup","2 cups shaved ice"], instructions:["Put shaved ice into serving bowl.","Add cendol jelly.","Pour coconut milk and gula Melaka syrup.","Serve immediately."] },
        { id:"INDG001", name:"Manok Pansoh", culture:"Indigenous / Borneo", calories:410, image:"https://www.iloveborneo.my/wp-content/uploads/2025/03/manuk-pansoh.jpg", ingredients:["500g chicken","2 stalks lemongrass","1 inch ginger","1 tsp salt","1 bamboo tube"], instructions:["Slice lemongrass and ginger.","Mix chicken with all ingredients.","Put mixture into bamboo tube.","Roast over fire for 30–40 minutes.","Serve hot."] },
        { id:"INDG002", name:"Hinava", culture:"Indigenous / Borneo", calories:230, image:"https://www.iloveborneo.my/wp-content/uploads/2022/11/192641977_311851713865257_4546435731127599506_n.jpg.webp", ingredients:["300g fresh fish","4 tbsp lime juice","1 inch ginger","2 chilies","½ onion"], instructions:["Slice fish thinly.","Pour lime juice over fish.","Add sliced ginger, chilies, and onion.","Mix well and serve fresh."] },
        { id:"INDG003", name:"Linopot", culture:"Indigenous / Borneo", calories:280, image:"https://scontent.fpen1-1.fna.fbcdn.net/v/t39.30808-6/485772215_1050404047120212_6457826580633626251_n.jpg?stp=dst-jpg_s640x640_tt6&_nc_cat=105&ccb=1-7&_nc_sid=127cfc&_nc_ohc=cNSmYwtbBqkQ7kNvwGpzQLq&_nc_oc=AdoZI55Uw_dOGVUYaETDRotz7NPH86ALf-_0_abvKYZdQkh13jxuXVLuW5XrrbtqyqW2BH1fG8XSZQeE3GXmnCDB&_nc_zt=23&_nc_ht=scontent.fpen1-1.fna&_nc_gid=5rNARYJmtyNDrAgs0An5Fg&_nc_ss=7b289&oh=00_Af6IZoTuWQqRdy8a7ujJjY6KZHcZywRws4Y_2VbtamvTmw&oe=6A1E2395", ingredients:["2 cups rice","1 cup sweet potato leaves","Banana leaves","1 tsp salt"], instructions:["Cook rice with salt.","Prepare banana leaves.","Wrap rice with sweet potato leaves inside banana leaves.","Steam for 5 minutes.","Serve warm."] },
        { id:"INDG004", name:"Penganan", culture:"Indigenous / Borneo", calories:340, image:"https://media.astroawani.com/awani/media/article/2019/May/18/51558165525_freesize.jpg", ingredients:["2 cups rice flour","1 cup grated coconut","½ cup sugar","1 cup water"], instructions:["Mix all ingredients into dough.","Shape into small balls or pieces.","Heat oil in a pan.","Fry until golden brown.","Drain oil and serve."] }
    ];

    /* ========== AUTHENTICATION ========== */
    // Get current logged-in user from localStorage
    const currentUser = localStorage.getItem('currentUser');
    if (currentUser) {
        document.getElementById('userGreetingField').innerText = currentUser;
        document.getElementById('avatarInitials').innerText = currentUser.charAt(0).toUpperCase();
    }
    
    // Handle logout - clear user data and redirect to login
    function handleLogout() { 
        localStorage.removeItem('currentUser'); 
        window.location.href = "login.php"; 
    }

    /* ========== COOKLIST BADGE ========== */
    // Update the cooklist badge count in sidebar
    function updateBadge() {
        const t = JSON.parse(localStorage.getItem('mealmemo_trolley')) || [];
        document.getElementById('sidebarCooklistBadge').innerText = t.reduce((s,i) => s + (parseInt(i.quantity)||1), 0);
    }

    /* ========== SIDEBAR FUNCTIONS ========== */
    // Toggle sidebar open/close (for mobile)
    function toggleSidebar() { 
        document.getElementById('sidebar').classList.toggle('open'); 
        document.getElementById('sidebarOverlay').classList.toggle('open'); 
    }
    function closeSidebar() { 
        document.getElementById('sidebar').classList.remove('open');  
        document.getElementById('sidebarOverlay').classList.remove('open'); 
    }

    /* ========== THEME TOGGLE (Light/Dark) ========== */
    const html = document.documentElement;
    const savedTheme = localStorage.getItem('mmTheme') || 'light';
    html.setAttribute('data-theme', savedTheme);
    document.getElementById('themeIcon').className = savedTheme === 'dark' ? 'bi bi-sun' : 'bi bi-moon';
    
    function toggleTheme() {
        const next = html.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
        html.setAttribute('data-theme', next); 
        localStorage.setItem('mmTheme', next);
        document.getElementById('themeIcon').className = next === 'dark' ? 'bi bi-sun' : 'bi bi-moon';
    }

    /* ========== LOGIN NOTIFICATION ========== */
    // Display welcome back notification when user just logged in
    function injectLoginNotif() {
        const loginTime = localStorage.getItem('mealmemo_loginTime');
        if (!loginTime || !currentUser) return;
        const notifList = document.getElementById('notifList');
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
                <p style="font-size:12px;font-weight:700;color:var(--text-primary);margin:0;">Welcome back, ${currentUser}!</p>
                <p style="font-size:11px;color:var(--text-muted);margin:2px 0 0;">Logged in on ${dateStr} at ${timeStr}</p>
            </div>`;
        notifList.prepend(item);
    }

    /* ========== NOTIFICATION PANEL ========== */
    function toggleNotifPanel() { 
        document.getElementById('notifPanel').classList.toggle('show'); 
    }
    
    // Close notification panel when clicking outside
    document.addEventListener('click', e => {
        const p = document.getElementById('notifPanel');
        if (!p.contains(e.target) && !document.getElementById('bellBtn').contains(e.target)) 
            p.classList.remove('show');
    });
    
    function clearAllNotif() {
        document.getElementById('notifList').innerHTML = '<p style="font-size:12px;color:var(--text-label);text-align:center;padding:16px 0;">No notifications yet.</p>';
    }

    /* ========== FILTER FUNCTIONS ========== */
    let activeCulture = 'All';
    
    // Set active culture filter
    function setCulture(btn, culture) {
        document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
        btn.classList.add('active'); 
        activeCulture = culture; 
        filterRecipes();
    }
    
    // Filter recipes based on culture and search keyword
    function filterRecipes() {
        const keyword = document.getElementById('recipeSearchBar').value.toLowerCase();
        renderRecipes(activeCulture, keyword);
    }

    /* ========== RENDER RECIPES ========== */
    function renderRecipes(culture = 'All', keyword = '') {
        const container = document.getElementById('recipe-container');
        container.innerHTML = '';
        
        // Filter data
        let filtered = recipes;
        if (culture !== 'All') filtered = filtered.filter(r => r.culture === culture);
        if (keyword) filtered = filtered.filter(r => r.name.toLowerCase().includes(keyword) || r.id.toLowerCase().includes(keyword));
        
        // Update result count
        document.getElementById('resultCount').innerText = filtered.length + ' record' + (filtered.length !== 1 ? 's' : '');
        
        // Show empty state if no results
        if (filtered.length === 0) {
            container.innerHTML = `<div class="empty-state"><i class="bi bi-search"></i><p style="font-size:14px;font-weight:600;">No records found</p><p style="font-size:12px;margin-top:4px;">Try a different search or filter.</p></div>`;
            return;
        }
        
        // Get current trolley from localStorage
        const trolley = JSON.parse(localStorage.getItem('mealmemo_trolley')) || [];
        const inTrolley = new Set(trolley.map(t => t.id));
        
        // Render each recipe card
        filtered.forEach(r => {
            const ingredientsHTML = r.ingredients.map(i => `<li><i class="bi bi-check2"></i>${i}</li>`).join('');
            const stepsHTML = r.instructions.map((s, idx) => `<li><span>${idx+1}.</span> ${s}</li>`).join('');
            const added = inTrolley.has(r.id);
            
            container.innerHTML += `
                <div class="col-12 col-md-6 col-xl-4 recipe-col">
                    <div class="recipe-card">
                        <!-- Recipe Image -->
                        <div class="recipe-img-wrap">
                            <img src="${r.image}" class="recipe-img" alt="${r.name}" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&auto=format&fit=crop'">
                            <span class="recipe-culture-badge">${r.culture}</span>
                        </div>
                        
                        <!-- Recipe Body -->
                        <div class="recipe-body">
                            <div class="recipe-top">
                                <div class="recipe-id">${r.id}</div>
                                <div class="recipe-name">${r.name}</div>
                                <div class="recipe-kcal"><i class="bi bi-fire"></i> ${r.calories} kcal / serving</div>
                            </div>
                            
                            <!-- Scrollable Ingredients & Steps -->
                            <div class="recipe-scroll">
                                <hr class="recipe-divider">
                                <div class="recipe-section-label"><i class="bi bi-egg"></i> Ingredients</div>
                                <ul class="ingredient-list">${ingredientsHTML}</ul>
                                <hr class="recipe-divider">
                                <div class="recipe-section-label"><i class="bi bi-list-ol"></i> Cooking Steps</div>
                                <ul class="steps-list">${stepsHTML}</ul>
                            </div>
                        </div>
                        
                        <!-- Recipe Footer with Add Button -->
                        <div class="recipe-footer">
                            <button id="btn-${r.id}" onclick="addToTrolley('${r.id}','${r.name}',${r.calories})"
                                class="btn-add-cooklist ${added ? 'added' : ''}">
                                <i class="bi ${added ? 'bi-check-circle-fill' : 'bi-plus-circle'}"></i>
                                ${added ? 'Added to Cooklist' : 'Add to Cooklist'}
                            </button>
                        </div>
                    </div>
                </div>`;
        });
    }

    /* ========== ADD TO COOKLIST ========== */
    function addToTrolley(id, name, calories) {
        let trolley = JSON.parse(localStorage.getItem('mealmemo_trolley')) || [];
        const existing = trolley.find(i => i.id === id);
        
        if (existing) { 
            existing.quantity += 1; 
        } else { 
            trolley.push({ id, name, calories, quantity: 1 }); 
        }
        
        localStorage.setItem('mealmemo_trolley', JSON.stringify(trolley));
        updateBadge();
        
        // Update button state
        const btn = document.getElementById('btn-' + id);
        if (btn) { 
            btn.classList.add('added'); 
            btn.innerHTML = '<i class="bi bi-check-circle-fill"></i> Added to Cooklist'; 
        }
        
        showToast(name + ' added to Cooklist!');
        
        // Add notification
        const notifList = document.getElementById('notifList');
        if (notifList.querySelector('p:not(.login-notif)') && !notifList.querySelector('.login-notif')) 
            notifList.innerHTML = '';
        
        const t = new Date().toLocaleTimeString('en-MY', {hour:'2-digit', minute:'2-digit'});
        const item = document.createElement('div');
        item.style.cssText = 'background:var(--input-bg);border:1px solid var(--border-color);border-radius:10px;padding:8px 10px;display:flex;align-items:center;gap:8px;';
        item.innerHTML = `<div style="width:28px;height:28px;background:#fff7ed;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="bi bi-journal-plus" style="color:var(--accent-orange);font-size:12px;"></i></div><div><p style="font-size:12px;font-weight:700;color:var(--text-primary);margin:0;">${name}</p><p style="font-size:10px;color:var(--text-muted);margin:1px 0 0;">Added to Cooklist · ${t}</p></div>`;
        notifList.prepend(item);
    }

    // Show toast message
    function showToast(msg) {
        const toast = document.getElementById('toast');
        document.getElementById('toastMsg').innerText = msg;
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 2800);
    }

    /* ========== BACK TO TOP BUTTON ========== */
    const bttBtn = document.getElementById('backToTop');
    bttBtn.onclick = () => window.scrollTo({ top:0, behavior:'smooth' });
    window.addEventListener('scroll', () => bttBtn.classList.toggle('visible', window.scrollY > 300));

    /* ========== FOOTER RESPONSIVE ========== */
    (function(){
        const footer = document.getElementById('pageFooter');
        const sidebar = document.getElementById('sidebar');
        new MutationObserver(() => { 
            footer.style.marginLeft = window.innerWidth < 992 ? '0' : 'var(--sidebar-width)'; 
        }).observe(sidebar, {attributes:true, attributeFilter:['class']});
        window.addEventListener('resize', () => { 
            footer.style.marginLeft = window.innerWidth < 992 ? '0' : 'var(--sidebar-width)'; 
        });
    })();

    /* ========== USER DROPDOWN TOGGLE ========== */
    function toggleUserDropdown() {
        var dropdown = document.getElementById('userDropdownMenu');
        dropdown.classList.toggle('open');
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        var dropdown = document.getElementById('userDropdownMenu');
        var userWrap = document.getElementById('userDropdownWrap');
        if (userWrap && !userWrap.contains(event.target)) {
            dropdown.classList.remove('open');
        }
    });

    /* ========== INITIALIZE PAGE ========== */
    renderRecipes('All');
    updateBadge();
    injectLoginNotif();
</script>
</body>
</html>