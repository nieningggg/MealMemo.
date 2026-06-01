<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login to MealMemo - Access your Malaysian recipe dashboard">
    <meta name="author" content="IMS566 MealMemo Project">
    <title>Log In - MealMemo.</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom Tailwind Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: { 
                        'slate-navy': '#0b1528', 
                        'accent-orange': '#d97706' 
                    }
                }
            }
        }
    </script>
</head>

<!-- Login page background -->
<body class="font-sans bg-[#f4f7f6] h-screen w-screen overflow-hidden relative">

    <!-- Blurred background overlay -->
    <div class="blur-[15px] absolute inset-0 z-10 bg-slate-200"></div>

    <!-- Login Modal - centered card -->
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-navy/15">
        <div class="bg-white/45 backdrop-blur-[20px] border border-white/60 rounded-[28px] p-10 w-full max-w-[450px] shadow-2xl text-center mx-4">

            <!-- Back button to welcome page -->
            <div class="text-left mb-4">
                <a href="index.php" class="text-gray-500 hover:text-slate-navy text-sm font-bold transition duration-200">
                    <i class="bi bi-arrow-left mr-1"></i> Back
                </a>
            </div>

            <!-- Logo & Brand -->
            <div class="text-3xl font-bold text-slate-navy mb-1">
                <i class="bi bi-egg-fried text-amber-500 mr-2"></i>MealMemo.
            </div>
            <p class="text-gray-500 text-xs mb-6">Sign in to unlock your dashboard environment</p>

            <!-- Error message alert (hidden by default) -->
            <div id="error-alert" class="bg-red-100 border border-red-200 text-red-700 px-4 py-2 rounded-xl text-xs font-medium mb-4 hidden"></div>

            <!-- Login Form -->
            <form id="loginForm" onsubmit="handleLogin(event)" class="space-y-4">
                <!-- Username field -->
                <div class="text-left">
                    <label class="text-xs font-semibold text-gray-500 block mb-1">Username</label>
                    <input type="text" id="loginUser"
                        class="w-full bg-white/80 border border-black/5 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-accent-orange focus:bg-white transition"
                        placeholder="admin or your username" required>
                </div>
                
                <!-- Password field -->
                <div class="text-left">
                    <label class="text-xs font-semibold text-gray-500 block mb-1">Password</label>
                    <input type="password" id="loginPass"
                        class="w-full bg-white/80 border border-black/5 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-accent-orange focus:bg-white transition"
                        placeholder="••••••••" required>
                </div>
                
                <!-- Submit button -->
                <button type="submit"
                    class="w-full bg-slate-navy text-white rounded-xl py-3 font-semibold text-sm hover:bg-slate-800 transition duration-300 shadow-md">
                    LOG IN SECURELY →
                </button>
            </form>

            <!-- Register link -->
            <p class="text-xs text-gray-500 mt-6">
                Don't have an account?
                <a href="register.php" class="text-slate-navy font-bold hover:underline">Sign Up here</a>
            </p>
        </div>
    </div>

    <!-- Login JavaScript -->
    <script>
        // Handle login form submission
        function handleLogin(e) {
            e.preventDefault();
            
            // Get input values
            const userIn   = document.getElementById('loginUser').value.trim();
            const passIn   = document.getElementById('loginPass').value;
            const errAlert = document.getElementById('error-alert');

            let loginSuccess = false;

            // Check 1: Master admin account
            if (userIn === "admin" && passIn === "password123") {
                localStorage.setItem('currentUser', "admin");
                loginSuccess = true;
            }

            // Check 2: Registered users from localStorage
            if (!loginSuccess) {
                const storedUsers = JSON.parse(localStorage.getItem('mealmemo_users')) || [];
                const matched = storedUsers.find(u => u.username === userIn && u.password === passIn);
                if (matched) {
                    localStorage.setItem('currentUser', matched.username);
                    loginSuccess = true;
                }
            }

            // If login successful, redirect to dashboard
            if (loginSuccess) {
                localStorage.setItem('mealmemo_loginTime', new Date().toISOString());
                window.location.href = "dashboard.php";
                return;
            }

            // Show error message with shake animation
            errAlert.innerText = "Invalid credentials.";
            errAlert.classList.remove('hidden');
            const form = document.getElementById('loginForm');
            form.style.animation = 'shake 0.4s ease';
            setTimeout(() => form.style.animation = '', 400);
        }
    </script>

    <!-- Shake animation for error feedback -->
    <style>
        @keyframes shake {
            0%,100% { transform: translateX(0); }
            20%,60%  { transform: translateX(-6px); }
            40%,80%  { transform: translateX(6px); }
        }
    </style>
</body>
</html>