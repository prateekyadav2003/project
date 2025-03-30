<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
require("../includes/database_connect.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $reset_token)
{
    require('PHPMailer/PHPMailer.php');
    require('PHPMailer/SMTP.php');
    require('PHPMailer/Exception.php');

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'team.pgfinder@gmail.com';                     //SMTP username
        $mail->Password   = 'cfux bbzc oazq hhoa';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('team.pgfinder@gmail.com', 'PG Finder');
        $mail->addAddress($email);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password Reset Link from PG Finder';
        $mail->Body    = "We got a request from you to reset your password! <b>
        Click the link below: </b>
        <a href='http://localhost/pglife-main/api/updatepassword.php?email=$email&reset_token=$reset_token'> 
          Reset Password
        </a>";

        $mail->send();
        return true;
    } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo; // Output the error message
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if email exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows==1) {
        // Generate a unique token
        $token = bin2hex(random_bytes(16));
        date_default_timezone_set('Asia/Kolkata');
        $date = date("Y-m-d"); // Set expiration time to 1 hour from now
        
        // Store the token in the database (you should also set an expiration time)
        $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_token_expire = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $date, $email);
        $stmt->execute();

        // Send email with reset link
        if (sendMail($email, $token)) {
            echo "Reset link sent to your email.";
        } else {
            echo "Failed to send reset link.";
        }
    } else {
        echo "
        <script>
          alert('Email not found.');
        </script>
        ";
    }
    $stmt->close();
}
$conn->close();
?>