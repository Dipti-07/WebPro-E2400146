document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    setupNavToggle();
    setupGoToTopButton();
    setupPage();
    setupAuthForms();
     
    setupGalleryScroll(); 
});

function setupNavToggle() {
    const navToggle = document.createElement('div');
    navToggle.classList.add('nav-toggle');
    navToggle.innerHTML = '&#9776;';  
    const header = document.querySelector('header');
    if (header) {
        header.appendChild(navToggle);
        navToggle.addEventListener('click', () => {
            const navList = document.querySelector('nav ul');
            if (navList) {
                navList.classList.toggle('show');
            }
        });
    } else {
        console.error('Header element not found in the DOM.');
    }
}

function setupPage() {
    if (document.body.classList.contains('index')) {
        setupAppointmentPage(); // Appointment form on index page
    }
    if (document.body.classList.contains('about')) {
        setupAboutPage(); //  about page setup function
    }
    if (document.body.classList.contains('appointment')) {
        setupAppointmentPage();
    }
     
    
    if (document.body.classList.contains('loginsignup')) {
        setupLoginSignupPage(); // login/signup page setup function
    }
    if (document.body.classList.contains('services')) {
        setupServicesPage(); // services page setup function
    }
    if (document.body.classList.contains('gallery')) {
        setupGalleryPage(); // gallery page setup function
    }
}

function setupAppointmentPage() {
    const form = document.querySelector('#appointment-form');
    const confirmation = document.getElementById('confirmation');

    if (form && confirmation) {
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const name = form.querySelector('#name').value.trim();
            const email = form.querySelector('#email').value.trim();
            const phone = form.querySelector('#phone').value.trim();
            const service = form.querySelector('#service').value;
            const date = form.querySelector('#date').value;
            const time = form.querySelector('#time').value;

            if (name && email && phone && service && date && time) {
                form.style.display = 'none';
                confirmation.style.display = 'block';
                confirmation.querySelector('#confirmName').textContent = name;
                confirmation.querySelector('#confirmService').textContent = service;
                confirmation.querySelector('#confirmDate').textContent = date;
                confirmation.querySelector('#confirmTime').textContent = time;
                confirmation.querySelector('#confirmEmail').textContent = email;
                confirmation.querySelector('#confirmPhone').textContent = phone;
                form.reset();
            } else {
                alert('Please fill out all required fields.');
            }
        });

        confirmation.querySelector('button').addEventListener('click', () => {
            confirmation.style.display = 'none';
            form.style.display = 'block';
        });
    } else {
        console.error('Appointment form or confirmation section not found.');
    }
}

function setupAuthForms() {
    const loginBtn = document.getElementById('login-btn');
    const signupBtn = document.getElementById('signup-btn');
    const loginForm = document.getElementById('login-form');
    const signupForm = document.getElementById('signup-form');
    const authMessage = document.querySelector('#login-form .auth-message'); // Targeting the auth-message within login-form

    if (loginBtn && signupBtn && loginForm && signupForm && authMessage) {
       
        loginForm.classList.remove('hidden');
        signupForm.classList.add('hidden');

        // Show login form and hide signup form
        loginBtn.addEventListener('click', () => {
            loginForm.classList.remove('hidden');
            signupForm.classList.add('hidden');
            loginBtn.classList.add('active');
            signupBtn.classList.remove('active');
        });

        // Show signup form and hide login form
        signupBtn.addEventListener('click', () => {
            signupForm.classList.remove('hidden');
            loginForm.classList.add('hidden');
            signupBtn.classList.add('active');
            loginBtn.classList.remove('active');
        });

        // Handle login form submission
        loginForm.addEventListener('submit', (event) => {
            event.preventDefault();
            const username = loginForm.querySelector('#username').value;
            const password = loginForm.querySelector('#password').value;

            if (!username || !password) {
                authMessage.textContent = 'Please fill in all fields.';
                authMessage.classList.remove('hidden');
            } else {
                authMessage.textContent = 'Success! You are now logged in.';
                authMessage.classList.remove('hidden');
                loginForm.reset();
                setTimeout(() => authMessage.classList.add('hidden'), 3000);
            }
        });

        // Handle signup form submission
        signupForm.addEventListener('submit', (event) => {
            event.preventDefault();
            const name = signupForm.querySelector('#name').value;
            const email = signupForm.querySelector('#email').value;
            const username = signupForm.querySelector('#username').value;
            const mobile = signupForm.querySelector('#mobile').value;
            const password = signupForm.querySelector('#password').value;
            const cpassword = signupForm.querySelector('#cpassword').value;

            if (!name || !email || !username || !mobile || !password || !cpassword) {
                authMessage.textContent = 'Please fill in all fields.';
                authMessage.classList.remove('hidden');
            } else if (password !== cpassword) {
                authMessage.textContent = 'Passwords do not match.';
                authMessage.classList.remove('hidden');
            } else {
                authMessage.textContent = 'Success! You are now signed up.';
                authMessage.classList.remove('hidden');
                signupForm.reset();
                setTimeout(() => authMessage.classList.add('hidden'), 3000);
            }
        });
    } else {
        console.error('One or more authentication elements not found in the DOM.');
    }
}

document.addEventListener('DOMContentLoaded', setupAuthForms);
 
function setupGoToTopButton() {
    const goToTopButton = document.getElementById('go-to-top');

    if (goToTopButton) {
        window.addEventListener('scroll', function () {
            if (window.pageYOffset > 300) {
                goToTopButton.style.display = 'block';
            } else {
                goToTopButton.style.display = 'none';
            }
        });

        goToTopButton.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    } else {
        console.error('Go to Top button not found in the DOM.');
    }
}
 // Gallery scroll setup
const setupGalleryScroll = () => {
    const showcaseWrapper = document.querySelector('.showcase-wrapper');
    const scrollRightBtn = document.getElementById('scroll-right');
    
    // Adjust scroll speed
    const scrollSpeed = 300; // Number of pixels to scroll per click

    if (showcaseWrapper && scrollRightBtn) {
        scrollRightBtn.addEventListener('click', function () {
            showcaseWrapper.scrollBy({
                left: scrollSpeed,
                behavior: 'smooth' // Smooth scrolling effect
            });
        });
    }
};

setupGalleryScroll();

// For About page
function setupAboutPage() {
     
    console.log('About page setup initialized.');
}
// For Login/Signup page
function setupLoginSignupPage() {
     
}

// For Services page
function setupServicesPage() {
     
}

// For Gallery page
function setupGalleryPage() {
    
}
