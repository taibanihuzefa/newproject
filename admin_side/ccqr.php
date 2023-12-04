


<?php
session_start();
$okid=$_SESSION['vinayid'] ;
echo $okid;

 include './admin-header.php';
 include '../connection.php';
 $conn = mysqli_connect("localhost", "root", "", "apnabook");

 // Check connection
 if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
 }
 $query ="SELECT * FROM issued_books WHERE id = '$okid'";
 $result = mysqli_query($conn, $query);
 $row = mysqli_fetch_assoc($result);

error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $first_name = $row['id'] ;
    $last_name =  $row['book_title'];
    $email =  $row['userEmail'];
    $startdate=$row['issue_date'];
    $enddate=$row['date_expire'];


    // Create a QR code content with the user information
    $qr_code_content = "bookid: $first_name\n";
    $qr_code_content .= "book title: $last_name\n";
    $qr_code_content .= "Email: $email\n";
    $qr_code_content .= "startdate:  $startdate\n";
    $qr_code_content .= "enddate:  $enddate\n";

   

    // Generate the QR code and save it
    $temp_dir = 'temp/';
    $qr_code_file = $temp_dir . 'qr-code.png';
    
    include 'phpqrcode/qrlib.php';
    QRcode::png($qr_code_content, $qr_code_file);

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'vinusingh019@gmail.com'; // Your email address
        $mail->Password = 'wnsmaprvkvqdmraz';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender and recipient settings
        $mail->setFrom('vinusingh019@gmail.com', 'vinay singh');
        $mail->addAddress($email, $first_name . ' ' . $last_name);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Your QR Code';
        $mail->Body = 'Here is your QR code:';
        
        // Attach the QR code image
        $mail->addAttachment($qr_code_file, 'qr-code.png');

        $mail->send();
        echo 'Email sent with QR code attached!';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>QR Code Generator</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <style>
      body {
            margin: 0;
            background-color: #ecfab6;
        }
        .container {
            padding: 20px;
            margin-left:400px;
            margin-top:50px;
        }
        .card {
            border: none;
        }
    </style>
</head>
<body>
    <?php
    
  
    ?>
<div class="container">
    <div class="card">
                    <div class="card-body">
                    <h2 class="card-title text-center">QR Code Generator</h2>
                    <form autocomplete="off" class="form" role="form" action="#" method="post">
    <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">Book Isbn</label>
        <div class="col-lg-9">
            <input class="form-control" type="text" name="book_isbn" value="<?php echo $row['id']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">Book Title</label>
        <div class="col-lg-9">
            <input class="form-control" type="text" name="book_title" value="<?php echo $row['book_title']; ?>" readonly>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">User Email</label>
        <div class="col-lg-9">
            <input class="form-control" type="email" value="<?php echo $row['userEmail']; ?>" name="email" readonly>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">Issue Date</label>
        <div class="col-lg-9">
            <input class="form-control" type="text" name="issue_date" value="<?php echo $row['issue_date']; ?>" readonly>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label">Date Expire</label>
        <div class="col-lg-9">
            <input class="form-control" type="text" name="date_expire" min="<?php $row['date_expire']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label"></label>
        <div class="col-lg-9">
            <input type="submit" class="btn btn-primary" value="Generate QR Code and Send Email">
            <a href="admin_side\issued_books.php"><input type="submit" class="btn btn-primary" value=" Previous Page"></a>
        </div>
    </div>
</form>

</div>
    </div>
    </div>

        
        
   
</body>
</html>
<?php 

include './admin-footer.php';
?>