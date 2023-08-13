<!DOCTYPE html>
<html>

<head>
    <title>Full Post</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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
                    // Create an array of images and content
                    $imagesContentRows = $imagesContentResult->fetch_all(MYSQLI_ASSOC);

                    // Loop through the images and content
                    foreach ($imagesContentRows as $key => $imageContent) {
                        // Display the image
                        echo '
        <div class="image">
            <img src="' . $imageContent['image_path'] . '" alt="Post Image">
            <p>' . $imageContent['content'] . '</p>

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
            >

        </div>
    </div>


</body>

</html>