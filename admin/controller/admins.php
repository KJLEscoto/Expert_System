<?php

require $_SERVER["DOCUMENT_ROOT"] . '/expert_system/config/database.php';

$sql = "SELECT * FROM users WHERE type='admin' and deleted_at IS null";
$result = $conn->query($sql);

$conn->close();
while ($row = $result->fetch_assoc()) {
    // Check if the logged-in admin's first name is "admin"
    // If it is, they can delete other admins (excluding themselves)
    if ($admin_first_name === "admin" && $row['first_name'] !== "admin") {
      $deleteLink = '<button type="submit" class="border-[#B85450] border-2 py-2 px-4 shadow-md tracking-wider rounded-2xl bg-[#FF9999] hover:bg-[#F8CECC] font-semibold hover:border-[#C27474] text-[#002951] transition duration-300 ease-in-out text-xs" name="deleteAdmin" value="' . $row['user_id'] . '">Delete</button>';
  } else {
      // Admin with other names or "admin" itself can't delete
      $deleteLink = 'Not Authorized';
  }
?>
<tr>
  <td class='py-2 px-4 border-r-2 text-center border-b'><?php echo $row['user_id']; ?></td>
  <td class='py-2 px-4 border-r-2 border-b'>
    <?php echo ucfirst($row['first_name']); ?>
    <?php echo ucfirst($row['last_name']); ?>
  </td>
  <td class='py-2 px-4 border-r-2 border-b'><?php echo $row['email']; ?></td>
  <td class='py-2 px-4 border-r-2 text-center border-b'><?php echo $row['pass']; ?></td>
  <td class='py-2 px-4 border-r-2 text-center border-b'><?php echo $deleteLink; ?></td>
</tr>
<?php } ?>