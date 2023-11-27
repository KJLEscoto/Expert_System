<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List of Users | Admin</title>
  <link rel="stylesheet" href="../../dist/output.css">
  <link rel="shortcut icon" type="x-icon" href="../../img/sti-logo.png">
  <style>
  ::-webkit-scrollbar {
    height: 8px;
    width: 8px;
  }

  ::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 8px;
  }

  ::-webkit-scrollbar-track {
    background: #f0f0f0;
    border-radius: 8px;
  }

  ::-webkit-scrollbar-thumb:hover {
    background: #000080;
  }
  </style>
</head>

<body class="font-sans bg-[#eeeded] md:px-20 px-5 pb-10 mt-10 tracking-wide">

  <?php
    session_start();
    if (isset($_GET['unset'])) {
      unset($_SESSION['result-user-id']);
    }
    if (isset($_POST['user_id']) && isset($_GET['confirm'])) {
        $_SESSION['u_id'] = $_POST['user_id'];
        include("../confirm-modal.php");
    }
    if (isset($_GET['save-success'])) {
        echo "<div class='notification success'>Deleted Successfully!</div>";
    }
    if (isset($_GET['secret_question'])) {
      include '../secret-question-modal.php';
    }
    if (isset($_GET['result']) || isset($_GET['result-delete'])) {
      if (!isset($_SESSION['result-user-id'])) {
        $_SESSION['result-user-id'] = $_POST['user_id'];
      }
      include '../result-modal.php';
      if (isset($_POST['result_id'])) {
        $_SESSION['result_id'] = $_POST['result_id'];
        include("../confirm-modal.php");
      }
    }
    ?>
  <script src="../../js/notify-script.js"></script>

  <a class="inline-block bg-[#9b9595] hover:bg-[#7c7474] text-white py-1 px-3 rounded mt-4 mb-2"
    href="../viewAdmin/adminDashboard.php"><button>
      < Back</button></a>
  <a class="inline-block bg-[#9b9595] hover:bg-[#7c7474] text-white py-1 px-3 rounded mt-4"
    href="../viewAdmin/viewUsers.php?secret_question=true"><button>
      Secret Questions</button></a>

  <h3 class="text-2xl font-bold mt-2 text-center bg-[#3B3131] text-white rounded-lg p-3">List of Users:
    <?php require "../controller/totalUsers.php"; ?> </h3>

  <div class="mt-5 flex items-center">
    <label for="search" class="mr-2">Search:</label>
    <input type="text" id="search" name="user_id"
      class="border border-gray-300 rounded-md p-2 focus:outline-none focus:border-blue-500"
      placeholder="User ID or Name">
    <button class="bg-[#9b9595] hover:bg-[#7c7474] text-white py-2 px-4 rounded-md ml-2"
      onclick="searchFunctionUsers()">Search</button>
    <button class="bg-[#9b9595] hover:bg-[#7c7474] text-white py-2 px-4 rounded-md ml-2"
      onclick="clearSearchUsers()">Clear</button>
  </div>

  <div class="flex justify-center mt-5">
    <div class="overflow-x-auto w-full">
      <table id="userTable" class="w-full bg-white border border-gray-300 rounded-md overflow-hidden shadow-md">
        <thead class="bg-gray-200 border-b-2">
          <tr>
            <th class="py-2 px-4 border-r-2">User ID</th>
            <th class="py-2 px-4 border-r-2">First Name</th>
            <th class="py-2 px-4 border-r-2">Last Name</th>
            <th class="py-2 px-4 border-r-2">Age</th>
            <th class="py-2 px-4 border-r-2">Email</th>
            <th class="py-2 px-4 border-r-2">Pin</th>
            <th class="py-2 px-4 border-r-2">Secret Question</th>
            <th class="py-2 px-4 border-r-2">Secret Answer</th>
            <th class="py-2 px-4 border-r-2">Type</th>
            <th class="py-2 px-4 border-r-2">Created At</th>
            <th class="py-2 px-4">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            require("../controller/users.php");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='py-2 px-4 border-r-2 text-center border-b'>" . $row['user_id'] . "</td>";
                echo "<td class='py-2 px-4 border-r-2 border-b'>" . ucwords($row['first_name']) . "</td>";
                echo "<td class='py-2 px-4 border-r-2 border-b'>" . ucwords($row['last_name']) . "</td>";
                echo "<td class='py-2 px-4 border-r-2 text-center border-b'>" . $row['age'] . "</td>";
                echo "<td class='py-2 px-4 border-r-2 border-b'>" . $row['email'] . "</td>";echo "<td class='py-2 px-4 border-r-2 border-b'>" . hash('md5', $row['pass']) . "</td>";
                echo "<td class='py-2 px-4 border-r-2 text-center border-b'>" . $row['s_question'] . "</td>";
                echo "<td class='py-2 px-4 border-r-2 border-b'>" . $row['s_answer'] . "</td>";
                echo "<td class='py-2 px-4 border-r-2 text-center border-b'>" . $row['type'] . "</td>";
                echo "<td class='py-2 px-4 border-r-2 border-b'>" . $row['created_at'] . "</td>";
                echo '<td class="py-2 px-4 text-center border-b">
                        <form method="post" action="viewUsers.php?result" class="mb-2">
                          <input type="hidden" name="user_id" value="' . $row['user_id'] . '">
                          <input type="submit" value="View Result" class="border-[#00994D] border-2 py-2 px-4 shadow-md tracking-wider rounded-2xl bg-[#B9E0A5] hover:bg-[#D5E8D4] font-semibold hover:border-[#82B366] text-[#002951] transition duration-300 ease-in-out text-xs">
                        </form>
                        <form method="post" action="viewUsers.php?confirm">
                          <input type="hidden" name="user_id" value="' . $row['user_id'] . '">
                          <input type="submit" value="Delete User" class="border-[#B85450] border-2 py-2 px-4 shadow-md tracking-wider rounded-2xl bg-[#FF9999] hover:bg-[#F8CECC] font-semibold hover:border-[#C27474] text-[#002951] transition duration-300 ease-in-out text-xs">
                        </form>
                      </td>';
                echo "</tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
  function clearSearchUsers() {
    var input, table, tr, i;

    // Clear the search box
    input = document.getElementById("search");
    input.value = "";

    // Display the entire table
    table = document.getElementById("userTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      tr[i].style.display = "";
    }
  }

  function searchFunctionUsers() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("userTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
      var found = false;
      for (j = 0; j < tr[i].cells.length; j++) {
        td = tr[i].getElementsByTagName("td")[j];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            found = true;
            break;
          }
        }
      }
      if (found || tr[i].getElementsByTagName("th").length > 0) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
  </script>

</body>

</html>