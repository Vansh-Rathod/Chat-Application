let form = document.querySelector(".signup-section form");

let registerBtn = document.querySelector(".register-btn input");

let errorText = document.querySelector(".error-txt");

form.onsubmit = (e) => {
  e.preventDefault();
};

registerBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "PHP/signupPHP.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        // console.log(data);

        if (data == "Successfully Registered!") {
          errorText.style.display = "block";
          errorText.textContent = "Successfully Registered!";
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
