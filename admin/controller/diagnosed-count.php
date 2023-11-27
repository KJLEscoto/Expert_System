<?php
require $_SERVER["DOCUMENT_ROOT"] . '/expert_system/config/database.php';

$sql = "SELECT 
            SUM(CASE WHEN r.result >= -1 AND r.result <= 10 THEN 1 ELSE 0 END) AS Normal,
            SUM(CASE WHEN r.result >= 11 AND r.result <= 16 THEN 1 ELSE 0 END) AS 'Mild Mood Disturbance',
            SUM(CASE WHEN r.result >= 17 AND r.result <= 20 THEN 1 ELSE 0 END) AS 'Borderline Clinical Depression',
            SUM(CASE WHEN r.result >= 21 AND r.result <= 30 THEN 1 ELSE 0 END) AS 'Moderate Depression',
            SUM(CASE WHEN r.result >= 31 AND r.result <= 40 THEN 1 ELSE 0 END) AS 'Severe Depression',
            SUM(CASE WHEN r.result > 40 THEN 1 ELSE 0 END) AS 'Extreme Depression'
        FROM result r 
        INNER JOIN users u ON r.user_id = u.user_id";
$result = $conn->query($sql);
$diagnosisCount = $result->fetch_assoc();

// Calculate the total count
$totalDiagnosisCount = array_sum($diagnosisCount);
?>

<div class="bg-gray-100 p-4 rounded-md shadow-md mb-4">
  <h6 class="md:text-lg text-sm text-gray-800"><span class="font-bold">Total Diagnosis Count:</span>
    <?php echo $totalDiagnosisCount; ?></h6>
</div>

<div class="overflow-y-auto">
  <table class='w-full bg-white border border-gray-300 rounded-md shadow-md'>
    <tbody>
      <?php
      foreach ($diagnosisCount as $diagnosis => $count) {
        echo "<tr>";
        echo "<th class='py-2 md:text-base text-sm font-normal px-4 border-2 text-start sm:table-cell'>$diagnosis</th>";
        echo "<td class='py-2 md:text-base text-sm px-4 text-center border-b-2 sm:table-cell'>$count</td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div>