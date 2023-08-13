<?php

session_start();

include 'database_connection.php';

if (isset($_SESSION['user'])) {
    // Retrieve the user's username from the session or database (based on your implementation)
    $user_name = $_SESSION['user']['username'];
    $user_id = $_SESSION['user']['id'];
} else {
    header("Location: http://127.0.0.1/modified_project/login.php");
    exit();
}

$profileImgQuery = "SELECT profile_image FROM profile WHERE id = $user_id";

$resultImgQuery = $connection->query($profileImgQuery);

if ($resultImgQuery->num_rows > 0) {
    $profileData = $resultImgQuery->fetch_assoc();
    $_profile_image = $profileData['profile_image'];
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Travel Tales and Trails</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');

        * {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            text-decoration: none;
            transition: all .2s linear;
        }

        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600&display=swap');



        html {
            font-size: 62.5%;
            overflow-x: hidden;
            background-color: #fff2fe;
        }

        section {
            padding: 5rem 2%;
        }

        .heading {
            text-align: center;
            margin-bottom: 3rem;
            font-size: 3.5rem;
            text-transform: capitalize;
            color: #444;
        }

        .blog .box-container {
            display: -ms-grid;
            display: grid;
            -ms-grid-columns: (minmax(30rem, 1fr))[auto-fit];
            grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
            gap: 2rem;
        }

        .blog .box-container .box:hover .image img {
            transform: scale(1.1);
        }

        .blog .box-container .box.shadow {
            box-shadow: 0px 18px 39.1px 6.9px rgba(224, 241, 255, 0.34) !important;
        }


        .blog .box-container .box .image {
            height: 25rem;
            overflow: hidden;
            position: relative;
        }

        .blog .box-container .box .image img {
            height: 100%;
            width: 100%;
            -o-object-fit: cover;
            object-fit: cover;
        }

        .blog .box-container .box .image h3 {
            background-color: #fff;
            color: #444;
            position: absolute;
            top: 2rem;
            left: 1rem;
            padding: .5rem 1.5rem;
            font-size: 1.5rem;
            border-radius: 15px;
        }

        .blog .box-container .box .image h3 i {
            color: #bd18b4;
        }

        .blog .box-container .box .content {
            padding: 2rem;
            background-color: #fff;
        }

        .blog .box-container .box .content h3 {
            font-size: 2rem;
        }

        .blog .box-container .box .content p {
            font-size: 1.5rem;
            padding: 1rem 0;
            line-height: 2;
            color: #777;
        }

        .btn {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.8rem 2rem;
            font-size: 1.2rem;
            border: 0.1rem solid #bd18b4;
            background: #ffeeff;
            color: #bd18b4;
            cursor: pointer;
            text-transform: capitalize;
        }

        .btn:hover {
            background: #bd18b4;
            color: #ffeeff;
        }

        body {
            background: #f5f6fa;
        }

        .wrapper .sidebar {
            background: rgb(3 144 151);
            position: fixed;
            top: 0;
            left: 0;
            width: 225px;
            height: 100%;
            padding: 20px 0;
            transition: all 0.5s ease;
            z-index: 1;

        }

        .wrapper .sidebar .profile {
            margin-bottom: 30px;
            text-align: center;

        }

        .wrapper .sidebar .profile img {
            display: block;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto;
        }

        .wrapper .sidebar .profile h3 {
            color: #ffffff;
            margin: 10px 0 5px;
        }

        .wrapper .sidebar .profile p {
            color: rgb(3 144 151);
            font-size: 14px;
        }

        .wrapper .sidebar ul li a {
            display: block;
            padding: 13px 30px;
            border-bottom: 1px solid rgb(3 144 151);
            color: rgb(241, 237, 237);
            font-size: 16px;
            position: relative;
        }

        .wrapper .sidebar ul li a .icon {
            color: #dee4ec;
            width: 30px;
            display: inline-block;
        }



        .wrapper .sidebar ul li a:hover,
        .wrapper .sidebar ul li a.active {
            color: #0c7db1;

            background: white;
            border-right: 2px solid rgb(3 144 151);
        }

        .wrapper .sidebar ul li a:hover .icon,
        .wrapper .sidebar ul li a.active .icon {
            color: #0c7db1;
        }

        .wrapper .sidebar ul li a:hover:before,
        .wrapper .sidebar ul li a.active:before {
            display: block;
        }

        .wrapper .section {
            width: calc(100% - 225px);
            margin-left: 225px;
            transition: all 0.5s ease;
        }

        .wrapper .section .top_navbar {
            background: rgb(7, 105, 185);
            height: 50px;
            display: flex;
            align-items: center;
            padding: 0 30px;

        }

        .wrapper .section .top_navbar .hamburger a {
            font-size: 28px;
            color: #f4fbff;
        }

        .wrapper .section .top_navbar .hamburger a:hover {
            color: #a2ecff;
        }



        body.active .wrapper .sidebar {
            left: -225px;
        }

        body.active .wrapper .section {
            margin-left: 0;
            width: 100%;
        }

        .hero {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 999;
        }

        nav {
            background-color: rgb(3 144 151);
            width: 100%;
            height: 100px;
            padding: 10px 1%;
            display: flex;
            align-items: center;
            /* justify-content: space-between; */
            position: relative;
        }

        nav img {
            margin-right: 35px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

        .logo img {
            width: 120px;
            height: 100px;
            padding-left: 20px;
        }

        nav h1 {
            color: white;
        }

        .nav2 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0%;
            width: 100%;
            position: relative;
        }

        .newpost_btn {

            margin-left: 89%;
            margin-top: 8%;
            position: static;
            display: inline;
            border: none;
        }

        #newpostbtn {
            background-color: rgb(3 144 151);
            margin-top: 3%;
            padding: 1%;
            color: white;
            font-size: 15px;
            font-weight: bold;
            border: none;
            border-radius: 25px;
            /* margin-left: 90%; */

        }

        .profile-time {
            display: flex;
            justify-items: center;

        }

        .profile-time img {
            width: 40px;
            height: 40px;
            border-radius: 50%;

        }

        .profile-time i {
            text-decoration: none;
            text-transform: capitalize;
        }

        .profile-time p.username {
            margin-top: -30px;
            margin-left: 50px;
        }

        .blog .box-container .box .content h3 {
            font-size: 2rem;
            margin: 5px -50px 0px 0px;
        }

        .blog .box-container .box .content h5 {
            margin: 40px 20px 10px 0px;
        }

        .wrapper .section .top_navbar {

            background: rgba(7, 105, 185, 0);
        }

        .container {
            margin-left: 90%;
            margin-top: 100px;

        }

        footer {
            padding: 10px 0;
            background-color: rgb(0, 126, 126);
        }

        .footer .social {
            text-align: center;
            color: #80eeaa;
            margin-top: 20px;
        }

        .footer .social a {
            font-size: 24px;
            color: inherit;
            border: 1px solid #ccc;
            width: 40px;
            height: 40px;
            line-height: 38px;
            display: inline-block;
            text-align: center;
            border-radius: 50%;
            margin: 0 8px;
            opacity: 0.75;
        }

        .footer .social a:hover {
            opacity: 0.9px;
        }

        .footer ul {
            margin-top: 50px;
            padding: 0;
            list-style: none;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 0;
            text-align: center;

        }

        .footer ul li a {
            color: inherit;
            text-decoration: none;
            opacity: 0.8;

        }

        .footer ul li {
            display: inline-block;
            padding: 0 15px;

        }

        .footer ul li a:hover {
            opacity: 1;
        }

        .footer .copyright {
            margin-top: 75px;
            text-align: center;
            font-size: 13px;
            color: #aaa;
        }
    </style>
</head>



<body class="active">
    <div class="hero">
        <nav>
            <div class="wrapper">
                <div class="section">
                    <div class="top_navbar">
                        <div class="hamburger">
                            <a href="#">
                                <i class="fas fa-bars"></i>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="sidebar">
                    <div class="profile">
                        <a href="images/<?php echo $_profile_image; ?>">
                            <?php if (!empty($_profile_image)) : ?>
                                <img name="profile_pic" src="images/<?php echo $_profile_image; ?>" alt="Profile Image" id="profileDisplay">
                            <?php else : ?>
                                <img name="profile_pic" src="no profile.png" alt="No Profile" id="profileDisplay">
                            <?php endif; ?> <h3><?php echo '' . $user_name . '' ?></h3>
                        </a>
                    </div>
                    <ul>
                        <li>
                            <a href="http://127.0.0.1/modified_project/post_1.php" class="active">
                                <span class="icon"><i class="fas fa-home"></i></span>
                                <span class="item">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="http://127.0.0.1/modified_project/profile.php">
                                <span class="icon"><i class="fas fa-desktop"></i></span>
                                <span class="item">My Posts</span>
                            </a>
                        </li>

                        <li>
                            <a href="http://127.0.0.1/modified_project/post_title.php">
                                <span class="icon"><i class="fasx fa-sticky-note-o"></i></span>
                                <span class="item">New Post</span>
                            </a>
                        </li>

                        <li>
                            <a href="http://127.0.0.1/modified_project/About.php">
                                <span class="icon"><i class="fas fa-user-shield"></i></span>
                                <span class="item">About</span>
                            </a>
                        </li>
                        <li>
                            <a href="http://127.0.0.1/modified_project/logOut.php">
                                <span class="icon"><i class="fas fa-cog"></i></span>
                                <span class="item">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="nav2">
                <a href="" class="logo">

                    <img src="./logo.png" alt="logo">
                </a>
                <h1>All Posts</h1>

                <div class="profileImage">

                    <a href="http://127.0.0.1/modified_project/profile_edit.php">
                        <?php if (!empty($_profile_image)) : ?>
                            <img name="profile_pic" src="images/<?php echo $_profile_image; ?>" alt="Profile Image" id="profileDisplay">
                        <?php else : ?>
                            <img name="profile_pic" src="no profile.png" alt="No Profile" id="profileDisplay">
                        <?php endif; ?>
                    </a>

                </div>
            </div>
        </nav>
    </div>


    <div class="container">

        <button type="button" id="newpostbtn" class="btn btn-primary">+ New Post</button>
        <div id="postsContainer"></div>
    </div>
    <section class="blog">
        <div class="box-container">
            <div class="row align-items-start">
                <?php
                include 'database_connection.php';

                // Retrieve the latest post with title, username, image, and content
                $sql = "SELECT pt.id AS post_id, pt.title, pt.location, ld.username, pi.image_path, pc.content
                FROM post_title pt
                INNER JOIN login_data ld ON pt.user_id = ld.id
                INNER JOIN (
                    SELECT post_id, MIN(id) AS min_id
                    FROM post_images
                    GROUP BY post_id
                ) AS min_pi ON pt.id = min_pi.post_id
                INNER JOIN post_images pi ON min_pi.min_id = pi.id
                INNER JOIN post_content pc ON pt.id = pc.post_id
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

                        // Display the post only if it is not a repeated post
                        if ($postId != $previousPostId) {
                            // Display the post
                            echo '
                            <div class="col-md-4 order-last" style="margin-bottom: 30px;">
                                <div class="box shadow">
                                    <div>
                                    <h5 class="username">Posted by: <br> ' . $username . '</h5>
                                    </div>
                                    <div class="image">
                                        <img src="' . $imagePath . '" alt="">
                                    </div>
                                    <div class="content">
                                        <div class="profile-time">
                                            <h3>' . $title . '</h3>
                                            <h5>' . $location . '</h5>
                                        </div>
                                        <p>' . substr($content, 0, 50) . '...</p>
                                        <a href="fullpost_1.php?id=' . $postId . '" class="btn">Read More</a>

                                        
                                        <button class="like-button" data-post-id="' . $postId . '">Like</button>
                                        <span class="likes-count" id="likesCount-' . $postId . '">0 Likes</span>
                                    </div>
                                </div>
                            </div>';
                        }

                        $previousPostId = $postId;
                    }
                } else {
                    echo 'No posts found.';
                }

                // Close the database connection
                $connection->close();
                ?>




            </div>

        </div>
    </section>

    <script>
        var hamburger = document.querySelector(".hamburger");
        hamburger.addEventListener("click", function() {
            document.querySelector("body").classList.toggle("active");
        });

        const newPostBtn = document.getElementById('newpostbtn');
        const postsContainer = document.getElementById('postsContainer');

        newPostBtn.addEventListener('click', function() {
            window.location.href = "post_title.php";
        });



        document.addEventListener("DOMContentLoaded", function() {
            const likeButtons = document.querySelectorAll(".like-button");

            likeButtons.forEach((button) => {
                button.addEventListener("click", function() {
                    const postId = button.dataset.postId;

                    // Send AJAX request to the backend to like the post
                    fetch("like_post.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify({
                                postId: postId
                            }),
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                // Update the UI to show that the post is liked (e.g., change the heart icon color)
                                button.classList.add("liked");
                            } else {
                                alert("You have already liked this post.");
                            }
                        })
                        .catch((error) => {
                            console.error("Error liking the post:", error);
                        });
                });
            });
        });
    </script>
    <?php
    require_once("footer.php");
    ?>
</body>

</html>