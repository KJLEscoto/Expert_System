<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List of Results | Admin</title>
  <link rel="stylesheet" href="../assets/css/styles.css">
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

  if (isset($_GET['diagnos'])) {
    include '../result-diagnos-modal.php';
  }
  ?>
  <div class="button-container">
    <a class="inline-block bg-[#9b9595] hover:bg-[#7c7474] text-white py-1 px-3 rounded mt-4"
      href="../viewAdmin/adminDashboard.php"><button>
        < Back</button></a>

    <a class="inline-block bg-[#9b9595] hover:bg-[#7c7474] text-white py-1 px-3 rounded mt-4"
      href="../viewAdmin/viewResults.php?diagnos=true"><button>
        Diagnosis Count</button></a>
  </div>

  <h3 class="text-2xl font-bold mt-5 text-center bg-[#3B3131] text-white rounded-lg p-3 mb-5">List of Results:
    <?php require "../controller/totalResults.php"; ?>
  </h3>

  <?php
      include "../controller/chart.php";
    ?>
</body>

</html>