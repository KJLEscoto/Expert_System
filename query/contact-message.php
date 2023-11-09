<?php

session_start();

require $_SERVER["DOCUMENT_ROOT"] . '/expert_system/config/database.php';

$stmt = $conn->prepare("INSERT INTO contact_message(contact_name, contact_email, contact_number, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $contactName, $contactEmail, $contactNumber, $message);

$contactName = $_POST["contact_name"];
$contactEmail = $_POST["contact_email"];
$contactNumber = $_POST["contact_number"];
$message = $_POST["message"];
$stmt->execute();

$stmt->close();
$conn->close();

$_SESSION["submit-success"] = true;

header("location: ../index.php#feedback-sent");
?>