<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Update</title>
    <style>
        body {
            background-color: #1e1e1e;
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .password-update-container {
            background-color: #2d2d2d;
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            border: 2px solid #4b47d9;
            padding: 2rem;
            max-width: 400px;
            width: 100%;
        }

        .password-update-container h3 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: white;
            text-align: center;
        }

        .password-update-container input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            border-radius: 6px;
            background-color: #3a3a3a;
            color: white;
            border: 1px solid #555;
            margin-bottom: 1.5rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .password-update-container input[type="password"]:focus {
            border-color: #4b47d9;
            box-shadow: 0 0 0 2px rgba(75, 71, 217, 0.3);
            outline: none;
        }

        .password-update-container button {
            width: 100%;
            background-color: #4b47d9;
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            transition: background-color 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .password-update-container button:hover {
            background-color: #3d39c1;
        }
    </style>
</head>
<body>

<?php
require("../includes/database_connect.php");

if(isset($_GET['email']) && isset($_GET['reset_token']))
{
    date_default_timezone_set('Asia/kolkata');
    $date = date("Y-m-d");
    $query = "SELECT * FROM `users` WHERE `email`='$_GET[email]' AND `reset_token`='$_GET[reset_token]' AND `reset_token_expire`='$date'";
    $result = mysqli_query($conn, $query);

    if($result)
    {
        if(mysqli_num_rows($result) == 1)
        {
            echo "
            <div class='password-update-container'>
                <form method='POST'>
                    <h3>Create New Password</h3>
                    <input type='password' placeholder='New Password' minlength='6' name='Password' required>
                    <input type='hidden' name='email' value='$_GET[email]'>
                    <button type='submit' name='updatepassword'>UPDATE</button>
                </form>
            </div>
            ";
        }
        else {
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
require("../includes/database_connect.php");

if (isset($_POST['updatepassword'])) {
    if (!isset($_POST['email']) || empty($_POST['email']) || empty($_POST['Password'])) {
        echo "
        <script>
          alert('Invalid request. Email or Password is missing.');
        </script>
        ";
        exit;
    }

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = sha1($_POST['Password']);

    $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expire = NULL WHERE email = ?");
    $stmt->bind_param("ss", $password, $email);

    if ($stmt->execute()) {
        echo "
        <script>
          alert('Password Updated Successfully.');
          window.location.href='http://localhost/pgfindermain/index.php';
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
