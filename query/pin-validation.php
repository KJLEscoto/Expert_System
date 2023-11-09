<?php
session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/expert_system/config/database.php';

if (isset($_POST['forgot-pass'])) {
    header("Location: ../index.php?forgot-pass=true");
    exit();
}

if (isset($_GET['quest'])){
    $_SESSION['another-question'] = $_GET['quest'];
}

if (isset($_POST['submit-pin'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $pin = validate($_POST['submit-pin']);
    $email = $_SESSION['email']; // Retrieving the email from the session
    $error_pin = array("PIN is required", "PIN should contain numbers only", "PIN should be a 4-digit number", "Incorrect PIN");

    if (empty($pin)) {
        header("Location: ../index.php?pin-error=" . urlencode($error_pin[0]));
    } elseif (!ctype_digit($pin)) {
        header("Location: ../index.php?pin-error=" . urlencode($error_pin[1]));
    } elseif (strlen($pin) !== 4) {
        header("Location: ../index.php?pin-error=" . urlencode($error_pin[2]));
    } else {
        $sql = "SELECT * FROM users WHERE email='$email' AND pass='$pin'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (isset($_SESSION['admin'])) {
                header("Location: ../admin/viewAdmin/adminDashboard.php");
            } else if ($_SESSION['another-question']) {
                unset($_SESSION['another-question']);
                $_SESSION['new-acc'] = false;
                $_SESSION['existing-email'] = true;
                header("Location: ../index.php?instruction=true");
            } else {
                header("Location: ../php_tabs/view-results.php");
            }
        } else {
            header("Location: ../index.php?pin-error=" . urlencode($error_pin[3]));
        }
    }
} else {
    header("Location: enter-pin.php");
    exit();
}
?>