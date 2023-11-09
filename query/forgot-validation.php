<?php 
session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/expert_system/config/database.php';

if (isset($_POST['submit-forgot'])) {
    $fAnswer = $_POST['submit-forgot'];
    $email = $_SESSION['email']; 

    $error_security = array("Secret answer is required", "Incorrect Answer");

    if (empty($fAnswer)) {
        header("Location: ../index.php?forgot-error=" . urlencode($error_security[0]));
    } else {
        $sql = "SELECT * FROM users WHERE email='$email' AND s_answer='$fAnswer'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($_SESSION['admin']) {
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
            header("Location: ../index.php?forgot-error=" . urlencode($error_security[1]));
        }
    }
}
?>