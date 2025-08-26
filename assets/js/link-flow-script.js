document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('a[href="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      e.preventDefault(); // Prevent page reload
    });
  });
});