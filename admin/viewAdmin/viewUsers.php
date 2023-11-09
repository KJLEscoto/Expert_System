<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <?php
    session_start();
    if (isset($_POST['user_id'])) {
        $_SESSION['u_id'] = $_POST['user_id'];
        include("../confirm-modal.php");
    } ?>
    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><button>Back</button></a>
    <a href="../viewAdmin/adminDashboard.php"><button>Home</button></a>
    <h3 class="font-size">Users</h3>
    <div>
        <form method="get" action="viewUsers.php">
            <label for="search">Search by User ID: </label>
            <input type="text" id="search" name="user_id" placeholder="Enter User ID">
            <input type="submit" value="Search">
        </form>
    </div>

    <table>
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>Email</th>
            <th>Secret Question</th>
            <th>Secret Answer</th>
            <th>Type</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        <?php
            require("../controller/users.php");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['user_id']."</td>";
                echo "<td>".$row['first_name']."</td>";
                echo "<td>".$row['last_name']."</td>";
                echo "<td>".$row['age']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['s_question']."</td>";
                echo "<td>".$row['s_answer']."</td>";
                echo "<td>".$row['type']."</td>";
                echo "<td>".$row['created_at']."</td>";
                echo '<td><form method="post" action="">
                  <input type="hidden" name="user_id" value="' . $row['user_id'] . '">
                  <input type="submit" value="Delete">
                  </form></td>';
                echo "</tr>";
            }
        ?>
    </table>
</body>

<style>
    .highlighted {
        background-color: yellow; /* You can adjust the background color as needed */
    }
</style>
</html>
