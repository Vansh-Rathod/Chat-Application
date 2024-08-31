let body = document.querySelector("body");
let form = document.querySelector(".typing-area");
let inputField = document.querySelector(".typing-area .text-input");
let sendBtn = document.querySelector(".typing-area .send-btn");
let chatBox = document.querySelector(".chat-box");
let securityInfo = document.querySelector(".security-info");

form.onsubmit = (e) => {
  e.preventDefault();
};

// inserting chat
sendBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "PHP/insertChatPHP.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // let data = xhr.response;
        // console.log(data);

        inputField.value = "";
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};

// if mouse pointer is in body tag then add "active" class in chatBox element
body.onmouseenter = () => {
  chatBox.classList.add("active");
};

// if mouse pointer is out of body tag then remove "active" class from chatBox element
body.onmouseleave = () => {
  chatBox.classList.remove("active");
};

// directly scroll to bottom int chatBox element code
function scrollToBottom() {
  console.log("Scrolling");
  // console.log(chatBox.scrollHeight);
  chatBox.scrollTop = chatBox.scrollHeight;
}

// getting chat
setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "PHP/getChatPHP.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data != "") {
          // console.log(data);
          chatBox.innerHTML = data;
          chatBox.insertAdjacentElement("beforeend", securityInfo);
          if (!chatBox.classList.contains("active")) { // if chatbox does not contain "active" class then scroll to bottom
            scrollToBottom();
          }
        }
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
}, 500); // this function will run frequently after 5ms
