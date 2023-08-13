<?php
session_start();
require_once("database_connection.php");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Generate a unique token
    $token = bin2hex(random_bytes(32));

    // Store the token, email, and timestamp in the database
    $email_address = $_POST["email_address"];
    $timestamp = time(); // Current timestamp

    // Prepare the insert query
    $insertQuery = "INSERT INTO password_reset_requests (email_address, token, timestamp) 
                    VALUES (?,?,?)";
    $stmt = $connection->prepare($insertQuery);
    $stmt->bind_Param("sss", $email_address, $token, $timestamp);  # Bind value of parameter
    $result = $stmt->execute();

    // Execute the insert query
    if ($result) {
        // Compose the password reset link with the token
        $resetLink = "http://127.0.0.1/modified_project/reset_password.php?token=" . $token;

        // Send the password reset email
        $to = $email_address;
        $subject = "Password Reset";
        $message = "Click the following link to reset your password: $resetLink";
        $headers = "From: muhammadimrann80055@gmail.com";

        // Send the email
        if (mail($to, $subject, $message, $headers)) {
            echo "Password reset email sent successfully.";
        } else {
            echo "Failed to send the password reset email.";
            echo "Error: " . error_get_last()['message'];
        }
    } else {
        echo "Error: Failed to store the password reset request in the database.";
    }


    // Redirect the user to a confirmation page
    header("Location: http://127.0.0.1/modified_project/password_reset_confirmation.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- <script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->


    <title>Forgot Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "poppins", sans-serif;
        }

        .login_body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url(./Pic/peakpx.jpg) no-repeat;
            background-size: cover;
            background-position: center;
        }



        .wrapper {
            position: relative;
            width: 400px;
            height: 440px;
            background: transparent;
            border: 2px solid #03464e;
            border-radius: 20px;
            backdrop-filter: blur(15px);
            box-shadow: 0 0 30px rgba(10, 99, 158, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .wrapper .error {
            padding-top: 20px;
            margin-left: 28px;
            color: red;
        }

        .wrapper .form-box {
            width: 100%;
            padding: 40px;
        }

        .form-box h2 {
            font-size: 2em;
            color: #03464e;
            text-align: center;
        }

        .input-box {
            position: relative;
            width: 100%;
            height: 50px;
            border-bottom: 2px solid #03464e;
            margin: 30px 0;
        }

        .input-box label {
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            font-size: 1em;
            font-weight: 500;
            pointer-events: none;
            transition: .5s;

        }

        .input-box input:focus~label,
        .input-box input:valid~label {
            top: -5px;
        }

        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            font-size: 1em;
            font-weight: 600;
            padding: 0 35px 0 5px;
        }

        .remember-forgot {
            font-size: .9em;
            color: #03464e;
            font-weight: 500;
            margin: -15px 0 15px;
            display: flex;
            justify-content: space-between;
        }

        .remember-forgot label input {
            accent-color: #03464e;
            margin-right: 3px;
        }

        .remember-forgot a {
            color: #03464e;
            text-decoration: none;
        }

        .remember-forgot a:hover {
            text-decoration: underline;
        }

        .login .btn {
            width: 100%;
            height: 45px;
            background: #03464e;
            border: none;
            outline: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1em;
            color: #fff;
            font-weight: 500;
        }

        .login .btn:hover {
            /* font-size: 1em; */
            font-weight: 700;
            background: #2c9ead;
            color: #03464e;
        }

        .login-register {
            font-size: .9em;
            color: #03464e;
            text-align: center;
            font-weight: 500;
            margin: 25px 0 10px;
        }

        .login-register p a {
            color: #03464e;
            text-decoration: none;
            font-weight: 600;
        }

        .login-register p a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body class="login_body">
    <div class="wrapper">
        <div class="form-box login">
            <h2>Forgot Password</h2>
            <form method="post" action="forgot_password.php">
                <div class="input-box">
                    <input type="email" name="email_address" required>
                    <label for="email_address">Email</label>
                </div>
                <button type="submit" class="btn" required>Reset Password</button>
            </form>
        </div>
    </div>
</body>