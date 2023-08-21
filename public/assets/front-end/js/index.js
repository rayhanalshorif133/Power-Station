const openMobileMenuButton = document.getElementById("open_mobile_menu_button");
const closeMobileMenuButton = document.getElementById(
  "close_mobile_menu_button"
);
const mobileMenu = document.getElementById("mobile_menu");

openMobileMenuButton.addEventListener("click", () => {
  mobileMenu.classList.remove('hidden')
});

closeMobileMenuButton.addEventListener("click", () => {
  mobileMenu.classList.add('hidden')
});
