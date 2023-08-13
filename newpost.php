<?php
session_start();
include 'database_connection.php';

if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contents = $_POST['content'];
    $images = $_FILES['image'];

    // Retrieve the post ID from the session
    $postId = $_SESSION["post_id"];

    // Prepare the SQL statement to insert post content
    $insertContentSql = "INSERT INTO post_content (post_id, content) VALUES (?, ?)";
    $contentStmt = $connection->prepare($insertContentSql);
    $contentStmt->bind_param('is', $postId, $content);

    // Prepare the SQL statement to insert post images
    $insertImageSql = "INSERT INTO post_images (post_id, image_path) VALUES (?, ?)";
    $imageStmt = $connection->prepare($insertImageSql);
    $imageStmt->bind_param('is', $postId, $imagePath);

    // Insert content and image pairs
    foreach ($contents as $index => $content) {
        $image = $images['tmp_name'][$index];
        $imageName = basename($images['name'][$index]);
        $uploadDir = 'uploads/';
        $targetPath = $uploadDir . $imageName;

        // Move the uploaded image to the target directory
        if (move_uploaded_file($image, $targetPath)) {
            $imagePath = $targetPath;

            $contentStmt->execute();

            $imageStmt->execute();
        }
    }

    header('Location: http://127.0.0.1/modified_project/post_1.php');
    exit();

    $contentStmt->close();
    $imageStmt->close();
}

$connection->close();

?>




<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            border: 1px solid black;
            width: 45%;
            margin: 12% 28%;
            padding: 0.5% 3%;
        }

        .container h1 {
            text-align: center;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 50px;
            font-weight: 100;
            margin: 0%;
        }

        .post-btn {
            display: flex;
            margin-left: 88%;
            margin-top: 4%;
            padding: 1.5% 3%;
            border-radius: unset;
            border: none;
            background-color: blue;
            color: white;
            font-size: 30px;
        }

        .form-control-file {
            border: 1px solid gray;
            border-radius: 7px;
        }

        .form-control {
            padding: 6px;
            border: none;
            outline-color: unset;
            border-bottom: 2px solid blue;
            font-size: 20px;
        }

        .form-control:focus {
            outline: none;
            outline-style: none;
            outline-color: unset;
            outline-offset: unset;
        }

        .post-btn:hover {
            border: 2px solid lightblue;
            padding: 1.3% 2.8%;
        }

        .content-wrapper {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Create New Post</h1>
        <form method="post" enctype="multipart/form-data" action="newpost.php" class="my-3" id="newPostForm">
            <div class="content-wrapper">
                <textarea class="form-control mb-2" name="content[]" placeholder="Enter your post content" required></textarea><br>
                <input type="file" class="form-control-file mb-2" name="image[]" accept="image/*" required>
            </div>
            <div id="imageContainer"></div>
            <button type="button" class="btn btn-secondary" id="addImageBtn">Add Another Image</button>
            <button type="submit" class="post-btn">Post</button>
        </form>
    </div>

    <script>
        // Add event listener to "Add Another Image" button
        const addImageBtn = document.getElementById('addImageBtn');
        const imageContainer = document.getElementById('imageContainer');

        let imageCount = 1; // Keep track of the number of images added

        addImageBtn.addEventListener('click', function() {
            // Create a new content wrapper
            const contentWrapper = document.createElement('div');
            contentWrapper.className = 'content-wrapper';

            // Create a new content textarea
            const newContentTextarea = document.createElement('textarea');
            newContentTextarea.className = 'form-control mb-2';
            newContentTextarea.name = 'content[]';
            newContentTextarea.placeholder = 'Enter your post content';
            newContentTextarea.required = true;

            // Create a new image input
            const newImageInput = document.createElement('input');
            newImageInput.type = 'file';
            newImageInput.className = 'form-control-file mb-2';
            newImageInput.name = 'image[]';
            newImageInput.accept = 'image/*';
            newImageInput.required = true;

            // Append the content textarea and image input to the content wrapper
            contentWrapper.appendChild(newContentTextarea);
            contentWrapper.appendChild(newImageInput);

            // Append the content wrapper to the image container
            imageContainer.appendChild(contentWrapper);

            // Increment the image count
            imageCount++;
        });
    </script>
</body>

</html>