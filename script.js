document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.querySelector('.wrapper');
    const loginLink = document.querySelector('.login-link');
    const registerLink = document.querySelector('.register-link');
    const btnPopup = document.querySelector('.btnLogin-popup');
    const iconClose = document.querySelector('.icon-close');
    const registerForm = document.getElementById('register-form');
    const loginForm = document.getElementById('login-form');

    registerLink.addEventListener('click', () => {
        wrapper.classList.add('active');
    });

    loginLink.addEventListener('click', () => {
        wrapper.classList.remove('active');
    });

    btnPopup.addEventListener('click', () => {
        wrapper.classList.add('active-popup');
    });

    iconClose.addEventListener('click', () => {
        wrapper.classList.remove('active-popup');
    });

    registerForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const username = document.getElementById('register-username').value;
        const email = document.getElementById('register-email').value;
        const password = document.getElementById('register-password').value;
        
        localStorage.setItem('username', username);
        localStorage.setItem('email', email);
        localStorage.setItem('password', password);

        wrapper.classList.remove('active');
        alert('Registration successful! Please login.');
    });

    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const email = document.getElementById('login-email').value;
        const password = document.getElementById('login-password').value;

        const storedEmail = localStorage.getItem('email');
        const storedPassword = localStorage.getItem('password');
        const storedUsername = localStorage.getItem('username');

        if (email === storedEmail && password === storedPassword) {
            alert(`Welcome, ${storedUsername}!`);
            // Redirect to a new page (you can change 'welcome.html' to the actual welcome page you want)
            window.location.href = 'welcome.html';
        } else {
            alert('Incorrect email or password. Please try again.');
        }
    });
});
