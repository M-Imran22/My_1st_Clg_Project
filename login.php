<?php
session_start();
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



    <title>Login</title>

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
            <h2>login</h2>
            <?php if (isset($_SESSION["error"])) : ?>
                <?php unset($_SESSION["error"]) ?>
                <p class="error">Email address or Password incorrect!</p>
            <?php endif; ?>
            <form method="post" action="http://127.0.0.1/modified_project/login_data.php">
                <div class="input-box">
                    <input type="email" name="email_address" required>
                    <label for="email_address">Email</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" required>
                    <label for="password">password</label>
                </div>
                <div class="remember-forgot">
                    <a href="http://127.0.0.1/modified_project/forgot_password.php">Forgot Password?</a>
                </div>
                <button type="submit" class="btn" required>Login</button>
                <div class="login-register">
                    <p>Don't have an account? <a href="http://127.0.0.1/modified_project/registration.php" class="register-link">Register</a></p>
                </div>
                <!-- <div class="g-recaptcha" data-sitekey="6Lc8xs0mAAAAAP8XyqfTyw2z8cePq80bgu9zL9-F"></div> -->


            </form>
        </div>
    </div>
</body>

</html>