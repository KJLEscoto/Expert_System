<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List of Admins | Admin</title>
  <link rel="stylesheet" href="../../dist/output.css">
  <link rel="shortcut icon" type="x-icon" href="../../img/sti-logo.png">
</head>

<body class="font-sans bg-[#eeeded] md:px-20 px-5 pb-10 mt-10 tracking-wide">
  <?php
include "../controller/adminIncharge.php";
?>
  <a class="inline-block bg-[#9b9595] hover:bg-[#7c7474] text-white py-1 px-3 rounded mt-4 mb-2"
    href="../viewAdmin/adminDashboard.php"><button>
      < Back</button></a>

  <h3 class="text-2xl font-bold mt-2 text-center bg-[#3B3131] text-white rounded-lg p-3 mb-5">List of Admins</h3>

  <p>
    <?php
    if (isset($_GET['save-success'])) {
        echo "Successfully saved";
    }
    ?>
  <div class="mb-5">
    <label for="search">Search by Admin ID or Name: </label>
    <input type="text" class="border border-gray-300 rounded-md p-2 focus:outline-none focus:border-blue-500"
      id="search" name="user_id" placeholder="Enter User ID or Name">
    <input type="button" class="bg-[#9b9595] hover:bg-[#7c7474] text-white py-2 px-4 rounded-md ml-2" value="Search"
      onclick="searchFunction()">
  </div>
  </p>
  </div>
  <table class="w-full bg-white border border-gray-300 rounded-md overflow-hidden shadow-md">
    <thead class="bg-gray-200 border-b-2">
      <th class="py-2 px-4 border-r-2">ID</th>
      <th class="py-2 px-4 border-r-2">Name</th>
      <th class="py-2 px-4 border-r-2">Email</th>
      <th class="py-2 px-4 border-r-2">Password</th>
      <th class="py-2 px-4">Action</th>

    </thead>
    <tbody>
      <?php
        include "../controller/admins.php";
        ?>

    </tbody>
  </table>
</body>
<script>
function searchFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("adminTableBody");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    var td1 = tr[i].getElementsByTagName("td")[0];
    var td2 = tr[i].getElementsByTagName("td")[1];
    if (td1 || td2) {
      var txtValue1 = td1.textContent || td1.innerText;
      var txtValue2 = td2.textContent || td2.innerText;
      if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function confirmDelete(user_id) {
  if (confirm("Are you sure you want to delete this admin?")) {
    window.location = "../controller/deleteAdmin.php?user_id=" + user_id;
  }
}
</script>

</html>