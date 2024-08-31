let passwordField = document.querySelector(
  "form .field input[type='password']"
);
let eyeBtn = document.querySelector("form .field i");

eyeBtn.addEventListener("click", function () {
  let type = passwordField.getAttribute("type");
  if (type == "text") {
    passwordField.setAttribute("type", "password");
    eyeBtn.setAttribute("class", "fa-solid fa-eye-slash");
  } else {
    // type == "password"
    passwordField.setAttribute("type", "text");
    eyeBtn.setAttribute("class", "fa-solid fa-eye");
  }
});
