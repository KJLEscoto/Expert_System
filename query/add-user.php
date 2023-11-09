<?php

require $_SERVER["DOCUMENT_ROOT"] . '/expert_system/config/database.php';

$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, age, email, pass, s_question, s_answer, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssississ", $firstname, $lastname, $age, $email, $pass, $security, $secret, $type);

$firstname = $_SESSION['first'];
$lastname = $_SESSION['last'];
$age = $_SESSION['age'];

$pass = $_SESSION['pass-pin'];
$security = $_SESSION['security'];
$secret = $_SESSION['secret'];

if (isset($_SESSION['admin'])) {
    $email = lcfirst($firstname) . lcfirst($lastname) . ".admin@gmail.com";
    $_SESSION['new-admin'] = $email; 
    $type = "admin";
} else {
    $type = "guest";
    $email = $_SESSION['email']; 
}

$stmt->execute();


$stmt->close();
$conn->close();

?>