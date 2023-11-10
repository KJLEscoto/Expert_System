<?php 
session_start();

if (isset($_POST['Yes'])) {
    require $_SERVER["DOCUMENT_ROOT"] . '/expert_system/config/database.php';
        
    // Include the save-user.php file to save the user data
    if ($_SESSION['new-acc']) {
        include('add-user.php');
    }
    
    // Include the get-id.php file to fetch the user_id
    include('fetch-user.php');
    
    $user_id = $row['user_id']; // Get the user_id from the fetched row
    
    // Inserting the answers into the database
    $values = array(); // Initialize the values array
    // Include the user_id as the first value in the array
    $values[] = $user_id;
    
    $placeholders = array("user_id"); // Include "user_id" as the first placeholder in the array
    
    $answers = array_map('intval', $_SESSION['answers']); // Convert answers to integers
    $result = array_sum($answers); // Calculate the sum of all answers
    
    foreach ($_SESSION['answers'] as $index => $answer) {
        $values[] = $answer;
        $placeholders[] = "q" . ($index + 1);
    }
    
    $values[] = $result;
    $placeholders[] = "result";
    
    $valuesString = implode(", ", $values);
    $placeholdersString = implode(", ", $placeholders);
    
    // Open the database connection before executing the query
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "INSERT INTO result ($placeholdersString) VALUES ($valuesString)";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close the connection after executing the query
    $conn->close();
    
    // Redirect to the result page
    
    // Unset the session after saving to the database
    
    unset($_SESSION['new-acc']);
    unset($_SESSION['answers']);
    unset($_SESSION['first']);
    unset($_SESSION['last']);
    unset($_SESSION['age']);
    unset($_SESSION['pass-pin']);
    
    unset($_SESSION['security']);
    unset($_SESSION['secret']);
    
    unset($_SESSION['displayed_questions']);
    header("Location: ../php_tabs/current-result.php");
    exit();
} else if (isset($_POST['No'])) {
    include ("../php_tabs/question-list.php");
    header("Location: question-loop.php?question=". count($questions));
    exit();
}
?>