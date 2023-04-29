<?php

require "vendor/autoload.php";

session_start();

// 4.

use App\QuestionManager;

$score = null;
try {
    $manager = new QuestionManager;
    $manager->initialize();

    if (!isset($_SESSION['answers'])) {
        throw new Exception('Missing answers');
    }
    $score = $manager->computeScore($_SESSION['answers']);
} catch (Exception $e) {
    echo '<h1>An error occurred:</h1>';
    echo '<p>' . $e->getMessage() . '</p>';
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz</title>
</head>
<body>

<h1>Thank You</h1>

<p style="color: gray">
    You've completed the exam.
</p>

<h2>
    Congratulations <?php echo $_SESSION['user_fullname']; ?>!
    <br>
    Email: <?php echo $_SESSION['user_email']; ?>
    <br>
    Gender: <?php echo $_SESSION['user_gender']; ?>
    <br>
    Birthday: <?php echo $_SESSION['user_birthdate']; ?>
    <br>
    <br>
    Your score is <?php echo $score; ?> out of <?php echo $manager->getQuestionSize() ;?></h3>
    

<!-- Display the results and the user's score -->
    <h3>Your Answers:</h2>
    
    <ol>
    <?php echo '<li>'.implode("</li><li>", $_SESSION['answers']).'</li>'?>
    </ol>

</body>
</html>

<!-- DEBUG MODE -->
<pre>
<?php
var_dump($_SESSION);
?>
</pre>