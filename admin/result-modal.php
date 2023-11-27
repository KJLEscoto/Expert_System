<?php
require("../controller/result-conn.php");
require("../controller/count-result.php");
require("../controller/user-result.php");

if (isset($_GET['result-delete'])) {
    echo "<div class='notification success'>Deleted Successfully!</div>";
}

$count = 0;
$rows = $result->fetch_all(MYSQLI_ASSOC);
$rowsUsers = $resultUser->fetch_all(MYSQLI_ASSOC);
?>

<div class="modal-container" style="display: block;">
  <div class="overlay fixed top-0 left-0 w-full h-full bg-black opacity-75 z-10"></div>
  <div
    class="modal fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#d0d9e7] p-6 shadow-lg rounded-lg z-20"
    style="display: block; max-height: 80%; overflow-y: scroll;">

    <div class="text-end mb-5 items-center">
      <a href="viewUsers.php?unset">
        <button
          class="cursor-pointer text-xl font-bold absolute top-2 right-2 text-gray-500 px-2 rounded-md hover:bg-gray-400 hover:text-white">&times;</button>
      </a>
    </div>

    <?php 
    foreach ($rowsUsers as $rowsUser) {
        echo "<h1 class='text-start mb-3 text-lg'> <span class='font-bold'>User</span>: " . $rowsUser['user_id'] . " - " . ucwords($rowsUser['first_name']) . ' ' . ucwords($rowsUser['last_name']) . "<h1>";
    }

    if (empty($rows)) {
        echo "<p class='text-center'>User has no result.<p>";
    } else {
    ?>

    <?php if (!empty($rows)) { ?>
    <p class="text-start"><span class="font-bold">Total Results</span>: <?php echo $resultCount; ?></p>
    <hr class="w-full m-auto border mt-5 mb-5">
    <div class="mt-5 flex items-center mb-5">
      <label for="search_result" class="mr-2">Search:</label>
      <input type="text" id="search_result" name="user_id"
        class="border border-gray-300 rounded-md p-2 focus:outline-none focus:border-blue-500"
        placeholder="Result ID or Diagnosis">
      <button class="bg-[#9b9595] hover:bg-[#7c7474] text-white py-2 px-4 rounded-md ml-2"
        onclick="searchFunctionResult()">Search</button>
      <button class="bg-[#9b9595] hover:bg-[#7c7474] text-white py-2 px-4 rounded-md ml-2"
        onclick="clearSearchResult()">Clear</button>
    </div>
    <div class="flex justify-center mt-5">
      <div class="overflow-x-auto w-full">
        <table id="resultTable" class='w-full bg-white border border-gray-300 rounded-md overflow-hidden shadow-md'>
          <thead class='bg-gray-200 border-b-2'>
            <th class='py-2 px-4 border-r-2'>Result ID</th>
            <th class='py-2 px-4 border-r-2'>Result</th>
            <th class='py-2 px-4 border-r-2'>Diagnosis</th>
            <th class='py-2 px-4 border-r-2'>Created at</th>
            <th class='py-2 px-4'>Action</th>
          </thead>
          <tbody>
            <?php
        foreach ($rows as $row) {
          $count++;
        ?>
            <tr>
              <td class='py-2 px-4 border-r-2 border-b-2'><?php echo $row['result_id']; ?></td>
              <td class='py-2 px-4 border-r-2 border-b-2'><?php echo $row['result']; ?></td>
              <td class='py-2 px-4 border-r-2 border-b-2'><?php echo getDiagnosis($row['result']); ?></td>
              <td class='py-2 px-4 border-r-2 border-b-2'><?php echo $row['created_at']; ?></td>
              <td class='py-2 px-4 border-b-2'>
                <form action="viewUsers.php?result" method="post">
                  <button type="submit" name="result_id" value="<?php echo $row['result_id']; ?>"
                    class="border-[#B85450] border-2 py-2 px-4 shadow-md tracking-wider rounded-2xl bg-[#FF9999] hover:bg-[#F8CECC] font-semibold hover:border-[#C27474] text-[#002951] transition duration-300 ease-in-out text-xs">
                    Delete
                  </button>
                </form>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php } ?>
    <?php } ?>
  </div>
</div>

<script>
function searchFunctionResult() {
  var searchTerm = document.getElementById('search_result').value.toLowerCase();
  var rows = document.querySelectorAll('#resultTable tbody tr');

  for (var i = 0; i < rows.length; i++) {
    var resultId = rows[i].querySelector('td:nth-child(1)').textContent.toLowerCase();
    var result = rows[i].querySelector('td:nth-child(2)').textContent.toLowerCase();
    var diagnosis = rows[i].querySelector('td:nth-child(3)').textContent.toLowerCase();

    if (resultId.includes(searchTerm) || result.includes(searchTerm) || diagnosis.includes(searchTerm)) {
      rows[i].style.display = '';
    } else {
      rows[i].style.display = 'none';
    }
  }
}

function clearSearchResult() {
  document.getElementById('search_result').value = '';
  var rows = document.querySelectorAll('#resultTable tbody tr');

  for (var i = 0; i < rows.length; i++) {
    rows[i].style.display = '';
  }
}
</script>


<?php
function getDiagnosis($result) {
  if ($result >= -1 && $result <= 10) {
    return 'Normal';
  } elseif ($result >= 11 && $result <= 16) {
    return 'Mild Mood Disturbance';
  } elseif ($result >= 17 && $result <= 20) {
    return 'Borderline Clinical Depression';
  } elseif ($result >= 21 && $result <= 30) {
    return 'Moderate Depression';
  } elseif ($result >= 31 && $result <= 40) {
    return 'Severe Depression';
  } elseif ($result > 40) {
    return 'Extreme Depression';
  }
}
?>