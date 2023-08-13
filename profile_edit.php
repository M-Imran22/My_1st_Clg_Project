<?php
session_start();
require_once("database_connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <style>
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 120px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            z-index: 999;
            background-color: transparent;
        }


        .navbar.scrolled {
            background-color: rgb(3 144 151);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logoimg {
            width: 144px;
            padding-left: 20px;
        }

        .logo a {
            display: inline-block;
            margin-left: 25px;
        }

        .nav-links {
            list-style: none;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin: 0;
            padding: 0;
            padding-right: 50px;

        }

        .page-active a {
            background-color: white;
            color: rgb(3 144 151) !important;

        }

        .nav-links li a:hover {
            background-color: white;
            color: rgb(3 144 151);

        }

        .nav-links li {
            margin: 0 10px;
        }

        .nav-links li a {
            text-decoration: none;
            color: #fff;
            font-size: 20px;
            /* background-color: lightseagreen; */
            font-weight: bold;
            display: inline-block;
            padding: 4px 8px;
            border-radius: 3px;
            border: 2px solid white;
            padding-left: -40px;
        }

        .toggle-button {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .toggle-button span {
            height: 2px;
            width: 25px;
            background-color: #333;
            margin-bottom: 4px;
            border-radius: 2px;
        }

        .sidebar {
            position: fixed;
            top: 0;
            right: -300px;
            width: 300px;
            height: 100vh;
            background-color: #f8f8f8;
            transition: right 0.3s ease-in-out;
            z-index: 998;
        }

        .sidebar-links {
            list-style: none;
            margin: 0;
            padding: 20px;
        }

        .sidebar-links li {
            margin-bottom: 10px;
        }

        .sidebar-links li a {
            text-decoration: none;
            color: #333;
            font-size: 16px;

        }

        .profile-edit-body {
            background: rgb(3 144 151);
            padding-left: 250px;
            padding-right: 250px;
        }

        .container {
            min-height: 520px !important;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .col-md-3 {
            margin-left: 40px;

        }

        .col-md-8 {
            margin-left: 290px !important;
            margin-top: -330px !important;
        }

        .profile-button {
            background: rgb(3 144 151);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }

        @media (max-width: 768px) {
            .toggle-button {
                display: flex;
            }

            .sidebar {
                right: 0;
            }

            .sidebar-links {
                padding: 40px 20px;
            }

            .navbar {
                justify-content: space-between;
            }

            .nav-links {
                display: none;
            }

            .nav-links.active {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                position: absolute;
                top: 60px;

            }
        }
    </style>
</head>

<body class="profile-edit-body">
    <nav class="navbar">
        <div class="logo">
            <a href="http://127.0.0.1/modified_project/post_1.php"><img src="./Pic/logo.png" class="logoimg" alt="Logo"></a>
        </div>
        <ul class="nav-links">
            <li><a href="http://127.0.0.1/modified_project/post_1.php">Home</a></li>
            <li><a href="http://127.0.0.1/modified_project/profile.php">Profile</a></li>
            <li class="page-active"><a href="http://127.0.0.1/modified_project/profile_edit.php">Edit Profile</a></li>
            <li><a href="http://127.0.0.1/modified_project/about.php">About</a></li>

        </ul>
        <div class="toggle-button">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <div class="sidebar">
        <ul class="sidebar-links">
            <li><a href="http://127.0.0.1/modified_project/post_1.php">Home</a></li>
            <li><a href="http://127.0.0.1/modified_project/profile.php">Profile</a></li>
            <li class="page-active"><a href="http://127.0.0.1/modified_project/profile_edit.php">Edit Profile</a></li>
            <li><a href="http://127.0.0.1/modified_project/about.php">About</a></li>
        </ul>
    </div>
    <?php


    $msg = "";
    $css_class = "";

    // Function to check if the user profile exists
    function isUserProfileExists($connection, $userId)
    {
        $checkQuery = "SELECT COUNT(*) FROM profile WHERE id = $userId";
        $result = mysqli_query($connection, $checkQuery);
        $count = mysqli_fetch_row($result)[0];
        return $count > 0;
    }

    // Function to create a user profile if it does not exist
    function createUserProfile($connection, $userId)
    {
        $createQuery = "INSERT INTO profile (id) VALUES ($userId)";
        mysqli_query($connection, $createQuery);
    }

    // Function to retrieve the user data from login_data table
    function getUserDataFromLoginData($connection, $userId)
    {
        $userDataQuery = "SELECT username, email_address FROM login_data WHERE id = $userId";
        $userDataResult = mysqli_query($connection, $userDataQuery);
        return mysqli_fetch_assoc($userDataResult);
    }

    // Function to retrieve the user data
    function getUserData($connection, $userId)
    {
        $userDataQuery = "SELECT * FROM profile WHERE id = $userId";
        $userDataResult = mysqli_query($connection, $userDataQuery);
        return mysqli_fetch_assoc($userDataResult);
    }

    // Check if the user is logged in
    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user']['id'];

        if (!isUserProfileExists($connection, $userId)) {
            // Create user profile if it does not exist
            createUserProfile($connection, $userId);
        }
        // Retrieve the user data from login_data table
        $userData = getUserDataFromLoginData($connection, $userId);

        // Assign the retrieved data to variables
        $_name = isset($userData['username']) ? $userData['username'] : '';
        $_email_address = isset($userData['email_address']) ? $userData['email_address'] : '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save-user'])) {
            // Data from the form submission
            $_name = $_POST['name'];
            $_lastname = $_POST['lastname'];
            $_email_address = $_POST['email_address'];
            $_mobile_number = $_POST['mobile_number'];
            $_country = $_POST['country'];
            $_state = $_POST['state'];

            $profileImage = $_FILES['image'];
            $coverPhoto = $_FILES['cover_photo'];

            // Process profile image upload
            if ($profileImage['name']) {
                $profileImageName = uploadFile($profileImage);
                if (!$profileImageName) {
                    $msg = "Failed to upload profile image";
                    $css_class = "alert-danger";
                    // Handle the error
                }
            } else {
                $profileImageName = null;
            }

            // Process cover photo upload
            if ($coverPhoto['name']) {
                $coverPhotoName = uploadFile($coverPhoto);
                if (!$coverPhotoName) {
                    $msg = "Failed to upload cover photo";
                    $css_class = "alert-danger";
                    // Handle the error
                }
            } else {
                $coverPhotoName = null;
            }

            // Update the user data in the database
            $updateQuery = "UPDATE profile SET 
                name = '$_name',
                lastname = '$_lastname',
                email_address = '$_email_address',
                mobile_number = '$_mobile_number',
                country = '$_country',
                state = '$_state',
                profile_image = '$profileImageName',
                cover_image = '$coverPhotoName'
                WHERE id = $userId";

            if (mysqli_query($connection, $updateQuery)) {
                $msg = "User data updated successfully";
                $css_class = "alert-success";
            } else {
                $msg = "Database Error: Failed to update user data";
                $css_class = "alert-danger";
            }
        }

        // Retrieve the user data
        $userData = getUserData($connection, $userId);

        // Assign the retrieved data to variables
        $_name = isset($userData['name']) ? $userData['name'] : '';
        $_lastname = isset($userData['lastname']) ? $userData['lastname'] : '';
        $_email_address = isset($userData['email_address']) ? $userData['email_address'] : '';
        $_mobile_number = isset($userData['mobile_number']) ? $userData['mobile_number'] : '';
        $_country = isset($userData['country']) ? $userData['country'] : '';
        $_state = isset($userData['state']) ? $userData['state'] : '';
        $_profile_image = isset($userData['profile_image']) ? $userData['profile_image'] : '';
        $_cover_image = isset($userData['cover_image']) ? $userData['cover_image'] : '';

        if ($_email_address != $_SESSION['user']['email_address'] || $_name != $_SESSION['user']['username']) {
            $updateQuery = "UPDATE login_data SET email_address = '$_email_address', username = '$_name $_lastname' WHERE id = $userId";
            mysqli_query($connection, $updateQuery);

            // Update the session variables
            $_SESSION['user']['email_address'] = $_email_address;
            $_SESSION['user']['username'] = $_name . ' ' . $_lastname;
        }
    }

    // Function to handle file upload
    function uploadFile($file)
    {
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowedExtensions = ['jpg', 'jpeg', 'png'];

        if (in_array($fileExtension, $allowedExtensions)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) { // Adjust the file size limit as needed
                    $newFileName = uniqid() . '.' . $fileExtension;
                    $target = 'images/' . $newFileName;

                    if (move_uploaded_file($fileTmpName, $target)) {
                        return $newFileName;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    ?>

    <div class="container-xxl rounded bg-white  mb-5" style="width: 860px; margin-top: 150px;">
        <?php if ($msg) : ?>
            <div class="alert <?php echo $css_class; ?>" role="alert">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <?php if (!empty($_profile_image)) : ?>
                        <img name="profile_pic" src="images/<?php echo $_profile_image; ?>" alt="Profile Image" id="profileDisplay" style="    width: 170px;
    height: 170px; margin: 10px; border-radius: 50%;">
                    <?php else : ?>
                        <img name="profile_pic" src="no profile.png" alt="No Profile" id="profileDisplay" style="width: 150%; margin: 10px; border-radius: 50%;">
                    <?php endif; ?>
                    <span class="font-weight-bold"><?php echo $_name; ?></span><span class="text-black-50"><?php echo $_email_address; ?></span>
                </div>
            </div>
            <div class="col-md-8 border-right">
                <form id="profileForm" method="post" enctype="multipart/form-data">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label for="name" class="labels">First Name</label><input type="text" name="name" class="form-control" placeholder="First name" value="<?php echo $_name; ?>"></div>
                            <div class="col-md-6"><label for="lastname" class="labels">Last Name</label><input type="text" name="lastname" class="form-control" value="<?php echo $_lastname; ?>" placeholder="Last name"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label for="email_address" class="labels">Email Address</label><input type="text" name="email_address" class="form-control" placeholder="Enter email address" value="<?php echo $_email_address; ?>" required></div>
                            <div class="col-md-12"><label for="mobile_number" class="labels">Mobile Number</label><input type="text" name="mobile_number" class="form-control" placeholder="Enter phone number" value="<?php echo $_mobile_number; ?>"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6"><label for="country" class="labels">Country</label><input type="text" name="country" class="form-control" placeholder="Country" value="<?php echo $_country; ?>"></div>
                            <div class="col-md-6"><label for="state" class="labels">State/Region</label><input type="text" name="state" class="form-control" value="<?php echo $_state; ?>" placeholder="State"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label for="image" class="labels">Profile Image</label><input type="file" name="image" class="form-control"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label for="cover_photo" class="labels">Cover Photo</label><input type="file" name="cover_photo" class="form-control"></div>
                        </div>
                        <div class="mt-5 text-center"><button name="save-user" class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const toggleButton = document.querySelector('.toggle-button');
        const sidebar = document.querySelector('.sidebar');

        toggleButton.addEventListener('click', () => {
            sidebar.style.right = sidebar.style.right === '0px' ? '-300px' : '0px';
        });


        const navbar = document.querySelector('.navbar');

        window.addEventListener('scroll', () => {

            if (window.scrollY > 0) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>

</body>

</html>