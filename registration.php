<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


?>
<?php
include 'connection.php';
include 'donationheader.php';



// Define variables and initialize with empty values

$username = $gender = $dob = $email = $password = $Cpassword = $contact = "";
$user_type = "user";
$username_err = $gender_err = $dob_err = $email_err = $password_err = $Cpassword_err = $contact_err = "";

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Validate username
    if (empty($_POST["username"])) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match("/^[a-zA-Z]+$/", $_POST["username"])) {
        $username_err = "Username can only contain alphabets.";
    } else {
        $username = $_POST["username"];
    }

    // Validate gender
    if (empty($_POST["gender"])) {
        $gender_err = "Please select a gender.";
    } else {
        $gender = ($_POST["gender"] == "male") ? "male" : "female";
    }

    // Validate date of birth
    if (empty($_POST["dob"])) {
        $dob_err = "Please enter a date of birth.";
    } else {
        $dob = $_POST["dob"];
    }

    // Validate password
    if (empty($_POST["password"])) {
        $password_err = "Please enter a password.";
    } elseif (strlen($_POST["password"]) < 8  || !preg_match("/[A-Z]+/", $_POST["password"]) || !preg_match("/[0-9]+/", $_POST["password"])) {
        $password_err = "Password length atleast 8 characters and should have atleast one capital letter and one number.";
    } else {
        $password = $_POST["password"];
    }

    // Validate confirm password
    if (empty($_POST["Cpassword"])) {
        $Cpassword_err = "Please enter confirm password.";
    } elseif ($_POST["password"] != $_POST["Cpassword"]) {
        $Cpassword_err = "Password did not match.";
    } else {
        $password = md5($_POST["password"]);
    }

    // Validate phone number
    if (empty(trim($_POST["contact"]))) {
        $contact_err = "Please enter a contact number.";
    } elseif (!preg_match("/^[0-9]{10}$/", trim($_POST["contact"]))) {
        $contact_err = "Phone number only conatins number and it should be a 10-digit number.";
    } else {
        $contact = $_POST["contact"];
    }

    // Validate email
    if (empty($_POST["email"])) {
        $email_err = "Please enter an email address.";
    } elseif (strlen($_POST["email"]) > 30) {
        $email_err = "Email length should not be greater than 30 characters.";
    } elseif (!preg_match("/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]+$/", $_POST["email"])) {
        $email_err = "Please enter a valid email address.";
    } else {

        $sql = "SELECT Email_id FROM user_register WHERE Email_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = $_POST['email'];

            // Try to execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This email is already taken";
                } else {
                    $email = $_POST['email'];
                }
            }
        }
    }


    if (empty($username_err) && empty($gender_err) && empty($dob_err) && empty($email_err) && empty($password_err) && empty($Cpassword_err) && empty($contact_err)) {

        // Prepare SQL statement to insert data into "user_register" table
        $sql = "INSERT INTO user_register (Username, Email_id, Password, Gender, DOB, Contact, user_type) VALUES ('$username', '$email', '$password', '$gender', '$dob', '$contact', '$user_type')";

        $result = mysqli_query($conn, $sql);

        $subject = $_POST['username'];
        echo $subject;
        $message = "you are successfully registred on apnabook";
        $email = $_POST['email'];
        echo $email;


error_reporting(0); 
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'vinusingh019@gmail.com';
            $mail->Password = 'wnsmaprvkvqdmraz';
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            //Send Email
            $mail->setFrom('vinusingh019@gmail.com');

            //Recipients
            $mail->addAddress($email);


            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();



            $_SESSION['result'] = 'Message has been sent';
            $_SESSION['status'] = 'ok';
        } catch (Exception $e) {
            $_SESSION['result'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            $_SESSION['status'] = 'error';
        }


        echo '<script>alert("Registration Successfully");</script>';


        header("location:login.php");
    } else {
        echo "Error found";
    }
}




?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="css/log_regis.css">
    <!-- <link rel="stylesheet" href="css/regis.css"> -->
    <style>
        body {
            background-color: #d8fffb;
        }

        .left {
            width: 100%;
            justify-content: center;
            display: flex;
            align-items: center;
            background: rgb(6, 53, 71);
            background: linear-gradient(110deg, rgba(6, 53, 71, 1) 6%, rgba(44, 152, 194, 1) 32%, rgba(6, 53, 71, 1) 63%, rgba(44, 152, 194, 1) 85%);
            border-radius: 10px 0px 0px 10px;


        }

        .right img {
            width: 100%;
            height: 100%;
            border-radius: 0 10px 10px 0;
        }


        .right {
            width: 80%;
        }

        .fields_main {
            display: flex;
            justify-content: center;

        }

        .fields_main .fields {
            width: 100%;
            text-align: left;

        }

        .fields label {
            text-align: left;
            font-size: 20px;
            margin-left: 15px;
        }

        .fields_main .fields .value {
            width: 45%;
            text-align: left;
            display: flex;
            font-size: 18px;
            margin: 10px;
        }

        .fields_main .fields .input-area {
            height: 50px;
            width: 100%;
            position: relative;
        }

        .fields_main .fields .input-area .area {
            width: 60%;
            height: 68%;
            outline: none;
            margin: 2px 6px;
            padding-left: 25px;
            font-size: 18px;
            background: none;
            border-radius: 10px;
            border: 1px solid #bfbfbf;
            border-bottom-width: 2px;
            transition: all 0.2s ease;

        }

        .toggle {
            padding-right: 0;
            background: none;
            border: none;
            z-index: 1;
            position: relative;
            top: 50%;
            right: 34px;
            font-size: 18px;
            pointer-events: none;
            transform: translateY(-50%);
        }

        input[type="password"]::-ms-reveal {
            display: none;
        }

        form .field .input-area {
            height: 50px;
            width: 100%;
            display: flex;
            position: relative;
            margin-top: 5px;
        }

        .far {
            right: 36px;
            top: 25px;
            cursor: pointer;
        }
    </style>

    <script>
        document.getElementById("userForm").addEventListener("click", function(event) {
            event.preventDefault()
        });

        function validateUsername() {
            var username = document.forms["userForm"]["username"].value;

            if (username === "") {
                document.getElementById("warningUsername").textContent = "Username is required.";
            } else if (/[^A-Za-z\s]+/g.test(username)) {
                document.getElementById("warningUsername").textContent = "Username should only contains Alphabetic character.";
            } else {
                document.getElementById("warningUsername").textContent = "";
            }
        }

        function validateEmail() {
            var email = document.forms["userForm"]["email"].value;

            if (email === "") {
                document.getElementById("warningEmail").textContent = "Email is required.";
            } else if (email.length > 30) {
                document.getElementById("warningEmail").textContent = "Email should contain a maximum of 30 characters.";
            } else if (!/^[A-Za-z]+@[A-Za-z]+\.[A-Za-z]+$/.test(email)) {
                document.getElementById("warningEmail").textContent = "Invalid email format.";
            } else {
                document.getElementById("warningEmail").textContent = "";
            }
        }

        function validatePassword() {
            var password = document.forms["userForm"]["password"].value;

            if (password === "") {
                document.getElementById("warningPassword").textContent = "Password is required.";
            } else if (password.length < 8) {
                document.getElementById("warningPassword").textContent = "Password should be at least 8 characters long.";
            } else if (!/[A-Z]/.test(password) || !/[0-9]/.test(password)) {
                document.getElementById("warningPassword").textContent = "Password should contain at least one capital letter and one number.";
            } else if (!/[^A-Za-z0-9]/.test(password)) {
                document.getElementById("warningPassword").textContent = "Password should contain at least one special character.";
            } else {
                document.getElementById("warningPassword").textContent = "";
            }
        }

        function validateConfirmPassword() {
            var password = document.forms["userForm"]["password"].value;
            var confirmPassword = document.forms["userForm"]["confirmPassword"].value;

            if (confirmPassword === "") {
                document.getElementById("warningConfirmPassword").textContent = "Confirm Password is required.";
            } else if (confirmPassword !== password) {
                document.getElementById("warningConfirmPassword").textContent = "Confirm Password should match the original password.";
            } else {
                document.getElementById("warningConfirmPassword").textContent = "";
            }
        }

        function restrictInputToTenDigits(event) {
            const input = event.target;
            let value = input.value;

            // Remove non-digit characters
            value = value.replace(/\D/g, '');

            // Restrict to 13 digits
            value = value.slice(0, 10);

            // Update the input field with the new value
            input.value = value;
        }
    </script>
</head>

<body>
    <div class="main">
        <div class="left">
            <div class="wrapper_regis wrapper">

                <header>Register</header>

                <form action="" method="post" name="userForm" id="userForm">

                    <div class="fields_main">

                        <div class="field username">
                            <label for="username">Username</label>
                            <div class="input-area">
                                <input type="text" placeholder="Username" oninput="validateUsername()" name="username" id="username" autocomplete="off">
                                <i class="icon fas fa-user"></i>
                            </div>
                        </div>

                        <div class="field email">
                            <label for="email">Email</label>
                            <div class="input-area">
                                <input type="text" placeholder="Email" name="email" oninput="validateEmail()" id="email" autocomplete="off">
                                <i class="icon fas fa-envelope"></i>
                            </div>
                        </div>

                    </div>

                    <div class="main_error">
                        <div class="error_box">
                            <span id="warningUsername"><?php echo  "$username_err" ?></span>


                        </div>
                        <div class="error_box">
                            <span id="warningEmail"><?php echo "$email_err" ?></span>

                        </div>

                    </div>



                    <div class="fields_main">

                        <div class="field password">
                            <label for="password">Password</label>

                            <div class="input-area">
                                <input type="password" placeholder="Password" name="password" id="password" oninput="validatePassword()">
                                <i class="icon fas fa-lock"></i>

                            </div>
                        </div>

                        <div class="field Cpassword">
                            <label for="Cpassword">Confirm password</label>
                            <div class="input-area">
                                <input type="password" placeholder="Confirm password" name="Cpassword" id="Cpassword" oninput="validateConfirmPassword()">
                                <i class="icon fas fa-lock"></i>
                            </div>
                        </div>

                    </div>

                    <div class="main_error">
                        <div class="error_box">
                            <span id="warningPassword"><?php echo $password_err ?></span>

                        </div>
                        <div class="error_box">
                            <span id="warningConfirmPassword"><?php echo $Cpassword_err ?></span>
                        </div>

                    </div>

                    <div class="fields_main">
                        <div class="fields gender">
                            <div>
                                <label for="gender">Gender</label>
                            </div>
                            <div class="value">
                                <input type="radio" name="gender" id="gender" value="male"> Male
                                <input type="radio" name="gender" id="gender" value="female"> Female
                            </div>

                        </div>

                        <div class="fields dob">
                            <div>
                                <label for="gender">Date Of Birth</label>
                            </div>
                            <div class="input-area">
                                <input class="area" type="date" value="" id="dob" name="dob" max="<?= date('Y-m-d', strtotime('-10 years')) ?>">
                            </div>
                        </div>

                    </div>

                    <div class="main_error">
                        <div class="error_box">
                            <span><?php echo $gender_err ?></span>

                        </div>
                        <div class="error_box">
                            <span><?php echo $dob_err ?></span>
                        </div>
                    </div>

                    <div class="fields_main">

                        <div class="field contact">
                            <label for="contact">Contact Number</label>
                            <div class="input-area">
                                <input type="tel" placeholder="Contact Number" name="contact" id="contact" oninput="restrictInputToTenDigits(event)" pattern="[0-9]{10}">
                                <i class="icon fas fa-address-book"></i>
                            </div>
                        </div>

                        <div class="fields extra">

                        </div>

                    </div>

                    <div class="main_error">
                        <div class="error_box">
                            <span><?php echo $contact_err ?></span>


                        </div>
                        <div class="error_box">

                        </div>
                    </div>

                    <input type="submit" value="Submit" name="send">


                    <div class="sign-txt">Already have an account? <a href="login.php">Login Now</a></div>


                </form>

            </div>
        </div>
        <div class="right">
            <img src="images/regisImg.jpg" alt="">
        </div>

    </div>




</body>

</html>