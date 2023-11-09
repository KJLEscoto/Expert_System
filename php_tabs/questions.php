<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Questionnaire | PsycheAssist</title>
  <link rel="stylesheet" href="../dist/output.css">
  <link rel="shortcut icon" type="x-icon" href="../img/sti-logo.png">
  <style>
  ::-webkit-scrollbar {
    width: 8px;
  }

  ::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
  }

  ::-webkit-scrollbar-track {
    background: #f0f0f0;
    border-radius: 4px;
  }

  ::-webkit-scrollbar-thumb:hover {
    background: #000080;
  }
  </style>
</head>

<body class="bg-[#3d3d3d] w-full h-auto">
  <?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['answers'])) {
    $_SESSION['answers'] = array(); // Initialize the answers as an empty array
}

$questions = array(
    "Emotional Well-Being" => array("I do not feel sad.", "I feel sad", "I am sad all the time and I can't snap out of it.", "I am so sad and unhappy that I can't stand it."),
    "Outlook on the Future" => array("I am not particularly discouraged about the future.", "I feel discouraged about the future.", "I feel I have nothing to look forward to.", "I feel the future is hopeless and that things cannot improve."),
    "Self-Perception" => array("I do not feel like a failure.", "I feel I have failed more than the average person.", "As I look back on my life, all I can see is a lot of failures.", "I feel I am a complete failure as a person."),
    "Enjoyment and Satisfaction" => array("I get as much satisfaction out of things as I used to.", "I don't enjoy things the way I used to.", "I don't get real satisfaction out of anything anymore.", "I am dissatisfied or bored with everything."),
    "Guilt" => array("I don't feel particularly guilty", "I feel guilty a good part of the time.", "I feel quite guilty most of the time.", "I feel guilty all of the time."),
    "Expectation of Punishment" => array("I don't feel I am being punished.", "I feel I may be punished.", "I expect to be punished.", "I feel I am being punished."),
    "Self-Disappointment" => array("I don't feel disappointed in myself.", "I am disappointed in myself.", "I am disgusted with myself.", "I hate myself."),
    "Self-Criticism" => array("I don't feel I am any worse than anybody else.", "I am critical of myself for my weaknesses or mistakes.", "I blame myself all the time for my faults.", "I blame myself for everything bad that happens."),
    "Suicidal Thoughts" => array("I don't have any thoughts of killing myself.", "I have thoughts of killing myself, but I would not carry them out.", "I would like to kill myself.", "I would kill myself if I had the chance."),
    "Frequency of Crying" => array("I don't cry any more than usual.", "I cry more now than I used to.", "I cry all the time now.", "I used to be able to cry, but now I can't cry even though I want to."),
    "Irritability" => array("I am no more irritated by things than I ever was.", "I am slightly more irritated now than usual.", "I am quite annoyed or irritated a good deal of the time.", "I feel irritated all the time."),
    "Interest in Other People" => array("I have not lost interest in other people.", "I am less interested in other people than I used to be.", "I have lost most of my interest in other people.", "I have lost all of my interest in other people."),
    "Decision-Making" => array("I make decisions about as well as I ever could.", "I put off making decisions more than I used to.", "I have greater difficulty in making decisions more than I used to.", "I can't make decisions at all anymore."),
    "Concerns About Appearance" => array("I don't feel that I look any worse than I used to.", "I am worried that I am looking old or unattractive.", "I feel there are permanent changes in my appearance that make me look unattractive", "I believe that I look ugly."),
    "Ability to Work" => array("I can work about as well as before.", "It takes an extra effort to get started at doing something.", "I have to push myself very hard to do anything.", "I can't do any work at all."),
    "Sleep Quality" => array("I can sleep as well as usual.", "I don't sleep as well as I used to.", "I wake up 1-2 hours earlier than usual and find it hard to get back to sleep.", "I wake up several hours earlier than I used to and cannot get back to sleep."),
    "Fatigue" => array("I don't get more tired than usual.", "I get tired more easily than I used to.", "I get tired from doing almost anything.", "I am too tired to do anything."),
    "Appetite" => array("My appetite is no worse than usual.", "My appetite is not as good as it used to be.", "My appetite is much worse now.", "I have no appetite at all anymore."),
    "Weight Changes" => array("I haven't lost much weight, if any, lately.", "I have lost more than five pounds.", "I have lost more than ten pounds.", "I have lost more than fifteen pounds."),
    "Health Concerns" => array("I am no more worried about my health than usual.", "I am worried about physical problems like aches, pains, upset stomach, or constipation.", "I am very worried about physical problems and it's hard to think of much else.", "I am so worried about my physical problems that I cannot think of anything else."),
    "Interest in Sex" => array("I have not noticed any recent change in my interest in sex.", "I am less interested in sex than I used to be.", "I have almost no interest in sex.", "I have lost interest in sex completely."),
);


// if (isset($_SESSION['answers']) && is_array($_SESSION['answers'])) { // Check if answers is an array
//   foreach ($_SESSION['answers'] as $index => $value) {
//       echo $_SESSION['answers'][$index];
//   }
// }

$question_number = isset($question_number) ? $question_number : 0;

$answeredQuestions = isset($_SESSION['answers']) ? count($_SESSION['answers']) : 0;
$totalQuestions = count($questions);

if (isset($_SESSION['error'])) {
    echo "<p class='notification error'>".$_SESSION['error']."</p>"; // Display the error message
    unset($_SESSION['error']);
}
?>
  <script src="../js/notify-script.js"></script>

  <!-- HTML Form -->
  <div class="pt-20 mb-10 text-center ">
    <h3 class="text-4xl font-bold text-[#dda44e] tracking-wide">Self-report Questionnaire
    </h3>
    <p class="mt-3 tracking-wider text-base text-gray-400">Beck Depression Inventory (BDI)</p>
  </div>

  <?php
  // PHP code for handling the query parameter to determine the selected question
  if (isset($_GET['question'])) {
    $question_number = (int)$_GET['question'] - 1;
  } else if (isset($_GET['detail'])) {
    $question_number = (int)$_GET['detail'] - 1;
    include("includes/details-modal.php");
  }

  // Assuming $questions is an array containing all your questions
  $selectedQuestion = array_keys($questions)[$question_number];
  $options = $questions[$selectedQuestion];
  ?>

  <div class="xl:px-72 md:px-40 px-10 duration-300">

    <form action="../query/question-loop.php" method="post">

      <!--details-->
      <div class="mb-10">
        <button type="submit" name="details"><img class="w-5 h-auto hover:opacity-50 opacity-70"
            src="../img/details.png" alt="details-img"></button>
      </div>

      <div class="justify-between flex-col-reverse flex lg:flex-row duration-300">
        <h4 class="text-2xl font-bold text-[#dda44e] tracking-wide">
          <?php echo $selectedQuestion; ?>
        </h4>

        <!--circles-->
        <div class="text-center lg:text-end mb-5 lg:mb-0">
          <div class="circle-indicators">
            <?php
  for ($i = 0; $i < $totalQuestions; $i++) {
    $answered = isset($_SESSION['answers'][$i]) && $_SESSION['answers'][$i] != 4;
    $indicatorClass = $answered ? 'circle-indicator answered' : 'circle-indicator';

    if ($i == $question_number) {
      $indicatorClass .= ' current'; // Add 'current' class for the current question
    }

    // Create anchor elements for each circle with a hyperlink to the current page and a query parameter to specify the question number
    echo "<a class='$indicatorClass' href='?question=" . ($i + 1) . "'></a>";
  }
  ?>
          </div>
        </div>
      </div>


      <hr class="mt-5 mb-5">

      <input type="hidden" name="question_number" value="<?php echo ($question_number + 1); ?>">
      <?php
  // Define an array of emoji symbols to represent each option
  $emojis = ["😕", "🙁", "😞", "😭"];

  foreach ($questions[array_keys($questions)[$question_number]] as $index => $option) {
      $checked = (isset($_SESSION['answers'][$question_number]) && $index == $_SESSION['answers'][$question_number]) ? "checked" : "";

      // Output a custom radio-like element with emoji and label
      echo "<label class='emoji-option flex mt-2 items-center cursor-pointer hover:bg-[#636363] rounded-full ease-in-out duration-300 p-2";
      echo $question_number >= 3 ? " sm:block " : "";
      echo "'>";          
      echo "<div class='flex items-center'>";
      echo "<input type='radio' name='answer' value='$index' $checked>";
        echo "<span class='emoji'>$emojis[$index]</span>";
        echo "<span class='text-md text-gray-300 tracking-wide'>$option</span>";
      echo "</div>";
      echo "</label>";
  }
?>
      <hr class="mt-5 mb-5">
      <div class="items-end text-end mt-5 mb-32">
        <?php if ($question_number > 0) { ?>
        <button
          class="hover:border-[#876128] border-2 py-2 px-10 shadow-md tracking-wider rounded-2xl hover:bg-[#febd5b] bg-[#5495C9] font-semibold text-white border-[#2e5679] hover:text-[#002951] transition duration-300 ease-in-out"
          type="submit" name="previous">
          < Previous</button>
            <?php } ?>
            <?php if ($question_number < count($questions) - 1) { ?>
            <button
              class="hover:border-[#876128] border-2 py-2 px-10 shadow-md tracking-wider rounded-2xl hover:bg-[#febd5b] bg-[#5495C9] font-semibold text-white border-[#2e5679] hover:text-[#002951] transition duration-300 ease-in-out"
              type="submit" name="next">Next ></button>
            <?php } else { ?>
            <button
              class="hover:border-[#876128] border-2 py-2 px-10 shadow-md tracking-wider rounded-2xl hover:bg-[#febd5b] bg-[#5495C9] font-semibold text-white border-[#2e5679] hover:text-[#002951] transition duration-300 ease-in-out"
              type="submit" name="submit">Submit</button>
            <?php } ?>
      </div>
    </form>
  </div>

  <?php 
    if (isset($_GET['submit'])) {
      include("includes/confirm-submit.php");
    }
  ?>

</body>

</html>