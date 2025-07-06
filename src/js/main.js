// In src/js/main.js

// This function initializes Fancybox on our gallery links
function initializeFancybox() {
  Fancybox.bind("[data-fancybox='artwork-gallery']", {
    // You can add custom Fancybox options here if needed
  });
}

// Run the function when the page first loads
document.addEventListener("DOMContentLoaded", () => {
  initializeFancybox();
});

// Listen for our custom event from Alpine.js
// When new posts are loaded, we re-initialize Fancybox on the new content.
document.addEventListener("posts-loaded", () => {
  console.log("Posts loaded event heard. Re-initializing Fancybox.");
  // We need to destroy the old instance before creating a new one
  if (Fancybox.getInstance()) {
    Fancybox.getInstance().destroy();
  }
  initializeFancybox();
});
