<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MealMemo Calorie Evaluation - Analyse energy content of your meal planner entries.">
    <meta name="keywords" content="MealMemo, calorie evaluation, energy analysis, kcal, IMS566, nutrition">
    <meta name="author" content="IMS566 MealMemo Project">
    <title>Calorie Evaluation - MealMemo.</title>
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
            --input-bg: rgba(255,255,255,0.06);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg-page); color: var(--text-primary); min-height: 100vh; transition: background 0.3s, color 0.3s; }

        /* SIDEBAR */
        #sidebar { position: fixed; top: 0; left: 0; width: var(--sidebar-width); height: 100vh; background: var(--bg-sidebar); border-right: 1px solid var(--border-color); backdrop-filter: blur(20px); display: flex; flex-direction: column; z-index: 1040; overflow-y: auto; transition: transform 0.3s ease, background 0.3s; }
        .sidebar-brand { padding: 22px 24px 20px; font-size: 20px; font-weight: 700; color: var(--text-primary); border-bottom: 1px solid var(--border-color); display: flex; align-items: center; gap: 10px; flex-shrink: 0; }
        .sidebar-brand i { color: var(--accent-orange); font-size: 22px; }
        .sidebar-section-label { font-size: 10px; font-weight: 700; letter-spacing: 1px; color: var(--text-label); text-transform: uppercase; padding: 20px 24px 8px; }
        .nav-item-link { display: flex; align-items: center; justify-content: space-between; padding: 10px 24px; font-size: 13.5px; font-weight: 600; color: var(--text-muted); text-decoration: none; transition: background 0.18s, color 0.18s; }
        .nav-item-link:hover { background: var(--bg-hover-nav); color: var(--text-primary); }
        .nav-item-link.active { background: var(--bg-active-nav); color: var(--accent-orange); box-shadow: var(--card-shadow); border-radius: 10px; margin: 0 12px; padding: 10px 12px; }
        .nav-item-link .nav-left { display: flex; align-items: center; gap: 10px; }
        .nav-item-link i { font-size: 16px; }
        .sidebar-footer { margin-top: auto; padding: 16px 16px 20px; border-top: 1px solid var(--border-color); flex-shrink: 0; }
        .btn-logout { width: 100%; background: var(--slate-navy); color: #fff; border: none; border-radius: 12px; padding: 10px 16px; font-size: 13px; font-weight: 600; font-family: 'Plus Jakarta Sans', sans-serif; display: flex; align-items: center; justify-content: center; gap: 8px; cursor: pointer; transition: background 0.2s; }
        .btn-logout:hover { background: #1a2d4a; }

        /* TOPBAR */
        #topbar { position: fixed; top: 0; left: var(--sidebar-width); right: 0; height: var(--topbar-height); background: var(--bg-topbar); border-bottom: 1px solid var(--border-color); backdrop-filter: blur(20px); display: flex; align-items: center; padding: 0 28px; gap: 16px; z-index: 1030; transition: left 0.3s, background 0.3s; }
        .hamburger-btn { background: none; border: none; color: var(--text-muted); font-size: 20px; cursor: pointer; padding: 4px 8px; border-radius: 8px; display: none; transition: background 0.2s; }
        .hamburger-btn:hover { background: var(--bg-hover-nav); }
        .topbar-right { margin-left: auto; display: flex; align-items: center; gap: 12px; }
        .topbar-icon-btn { width: 38px; height: 38px; background: var(--input-bg); border: 1px solid var(--border-color); border-radius: 10px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text-muted); font-size: 17px; transition: background 0.2s, color 0.2s; position: relative; flex-shrink: 0; }
        .topbar-icon-btn:hover { background: var(--bg-hover-nav); color: var(--text-primary); }
        @keyframes beep { 0%,100%{transform:scale(1);opacity:1} 25%,75%{transform:scale(1.6);opacity:0.5} }
        .notif-dot { position: absolute; top: 6px; right: 6px; width: 9px; height: 9px; background: #ef4444; border-radius: 50%; border: 2px solid var(--bg-topbar); animation: beep 1.6s ease-in-out infinite; }
        .topbar-user { display: flex; align-items: center; gap: 8px; cursor: pointer; padding: 4px 10px; border-radius: 10px; transition: background 0.2s; }
        .topbar-user:hover { background: var(--bg-hover-nav); }
        .topbar-avatar { width: 34px; height: 34px; background: var(--accent-orange); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; color: #fff; flex-shrink: 0; }
        .topbar-username { font-size: 13px; font-weight: 600; color: var(--text-primary); }

        /* USER DROPDOWN */
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

        /* MAIN */
        #main-content { margin-left: var(--sidebar-width); padding-top: var(--topbar-height); min-height: 100vh; transition: margin-left 0.3s; }
        .content-inner { padding: 28px 28px 80px; }

        /* CARDS - All cards have same font size for values */
        .mm-card { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 18px; box-shadow: var(--card-shadow); backdrop-filter: blur(12px); transition: background 0.3s, border-color 0.3s; padding: 22px 24px; }
        .stat-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: var(--text-label); margin-bottom: 8px; }
        
        /* UNIFIED VALUE STYLES - All cards use same 26px font size */
        .stat-value {
            font-size: 26px;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
            line-height: 1.2;
        }
        .stat-value-sm {
            font-size: 26px;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
            line-height: 1.2;
        }
        
        /* Status text container - same size as stat-value */
        #status-text {
            font-size: 26px;
            font-weight: 700;
            margin: 0;
            line-height: 1.2;
        }

        /* NOTIFICATION PANEL */
        #notifPanel { display: none; position: absolute; top: calc(var(--topbar-height) + 4px); right: 28px; width: 300px; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,0.12); padding: 16px; z-index: 2000; backdrop-filter: blur(20px); }
        #notifPanel.show { display: block; }

        /* BACK TO TOP */
        #backToTop { position: fixed; bottom: 28px; right: 28px; width: 42px; height: 42px; background: var(--accent-orange); color: white; border: none; border-radius: 12px; font-size: 18px; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 9999; opacity: 0; transform: translateY(12px); transition: opacity 0.3s, transform 0.3s; pointer-events: none; box-shadow: 0 4px 14px rgba(217,119,6,0.4); }
        #backToTop.visible { opacity: 1; transform: translateY(0); pointer-events: all; }
        #backToTop:hover { background: #b45309; }

        #sidebarOverlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 1039; }

        @media (max-width: 991.98px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.open { transform: translateX(0); }
            #sidebarOverlay.open { display: block; }
            #main-content { margin-left: 0; }
            #topbar { left: 0; }
            .hamburger-btn { display: flex !important; }
            #pageFooter { margin-left: 0 !important; }
        }
        ::-webkit-scrollbar { width: 5px; } ::-webkit-scrollbar-track { background: transparent; } ::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.12); border-radius: 99px; }
        [data-theme="dark"] ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); }

        /* EMPTY CHART STATE - CENTERED */
        .chart-card-container {
            min-height: 360px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
        }
        #calorieChart { max-height: 280px; width: 100%; }
        .empty-chart-state { text-align: center; padding: 60px 20px; width: 100%; }
        .empty-chart-state i { font-size: 56px; color: var(--text-muted); opacity: 0.4; margin-bottom: 16px; display: block; }
        .empty-chart-state p { font-size: 15px; font-weight: 600; color: var(--text-muted); margin: 0 0 8px 0; }
        .empty-chart-state small { font-size: 13px; color: var(--text-label); display: block; }
        .empty-chart-state a { color: var(--accent-orange); text-decoration: none; font-weight: 600; }
        .empty-chart-state a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<nav id="sidebar">
    <div class="sidebar-brand"><i class="bi bi-egg-fried"></i> MealMemo.</div>
    <div class="sidebar-section-label">Menu</div>
    <a href="dashboard.php" class="nav-item-link"><span class="nav-left"><i class="bi bi-grid-1x2-fill"></i> Overview</span></a>
    <a href="catalog.php" class="nav-item-link"><span class="nav-left"><i class="bi bi-book"></i> Catalog</span></a>
    <a href="cooklist.php" class="nav-item-link">
        <span class="nav-left"><i class="bi bi-journal-check"></i> Cooklist</span>
        <span id="sidebarCooklistBadge" class="badge rounded-pill" style="background:var(--accent-orange);font-size:10px;">0</span>
    </a>
    <a href="calorie-evaluation.php" class="nav-item-link active"><span class="nav-left"><i class="bi bi-calculator"></i> Calorie Evaluation</span></a>
    <div class="sidebar-section-label" style="margin-top:8px;">Support</div>
    <a href="help.php" class="nav-item-link"><span class="nav-left"><i class="bi bi-chat-dots-fill"></i> Contact Us</span></a>
    <div class="sidebar-footer">
        <button class="btn-logout" onclick="handleLogout()"><i class="bi bi-box-arrow-left"></i> Log Out</button>
    </div>
</nav>
<div id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- TOPBAR -->
<header id="topbar">
    <button class="hamburger-btn" onclick="toggleSidebar()"><i class="bi bi-list"></i></button>
    <div class="topbar-right">
        <div class="topbar-icon-btn" onclick="toggleTheme()" title="Toggle theme"><i id="themeIcon" class="bi bi-moon"></i></div>
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

<!-- NOTIFICATION PANEL -->
<div id="notifPanel">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p style="font-weight:700;font-size:13px;color:var(--text-primary);">Notifications</p>
        <button onclick="clearAllNotif()" style="background:none;border:none;font-size:11px;color:var(--text-label);cursor:pointer;">Clear all</button>
    </div>
    <div id="notifList" style="display:flex;flex-direction:column;gap:8px;max-height:280px;overflow-y:auto;">
        <p style="font-size:12px;color:var(--text-label);text-align:center;padding:16px 0;">No notifications yet.</p>
    </div>
</div>

<!-- MAIN CONTENT -->
<main id="main-content">
    <div class="content-inner">

        <!-- PAGE HEADER -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 style="font-size:20px;font-weight:700;color:var(--text-primary);margin:0;">Calorie Evaluation</h1>
                <p style="font-size:12px;color:var(--text-muted);margin:4px 0 0;">Energy content analysis of your meal planner</p>
            </div>
            <span style="background:#fef3c7;color:#92400e;font-size:10px;font-weight:700;padding:5px 12px;border-radius:99px;letter-spacing:0.5px;">IMS566 Company</span>
        </div>

        <!-- STAT CARDS - All have same font size (26px) -->
        <div class="row g-3 mb-4">
            
            <!-- Calculated Energy Card -->
            <div class="col-12 col-md-4">
                <div class="mm-card">
                    <p class="stat-label">Calculated Energy</p>
                    <p class="stat-value" id="total-kcal">0 kcal</p>
                </div>
            </div>
            
            <!-- Status Threshold Card - NOW SAME FONT SIZE AS OTHERS -->
            <div class="col-12 col-md-4">
                <div class="mm-card">
                    <p class="stat-label">Status Threshold</p>
                    <div id="status-text">Monitoring... <i id="status-icon" class="bi bi-battery" style="margin-left:6px;"></i></div>
                </div>
            </div>
            
            <!-- Indexed Items Card -->
            <div class="col-12 col-md-4">
                <div class="mm-card">
                    <p class="stat-label">Indexed Items</p>
                    <p class="stat-value" id="item-count">0 Varieties</p>
                </div>
            </div>
            
        </div>

        <!-- CHART CARD -->
        <div class="mm-card" style="padding:24px;">
            <h2 style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.8px;color:var(--text-label);margin-bottom:20px;">Energy Content Comparison Matrix</h2>
            <div id="chartContainer" class="chart-card-container">
                <canvas id="calorieChart" style="display: none;"></canvas>
                <div id="emptyChartMessage" class="empty-chart-state">
                    <i class="bi bi-journal-x"></i>
                    <p>No items in planner</p>
                    <small>Add recipes from the <a href="catalog.php">Catalog</a></small>
                </div>
            </div>
        </div>

    </div>
</main>

<!-- BACK TO TOP -->
<button id="backToTop" title="Back to top"><i class="bi bi-chevron-up"></i></button>

<!-- FOOTER -->
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    /* ========== AUTH ========== */
    const currentUser = localStorage.getItem('currentUser');
    if (currentUser) {
        document.getElementById('userGreetingField').innerText = currentUser;
        document.getElementById('avatarInitials').innerText = currentUser.charAt(0).toUpperCase();
    }
    function handleLogout() { localStorage.removeItem('currentUser'); window.location.href = "login.php"; }

    /* ========== COOKLIST BADGE ========== */
    function updateBadge() {
        const trolley = JSON.parse(localStorage.getItem('mealmemo_trolley')) || [];
        const total = trolley.reduce((sum, item) => sum + (parseInt(item.quantity) || 1), 0);
        const badge = document.getElementById('sidebarCooklistBadge');
        if (badge) badge.innerText = total;
    }

    /* ========== SIDEBAR ========== */
    function toggleSidebar() { document.getElementById('sidebar').classList.toggle('open'); document.getElementById('sidebarOverlay').classList.toggle('open'); }
    function closeSidebar() { document.getElementById('sidebar').classList.remove('open'); document.getElementById('sidebarOverlay').classList.remove('open'); }

    /* ========== THEME ========== */
    const html = document.documentElement;
    const savedTheme = localStorage.getItem('mmTheme') || 'light';
    html.setAttribute('data-theme', savedTheme);
    updateThemeIcon(savedTheme);
    function toggleTheme() {
        const next = html.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
        html.setAttribute('data-theme', next); localStorage.setItem('mmTheme', next); updateThemeIcon(next);
    }
    function updateThemeIcon(t) { document.getElementById('themeIcon').className = t === 'dark' ? 'bi bi-sun' : 'bi bi-moon'; }

    /* ========== NOTIFICATIONS ========== */
    function toggleNotifPanel() { document.getElementById('notifPanel').classList.toggle('show'); }
    document.addEventListener('click', function(e) {
        const p = document.getElementById('notifPanel');
        if (!p.contains(e.target) && !document.getElementById('bellBtn').contains(e.target)) p.classList.remove('show');
    });
    function clearAllNotif() { document.getElementById('notifList').innerHTML = '<p style="font-size:12px;color:var(--text-label);text-align:center;padding:16px 0;">No notifications yet.</p>'; }

    /* ========== CALORIE EVALUATION ========== */
    function updateEvaluation() {
        const trolley = JSON.parse(localStorage.getItem('mealmemo_trolley')) || [];
        let totalKcal = 0;
        trolley.forEach(item => { totalKcal += (parseInt(item.calories) || 400) * (parseInt(item.quantity) || 1); });

        // Update Calculated Energy
        document.getElementById('total-kcal').innerText = totalKcal + ' kcal';
        
        // Update Indexed Items
        document.getElementById('item-count').innerText = trolley.length + ' Varieties';

        // Update Status Threshold - THIS NOW USES SAME 26px FONT SIZE
        const statusDiv = document.getElementById('status-text');
        if (trolley.length === 0) {
            statusDiv.innerHTML = '— <i class="bi bi-dash-circle" style="margin-left:6px;color:var(--text-label);"></i>';
            statusDiv.style.color = 'var(--text-label)';
        } else if (totalKcal >= 2000) {
            statusDiv.innerHTML = 'Energy Goal Met <i class="bi bi-battery-full" style="margin-left:6px;color:#16a34a;"></i>';
            statusDiv.style.color = '#16a34a';
        } else if (totalKcal > 800) {
            statusDiv.innerHTML = 'Fueling Phase <i class="bi bi-battery-half" style="margin-left:6px;color:#d97706;"></i>';
            statusDiv.style.color = '#d97706';
        } else {
            statusDiv.innerHTML = 'Light & Lean <i class="bi bi-battery" style="margin-left:6px;color:#3b82f6;"></i>';
            statusDiv.style.color = '#3b82f6';
        }

        // Handle chart
        const canvas = document.getElementById('calorieChart');
        const emptyDiv = document.getElementById('emptyChartMessage');
        
        if (trolley.length > 0) {
            canvas.style.display = 'block';
            emptyDiv.style.display = 'none';
            
            if (window.calorieChartInstance) window.calorieChartInstance.destroy();
            
            window.calorieChartInstance = new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: trolley.map(i => i.name),
                    datasets: [{
                        label: 'Energy (kcal)',
                        data: trolley.map(i => (parseInt(i.calories) || 400) * (i.quantity || 1)),
                        backgroundColor: '#d97706',
                        borderRadius: 6,
                        borderSkipped: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
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
                            ticks: { font: { size: 11 }, color: '#9ca3af' }
                        },
                        y: {
                            grid: { color: 'rgba(0,0,0,0.04)' },
                            ticks: { font: { size: 11 }, color: '#9ca3af' },
                            beginAtZero: true
                        }
                    }
                }
            });
        } else {
            canvas.style.display = 'none';
            emptyDiv.style.display = 'block';
        }
    }

    /* ========== BACK TO TOP ========== */
    const bttBtn = document.getElementById('backToTop');
    bttBtn.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });
    window.addEventListener('scroll', () => bttBtn.classList.toggle('visible', window.scrollY > 300));

    /* ========== USER DROPDOWN ========== */
    function toggleUserDropdown() {
        var dropdown = document.getElementById('userDropdownMenu');
        if (dropdown) dropdown.classList.toggle('open');
    }

    /* ========== LOGIN NOTIFICATION ========== */
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

    /* ========== INIT ========== */
    updateBadge();
    updateEvaluation();
    injectLoginNotif();

</script>

<!-- FOOTER RESPONSIVE SYNC -->
<script>
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