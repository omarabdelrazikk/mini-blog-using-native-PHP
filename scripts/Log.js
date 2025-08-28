var form = document.querySelector("form");
var usernamemail = document.getElementById("usernamemail");
var password = document.getElementById("password");



function validateForm() {
    if (usernamemail.value === "" || password.value === "") {
        alert("Please fill in all fields.");
        return false;
    }
    return true;
}


form.addEventListener("submit", function (event) {
    if (!validateForm()) {
        event.preventDefault();
    }
});