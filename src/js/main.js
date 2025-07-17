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
// Add this to the end of your src/js/main.js file

document.addEventListener("DOMContentLoaded", () => {
  const mosaicVideo = document.querySelector("#featured-works video");

  // A reliable way to check if it's a mobile/touch device
  const isMobile = "ontouchstart" in window || navigator.maxTouchPoints > 0;

  if (mosaicVideo && isMobile) {
    // If we find the video and it's a mobile device, pause it.
    mosaicVideo.pause();
  }
});
