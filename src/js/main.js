// In src/js/main.js

// This function initializes Fancybox on our gallery links
function initializeFancybox() {
  // CORRECTED: The selector now matches the HTML attribute 'data-fancybox="gallery"'
  Fancybox.bind("[data-fancybox='gallery']", {
    // You can add custom Fancybox options here if needed
  });
}

// Run the function when the page first loads
document.addEventListener("DOMContentLoaded", () => {
  initializeFancybox();
});

// Listen for our custom event from Alpine.js
// When new posts are loaded via AJAX, we re-initialize Fancybox
document.addEventListener("posts-loaded", () => {
  // Optional: You can uncomment the line below to see this fire in your browser's console
  // console.log("Posts loaded event heard. Re-initializing Fancybox.");

  // No need to destroy the old instance, Fancybox 5 is smart enough to handle re-binding.
  initializeFancybox();
});
