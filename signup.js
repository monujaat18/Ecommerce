document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordInput = document.getElementById('password');
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);

    // Change the icon based on visibility
    this.src = type === 'password' ? './assets/huge-icon-interface-outline-eye.svg' : './assets/huge-icon-interface-outline-eye-open.svg'; // Use the appropriate images
});