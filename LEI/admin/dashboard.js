const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});

document.addEventListener("DOMContentLoaded", function () {
  var notificationWrapper = document.querySelector(".notification-wrapper");
  if (notificationWrapper.scrollHeight > notificationWrapper.clientHeight) {
    notificationWrapper.classList.add("scrollable");
  }

  document.getElementById("search").addEventListener("input", function () {
    var searchText = this.value.toLowerCase();
    var notificationItems = document.querySelectorAll(".notification-item");
    notificationItems.forEach(function (item) {
      var notificationText = item.textContent.toLowerCase();
      if (notificationText.includes(searchText)) {
        item.style.display = "block";
      } else {
        item.style.display = "none";
      }
    });
  });
});
