<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    
 * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
}

/* Chat container styles */
.chat-container {
  width: 300px;
  margin: 0 auto;
  border: 1px solid #ccc;
  border-radius: 5px;
  overflow: hidden;
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
}

.chat-header {
  background-color: #3498db;
  color: #fff;
  text-align: center;
  padding: 10px;
}

.chat-header h1 {
  margin: 0;
}

.chat-body {
  padding: 10px;
  max-height: 300px;
  overflow-y: scroll;
}

/* Chat message styles */
.chat-message {
  margin: 5px 0;
  padding: 10px;
  border-radius: 5px;
}

.user-message {
  background-color: #3498db;
  color: #fff;
  align-self: flex-end;
}

.bot-message {
  background-color: #f1f0f0;
}

.chat-footer {
  background-color: #f1f0f0;
  padding: 10px;
}

.input-container {
  display: flex;
}

input[type="text"] {
  flex: 1;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

button {
  background-color: #3498db;
  color: #fff;
  border: none;
  border-radius: 3px;
  padding: 5px 10px;
  cursor: pointer;
}

button:hover {
  background-color: #2980b9;
}



  </style>
</head>
<body>
  <div class="chat-container">
    <div class="chat-header">
      <h1>Chatbot</h1>
    </div>
    <div class="chat-body" id="chat-body">
     </div>
    <div class="chat-footer">
      <div class="input-container">
        <input type="text" id="user-input" placeholder="Type your message...">
        <button onclick="sendMessage()">Send</button>
      </div>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>

<script>
function displayMessage(message, isUser) {
  var chatBody = document.getElementById("chat-body");
  var className = isUser ? "user-message" : "bot-message";
  var messageElement = document.createElement("div");
  messageElement.className = "chat-message " + className;
  messageElement.innerHTML = message;  
  chatBody.appendChild(messageElement);

   chatBody.scrollTop = chatBody.scrollHeight;
}

function sendMessage() {
  var userInput = document.getElementById("user-input").value;

  if (userInput.trim() !== "") {
    displayMessage(userInput, true);
    document.getElementById("user-input").value = "";

    
  }
}

 
window.addEventListener("DOMContentLoaded", function() {
  var defaultGreeting = "Hello! How can I help you?";
  displayMessage(defaultGreeting, false);
});



</script>
 
