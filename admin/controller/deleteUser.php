<?php
require $_SERVER["DOCUMENT_ROOT"] . '/simpleAdmin/config/dbconnect.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Update the user's deleted_at time to the current time
    $updateUserSQL = "UPDATE users SET deleted_at = NOW() WHERE user_id = $user_id";
    if ($conn->query($updateUserSQL) === true) {
        // Success: User's deleted_at time updated
        header("Location: ../viewAdmin/viewUsers.php"); // Redirect back to the main page
    } else {
        echo "Error updating user's deleted_at time: " . $conn->error;
    }
}

$conn->close();
?>
