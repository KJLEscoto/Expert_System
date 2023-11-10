<?php 

require $_SERVER["DOCUMENT_ROOT"] . '/expert_system/config/database.php';

// Initialize the count variables
$zerocount = 0;
$onecount = 0;
$twocount = 0;
$threecount = 0;

    $result_id = $result['result_id'] ; // Retrieve the result_id from the URL parameters

    $sql_result_id = "SELECT * FROM result WHERE result_id = '$result_id'";
    $result_result_id = $conn->query($sql_result_id);

    if ($result_result_id->num_rows > 0) {
        $row = $result_result_id->fetch_assoc();

        // Set the number of iterations for the loop
        $numIterations = 21;
        for ($i = 1; $i <= $numIterations; $i++) {
            $q = "q" . $i; // Build the q variable name

            // Check conditions for q
            if ($row[$q] == 0) {
                $zerocount++;
            } elseif ($row[$q] == 1) {
                $onecount++;
            } elseif ($row[$q] == 2) {
                $twocount++;
            } elseif ($row[$q] == 3) {
                $threecount++;
            }
        }
    }
    $conn->close();
?>


<table class="mx-auto max-w-screen-md table-auto border border-collapse border-gray-300">
  <thead class=" bg-gray-600">
    <tr>
      <?php $emojis = ["😕", "🙁", "😞", "😭"];
    foreach ($emojis as $emoji) {
    echo "<th class='px-4 py-2 border'>$emoji</th>";
    }
    ?>
    </tr>
  </thead>
  <tr class="text-center">
    <td class="border"><?php echo $zerocount; ?></td>
    <td class="border"><?php echo $onecount; ?></td>
    <td class="border"><?php echo $twocount; ?></td>
    <td class="border"><?php echo $threecount; ?></td>
  </tr>
</table>