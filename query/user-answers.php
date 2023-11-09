//wala pa ni gamit

<?php
session_start();

require $_SERVER["DOCUMENT_ROOT"] . '/expert_system/config/database.php';


$counter = 1;

while ($counter <= 21) {
  $stmt = $conn->prepare("SELECT (q$counter, result)  FROM result WHERE user_id = ? ORDER BY created_at DESC");
  $stmt->bind_param("i", $_SESSION["fk-user-id"]); $stmt->execute(); $result = $stmt->get_result();
  $counter++;
}

$stmt->execute();
$stmt->close();
$conn->close();