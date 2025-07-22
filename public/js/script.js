
        // Auto-hide error messages after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const errorMessages = document.querySelectorAll('.error-msg');
            
            errorMessages.forEach(function(errorMsg) {
                // Only hide if there's actual error text
                if (errorMsg.textContent.trim() !== '') {
                    setTimeout(function() {
                        errorMsg.classList.add('fade-out');
                        
                        // Completely hide after fade animation
                        setTimeout(function() {
                            errorMsg.textContent = '';
                            errorMsg.classList.remove('fade-out');
                        }, 500); // Match the CSS transition duration
                    }, 5000); // Hide after 5 seconds
                }
            });
        });

        // Also hide errors when user starts typing (optional)
        document.addEventListener('DOMContentLoaded', function() {
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');
            const errorMessages = document.querySelectorAll('.error-msg');

            function hideErrorsOnInput() {
                errorMessages.forEach(function(errorMsg) {
                    if (errorMsg.textContent.trim() !== '') {
                        errorMsg.classList.add('fade-out');
                        setTimeout(function() {
                            errorMsg.textContent = '';
                            errorMsg.classList.remove('fade-out');
                        }, 500);
                    }
                });
            }

            // Hide errors when user starts typing
            usernameInput.addEventListener('input', hideErrorsOnInput);
            passwordInput.addEventListener('input', hideErrorsOnInput);
        });
    