function visibilidadContrasena() {
    var passwordInput = document.querySelector('input[name="contrasena"]');
    var passwordToggle = document.querySelector('#togglePassword img');
    
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordToggle.src = "../public/img/eye.svg"; 
    } else {
        passwordInput.type = "password";
        passwordToggle.src = "../public/img/eye-closed.svg";
    }
}
