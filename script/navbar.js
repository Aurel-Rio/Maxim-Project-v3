const nav = document.getElementById('navbar');
let countNav = true;
if (countNav == true){
window.onload = function() {
  nav.classList.add('nav_start');
  setTimeout(function() {
    nav.classList.remove('nav_start');
  }, 3000);
  countNav = false;
};
}