<?php
session_start();


if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['id'];

    // Check if the request is a POST request
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Get the post ID from the AJAX request and sanitize it
        $post_id = filter_input(INPUT_POST, 'postId', FILTER_SANITIZE_NUMBER_INT);

        // Validate the post ID (check if it's a positive integer)
        if (!is_int($post_id) || $post_id <= 0) {
            $response = ["success" => false];
            // Return the response as JSON
            header("Content-Type: application/json");
            echo json_encode($response);
            exit();
        }

        // Include the database connection file
        include 'database_connection.php';

        // Check if the user has already liked the post using prepared statement
        $likeCheckQuery = "SELECT COUNT(*) AS count FROM post_likes WHERE user_id = ? AND post_id = ?";
        $stmt = $connection->prepare($likeCheckQuery);
        $stmt->bind_param("ii", $user_id, $post_id);
        $stmt->execute();
        $stmt->bind_result($likeCount);
        $stmt->fetch();
        $stmt->close();

        if ($likeCount === 0) {
            // User hasn't liked the post yet, insert a new row in the post_likes table using prepared statement
            $insertLikeQuery = "INSERT INTO post_likes (user_id, post_id) VALUES (?, ?)";
            $stmt = $connection->prepare($insertLikeQuery);
            $stmt->bind_param("ii", $user_id, $post_id);
            $stmt->execute();
            $stmt->close();

            // Like successfully added
            $response = ["success" => true];
        } else {
            // User has already liked the post
            $response = ["success" => false];
        }

        // Close the database connection
        $connection->close();

        // Return the response as JSON
        header("Content-Type: application/json");
        echo json_encode($response);
    }
} else {
    // User is not logged in
    header("Location: http://127.0.0.1/modified_project/login.php");
    exit();
}
