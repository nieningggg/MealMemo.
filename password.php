<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MealMemo - Change your account password.">
    <meta name="keywords" content="MealMemo, change password, account, IMS566">
    <meta name="author" content="IMS566 MealMemo Project">
    <title>Change Password - MealMemo.</title>
    
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
        
        /* Card Styles */
        .mm-card { 
            background: var(--bg-card); 
            border: 1px solid var(--border-color); 
            border-radius: 18px; 
            box-shadow: var(--card-shadow); 
            backdrop-filter: blur(12px); 
            transition: background 0.3s, border-color 0.3s; 
        }

        /* ========== FORM STYLES ========== */
        .form-label-custom { 
            font-size: 11px; font-weight: 700; 
            text-transform: uppercase; letter-spacing: 0.7px; 
            color: var(--text-label); margin-bottom: 6px; 
            display: block; 
        }
        
        .form-control-custom { 
            width: 100%; background: var(--input-bg); 
            border: 1px solid var(--border-color); border-radius: 10px; 
            padding: 10px 14px 10px 40px; 
            font-size: 13px; font-family: 'Plus Jakarta Sans', sans-serif; 
            color: var(--text-primary); outline: none; 
            transition: border-color 0.2s, background 0.3s; 
        }
        .form-control-custom::placeholder { color: var(--text-label); }
        .form-control-custom:focus { 
            border-color: var(--accent-orange); 
            box-shadow: 0 0 0 3px rgba(217,119,6,0.1); 
        }
        
        /* Input with Icons */
        .input-wrap { position: relative; }
        .input-wrap i.lead-icon { 
            position: absolute; left: 12px; top: 50%; 
            transform: translateY(-50%); 
            color: var(--text-label); font-size: 14px; 
            pointer-events: none; 
        }
        
        /* Password Toggle Eye Button */
        .input-wrap .toggle-eye { 
            position: absolute; right: 12px; top: 50%; 
            transform: translateY(-50%); 
            color: var(--text-label); font-size: 15px; 
            cursor: pointer; background: none; border: none; 
            padding: 0; 
        }
        .input-wrap .toggle-eye:hover { color: var(--text-primary); }
        
        /* Save Button */
        .btn-save { 
            background: var(--accent-orange); color: #fff; 
            border: none; border-radius: 12px; 
            padding: 11px 28px; font-size: 13px; font-weight: 700; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            display: inline-flex; align-items: center; gap: 8px; 
            cursor: pointer; transition: background 0.2s, transform 0.15s; 
        }
        .btn-save:hover { background: #b45309; transform: translateY(-1px); }
        
        /* Error & Success Messages */
        .err-msg { font-size: 11px; color: #ef4444; margin-top: 4px; display: none; }
        .err-msg.show { display: block; }
        .success-msg { font-size: 11px; color: #059669; margin-top: 4px; display: none; font-weight: 600; }
        .success-msg.show { display: block; }

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
        #sidebarOverlay { 
            display: none; position: fixed; inset: 0; 
            background: rgba(0,0,0,0.4); z-index: 1039; 
        }

        /* ========== RESPONSIVE DESIGN ========== */
        @media (max-width: 991.98px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.open { transform: translateX(0); }
            #sidebarOverlay.open { display: block; }
            #main-content { margin-left: 0; }
            #topbar { left: 0; }
            .hamburger-btn { display: flex !important; }
            #pageFooter { margin-left: 0 !important; }
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
            <div class="topbar-user" onclick="toggleUserDropdown()">
                <div class="topbar-avatar" id="avatarInitials">G</div>
                <span class="topbar-username" id="userGreetingField">Guest</span>
                <i class="bi bi-chevron-down" style="font-size:11px;color:var(--text-muted);margin-left:2px;"></i>
            </div>
            <div class="user-dropdown-menu" id="userDropdownMenu">
                <a href="password.php" class="user-dropdown-item" style="color:var(--accent-orange);"><i class="bi bi-key"></i> Change Password</a>
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
                <h1 style="font-size:20px;font-weight:700;color:var(--text-primary);margin:0;">Change Password</h1>
                <p style="font-size:12px;color:var(--text-muted);margin:4px 0 0;">Update your account password securely</p>
            </div>
            <span style="background:#fef3c7;color:#92400e;font-size:10px;font-weight:700;padding:5px 12px;border-radius:99px;letter-spacing:0.5px;">IMS566 Company</span>
        </div>

        <!-- ========== CHANGE PASSWORD FORM ========== -->
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="mm-card p-4 p-md-5">

                    <!-- Icon Header -->
                    <div class="text-center mb-4">
                        <div style="width:56px;height:56px;background:#fff7ed;border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                            <i class="bi bi-key-fill" style="font-size:24px;color:var(--accent-orange);"></i>
                        </div>
                        <p style="font-size:13px;color:var(--text-muted);margin:0;">Enter your current password, then choose a new one.</p>
                    </div>

                    <div class="d-flex flex-column gap-4">

                        <!-- Current Password Field -->
                        <div>
                            <label class="form-label-custom">Current Password</label>
                            <div class="input-wrap">
                                <i class="bi bi-lock lead-icon"></i>
                                <input type="password" id="currentPass" class="form-control-custom" placeholder="Enter current password">
                                <button class="toggle-eye" type="button" onclick="toggleEye('currentPass',this)"><i class="bi bi-eye"></i></button>
                            </div>
                            <div class="err-msg" id="errCurrent">Incorrect current password.</div>
                        </div>

                        <!-- New Password Field -->
                        <div>
                            <label class="form-label-custom">New Password</label>
                            <div class="input-wrap">
                                <i class="bi bi-lock-fill lead-icon"></i>
                                <input type="password" id="newPass" class="form-control-custom" placeholder="Min. 6 characters">
                                <button class="toggle-eye" type="button" onclick="toggleEye('newPass',this)"><i class="bi bi-eye"></i></button>
                            </div>
                            <div class="err-msg" id="errNew">Password must be at least 6 characters.</div>
                        </div>

                        <!-- Confirm Password Field -->
                        <div>
                            <label class="form-label-custom">Confirm New Password</label>
                            <div class="input-wrap">
                                <i class="bi bi-shield-lock lead-icon"></i>
                                <input type="password" id="confirmPass" class="form-control-custom" placeholder="Repeat new password">
                                <button class="toggle-eye" type="button" onclick="toggleEye('confirmPass',this)"><i class="bi bi-eye"></i></button>
                            </div>
                            <div class="err-msg" id="errConfirm">Passwords do not match.</div>
                        </div>

                        <!-- Success Message -->
                        <div class="success-msg" id="successMsg"><i class="bi bi-check-circle-fill"></i> Password changed successfully!</div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <a href="dashboard.php" style="font-size:13px;color:var(--text-muted);text-decoration:none;font-weight:600;">
                                <i class="bi bi-arrow-left" style="margin-right:4px;"></i>Back
                            </a>
                            <button class="btn-save" onclick="changePassword()">
                                <i class="bi bi-shield-check"></i> Save Password
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

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
    /* ========== AUTHENTICATION ========== */
    // Get current logged-in user from localStorage
    const currentUser = localStorage.getItem('currentUser');
    
    // Redirect to login if not authenticated
    if (!currentUser) { 
        window.location.href = 'login.php'; 
    } else {
        document.getElementById('userGreetingField').innerText = currentUser;
        document.getElementById('avatarInitials').innerText = currentUser.charAt(0).toUpperCase();
    }
    
    // Handle logout - clear user data and redirect to login
    function handleLogout() { 
        localStorage.removeItem('currentUser'); 
        window.location.href = 'login.php'; 
    }

    /* ========== COOKLIST BADGE ========== */
    // Update the cooklist badge count in sidebar
    (function(){ 
        const t = JSON.parse(localStorage.getItem('mealmemo_trolley')) || []; 
        document.getElementById('sidebarCooklistBadge').innerText = t.reduce((s,i) => s + (parseInt(i.quantity) || 1), 0); 
    })();

    /* ========== SIDEBAR FUNCTIONS ========== */
    // Toggle sidebar open/close (for mobile)
    function toggleSidebar(){ 
        document.getElementById('sidebar').classList.toggle('open'); 
        document.getElementById('sidebarOverlay').classList.toggle('open'); 
    }
    function closeSidebar(){ 
        document.getElementById('sidebar').classList.remove('open'); 
        document.getElementById('sidebarOverlay').classList.remove('open'); 
    }

    /* ========== THEME TOGGLE (Light/Dark) ========== */
    const html = document.documentElement;
    const savedTheme = localStorage.getItem('mmTheme') || 'light';
    html.setAttribute('data-theme', savedTheme);
    document.getElementById('themeIcon').className = savedTheme === 'dark' ? 'bi bi-sun' : 'bi bi-moon';
    
    function toggleTheme(){ 
        const next = html.getAttribute('data-theme') === 'light' ? 'dark' : 'light'; 
        html.setAttribute('data-theme', next); 
        localStorage.setItem('mmTheme', next); 
        document.getElementById('themeIcon').className = next === 'dark' ? 'bi bi-sun' : 'bi bi-moon'; 
    }

    /* ========== NOTIFICATION PANEL ========== */
    function toggleNotifPanel(){ 
        document.getElementById('notifPanel').classList.toggle('show'); 
    }
    
    // Close notification panel when clicking outside
    document.addEventListener('click', e => {
        const p = document.getElementById('notifPanel');
        if (!p.contains(e.target) && !document.getElementById('bellBtn').contains(e.target)) 
            p.classList.remove('show');
    });
    
    function clearAllNotif(){ 
        document.getElementById('notifList').innerHTML = '<p style="font-size:12px;color:var(--text-label);text-align:center;padding:16px 0;">No notifications yet.</p>'; 
    }

    /* ========== USER DROPDOWN ========== */
    function toggleUserDropdown(){ 
        document.getElementById('userDropdownMenu').classList.toggle('open'); 
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', e => {
        const wrap = document.getElementById('userDropdownWrap');
        if (wrap && !wrap.contains(e.target)) { 
            const m = document.getElementById('userDropdownMenu'); 
            if(m) m.classList.remove('open'); 
        }
    });

    /* ========== TOGGLE PASSWORD VISIBILITY ========== */
    // Show/hide password with eye icon
    function toggleEye(inputId, btn) {
        const input = document.getElementById(inputId);
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        btn.querySelector('i').className = isHidden ? 'bi bi-eye-slash' : 'bi bi-eye';
    }

    /* ========== CHANGE PASSWORD FUNCTION ========== */
    function changePassword() {
        // Get input values
        const current = document.getElementById('currentPass').value;
        const newP    = document.getElementById('newPass').value;
        const confirm = document.getElementById('confirmPass').value;

        // Reset error and success messages
        ['errCurrent','errNew','errConfirm','successMsg'].forEach(id => 
            document.getElementById(id).classList.remove('show')
        );
        ['currentPass','newPass','confirmPass'].forEach(id => 
            document.getElementById(id).style.borderColor = 'var(--border-color)'
        );

        let valid = true;

        // Validate current password
        const isAdmin = (currentUser === 'admin' && current === 'password123');
        const storedUsers = JSON.parse(localStorage.getItem('mealmemo_users')) || [];
        const userRecord  = storedUsers.find(u => u.username === currentUser);
        const isMatch     = isAdmin || (userRecord && userRecord.password === current);

        if (!current || !isMatch) {
            document.getElementById('errCurrent').classList.add('show');
            document.getElementById('currentPass').style.borderColor = '#ef4444';
            valid = false;
        }
        
        // Validate new password length
        if (newP.length < 6) {
            document.getElementById('errNew').classList.add('show');
            document.getElementById('newPass').style.borderColor = '#ef4444';
            valid = false;
        }
        
        // Validate password confirmation
        if (newP !== confirm) {
            document.getElementById('errConfirm').classList.add('show');
            document.getElementById('confirmPass').style.borderColor = '#ef4444';
            valid = false;
        }
        
        // Stop if validation fails
        if (!valid) return;

        // Save new password for registered users (admin is hardcoded)
        if (userRecord) {
            userRecord.password = newP;
            localStorage.setItem('mealmemo_users', JSON.stringify(storedUsers));
        }

        // Clear form fields and show success message
        ['currentPass','newPass','confirmPass'].forEach(id => 
            document.getElementById(id).value = ''
        );
        document.getElementById('successMsg').classList.add('show');
    }

    /* ========== LOGIN NOTIFICATION ========== */
    // Display welcome back notification when user just logged in
    function injectLoginNotif() {
        const loginTime = localStorage.getItem('mealmemo_loginTime');
        if (!loginTime) return;
        
        const user = localStorage.getItem('currentUser') || 'User';
        const notifList = document.getElementById('notifList');
        if (!notifList || notifList.querySelector('.login-notif')) return;
        
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

    /* ========== BACK TO TOP BUTTON ========== */
    const bttBtn = document.getElementById('backToTop');
    bttBtn.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });
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
</script>
</body>
</html>