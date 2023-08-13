<?php
session_start();
require_once("database_connection.php");

$email_address = $_POST["email_address"];
$password = $_POST["password"];

$login_query = "SELECT * FROM login_data WHERE email_address = ? AND password = ? LIMIT 1";
$stmt = $connection->prepare($login_query);
$stmt->bind_param("ss", $email_address, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_data = null;
    while ($row = $result->fetch_assoc()) {
        $user_data = $row;
    }
    $_SESSION['user'] = $user_data;
    header("Location:http://127.0.0.1/modified_project/post_1.php");
} else {
    $_SESSION["error"] = 1;
    header("Location:http://127.0.0.1/modified_project/login.php");
}
