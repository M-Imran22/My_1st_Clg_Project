<?php
// Include the database connection file
include 'database_connection.php';

session_start();

// Check if the user is logged in
if (!isset($_SESSION["user"])) {
  header("Location: http://127.0.0.1/modified_project/login.php");
  exit();
}

// Initialize variables
$title = $location = '';
$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get form data
  $title = $_POST['title'];
  $location = $_POST['location'];

  // Validate form inputs
  if (empty($title)) {
    $errors[] = "Title is required";
  }

  if (empty($location)) {
    $errors[] = "Location is required";
  }

  // If there are no validation errors, proceed to insert the post into the database
  if (empty($errors)) {
    $user_id = $_SESSION["user"]["id"];

    // Prepare the SQL statement
    $sql = "INSERT INTO post_title (title, location, user_id) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('ssi', $title, $location, $user_id);

    // Execute the statement
    if ($stmt->execute()) {
      // Get the inserted post ID
      $post_id = $stmt->insert_id;

      // Store the post ID in the session for further use if needed
      $_SESSION["post_id"] = $post_id;

      // Redirect the user to the next page (e.g., post details or image upload)
      header("Location: http://127.0.0.1/modified_project/newpost.php");
      exit();
    } else {
      // Handle any errors
      $errors[] = "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
  }
}

// Close the database connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Post</title>
  <style>
    .main-container {
      border: 1px solid black;
      width: 45%;
      margin: 10% 25%;
      padding: 3% 3%;
    }

    .main-container h1 {
      text-align: center;
      font-size: 24px;
    }

    .error-message {
      color: red;
    }

    .form-field {
      margin-bottom: 10px;
    }

    .form-field label {
      display: block;
      font-weight: bold;
    }

    .form-field input[type="text"] {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    .submit-btn {
      display: block;
      margin-top: 10px;
      padding: 10px 20px;
      background-color: blue;
      color: white;
      font-weight: bold;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div class="main-container">
    <h1>Create New Post</h1>
    <?php if (!empty($errors)) : ?>
      <div class="error-message">
        <?php foreach ($errors as $error) : ?>
          <p><?php echo $error; ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <form method="post" action="post_title.php">
      <div class="form-field">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $title; ?>" required>
      </div>
      <div class="form-field">
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?php echo $location; ?>" required>
      </div>
      <button type="submit" class="submit-btn">Next Page</button>
    </form>
  </div>
</body>

</html>