<?php
require $_SERVER["DOCUMENT_ROOT"] . '/expert_system/config/database.php';

$resultCount = 0;

$sql = "SELECT COUNT(*) FROM result WHERE user_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $_SESSION['result-user-id']);

    $stmt->execute();

    $resultUser = $stmt->get_result();

    if ($resultUser) {
        $row = $resultUser->fetch_assoc();
        $resultCount = $row['COUNT(*)'];
    } else {
        echo "Error fetching result count: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

$conn->close();

?>