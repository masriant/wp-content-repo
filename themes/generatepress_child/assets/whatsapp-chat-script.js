document.addEventListener("DOMContentLoaded", function () {
  // Create the WhatsApp chat button
  var chatButton = document.createElement("div");
  chatButton.id = "whatsapp-chat-button";
  chatButton.style.position = "fixed";
  chatButton.style.bottom = "20px";
  chatButton.style.right = "20px";
  chatButton.style.backgroundColor = "#25D366";
  chatButton.style.color = "#fff";
  chatButton.style.borderRadius = "50%";
  chatButton.style.width = "60px";
  chatButton.style.height = "60px";
  chatButton.style.display = "flex";
  chatButton.style.alignItems = "center";
  chatButton.style.justifyContent = "center";
  chatButton.style.cursor = "pointer";
  chatButton.innerHTML =
    '<i class="fab fa-whatsapp" style="font-size: 24px;"></i>'; // Font Awesome icon

  // Append the button to the body
  document.body.appendChild(chatButton);

  // Add click event to open WhatsApp chat
  chatButton.addEventListener("click", function () {
    var phoneNumber = "+628119991779"; // Replace with your WhatsApp number
    var message = "Hello! How can I help you?"; // Default message
    var url = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(
      message
    )}`;
    window.open(url, "_blank");
  });
});
