<?php
    session_start();
    if (isset($_POST['pass'])) {
        $pin = $_POST['pass'];
        $_SESSION['first'] = $_POST['f_name'];
        $_SESSION['last'] = $_POST['l_name'];
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['pass-pin'] = $pin;

        $_SESSION['security'] = $_POST['security'];
        $_SESSION['secret'] = $_POST['secret'];
        
        $error_pin = array("PIN is required", "PIN should be a 4-digit number");

        if (isset($_SESSION['admin'])){
            $direction_index = "../admin/viewAdmin/createAdmin.php?error-";
        } else {
            $direction_index = "../index.php?error-";
        }

        if (empty($pin)) {
            header("Location: " . $direction_index . "pin=" . urlencode($error_pin[0]));
        } elseif (!preg_match('/^[0-9]{4}$/', $pin)) {
            unset($_SESSION['pass-pin']);
            header("Location: " . $direction_index . "pin=" . urlencode($error_pin[1]));
        } else {
            $f_name = $_SESSION['first'];
            $l_name = $_SESSION['last'];
            $age = $_SESSION['age'];
            $security =  $_SESSION['security'];
            $secret = $_SESSION['secret'];

            $error_fname = array("First Name is required", "First Name should only contain letters and dots");

            // Check if first name is empty
            if (empty($f_name)) {
                header("Location: " . $direction_index . "first=" . urlencode($error_fname[0]));
                exit;
            } elseif (!preg_match('/^[A-Za-z.]+$/', $f_name)) {
                unset($_SESSION['first']);
                header("Location: " . $direction_index . "first=" . urlencode($error_fname[1]));
                exit;
            }

            $error_lname = array("Last Name is required", "Last Name should only contain letters and dots");

            // Check if last name is empty
            if (empty($l_name)) {
                header("Location: " . $direction_index . "last=" . urlencode($error_lname[0]));
                exit;
            } elseif (!preg_match('/^[A-Za-z.]+$/', $l_name)) {
                unset($_SESSION['last']);
                header("Location: " . $direction_index . "last=" . urlencode($error_lname[1]));
                exit;
            }

            $error_age = array("Age is required", "Age should be a number", "Age cannot be below 0", "Age cannot exceed more than 120");

            // Check if age is empty
            if (empty($age)) {
                unset($_SESSION['age']);
                header("Location: " . $direction_index . "age=" . urlencode($error_age[0]));
                exit;
            }

            // Validate age
            if (!is_numeric($age)) {
                unset($_SESSION['age']);
                header("Location: " . $direction_index . "age=" . urlencode($error_age[1]));
                exit;
            } elseif ($age < 0) {
                unset($_SESSION['age']);
                header("Location: " . $direction_index . "age=" . urlencode($error_age[2]));
                exit;
            } elseif ($age > 120) {
                unset($_SESSION['age']);
                header("Location: " . $direction_index . "age=" . urlencode($error_age[3]));
                exit;
            }

            $error_security = array("Security Question is required", "Secret answer is required");

            // Check if Security Question is empty
            if ($security == "---") {
                header("Location: " . $direction_index . "security=" . urlencode($error_security[0]));
                exit;
            }

            if (empty($secret)) {
                header("Location: " . $direction_index . "secret=" . urlencode($error_security[1]));
                exit;
            }

            // If all validations pass, store data in session and proceed
            $_SESSION['new-acc'] = true; // Storing the pin in session
            if (isset($_SESSION['admin'])) { 
                include("add-user.php");
                header("Location: ../admin/viewAdmin/adminDashboard.php?acc-created=true");
            } else {
                header("Location: ../index.php?instruction=true");
            }
        }
    }
?>