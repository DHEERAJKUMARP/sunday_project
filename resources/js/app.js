import './bootstrap';


function toggleDarkMode() {
    const isDarkMode = document.documentElement.classList.toggle('dark');
    const button = document.getElementById('mode-toggle');
    
    // Change button text based on the current mode
    if (isDarkMode) {
        button.textContent = 'Switch to Light Mode'; // Dark mode is enabled
    } else {
        button.textContent = 'Switch to Dark Mode'; // Light mode is enabled
    }
}
