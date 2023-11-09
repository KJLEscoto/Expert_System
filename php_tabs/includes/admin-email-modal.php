<div class="fixed top-0 left-0 w-full h-full bg-black opacity-75 z-10" style="display: block;">
</div>
<div
  class="modal fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#d0d9e7] p-6 shadow-lg rounded-lg z-20"
  style="display: block;">
  <h2 class="text-2xl font-semibold text-gray-800 mb-4">Admin Email Created</h2>
  <hr class="w-full m-auto border">
  <br>
  <p class='mb-2'>This is your created email:</p>

  <p>Email: </p> <?php echo $_SESSION['new-admin'] ?>

  <hr class="w-full m-auto border mt-5">
  <div class="flex justify-center items-center">
    <form action="../../admin/viewAdmin/adminDashboard.php" method="POST">
      <div class="flex mt-5 gap-10">
        <button type="submit" name="okay" value="<?php echo ($question_number + 1) ?>"
          class="border-[#00994D] border-2 py-2 px-10 shadow-md tracking-wider rounded-2xl bg-[#B9E0A5] hover:bg-[#D5E8D4] font-semibold hover:border-[#82B366] text-[#002951] transition duration-300 ease-in-out">Okay
        </button>
      </div>
    </form>
  </div>
</div>