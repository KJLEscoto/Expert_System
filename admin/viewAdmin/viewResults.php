<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../../dist/output.css">
</head>
<body>
    <div class="button-container">
    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><button>Back</button></a>
    <a href="../viewAdmin/adminDashboard.php"><button>Home</button></a>
    </div>
    <h1>Diagnosis Count</h1>

    <h2>Results</h2>
    <table class="w-full border-2 border-black">
        
    <tr class="border-2 border-black">
        <?php
        include "../controller/chart.php";
        ?>
    </tr>

    </table>
</body>
</html>
