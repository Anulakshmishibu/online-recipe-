document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const usernameError = document.getElementById('usernameError');
    const passwordError = document.getElementById('passwordError');

    loginForm.addEventListener('submit', function(event) {
        let valid = true;
        
        // Reset error messages
        usernameError.textContent = '';
        passwordError.textContent = '';

        // Username validation
        if (usernameInput.value.trim() === '') {
            valid = false;
            usernameError.textContent = 'Username is required';
        }

        // Password validation
        if (passwordInput.value.trim() === '') {
            valid = false;
            passwordError.textContent = 'Password is required';
        }

        if (!valid) {
            event.preventDefault();
        }
    });
});
