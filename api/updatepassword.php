<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Update</title>
</head>
<body>
    
<?php
// Database connection
require("../includes/database_connect.php");

if(isset($_GET['email']) && isset($_GET['reset_token']))
{
    date_default_timezone_set('Asia/kolkata');
    $date=date("Y-m-d");
    $query="SELECT * FROM `users` WHERE `email`='$_GET[email]' AND `reset_token`='$_GET[reset_token]' AND `reset_token_expire`='$date'";
    $result=mysqli_query($conn,$query);

    if($result)
    {
        if(mysqli_num_rows($result) == 1)
        {
            echo"
            <form method='POST'>
               <h3>Create New Password</h3>
               <input type='password' placeholder='New Password' minlength='6' name='Password'>
               <button type='submit' name='updatepassword'>UPDATE</button>
               <input type='hidden' name='email' value='$_GET[email]'>
            </form>
            ";
        }
        else{
        echo "
        <script>
          alert('Invalid or Expire Link.');
        </script>
        ";
        }
    }
    else
    {
        echo "
        <script>
          alert('Server Down! Try again later.');
        </script>
        ";
    }
}
?>

<?php
require("../includes/database_connect.php"); // Include the database connection

if (isset($_POST['updatepassword'])) {
    if (!isset($_POST['email']) || empty($_POST['email']) || empty($_POST['Password'])) {
        echo "
        <script>
          alert('Invalid request. Email or Password is missing.');
        </script>
        ";
        exit;
    }

    // Secure input
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = sha1($_POST['Password']);

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expire = NULL WHERE email = ?");
    $stmt->bind_param("ss", $password, $email);

    if ($stmt->execute()) {
        echo "
        <script>
          alert('Password Updated Successfully.');
          window.location.href='http://localhost/pglife-main/index.php';
        </script>
        ";
    } else {
        echo "
        <script>
          alert('Server Down! Try again later.');
        </script>
        ";
    }

    $stmt->close();
}

$conn->close();
?>

</body>
</html>