let form = document.querySelector(".login-section form");

let loginBtn = document.querySelector(".login-btn input");

let errorText = document.querySelector(".error-txt");

form.onsubmit = (e) => {
  e.preventDefault();
};

loginBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "PHP/loginPHP.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        // console.log(data);

        if (data == "Successfully LoggedIn!") {
          errorText.style.display = "block";
          errorText.textContent = "Successfully LoggedIn!";
          alert(data);
          location.href = "users.php";
        } else {
          errorText.style.display = "block";
          errorText.textContent = data;
          alert(data);
        }
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};
