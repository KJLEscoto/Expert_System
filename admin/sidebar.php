<!-- Sidebar -->
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

<div class="sidebar" id="mySidebar">
  <div class="flex items-center justify-center">
    <img class="m-auto" src="../assets/images/logo.png" width="120" height="120" alt="Swiss Collection">
  </div>

  <h5 class="text-center mt-3 text-[#e7e7e7] mb-3">Hello, <?php echo ucfirst($admin_first_name); ?>!</h5>

  <hr class="border-2 border-gray-200 w-3/4 mb-3 m-auto">

  <a href="../viewAdmin/adminDashboard.php" class="mt-2">
    <div class="flex text-base items-center m-auto">
      <i class="fa fa-home mr-2"></i>
      <p>Dashboard</p>
    </div>
  </a>
  <a href="../viewAdmin/viewUsers.php">
    <div class="flex text-base items-center m-auto">
      <i class="fa fa-users mr-2 -ml-1"></i>
      <p>Users</p>
    </div>
  </a>
  <a href="../viewAdmin/viewAdmin.php">
    <div class="flex text-base items-center m-auto">
      <i class="fa fa-list mr-2"></i>
      <p>Admins</p>
    </div>
  </a>
  <a href="../viewAdmin/viewResults.php">
    <div class="flex text-base items-center m-auto">
      <i class="fa fa-th mr-2"></i>
      <p>Results</p>
    </div>
  </a>
</div>

<div id="main">
  <button class="openbtn rounded-lg" onclick="toggleNav()"><i class="fa fa-bars"></i></button>
</div>