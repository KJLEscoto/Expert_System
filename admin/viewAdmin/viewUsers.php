<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List of Users | Admin</title>
  <link rel="stylesheet" href="../../dist/output.css">
  <link rel="shortcut icon" type="x-icon" href="../../img/sti-logo.png">
</head>

<body class="font-sans bg-[#eeeded] md:px-20 px-5 pb-10 mt-10 tracking-wide">

  <?php
    session_start();
    if (isset($_POST['user_id'])) {
        $_SESSION['u_id'] = $_POST['user_id'];
        include("../confirm-modal.php");
    } ?>

  <a class="inline-block bg-[#9b9595] hover:bg-[#7c7474] text-white py-1 px-3 rounded mt-4 mb-2"
    href="../viewAdmin/adminDashboard.php"><button>
      < Back</button></a>

  <h3 class="text-2xl font-bold mt-2 text-center bg-[#3B3131] text-white rounded-lg p-3">List of Users</h3>

  <div class="mt-5 flex items-center">
    <label for="search" class="mr-2">Search by User ID or Name:</label>
    <input type="text" id="search" name="user_id"
      class="border border-gray-300 rounded-md p-2 focus:outline-none focus:border-blue-500"
      placeholder="User ID or Name">
    <button class="bg-[#9b9595] hover:bg-[#7c7474] text-white py-2 px-4 rounded-md ml-2"
      onclick="searchFunction()">Search</button>
  </div>

  <div class="flex justify-center mt-5">
    <table id="userTable" class="w-full bg-white border border-gray-300 rounded-md overflow-hidden shadow-md">
      <thead class="bg-gray-200 border-b-2">
        <tr>
          <th class="py-2 px-4 border-r-2">User ID</th>
          <th class="py-2 px-4 border-r-2">First Name</th>
          <th class="py-2 px-4 border-r-2">Last Name</th>
          <th class="py-2 px-4 border-r-2">Age</th>
          <th class="py-2 px-4 border-r-2">Email</th>
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
                echo "<td class='py-2 px-4 border-r-2 border-b'>" . $row['first_name'] . "</td>";
                echo "<td class='py-2 px-4 border-r-2 border-b'>" . $row['last_name'] . "</td>";
                echo "<td class='py-2 px-4 border-r-2 text-center border-b'>" . $row['age'] . "</td>";
                echo "<td class='py-2 px-4 border-r-2 border-b'>" . $row['email'] . "</td>";
                echo "<td class='py-2 px-4 border-r-2 text-center border-b'>" . $row['s_question'] . "</td>";
                echo "<td class='py-2 px-4 border-r-2 border-b'>" . $row['s_answer'] . "</td>";
                echo "<td class='py-2 px-4 border-r-2 text-center border-b'>" . $row['type'] . "</td>";
                echo "<td class='py-2 px-4 border-r-2 border-b'>" . $row['created_at'] . "</td>";
                echo '<td class="py-2 px-4 text-center border-b">
                        <form method="post" action="">
                          <input type="hidden" name="user_id" value="' . $row['user_id'] . '">
                          <input type="submit" value="Delete" class="bg-[#a07f7e] hover:bg-[#864543] text-white py-1 px-2 rounded">
                        </form>
                      </td>';
                echo "</tr>";
            }
          ?>
      </tbody>
    </table>
  </div>

  <script>
  function searchFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("userTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
      var found = false;
      for (var j = 0; j < 2; j++) { // Search in the first two columns: User ID and Name
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