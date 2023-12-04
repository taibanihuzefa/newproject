// script.js
function sendMessage() {
    var userInput = document.getElementById("user-input").value;
  
    if (userInput.trim() !== "") {
      var chatBody = document.getElementById("chat-body");
      var messageElement = document.createElement("div");
      messageElement.className = "chat-message";
      messageElement.textContent = userInput;
  
      chatBody.appendChild(messageElement);
      document.getElementById("user-input").value = "";
    }
  }
  