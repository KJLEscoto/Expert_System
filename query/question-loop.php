<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $question_number = $_POST['question_number'] - 1;
    if (!isset($_POST['details']) && !isset($_POST['okay'])) {
        if (isset($_POST['answer'])) {
            $_SESSION['answers'][$question_number] = $_POST['answer'];
        } else {
            $_SESSION['answers'][$question_number] = 4;
        }
    }

    if (isset($_POST['next'])) {
        header("Location: question-loop.php?question=" . ($question_number + 2)); // Adjust the question number accordingly
        exit();
    } elseif (isset($_POST['previous'])) {
        header("Location: question-loop.php?question=" . $question_number); // Adjust the question number accordingly
        exit();
    }
    if (isset($_POST['submit'])) {
        include("../php_tabs/question-list.php");

        $answers = $_SESSION['answers'];
        $answersCount = count($questions);
    
        for ($i = 0; $i < $answersCount; $i++) {
            if (!isset($_SESSION['answers'][$i]) || $_SESSION['answers'][$i] < 0 || $_SESSION['answers'][$i] > 3) {
                $_SESSION['error'] = "Check carefully, all questions must be answered!";
                header("Location: question-loop.php?question=". $answersCount);
                exit();
            }
        }
        header("Location: ../php_tabs/questions.php?submit=" . $answersCount);
        exit();
    }
    
    if (isset($_POST['details'])) {
        header("Location: ../php_tabs/questions.php?detail=" . ($question_number + 1)); // Adjust the question number accordingly
        exit();
    }
    if (isset($_POST['okay'])) {
        header("Location: question-loop.php?question=" . $_POST['okay']);
        exit();
    }
}

if (!isset($_GET['question']) && !isset($_GET['detail'])) {
    header("Location: question-loop.php?question=1");
    exit();
}

if (!isset($_SESSION['answers'])) {
    $_SESSION['answers'] = array();
}

include('../php_tabs/questions.php');

?>