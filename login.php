<?php
require 'auth.php';

if (isLoggedIn()) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gym Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-lg shadow-2xl overflow-hidden border-4 border-black">
            <!-- Header -->
            <div class="bg-black text-white py-8 px-6 text-center">
                <h1 class="text-3xl font-bold">Gym Management</h1>
                <p class="text-red-500 mt-2">Login to Continue</p>
            </div>

            <!-- Tabs -->
            <div class="flex border-b-2 border-gray-200">
                <button onclick="showTab('login')" id="loginTab" class="flex-1 py-4 font-semibold bg-red-600 text-white border-b-4 border-red-800">
                    Login
                </button>
                <button onclick="showTab('register')" id="registerTab" class="flex-1 py-4 font-semibold text-gray-600 hover:bg-gray-100">
                    Register
                </button>
            </div>

            <!-- Login Form -->
            <div id="loginForm" class="p-8">
                <?php if (isset($loginError)): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?= htmlspecialchars($loginError) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Username</label>
                        <input type="text" name="username" required 
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded focus:border-red-600 focus:outline-none">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Password</label>
                        <input type="password" name="password" required 
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded focus:border-red-600 focus:outline-none">
                    </div>

                    <button type="submit" name="login" 
                            class="w-full bg-red-600 hover:bg-black text-white font-bold py-3 rounded transition duration-200">
                        Login
                    </button>
                </form>
            </div>

            <!-- Register Form -->
            <div id="registerForm" class="p-8 hidden">
                <?php if (isset($registerError)): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?= htmlspecialchars($registerError) ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($registerSuccess)): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <?= htmlspecialchars($registerSuccess) ?>. You can now login.
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Username</label>
                        <input type="text" name="username" required 
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded focus:border-red-600 focus:outline-none">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" name="email" required 
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded focus:border-red-600 focus:outline-none">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Password</label>
                        <input type="password" name="password" required minlength="6"
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded focus:border-red-600 focus:outline-none">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Confirm Password</label>
                        <input type="password" name="confirm_password" required minlength="6"
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded focus:border-red-600 focus:outline-none">
                    </div>

                    <button type="submit" name="register" 
                            class="w-full bg-black hover:bg-red-600 text-white font-bold py-3 rounded transition duration-200">
                        Register
                    </button>
                </form>
            </div>
        </div>

        <div class="text-center mt-6 text-gray-600">
            <p class="text-sm">Demo credentials: admin / admin123</p>
        </div>
    </div>

    <script>
        function showTab(tab) {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const loginTab = document.getElementById('loginTab');
            const registerTab = document.getElementById('registerTab');

            if (tab === 'login') {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                loginTab.classList.add('bg-red-600', 'text-white', 'border-b-4', 'border-red-800');
                loginTab.classList.remove('text-gray-600', 'hover:bg-gray-100');
                registerTab.classList.remove('bg-red-600', 'text-white', 'border-b-4', 'border-red-800');
                registerTab.classList.add('text-gray-600', 'hover:bg-gray-100');
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                registerTab.classList.add('bg-red-600', 'text-white', 'border-b-4', 'border-red-800');
                registerTab.classList.remove('text-gray-600', 'hover:bg-gray-100');
                loginTab.classList.remove('bg-red-600', 'text-white', 'border-b-4', 'border-red-800');
                loginTab.classList.add('text-gray-600', 'hover:bg-gray-100');
            }
        }
    </script>
</body>
</html>