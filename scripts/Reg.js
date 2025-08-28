var form = document.querySelector("form");
var username = document.getElementById("username");
var email = document.getElementById("email");
var password = document.getElementById("password");
var confirmPassword = document.getElementById("repassword");


function validateForm() {
    if (username.value === "" || email.value === "" || password.value === "") {
        alert("Please fill in all fields.");
        return false;
    }
    else if (!validateEmail(email.value)) {
        alert("Please enter a valid email address.");
        return false;
    }
    else if (!validatePassword(password.value, confirmPassword.value)) {
        alert("Password must be at least 6 characters long and contain at least one uppercase letter and one number. Also, passwords must match.");
        return false;
    }
    return true;
}


function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validatePassword(pass, confirmPass) {
    if (pass.length >= 6 &&
         /[A-Z]/.test(pass) &&
          /[0-9]/.test(pass) && 
          confirmPass === pass) {
        return true;
    }
    return false;
}

form.addEventListener("submit", function (event) {
    if (!validateForm()) {
        event.preventDefault();
    }
});