const menuBar = document.getElementById("menu_bar");
const closeBtn = document.getElementById("close_btn");
const sidebar = document.querySelector("aside");

// Open sidebar on menu click
menuBar.addEventListener("click", () => {
    sidebar.classList.add("open");
});

// Close sidebar on close button click
closeBtn.addEventListener("click", () => {
    sidebar.classList.remove("open");
});