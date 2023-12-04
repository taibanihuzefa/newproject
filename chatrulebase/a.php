<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
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

  <script>
    function displayMessage(message, isUser) {
      var chatBody = document.getElementById("chat-body");
      var className = isUser ? "user-message" : "bot-message";
      var messageElement = document.createElement("div");
      messageElement.className = "chat-message " + className;
      messageElement.innerHTML = message;  
      chatBody.appendChild(messageElement);
    }

    function sendMessage() {
      var userInput = document.getElementById("user-input").value;

      if (userInput.trim() !== "") {
        displayMessage(userInput, true);
        document.getElementById("user-input").value = "";

        fetch("backend.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: "message=" + encodeURIComponent(userInput)
        })
          .then(response => {
            if (response.ok) {
              return response.text();
            } else {
              throw new Error("Failed to store the message in the database");
            }
          })
          .then(responseText => {
            if (responseText.trim() === "No trigger phrases found.") {
              displayMessage(responseText, false);
            } else {
            
              var triggerPhrases = responseText.split('\n');
              var triggerMessage = "";
              for (var i = 0; i < triggerPhrases.length; i++) {
                triggerMessage += '<a href="#" onclick="getTriggerResponse(\'' + triggerPhrases[i] + '\')">' + triggerPhrases[i] + '</a><br>';
              }
              displayMessage(triggerMessage, false);
            }
          })
          .catch(error => {
            console.error("An error occurred while storing or retrieving the message:", error);
          });
      }
    }

    function getTriggerResponse(trigger) {
      fetch("backend.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "message=" + encodeURIComponent(trigger)
      })
        .then(response => {
          if (response.ok) {
            return response.text();
          } else {
            throw new Error("Failed to retrieve trigger response");
          }
        })
        .then(responseText => {
          displayMessage(responseText, false);
        })
        .catch(error => {
          console.error("An error occurred while retrieving trigger response:", error);
        });
    }

   
    window.addEventListener("DOMContentLoaded", function() {
      var defaultGreeting = "Hello! How can I help you ? Type help ";
      displayMessage(defaultGreeting, false);
    });
  </script>
</body>
</html>
