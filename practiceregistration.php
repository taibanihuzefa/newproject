<!DOCTYPE html>
<html>
<head>
    <title>User Form</title>
    <script>
        function validateUsername() {
            var username = document.forms["userForm"]["username"].value;

            if (username === "") {
                document.getElementById("warningMessage").textContent = "Username is required.";
            } else if (!/^[A-Z]/.test(username)) {
                document.getElementById("warningMessage").textContent = "Username should start with a capital letter.";
            } else {
                document.getElementById("warningMessage").textContent = "";
            }
        }

        function validateForm() {
            validateUsername(); // Call the validation function before form submission

            var username = document.forms["userForm"]["username"].value;

            if (username === "" || !/^[A-Z]/.test(username)) {
                return false; // Prevent form submission
            }

            // Additional validation logic can be added here

            return true; // Allow form submission
        }
    </script>
</head>
<body>
    <form name="userForm" onsubmit="return validateForm()">
        <label for="username">Username:</label>

        <input type="text" id="username" name="username" oninput="validateUsername()">
        
        <span id="warningMessage" style="color: red;"></span>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>