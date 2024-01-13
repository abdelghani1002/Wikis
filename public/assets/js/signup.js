document.getElementById('formSinup').addEventListener('submit', function (event) {

    var name = document.getElementById('yourName');
    var email = document.getElementById('yourEmail');
    var password = document.getElementById('yourPassword');

    if (!isValidEmail(email.value)) {
        email.classList.remove('is-valid');
        email.classList.add('is-invalid');
        event.preventDefault();
    } else {
        email.classList.remove('is-invalid');
        email.classList.add('is-valid');
    }

    if (!isValidPassword(password.value)) {
        password.classList.remove('is-valid');
        password.classList.add('is-invalid');
        password.nextElementSibling.innerHTML = "Create a password that is at least 8 characters long, includes at least one lowercase letter, one uppercase letter, and one digit."
        event.preventDefault();
    } else {
        password.classList.remove('is-invalid');
        password.classList.add('is-valid');
    }

    if (!isValidName(name.value)) {
        name.classList.remove('is-valid');
        name.classList.add('is-invalid');
        event.preventDefault();
    } else {
        name.classList.remove('is-invalid');
        name.classList.add('is-valid');
    }

});

function isValidName(name) {
    var nameRegex = /^[A-Za-z\s]+$/;
    return nameRegex.test(name);
}

function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function isValidPassword(password) {
    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
    return passwordRegex.test(password);
}