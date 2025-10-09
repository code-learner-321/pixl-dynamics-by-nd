document.addEventListener("DOMContentLoaded", function () {
  const currentUrl = window.location.href;
  const menuLinks = document.querySelectorAll(".menu-link");

  menuLinks.forEach(link => {
    if (link.href === currentUrl) {
      link.classList.add("active");

      // Optional: expand parent submenu
      let parent = link.closest(".menu-item-wrapper");
      while (parent) {
        const checkbox = parent.querySelector(".submenu-toggle");
        if (checkbox) checkbox.checked = true;
        parent = parent.parentElement.closest(".menu-item-wrapper");
      }
    }
  });
});