<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Create a new account for MealMemo - Malaysian recipe management system">
    <meta name="author" content="IMS566 MealMemo Project">
    <title>Sign Up - MealMemo.</title>
    
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

<!-- Register page background -->
<body class="font-sans bg-[#f4f7f6] h-screen w-screen overflow-hidden relative">

    <!-- Blurred background overlay -->
    <div class="blur-[15px] absolute inset-0 z-10 bg-slate-300"></div>

    <!-- Register Modal - centered card -->
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
            <p class="text-gray-500 text-xs mb-6">Create your personalized repository credential access</p>

            <!-- Error message alert (hidden by default) -->
            <div id="error-alert" class="bg-red-100 border border-red-200 text-red-700 px-4 py-2 rounded-xl text-xs font-medium mb-4 hidden"></div>

            <!-- Registration Form -->
            <form id="registerForm" onsubmit="handleRegister(event)" class="space-y-4">
                <!-- Username field -->
                <div class="text-left">
                    <label class="text-xs font-semibold text-gray-500 block mb-1">Choose Username</label>
                    <input type="text" id="regUser" 
                        class="w-full bg-white/80 border border-black/5 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-accent-orange focus:bg-white transition" 
                        placeholder="e.g. ninie" required>
                </div>
                
                <!-- Password field -->
                <div class="text-left">
                    <label class="text-xs font-semibold text-gray-500 block mb-1">Choose Password</label>
                    <input type="password" id="regPass" 
                        class="w-full bg-white/80 border border-black/5 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-accent-orange focus:bg-white transition" 
                        placeholder="••••••••" required>
                </div>
                
                <!-- Submit button -->
                <button type="submit" 
                    class="w-full bg-accent-orange text-white rounded-xl py-3 font-semibold text-sm hover:bg-amber-700 transition duration-300 shadow-md">
                    REGISTER NEW ACCOUNT ✨
                </button>
            </form>

            <!-- Login link -->
            <p class="text-xs text-gray-500 mt-6">
                Already registered? 
                <a href="login.php" class="text-slate-navy font-bold hover:underline">Log In here</a>
            </p>
        </div>
    </div>

    <!-- Registration JavaScript -->
    <script>
        // Handle registration form submission
        function handleRegister(e) {
            e.preventDefault();
            
            // Get input values
            const userIn = document.getElementById('regUser').value.trim();
            const passIn = document.getElementById('regPass').value;
            const errAlert = document.getElementById('error-alert');

            // Get existing users from localStorage
            let storedUsers = JSON.parse(localStorage.getItem('mealmemo_users')) || [];

            // Check if username is 'admin' or already exists
            if (userIn.toLowerCase() === "admin" || storedUsers.some(u => u.username.toLowerCase() === userIn.toLowerCase())) {
                errAlert.innerText = "Error: Username is already taken!";
                errAlert.classList.remove('hidden');
                return;
            }

            // Save new user to localStorage
            storedUsers.push({ username: userIn, password: passIn });
            localStorage.setItem('mealmemo_users', JSON.stringify(storedUsers));

            // Show success and redirect to login page
            alert("Success! Account created. Transferring you to Login page.");
            window.location.href = "login.php";
        }
    </script>
</body>
</html>