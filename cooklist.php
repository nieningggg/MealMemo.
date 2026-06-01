<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MealMemo Cooklist - Track and manage your personal cooking plan and meal completion history.">
    <meta name="keywords" content="MealMemo, cooklist, meal planner, cooking tracker, IMS566">
    <meta name="author" content="IMS566 MealMemo Project">
    <title>Cooklist - MealMemo.</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts - Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Chart.js for pie chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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
            --table-row-hover: rgba(0,0,0,0.02);
            --divider: rgba(0,0,0,0.06);
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
            --table-row-hover: rgba(255,255,255,0.03);
            --divider: rgba(255,255,255,0.06);
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
            transition: transform 0.3s ease, background 0.3s; 
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
        
        /* Hamburger Menu Button (mobile only) */
        .hamburger-btn { 
            background: none; border: none; 
            color: var(--text-muted); font-size: 20px; 
            cursor: pointer; padding: 4px 8px; 
            border-radius: 8px; display: none; 
            transition: background 0.2s; 
        }
        .hamburger-btn:hover { background: var(--bg-hover-nav); }
        
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

        /* ========== CARD STYLES ========== */
        .mm-card { 
            background: var(--bg-card); 
            border: 1px solid var(--border-color); 
            border-radius: 18px; 
            box-shadow: var(--card-shadow); 
            backdrop-filter: blur(12px); 
            transition: background 0.3s, border-color 0.3s; 
        }

        /* ========== TABLE STYLES ========== */
        .mm-table { width: 100%; border-collapse: collapse; }
        .mm-table thead th { 
            font-size: 10px; font-weight: 700; 
            text-transform: uppercase; letter-spacing: 0.7px; 
            color: var(--text-label); padding: 10px 14px; 
            border-bottom: 1px solid var(--border-color); 
            white-space: nowrap; 
        }
        .mm-table tbody tr { border-bottom: 1px solid var(--divider); transition: background 0.15s; }
        .mm-table tbody tr:hover { background: var(--table-row-hover); }
        .mm-table tbody td { padding: 13px 14px; font-size: 13px; color: var(--text-primary); font-weight: 500; }
        .mm-table tbody td.cooked-row { opacity: 0.55; }

        /* Status Badges */
        .badge-cooked { 
            background: #d1fae5; color: #065f46; 
            font-size: 10px; font-weight: 700; 
            padding: 3px 10px; border-radius: 99px; 
            display: inline-flex; align-items: center; gap: 4px; 
        }
        .badge-pending { 
            background: #fef3c7; color: #92400e; 
            font-size: 10px; font-weight: 700; 
            padding: 3px 10px; border-radius: 99px; 
            display: inline-flex; align-items: center; gap: 4px; 
        }
        [data-theme="dark"] .badge-cooked { background: rgba(5,150,105,0.2); color: #34d399; }
        [data-theme="dark"] .badge-pending { background: rgba(217,119,6,0.2); color: #fbbf24; }

        /* Quantity Control Buttons */
        .qty-btn { 
            width: 22px; height: 22px; 
            border: 1px solid var(--border-color); 
            border-radius: 6px; background: var(--input-bg); 
            color: var(--text-primary); font-size: 12px; font-weight: 700; 
            display: flex; align-items: center; justify-content: center; 
            cursor: pointer; transition: background 0.15s; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
        }
        .qty-btn:hover { background: var(--bg-hover-nav); }
        .qty-btn:disabled { opacity: 0.3; cursor: not-allowed; }

        /* Remove Button */
        .btn-remove { 
            background: rgba(239,68,68,0.08); 
            border: none; color: #ef4444; 
            width: 30px; height: 30px; 
            border-radius: 8px; 
            display: flex; align-items: center; justify-content: center; 
            cursor: pointer; font-size: 13px; 
            transition: background 0.15s; 
        }
        .btn-remove:hover { background: rgba(239,68,68,0.18); }

        /* Cook Checkbox */
        .cook-check { width: 16px; height: 16px; accent-color: var(--accent-orange); cursor: pointer; }

        /* History Table */
        .mm-table.history tbody tr { background: rgba(5,150,105,0.01); }
        .mm-table.history tbody tr:hover { background: rgba(5,150,105,0.03); }

        /* Pie Chart Card */
        .pie-card { 
            background: linear-gradient(135deg, #0b1528 0%, #1a2d4a 100%); 
            border-radius: 18px; padding: 24px; 
            color: white; 
        }

        /* Action Buttons */
        .btn-reset { 
            background: var(--input-bg); 
            border: 1px solid var(--border-color); 
            color: var(--text-primary); 
            border-radius: 12px; padding: 10px 20px; 
            font-size: 12px; font-weight: 700; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            display: flex; align-items: center; gap: 6px; 
            cursor: pointer; transition: background 0.2s; 
        }
        .btn-reset:hover { background: var(--bg-hover-nav); }
        .btn-proceed { 
            background: var(--accent-orange); 
            border: none; color: #fff; 
            border-radius: 12px; padding: 10px 20px; 
            font-size: 12px; font-weight: 700; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            display: flex; align-items: center; gap: 6px; 
            cursor: pointer; text-decoration: none; 
            transition: background 0.2s; 
        }
        .btn-proceed:hover { background: #b45309; color: #fff; }

        /* ========== NOTIFICATION PANEL ========== */
        #notifPanel { 
            display: none; position: absolute; 
            top: calc(var(--topbar-height) + 4px); right: 28px; 
            width: 300px; background: var(--bg-card); 
            border: 1px solid var(--border-color); 
            border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,0.12); 
            padding: 16px; z-index: 2000; 
            backdrop-filter: blur(20px); 
        }
        #notifPanel.show { display: block; }

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
            .hamburger-btn { display: flex !important; }
        }
        
        /* Scrollbar Styling */
        ::-webkit-scrollbar { width: 5px; } 
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
    <a href="catalog.php" class="nav-item-link"><span class="nav-left"><i class="bi bi-book"></i> Catalog</span></a>
    <a href="cooklist.php" class="nav-item-link active">
        <span class="nav-left"><i class="bi bi-journal-check"></i> Cooklist</span>
        <span id="trolley-badge" class="badge rounded-pill" style="background:var(--accent-orange);font-size:10px;">0</span>
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
    <!-- Hamburger Menu Button (visible on mobile) -->
    <button class="hamburger-btn" onclick="toggleSidebar()"><i class="bi bi-list"></i></button>
    
    <div class="topbar-right">
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

<!-- ========== NOTIFICATION PANEL ========== -->
<div id="notifPanel">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p style="font-weight:700;font-size:13px;color:var(--text-primary);">Notifications</p>
        <button onclick="clearAllNotif()" style="background:none;border:none;font-size:11px;color:var(--text-label);cursor:pointer;">Clear all</button>
    </div>
    <div id="notifList" style="display:flex;flex-direction:column;gap:8px;max-height:280px;overflow-y:auto;">
        <p style="font-size:12px;color:var(--text-label);text-align:center;padding:16px 0;">No notifications yet.</p>
    </div>
</div>

<!-- ========== MAIN CONTENT ========== -->
<main id="main-content">
    <div class="content-inner">

        <!-- Page Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 style="font-size:20px;font-weight:700;color:var(--text-primary);margin:0;">My Meal Planner</h1>
                <p style="font-size:12px;color:var(--text-muted);margin:4px 0 0;">Manage your cooking list registry and track completion statuses</p>
            </div>
            <span style="background:#fef3c7;color:#92400e;font-size:10px;font-weight:700;padding:5px 12px;border-radius:99px;letter-spacing:0.5px;">IMS566 Company</span>
        </div>

        <!-- ========== ACTIVE COOKLIST TABLE ========== -->
        <div class="mm-card p-4 mb-4">
            <h2 style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.8px;color:var(--text-label);margin-bottom:16px;display:flex;align-items:center;gap:8px;">
                <i class="bi bi-journal-check" style="color:var(--accent-orange);"></i> Active Cooking List
            </h2>
            <div style="overflow-x:auto;">
                <table class="mm-table">
                    <thead>
                        <tr>
                            <th style="text-align:center;width:80px;">Mark Cooked</th>
                            <th style="width:90px;">ID</th>
                            <th>Recipe Name</th>
                            <th style="text-align:center;width:120px;">Portion</th>
                            <th style="text-align:center;width:110px;">Status</th>
                            <th style="text-align:center;width:70px;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="planner-table-body"></tbody>
                </table>
            </div>
            <!-- Empty state message -->
            <div id="planner-empty-state" class="text-center py-5" style="display:none;color:var(--text-muted);font-size:13px;">
                No active cooking records found. Add some from the <a href="catalog.php" style="color:var(--accent-orange);font-weight:700;">Catalog</a>.
            </div>
        </div>

        <!-- ========== BOTTOM SECTION: HISTORY + PIE CHART ========== -->
        <div class="row g-4 mb-4">

            <!-- Completed History Table -->
            <div class="col-12 col-xl-8">
                <div class="mm-card p-4 h-100">
                    <h2 style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.8px;color:var(--text-label);margin-bottom:16px;display:flex;align-items:center;gap:8px;">
                        <i class="bi bi-award" style="color:#059669;"></i> Completed Cooking History
                    </h2>
                    <div style="overflow-x:auto;">
                        <table class="mm-table history">
                            <thead>
                                <tr>
                                    <th style="width:60px;">No.</th>
                                    <th style="width:110px;">Recipe ID</th>
                                    <th>Recipe Name</th>
                                    <th style="text-align:center;width:130px;">Total Portion</th>
                                </tr>
                            </thead>
                            <tbody id="history-table-body"></tbody>
                        </table>
                    </div>
                    <!-- Empty state for history -->
                    <div id="history-empty-state" style="display:none;text-align:center;padding:40px 0;color:var(--text-muted);font-size:13px;">
                        No menus have been marked as cooked yet.
                    </div>
                </div>
            </div>

            <!-- Pie Chart Card -->
            <div class="col-12 col-xl-4">
                <div class="pie-card h-100 d-flex flex-column">
                    <div class="mb-3">
                        <span style="background:#d97706;color:#0b1528;font-size:10px;font-weight:700;padding:3px 10px;border-radius:99px;display:inline-block;margin-bottom:8px;">LIVE INSIGHTS</span>
                        <h2 style="font-size:16px;font-weight:700;color:#fff;margin:0;">Completion Ratio</h2>
                    </div>
                    <div style="flex:1;display:flex;align-items:center;justify-content:center;min-height:180px;">
                        <canvas id="plannerPieChart" style="max-width:200px;max-height:200px;"></canvas>
                    </div>
                    <p style="font-size:11px;color:rgba(255,255,255,0.4);text-align:center;margin-top:12px;padding-top:12px;border-top:1px solid rgba(255,255,255,0.08);" id="chart-legend-text">
                        Update the status above to reflect live charting data.
                    </p>
                </div>
            </div>

        </div>

        <!-- ========== ACTION BUTTONS ========== -->
        <div class="d-flex justify-content-end gap-3">
            <button onclick="clearAllPlanner()" class="btn-reset"><i class="bi bi-trash3"></i> Reset All Lists</button>
            <a href="calorie-evaluation.php" class="btn-proceed">Proceed to Calorie Evaluation <i class="bi bi-arrow-right-short" style="font-size:16px;"></i></a>
        </div>

    </div>
</main>

<!-- ========== BACK TO TOP BUTTON ========== -->
<button id="backToTop" title="Back to top"><i class="bi bi-chevron-up"></i></button>

<!-- ========== FOOTER ========== -->
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

<!-- ========== JAVASCRIPT ========== -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Global chart instance reference
    let globalChartInstance = null;

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

    /* ========== NOTIFICATION PANEL ========== */
    function toggleNotifPanel() { 
        document.getElementById('notifPanel').classList.toggle('show'); 
    }
    
    // Close notification panel when clicking outside
    document.addEventListener('click', function(e) {
        const p = document.getElementById('notifPanel');
        if (!p.contains(e.target) && !document.getElementById('bellBtn').contains(e.target)) 
            p.classList.remove('show');
    });
    
    function clearAllNotif() { 
        document.getElementById('notifList').innerHTML = '<p style="font-size:12px;color:var(--text-label);text-align:center;padding:16px 0;">No notifications yet.</p>'; 
    }

    /* ========== RENDER PLANNER SYSTEM ========== */
    // Main function to render both active planner and history tables
    function renderPlannerSystem() {
        // Get trolley data from localStorage
        const trolley = JSON.parse(localStorage.getItem('mealmemo_trolley')) || [];
        const plannerBody = document.getElementById('planner-table-body');
        const historyBody = document.getElementById('history-table-body');
        const plannerEmpty = document.getElementById('planner-empty-state');
        const historyEmpty = document.getElementById('history-empty-state');

        // Clear existing content
        plannerBody.innerHTML = '';
        historyBody.innerHTML = '';

        // Show empty state if no items
        if (trolley.length === 0) {
            plannerEmpty.style.display = 'block';
            historyEmpty.style.display = 'block';
            document.getElementById('trolley-badge').innerText = 0;
            updatePieChart(0, 0);
            return;
        }
        plannerEmpty.style.display = 'none';

        // Variables for badge and pie chart
        let totalBadge = 0, cookedIdx = 0, pendingPortion = 0, cookedPortion = 0;

        // Loop through each item in trolley
        trolley.forEach(item => {
            // Ensure quantity is a number
            item.quantity = parseInt(item.quantity) || 1;
            // Initialize cooked status if not exists
            if (item.cooked === undefined) item.cooked = false;
            
            // Update totals
            totalBadge += item.quantity;
            if (item.cooked) {
                cookedPortion += item.quantity;
            } else {
                pendingPortion += item.quantity;
            }

            const disabledAttr = item.cooked ? 'disabled' : '';
            const cookedClass = item.cooked ? 'cooked-row' : '';

            // Render active planner row
            plannerBody.innerHTML += `
                <tr>
                    <td style="text-align:center;">
                        <input type="checkbox" class="cook-check" ${item.cooked ? 'checked' : ''} onclick="toggleCookedStatus('${item.id}')">
                    </td>
                    <td class="${cookedClass}"><span style="font-family:monospace;font-size:11px;color:var(--text-label);font-weight:700;">${item.id}</span></td>
                    <td class="${cookedClass}" style="font-weight:700;${item.cooked ? 'text-decoration:line-through;' : ''}">${item.name}</td>
                    <td>
                        <div class="d-flex align-items-center justify-content-center gap-2">
                            <button class="qty-btn" onclick="adjustQuantity('${item.id}',-1)" ${disabledAttr}>−</button>
                            <span style="font-weight:700;font-size:13px;min-width:20px;text-align:center;">${item.quantity}</span>
                            <button class="qty-btn" onclick="adjustQuantity('${item.id}',1)" ${disabledAttr}>+</button>
                        </div>
                    </td>
                    <td style="text-align:center;">
                        ${item.cooked
                            ? '<span class="badge-cooked"><i class="bi bi-check-circle-fill"></i> Cooked</span>'
                            : '<span class="badge-pending"><i class="bi bi-clock"></i> Pending</span>'}
                    </td>
                    <td style="text-align:center;">
                        <button class="btn-remove" onclick="removeItem('${item.id}')"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>`;

            // Render history row if item is cooked
            if (item.cooked) {
                cookedIdx++;
                historyBody.innerHTML += `
                    <tr>
                        <td style="font-weight:700;color:var(--text-primary);">#0${cookedIdx}</td>
                        <td style="font-family:monospace;font-size:11px;color:var(--text-label);font-weight:700;">${item.id}</td>
                        <td style="font-weight:600;">${item.name}</td>
                        <td style="text-align:center;font-weight:700;color:#059669;">${item.quantity} Portion(s)</td>
                    </tr>`;
            }
        });

        // Update badge and history empty state
        historyEmpty.style.display = cookedIdx === 0 ? 'block' : 'none';
        document.getElementById('trolley-badge').innerText = totalBadge;
        
        // Update pie chart
        updatePieChart(pendingPortion, cookedPortion);
    }

    // Toggle cooked status for an item
    function toggleCookedStatus(id) {
        let t = JSON.parse(localStorage.getItem('mealmemo_trolley')) || [];
        const item = t.find(i => i.id === id);
        if (item) {
            item.cooked = !item.cooked;
            localStorage.setItem('mealmemo_trolley', JSON.stringify(t));
            renderPlannerSystem();
        }
    }

    // Adjust quantity of an item (increase or decrease)
    function adjustQuantity(id, change) {
        let t = JSON.parse(localStorage.getItem('mealmemo_trolley')) || [];
        const item = t.find(i => i.id === id);
        if (item && !item.cooked) {
            item.quantity = (parseInt(item.quantity) || 1) + change;
            if (item.quantity <= 0) {
                t = t.filter(i => i.id !== id);
            }
            localStorage.setItem('mealmemo_trolley', JSON.stringify(t));
            renderPlannerSystem();
        }
    }

    // Remove an item completely from the planner
    function removeItem(id) {
        let t = JSON.parse(localStorage.getItem('mealmemo_trolley')) || [];
        localStorage.setItem('mealmemo_trolley', JSON.stringify(t.filter(i => i.id !== id)));
        renderPlannerSystem();
    }

    // Clear all planner data (reset everything)
    function clearAllPlanner() {
        if (confirm('Flush all active plans and cooking history schedule?')) {
            localStorage.removeItem('mealmemo_trolley');
            renderPlannerSystem();
        }
    }

    // Update the pie chart with pending vs cooked portions
    function updatePieChart(pending, cooked) {
        const ctx = document.getElementById('plannerPieChart').getContext('2d');
        
        // Destroy existing chart instance if exists
        if (globalChartInstance) {
            globalChartInstance.destroy();
            globalChartInstance = null;
        }
        
        const legend = document.getElementById('chart-legend-text');
        
        // Show message if no data
        if (pending === 0 && cooked === 0) {
            legend.innerText = 'No data available in planner repository.';
            return;
        }
        
        legend.innerText = `Ratio: ${cooked} Cooked vs ${pending} Pending portions.`;
        
        // Create new pie chart
        globalChartInstance = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Pending', 'Cooked'],
                datasets: [{ 
                    data: [pending, cooked], 
                    backgroundColor: ['#d97706', '#10b981'], 
                    borderWidth: 0 
                }]
            },
            options: {
                responsive: true, 
                maintainAspectRatio: true,
                plugins: { 
                    legend: { 
                        position: 'bottom', 
                        labels: { 
                            font: { size: 10, family: 'Plus Jakarta Sans', weight: '600' }, 
                            color: '#9ca3af', 
                            boxWidth: 10, 
                            padding: 10 
                        } 
                    } 
                }
            }
        });
    }

    /* ========== BACK TO TOP BUTTON ========== */
    const bttBtn = document.getElementById('backToTop');
    bttBtn.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });
    window.addEventListener('scroll', () => bttBtn.classList.toggle('visible', window.scrollY > 300));

    /* ========== USER DROPDOWN TOGGLE ========== */
    function toggleUserDropdown() {
        var dropdown = document.getElementById('userDropdownMenu');
        dropdown.classList.toggle('open');
    }

    /* ========== LOGIN NOTIFICATION ========== */
    // Display welcome back notification when user just logged in
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

    /* ========== INITIALIZE PAGE ========== */
    renderPlannerSystem();
    injectLoginNotif();

</script>

<!-- ========== FOOTER RESPONSIVE SYNC ========== -->
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