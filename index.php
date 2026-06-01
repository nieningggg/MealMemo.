<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to MealMemo - Malaysian recipe management system">
    <meta name="author" content="IMS566 MealMemo Project">
    <title>Welcome to MealMemo.</title>
    
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

<!-- Landing page background - matches login.php style -->
<body class="font-sans bg-[#f4f7f6] h-screen w-screen overflow-hidden relative">

    <!-- Blurred background overlay -->
    <div class="blur-[15px] absolute inset-0 z-10 bg-slate-200"></div>

    <!-- Welcome Modal - centered card with slide-up animation -->
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-navy/15">
        <div class="bg-white/45 backdrop-blur-[20px] border border-white/60 rounded-[28px] p-12 w-full max-w-[500px] shadow-2xl text-center mx-4 animate-[slideUp_0.8s_ease-out]">
            
            <!-- Logo & Brand -->
            <div class="text-5xl font-bold text-slate-navy mb-2">
                <i class="bi bi-egg-fried text-amber-500 mr-2"></i>MealMemo.
            </div>
            <p class="text-gray-500 text-sm mb-6">The Art of Malaysian Cuisine</p>

            <hr class="my-6 border-gray-300/50">

            <!-- Action Buttons - Login & Register -->
            <div class="flex flex-col gap-4">
                <!-- Login Button -->
                <a href="login.php"
                    class="bg-slate-navy text-white font-semibold rounded-xl py-3.5 hover:bg-slate-800 transition duration-300 shadow-md block w-full text-center">
                    LOG IN NOW →
                </a>
                
                <!-- Register Button -->
                <a href="register.php"
                    class="bg-transparent text-slate-navy font-semibold border-2 border-slate-navy rounded-xl py-3.5 hover:bg-slate-900/5 transition duration-300 block w-full text-center">
                    CREATE ACCOUNT
                </a>
            </div>
            
            <!-- Footer -->
            <div class="text-gray-400 text-xs mt-8">© 2026 IMS566 Company</div>
        </div>
    </div>

    <!-- Animation Keyframes -->
    <style>
        @keyframes slideUp {
            0%   { transform: translateY(20px); opacity: 0; }
            100% { transform: translateY(0);    opacity: 1; }
        }
    </style>
</body>
</html>
