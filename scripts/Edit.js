var form = document.querySelector("form");
var oldpassword = document.getElementById("oldpassword");
var newpassword = document.getElementById("password");
var email = document.getElementById("email");

function validateForm() {
    if (oldpassword.value === "") {
        alert("Please fill in all fields.");
        return false;
    }
    {
    if (email.value === "") {
        return true;
    }
    else if (!validateEmail(email.value)) {
        alert("Please enter a valid email address.");
        return false;
    }
}
    if (!validatePassword(oldpassword.value)) {
        alert("Password must be at least 6 characters long and contain at least one uppercase letter and one number.");
        return false;
    }
        else if (!validatePassword(newpassword.value)) {
        alert("New Password must be at least 6 characters long and contain at least one uppercase letter and one number.");
        return false;
    }
    return true;
}


function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validatePassword(pass) {
    if (pass.length >= 6 &&
         /[A-Z]/.test(pass) &&
          /[0-9]/.test(pass) ) {
        return true;
    }
    return false;
}

form.addEventListener("submit", function (event) {
    if (!validateForm()) {
        event.preventDefault();
    }
});