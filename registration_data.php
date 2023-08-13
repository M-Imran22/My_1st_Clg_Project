<?php
session_start();
require_once("database_connection.php");

$email_address = $_POST["email_address"];
$password = $_POST["password"];
$username = $_POST["username"];

// Check if the user is already registered
$check_query = "SELECT * FROM login_data WHERE email_address = ? OR username = ?";
$stmt = $connection->prepare($check_query);
$stmt->bind_param("ss", $email_address, $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User is already registered
    $_SESSION["error"] = 1;
    header("Location: http://127.0.0.1/modified_project/registration.php");
    exit; // Exit the script to prevent further execution
} else {
    // User is not registered, proceed with registration
    $registration_query = "INSERT INTO login_data (email_address, password, username) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($registration_query);
    $stmt->bind_param("sss", $email_address, $password, $username);
    $query_result = $stmt->execute();

    if ($query_result == true) {
        $_SESSION['user'] = array(
            'username' => $username,
            'id' => $stmt->insert_id
        );
        header("Location: http://127.0.0.1/modified_project/post_1.php");
        exit; // Exit the script to prevent further execution
    } else {
        $_SESSION["error"] = 1;
        header("Location: http://127.0.0.1/modified_project/registration.php");
        exit; // Exit the script to prevent further execution
    }
}

$stmt->close();
$connection->close();
