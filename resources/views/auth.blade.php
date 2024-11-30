<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register / Login</title>
    @vite('resources/css/app.css')
</head>
<body class="flex justify-center items-center min-h-screen bg-gray-800">
    <div class="w-full max-w-md bg-gray-700 p-8 rounded shadow-md ">

        <div class="mb-6 flex">
            <button id="registerTab" class="w-1/2 text-center py-2 bg-gray-300 text-gray-700 hover:bg-gray-200" onclick="showForm('register')">
                Register
            </button>
            <button id="loginTab" class="w-1/2 text-center py-2 bg-gray-300 text-gray-700 hover:bg-gray-200" onclick="showForm('login')">
                Login
            </button>
        </div>

        <!-- Registration Form -->
        <div id="registerForm">
            <h1 class="text-2xl text-white font-bold mb-6">Register</h1>

            <form action="{{ url('/register') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-white">Name</label>
                    <input type="text" name="name" id="name" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-white">Email</label>
                    <input type="email" name="email" id="email" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-white">Password</label>
                    <input type="password" name="password" id="password" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-white">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border rounded p-2" required>
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                    Register
                </button>
            </form>
        </div>

        <!-- Login Form -->
        <div id="loginForm" class="hidden">
            <h1 class="text-2xl text-white font-bold mb-6">Login</h1>

            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-white">Email</label>
                    <input type="email" name="email" id="email" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-white">Password</label>
                    <input type="password" name="password" id="password" class="w-full border rounded p-2" required>
                </div>

                <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">
                    Login
                </button>
            </form>
        </div>
    </div>

    <script>
        function showForm(formType) {
            // Show Register Form and change button styles
            if (formType === 'register') {
                document.getElementById('registerForm').classList.remove('hidden');
                document.getElementById('loginForm').classList.add('hidden');
                document.getElementById('registerTab').classList.add('bg-gray-200', 'text-gray-700');
                document.getElementById('registerTab').classList.remove('bg-gray-300', 'text-white');
                document.getElementById('loginTab').classList.remove('bg-gray-200', 'text-gray-700');
                document.getElementById('loginTab').classList.add('bg-gray-300', 'text-white');
            } else {
                // Show Login Form and change button styles
                document.getElementById('registerForm').classList.add('hidden');
                document.getElementById('loginForm').classList.remove('hidden');
                document.getElementById('loginTab').classList.add('bg-gray-200', 'text-gray-700');
                document.getElementById('loginTab').classList.remove('bg-gray-300', 'text-white');
                document.getElementById('registerTab').classList.remove('bg-gray-200', 'text-gray-700');
                document.getElementById('registerTab').classList.add('bg-gray-300', 'text-white');
            }
        }

        // Default to show Register form
        showForm('register');
    </script>
</body>
</html>
