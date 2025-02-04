$(document).ready(function(){
    $('#UF_HEAD_PHONE').mask('+7 (999) 999-9999');

});

function onRecaptchaSuccess() {
    $('#register_submit_button').attr('disabled',false);
    $('.submit-disable-notice').hide();
}

function togglePasswordVisibility() {
    var passwordField = document.getElementById("password-field");
    var passToggle = document.querySelector(".password-toggle");

    // Check if the password is visible, switch to hidden, change icon
    if (passwordField.type === "password") {
        passwordField.type = "text";
        passToggle.classList.remove("fa-eye");
        passToggle.classList.add("fa-eye-slash");
    } else { // otherwise, switch to visible, change icon back
        passwordField.type = "password";
        passToggle.classList.remove("fa-eye-slash");
        passToggle.classList.add("fa-eye");
    }
}

function toggleConfirmPasswordVisibility() {
    var passwordField = document.getElementById("password-repeat-field");
    var passToggle = document.querySelector(".password-confirm-toggle");

    // Check if the password is visible, switch to hidden, change icon
    if (passwordField.type === "password") {
        passwordField.type = "text";
        passToggle.classList.remove("fa-eye");
        passToggle.classList.add("fa-eye-slash");
    } else { // otherwise, switch to visible, change icon back
        passwordField.type = "password";
        passToggle.classList.remove("fa-eye-slash");
        passToggle.classList.add("fa-eye");
    }
}