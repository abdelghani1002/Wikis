
document.getElementById('formlogin').addEventListener('submit', function(event) {
    
    var email = document.getElementById('yourEmail');
    var password = document.getElementById('yourPassword');

    if (!isValidEmail(email.value)) {
        email.classList.add('is-invalid');
        email.classList.remove('is-valid');
        event.preventDefault();
    } else {
        email.classList.add('is-valid');
        email.classList.remove('is-invalid');
    }

    if (!isValidPassword(password.value)) {
        password.classList.add('is-invalid');
        password.classList.remove('is-valid');
        event.preventDefault();
    } else {
        password.classList.add('is-valid');
        password.classList.remove('is-invalid');
    }

});

function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function isValidPassword(password) {
    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
    return passwordRegex.test(password);
}