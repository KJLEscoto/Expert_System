<?php
session_start();

require $_SERVER["DOCUMENT_ROOT"] . '/simpleAdmin/config/dbconnect.php';

$sql = "SELECT r.result_id, r.user_id, u.first_name, u.last_name, r.result, r.created_at 
        FROM result r 
        INNER JOIN users u ON r.user_id = u.user_id
        ORDER BY r.user_id";
$result = $conn->query($sql);

$previousUserId = null;
$countResults = 0;

if (isset($_POST['result_id'])) {
    $_SESSION['result_id'] = $_POST['result_id']; 
    include("../confirm-modal.php");
}

echo "<table class='w-full border-2 border-black'>";
echo "<tr class='border-2 border-black'>";
echo "<th class='border-2 border-black'>User</th>";
echo "<th class='border-2 border-black'>Result</th>";
echo "<th class='border-2 border-black'>Diagnosis</th>";
echo "<th class='border-2 border-black'>Date Taken</th>";
echo "<th class='border-2 border-black'>Action</th>";
echo "</tr>";

while ($row = $result->fetch_assoc()) {
    // Determine diagnosis based on 'result' column
    $diagnosis = '';
    $resultValue = $row['result'];
    if ($resultValue >= 1 && $resultValue <= 10) {
        $diagnosis = 'Normal';
    } elseif ($resultValue >= 11 && $resultValue <= 16) {
        $diagnosis = 'Mild Mood Disturbance';
    } elseif ($resultValue >= 17 && $resultValue <= 20) {
        $diagnosis = 'Borderline Clinical Depression';
    } elseif ($resultValue >= 21 && $resultValue <= 30) {
        $diagnosis = 'Moderate Depression';
    } elseif ($resultValue >= 31 && $resultValue <= 40) {
        $diagnosis = 'Severe Depression';
    } elseif ($resultValue > 40) {
        $diagnosis = 'Extreme Depression';
    }

    // Check if the current user is the same as the previous one
    if ($previousUserId !== $row['user_id']) {
        if ($countResults > 0) {
            echo "</tr class='border-2 border-black'>";
        }
        $countResults = 0;
        $previousUserId = $row['user_id'];
        echo "<tr class='border-2 border-black'>";
        $numRows = getNumRows($row['user_id'], $conn);
        echo "<td rowspan='$numRows' class='border-2 border-black'>" . $row['user_id'] . " - " . $row['first_name'] . " " . $row['last_name']  . "</td>";
    }

    if ($countResults > 0) {
        echo "</tr>";
        echo "<tr class='border-2 border-black'>";
    }

    echo "<td class='border-2 border-black'>" . $row['result'] . "</td>";
    echo "<td class='border-2 border-black'>" . $diagnosis . "</td>";
    echo "<td class='border-2 border-black'>" . $row['created_at'] . "</td>";
    echo '<td class="border-2 border-black"><form method="post" action="">
    <input type="hidden" name="result_id" value="' . $row['result_id'] . '">
    <input type="submit" value="Delete">
    </form></td>';
    $countResults++;
}
if ($countResults > 0) {
    echo "</tr>";
}
echo "</table>";

$conn->close();

function getNumRows($user_id, $connection) {
    $query = "SELECT COUNT(*) as num_rows FROM result WHERE user_id = $user_id";
    $result = $connection->query($query);
    $row = $result->fetch_assoc();
    return $row['num_rows'];
}
?>
