<?php

session_start();

include 'database_connection.php';

if (isset($_SESSION['user'])) {
    $username = $_SESSION['user']['username'];
    $user_id = $_SESSION['user']['id'];
} else {

    header("Location: login.php");
    exit();
}

// Retrieve the profile image path from the database
$profileImgQuery = "SELECT profile_image, cover_image, country FROM profile WHERE id = $user_id";

$resultImgQuery = $connection->query($profileImgQuery);

if ($resultImgQuery->num_rows > 0) {
    $profileData = $resultImgQuery->fetch_assoc();
    $_profile_image = $profileData['profile_image'];
    $_location = $profileData['country'];
    $_cover_image = $profileData['cover_image'];
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="./style.css"> -->
    <link rel="stylesheet" href="./font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- <script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->


    <title>Profile</title>
    <style>
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 107px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 20px;
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



        .nav-links li a:hover,
        .edit-btn:hover,
        .page-active {
            background-color: white;
            color: rgb(3 144 151) !important;

        }

        .nav-links li {
            margin: 0 10px;
        }

        .nav-links li a,
        .edit-btn {
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

        .profile-body {
            background-color: #ced4da;
        }

        .container-xxl {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .profile {
            width: 100%;
            height: 350px;
        }

        .profile-header-content {
            height: 280px !important;

        }

        .profile-header {
            position: relative;
            overflow: hidden;
            height: 500px;

        }

        .profile-cover-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            max-height: 490px !important;
            overflow: hidden;
            z-index: 1;
        }


        .profile-header-img {
            float: left;
            width: 120px;
            height: 120px;
            overflow: hidden;
            position: relative;
            z-index: 10;
            padding: 3px;
            border-radius: 4px;
            background: #fff;
            margin-left: 140px;
            margin-top: 65px !important;


        }

        .profile-header-info {
            z-index: 10;
            position: relative;
            font-weight: 500;
            color: #080808;
            margin-left: 290px;
            margin-top: 120px !important;
        }

        .profile-header-img img {
            max-width: 114px;
            height: 114px;
        }

        .profile-header h4 {
            font-weight: 500;
            color: #fff
        }

        .profile-header p {
            margin: 5px 0;
            color: #fff;
        }



        .text-ellipsis,
        .text-nowrap {
            white-space: nowrap !important
        }

        .profile-header-tab {
            background: #fff;
            list-style-type: none;
            margin: -10px 0 0;
            padding: 20px 0 0 140px;
            white-space: nowrap;
            border-radius: 0;
        }

        .profile-header .profile-header-tab>li {
            display: inline-block;
            margin: 0
        }

        .profile-header .profile-header-tab>li>a {
            display: block;
            color: #929ba1;
            line-height: 20px;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: 700;
            font-size: 12px;
            border: none
        }

        .profile-header .profile-header-tab>li.active>a,
        .profile-header .profile-header-tab>li>a.active {
            color: #242a30
        }

        .profile-content {
            padding: 25px;
            border-radius: 4px;

        }

        .profile-content:after,
        .profile-content:before {
            content: '';
            display: table;
            clear: both
        }

        .profile-content .tab-content,
        .profile-content .tab-pane {
            background: 0 0
        }

        .profile-left {
            width: 200px;
            float: left
        }

        .profile-right {
            margin-left: 240px;
            padding-right: 20px
        }


        .input-group {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -ms-flex-align: stretch;
            align-items: stretch;
            width: 100%;
        }

        .input-group>.custom-select:not(:last-child),
        .input-group>.form-control:not(:last-child) {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .input-group>.custom-file,
        .input-group>.custom-select,
        .input-group>.form-control {
            position: relative;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            width: 1%;
            margin-bottom: 0;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        button,
        input {
            overflow: visible;
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            margin: 0;
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
        }

        .timeline {
            list-style-type: none;
            margin: 0;
            padding: 0;
            position: relative
        }

        .timeline:before {
            content: '';
            position: absolute;
            top: 5px;
            bottom: 5px;
            width: 5px;
            background: #2d353c;
            left: 20%;
            margin-left: -2.5px
        }

        .timeline>li {
            position: relative;
            min-height: 50px;
            padding: 20px 0
        }

        .timeline .timeline-time {
            position: absolute;
            left: 0;
            width: 18%;
            text-align: right;
            top: 30px
        }

        .timeline .timeline-time .date,
        .timeline .timeline-time .time {
            display: block;
            font-weight: 600
        }

        .timeline .timeline-time .date {
            line-height: 16px;
            font-size: 12px
        }

        .timeline .timeline-time .time {
            line-height: 24px;
            font-size: 20px;
            color: #242a30
        }

        .timeline .timeline-icon {
            left: 15%;
            position: absolute;
            width: 10%;
            text-align: center;
            top: 40px
        }

        .timeline .timeline-icon a {
            text-decoration: none;
            width: 20px;
            height: 20px;
            display: inline-block;
            border-radius: 20px;
            background: #d9e0e7;
            line-height: 10px;
            color: #fff;
            font-size: 14px;
            border: 5px solid #2d353c;
            transition: border-color .2s linear
        }

        .timeline .timeline-body {
            margin-left: 23%;
            margin-right: 17%;
            background: #fff;
            position: relative;
            padding: 20px 25px;
            border-radius: 6px
        }

        .timeline .timeline-body:before {
            content: '';
            display: block;
            position: absolute;
            border: 10px solid transparent;
            border-right-color: #fff;
            left: -20px;
            top: 20px
        }

        .timeline .timeline-body>div+div {
            margin-top: 15px
        }

        .timeline .timeline-body>div+div:last-child {
            margin-bottom: -20px;
            padding-bottom: 20px;
            border-radius: 0 0 6px 6px
        }

        .timeline-header {
            padding-bottom: 10px;
            border-bottom: 1px solid #e2e7eb;
            line-height: 30px
        }

        .timeline-header .userimage {
            float: left;
            width: 34px;
            height: 34px;
            border-radius: 40px;
            overflow: hidden;
            margin: -2px 10px -2px 0
        }

        .timeline-header .username {
            font-size: 16px;
            font-weight: 600
        }

        .timeline-header .username,
        .timeline-header .username a {
            color: #2d353c
        }

        .timeline img {
            max-width: 100%;
            display: block
        }

        .pull-right {
            float: right;
        }

        .timeline-content {
            letter-spacing: .25px;
            line-height: 18px;
            font-size: 13px
        }

        .timeline-content:after,
        .timeline-content:before {
            content: '';
            display: table;
            clear: both
        }

        .timeline-title {
            margin-top: 0
        }

        .timeline-footer {
            background: #fff;
            border-top: 1px solid #e2e7ec;
            padding-top: 15px
        }

        .timeline-footer a:not(.btn) {
            color: #575d63
        }

        .timeline-footer a:not(.btn):focus,
        .timeline-footer a:not(.btn):hover {
            color: #2d353c
        }

        .timeline-likes {
            color: #6d767f;
            font-weight: 600;
            font-size: 12px
        }

        .timeline-likes .stats-right {
            float: right
        }

        .timeline-likes .stats-total {
            display: inline-block;
            line-height: 20px
        }

        .timeline-likes .stats-icon {
            float: left;
            margin-right: 5px;
            font-size: 9px
        }

        .timeline-likes .stats-icon+.stats-icon {
            margin-left: -2px
        }

        .timeline-likes .stats-text {
            line-height: 20px
        }

        .timeline-likes .stats-text+.stats-text {
            margin-left: 15px
        }

        .timeline-comment-box {
            background: #f2f3f4;
            margin-left: -25px;
            margin-right: -25px;
            padding: 20px 25px
        }

        .timeline-comment-box .user {
            float: left;
            width: 34px;
            height: 34px;
            overflow: hidden;
            border-radius: 30px
        }

        .timeline-comment-box .user img {
            max-width: 100%;
            max-height: 100%
        }

        .timeline-comment-box .user+.input {
            margin-left: 44px
        }

        .lead {
            margin-bottom: 20px;
            font-size: 21px;
            font-weight: 300;
            line-height: 1.4;
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

<body class="profile-body">
    <div class="container-xxl">
        <div class="profile">
            <div class="profile-header">
                <nav class="navbar">
                    <div class="logo">
                        <a href="http://127.0.0.1/modified_project/post_1.php"><img src="./Pic/logo.png" class="logoimg" alt="Logo"></a>
                    </div>
                    <ul class="nav-links">
                        <li><a href="http://127.0.0.1/modified_project/post_1.php">Home</a></li>
                        <li class="page-active"><a href="http://127.0.0.1/modified_project/profile.php">Profile</a></li>
                        <li><a href="http://127.0.0.1/modified_project/profile_edit.php">Edit Profile</a></li>
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
                        <li class="page-active"><a href="http://127.0.0.1/modified_project/profile.php">Profile</a></li>
                        <li><a href="http://127.0.0.1/modified_project/profile_edit.php">Edit Profile</a></li>
                        <li><a href="http://127.0.0.1/modified_project/about.php">About</a></li>

                    </ul>
                </div>
                <div class="profile-header-content">
                    <div class="profile-cover-img" style="max-height: 490px ;">
                        <?php if (!empty($_cover_image)) : ?>
                            <img name="cover_pic" src="images/<?php echo $_cover_image; ?>" alt="Cover Image" style=" width: 100%;
    height: 490px;
    filter: brightness(0.6);">
                        <?php else : ?>
                            <img name="cover_pic" src="no profile.png" alt="No Profile" style=" width: 100%;
    height: 490px;
    filter: brightness(0.8);">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="profile-header-img" style="margin-top: -70px; ">

                    <?php if (!empty($_profile_image)) : ?>
                        <img name="profile_pic" src="images/<?php echo $_profile_image; ?>" alt="Profile Image" style=" max-width: 114px;
    height: 114px;">
                    <?php else : ?>
                        <img name="profile_pic" src="no profile.png" alt="No Profile" style=" max-width: 114px;
    height: 114px;">
                    <?php endif; ?>
                </div>
                <div class="profile-header-info" style="  margin-top: -40px ; padding-top: 0px;">
                    <h4><?php echo $username; ?></h4>

                    <a href="http://127.0.0.1/modified_project/profile_edit.php" class="edit-btn">Edit Profile</a>
                </div>
            </div>
            <ul class="profile-header-tab">
                <li class="active"><a href="#" style=" color: #070707; text-decoration: none;"> <b>POSTS</b> </a></li>
            </ul>
        </div>
    </div>
    <div class="profile-content" style="margin-top: 175px;">
        <!-- begin tab-content -->
        <div class="tab-content p-0">
            <!-- begin #profile-post tab -->
            <div class="tab-pane fade active show" id="profile-post">
                <!-- begin timeline -->
                <ul class="timeline">
                    <?php
                    // Include the database connection file
                    include 'database_connection.php';

                    $userId = $_SESSION['user']['id'];

                    // Retrieve the latest post with title, username, image, and content
                    $sql = "SELECT pt.id AS post_id, pt.title, pt.location, ld.username, pi.image_path, pc.content, pt.created_at
                FROM post_title pt
                INNER JOIN login_data ld ON pt.user_id = ld.id
                INNER JOIN (
                    SELECT post_id, MIN(id) AS min_id
                    FROM post_images
                    GROUP BY post_id
                ) AS min_pi ON pt.id = min_pi.post_id
                INNER JOIN post_images pi ON min_pi.min_id = pi.id
                INNER JOIN post_content pc ON pt.id = pc.post_id
                WHERE ld.id = $userId
                ORDER BY pt.id DESC";

                    $result = $connection->query($sql);

                    // Check if a post is found
                    if ($result->num_rows > 0) {
                        $previousPostId = null;
                        while ($row = $result->fetch_assoc()) {
                            $postId = $row['post_id'];
                            $title = $row['title'];
                            $location = $row['location'];
                            $username = $row['username'];
                            $imagePath = $row['image_path'];
                            $content = $row['content'];
                            $created_at = $row['created_at'];

                            // Display the post only if it is not a repeated post
                            if ($postId != $previousPostId) {

                                // Display the post in the timeline
                                echo '
        <li>
        <!-- begin timeline-time -->
        <div class="timeline-time">
        <span class="date">' . date('F j, Y', strtotime($row['created_at'])) . '</span>
        <span class="time">' . date('H:i', strtotime($row['created_at'])) . '</span>
    </div>
                            <!-- end timeline-time -->
                            <!-- begin timeline-icon -->
                            <div class="timeline-icon">
                                <a href="javascript:;">&nbsp;</a>
                            </div>
            <!-- Timeline content for each post -->
            <div class="timeline-body">
                <div class="timeline-header">
                    <!-- User image and username -->
                    <span class="userimage">
                    <?php if (!empty($_profile_image)) : ?>
                        <img src="images/ ' . $_profile_image . ' " alt="Profile Image" id="profileDisplay">
                    <?php else : ?>
                        <img src="no profile.png" alt="No Profile" >
                    <?php endif; ?>
                                         </span>
                    <span class="username">' . $username . '</span>
                </div>
                <div class="timeline-content">
                    <!-- Post title, location, image, and content -->
                    <h4>' . $title . '</h4>
                    <p>' . $location . '</p>
                    <div class="image">
                    <img src="' . $imagePath . '" alt="">
                </div>
                <p>' . substr($content, 0, 50) . '...</p>
                <a href="fullpost.php?id=' . $postId . '" class="btn">Read More</a>
                </div>
            </div>
        </li>';
                            }

                            $previousPostId = $postId;
                        }
                    } else {
                        echo 'No posts found.';
                    }

                    // Close the database connection
                    $connection->close();
                    ?>


                </ul>
                <!-- end timeline -->
            </div>
            <!-- end #profile-post tab -->
        </div>
        <!-- end tab-content -->
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
    <?php
    require_once("footer.php");
    ?>