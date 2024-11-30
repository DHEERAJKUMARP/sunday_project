<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>
<body class="bg-gray-100 dark:bg-gray-900 transition-colors">

    <!-- Header -->
    <header class="bg-blue-600 text-white py-4 shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">My Dashboard</h1>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="/" class="hover:underline">Home</a></li>
                    <li><a href="/projects" class="hover:underline">Projects</a></li>
                    <li><a href="/contact" class="hover:underline">Contact</a></li>
                </ul>
            </nav>
            <!-- Dark Mode Toggle Button -->
            <button id="mode-toggle" onclick="toggleDarkMode()" class="bg-gray-800 text-white p-2 rounded-md">
                Switch to Light Mode
            </button>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 dark:bg-red-700 text-white p-2 rounded-md hover:bg-red-600">Logout</button>
            </form>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto p-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 My Dashboard. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Toggle dark mode
        function toggleDarkMode() {
            const isDarkMode = document.documentElement.classList.toggle('dark');
            const button = document.getElementById('mode-toggle');
// Save the mode preference in localStorage
        localStorage.setItem('darkMode', isDarkMode);
            if (isDarkMode) {
                button.textContent = 'Switch to Light Mode'; // Dark mode is enabled
            } else {
                button.textContent = 'Switch to Dark Mode'; // Light mode is enabled
            }
        }
    </script>

</body>
</html>
