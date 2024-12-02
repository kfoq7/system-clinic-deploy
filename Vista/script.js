const containerLogin = document.querySelector(".container-login");
const btnSignInLogin = document.getElementById("btn-sign-in");
const btnSignUpLogin = document.getElementById("btn-sign-up");

// Evento para cambiar a la vista de "Iniciar Sesión"
btnSignInLogin.addEventListener("click", () => {
   containerLogin.classList.remove("toggle"); // Muestra el formulario de iniciar sesión
});

// Evento para cambiar a la vista de "Registrarse"
btnSignUpLogin.addEventListener("click", () => {
   containerLogin.classList.add("toggle");
});
