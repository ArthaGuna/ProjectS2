function togglePasswordVisibility(inputId) {
  let passwordInput = document.getElementById(inputId);

  passwordInput.type = passwordInput.type === "password" ? "text" : "password";
}
