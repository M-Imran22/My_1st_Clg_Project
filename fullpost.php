<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Full Post</title>
    <style>
        body {
            background-color: #f5f6fa;
            padding: 20px;
        }

        .post-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .post-container .image {
            margin-bottom: 20px;
        }

        .post-container .image img {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .post-container h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .post-container h5 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .post-container .username {
            margin-bottom: 20px;
        }

        .post-container p {
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="post-container">
            <?php
            // Include the database connection file
            include 'database_connection.php';

            // Get the post ID from the URL parameter
            $postId = $_GET['id'];

            // Retrieve the post title, location, and username
            $titleLocationSql = "SELECT pt.title, pt.location, ld.username
                FROM post_title pt
                INNER JOIN login_data ld ON pt.user_id = ld.id
                WHERE pt.id = $postId";
            $titleLocationResult = $connection->query($titleLocationSql);

            // Check if the post exists
            if ($titleLocationResult->num_rows > 0) {
                $titleLocationRow = $titleLocationResult->fetch_assoc();
                $title = $titleLocationRow['title'];
                $location = $titleLocationRow['location'];
                $username = $titleLocationRow['username'];

                // Display the post title, location, and username
                echo '
                <h3>' . $title . '</h3>
                <h5>' . $location . '</h5>
                <div class="username">
                    <p>Posted by: ' . $username . '</p>
                </div>';

                // Retrieve all images and content associated with the post ID
                $imagesContentSql = "SELECT pi.image_path, pc.content
                    FROM post_images pi
                    INNER JOIN post_content pc ON pi.post_id = pc.post_id
                    WHERE pi.post_id = $postId
                    ";
                $imagesContentResult = $connection->query($imagesContentSql);

                // Check if images and content exist
                if ($imagesContentResult->num_rows > 0) {
                    $imagesContentRows = $imagesContentResult->fetch_all(MYSQLI_ASSOC);

                    foreach ($imagesContentRows as $row) {
                        $imagePath = $row['image_path'];
                        $content = $row['content'];

                        // Display the image
                        echo '
        <div class="image">
            <img src="' . $imagePath . '" alt="Post Image">
            <p>' . $content . '</p>

        </div>';
                    }
                } else {
                    echo 'No images and content found for this post.';
                }
            } else {
                echo 'Post not found.';
            }
            // Close the database connection
            $connection->close();
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>