
<?php 
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'apnabook';

 
$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die('Error connecting to MySQL: ' . mysqli_connect_error());
}
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];

    if (strtolower($message) === 'help') {
      
        $helpQuery = "SELECT trigger_phrase FROM responses";
        $helpResult = mysqli_query($conn, $helpQuery);
        if ($helpResult && mysqli_num_rows($helpResult) > 0) {
            while ($row = mysqli_fetch_assoc($helpResult)) {
                echo $row['trigger_phrase'] . "\n";  
            }
        } else {
            echo 'No trigger phrases found.';
        }
        exit;  
    }

  
    $insertQuery = "INSERT INTO messages (content) VALUES ('$message')";
    $insertResult = mysqli_query($conn, $insertQuery);
    if (!$insertResult) {
        echo 'Failed to insert message';
    }

     
    $responseQuery = "SELECT content FROM responses WHERE trigger_phrase = '$message'";
    $responseResult = mysqli_query($conn, $responseQuery);
    if ($responseResult && mysqli_num_rows($responseResult) > 0) {
        $row = mysqli_fetch_assoc($responseResult);
        $responseMessage = $row['content'];
        
        
        $botResponseQuery = "INSERT INTO messages (content) VALUES ('$responseMessage')";
        $botResponseResult = mysqli_query($conn, $botResponseQuery);
        if (!$botResponseResult) {
          
        }
    } else {
        $responseMessage = "Sorry, I didn't understand your message  type help.";  
        
        $botResponseQuery = "INSERT INTO messages (content) VALUES ('$responseMessage')";
        $botResponseResult = mysqli_query($conn, $botResponseQuery);
        if (!$botResponseResult) {
            echo 'Failed to insert bot response';
        }
    }
    
    
    echo $responseMessage;
}

 
mysqli_close($conn);
?>