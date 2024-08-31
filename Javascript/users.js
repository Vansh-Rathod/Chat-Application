let usersList = document.querySelector(".users .users-list");

let searchBarInput = document.querySelector(".search-section input");
let searchBtn = document.querySelector(".search-section .search-btn");

searchBtn.onclick = () => {
  searchBarInput.classList.toggle("active");
  searchBarInput.focus();
  searchBtn.classList.toggle("active");
  searchBarInput.value = "";
};

// search code
searchBarInput.onkeyup = () => {
  let searchValue = searchBarInput.value;
  // if (searchValue != "") { // if user have entered some keyword in searchbar
  //   searchBarInput.classList.add("active");
  // } else { // if there is nothing in searchbar
  //   searchBarInput.classList.remove("active");
  // }
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "PHP/searchPHP.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        // console.log(data);
        usersList.innerHTML = data;
      }
    }
  };
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("searchValue=" + searchValue);
};

// all users available code
setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "PHP/usersPHP.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (!searchBarInput.classList.contains("active")) {
          // console.log(data);
          usersList.innerHTML = data;
        }
      }
    }
  };
  xhr.send();
}, 500); // this function will run frequently after 5ms


// version2 of above code - it will not run 5ms frequently, it will run only once
// all users available code
// let xhr = new XMLHttpRequest();
// xhr.open("GET", "PHP/usersPHP.php", true);
// xhr.onload = () => {
//   if (xhr.readyState === XMLHttpRequest.DONE) {
//     if (xhr.status === 200) {
//       let data = xhr.response;
//       if (!searchBarInput.classList.contains("active")) {
//         // console.log(data);
//         usersList.innerHTML = data;
//       }
//     }
//   }
// };
// xhr.send();
