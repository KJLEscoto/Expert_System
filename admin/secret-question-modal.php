<div class="fixed top-0 left-0 w-full h-full bg-black opacity-75 z-10" style="display: block;">
</div>
<div
  class="modal fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#d0d9e7] p-6 shadow-lg rounded-lg z-20"
  style="display: block; max-height: 80%; overflow-y: scroll;">

  <h1 class="text-start font-bold text-lg mb-2">Security Questions:</h1>

  <?php include('../../php_tabs/security-questions.php') ; 
  $count = 0;
  while($count <= count($securityQuestions)-1) {
    echo "<p class='text-base text-start'>" . $count . ' - ' . $securityQuestions[$count];
    $count++;
  }
  ?>

  <hr class="w-full m-auto border mt-5">
  <div class="flex justify-center items-center">
    <div class="flex mt-5 gap-10">
      <a href="viewUsers.php">
        <button
          class="border-[#00994D] border-2 py-2 px-10 shadow-md tracking-wider rounded-2xl bg-[#B9E0A5] hover:bg-[#D5E8D4] font-semibold hover:border-[#82B366] text-[#002951] transition duration-300 ease-in-out">Okay
        </button>
      </a>
    </div>
  </div>
</div>