<?php
session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/expert_system/config/database.php';

if (isset($_SESSION['first']) || isset($_SESSION['last']) || isset($_SESSION['age']) || isset($_SESSION['pass-pin'])  || isset($_SESSION['security']) || isset($_SESSION['secret'])){
  unset($_SESSION['first']);
  unset($_SESSION['last']);
  unset($_SESSION['age']);
  unset($_SESSION['pass-pin']);
  unset($_SESSION['security']);
  unset($_SESSION['secret']);
} 

if (isset($_POST['email'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    unset($_SESSION['admin']);
    $email = validate($_POST['email']);

    if (empty($email)) {
      $error_message = "Email is required";
      header("Location: ../index.php?error=" . urlencode($error_message));
    } else {
        $_SESSION['email'] = $email;
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['type'] === 'admin') {
                $_SESSION['admin-id'] = $row['user_id'];
                $_SESSION['admin'] = true;
                header("Location: ../index.php?admin-page=true");
            } else {
                unset($_SESSION['admin-id']);
                header("Location: ../index.php?existing-user=true");
            }
        } else {
            unset($_SESSION['admin-id']);
            header("Location: ../index.php?new-user=true");
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>