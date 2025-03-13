<?php
@include 'config.php';

// Fetch the problem label, category, and difficulty from URL parameters
$problem_label = $_GET['problem_label'];
$category = $_GET['category'];
$difficulty = $_GET['difficulty'];

// Extract the problem number from the problem label (e.g., E1, M2, H3)
$problem_number = (int) preg_replace('/[^0-9]/', '', $problem_label);  // Extract the number from the label

// Fetch the list of problems for the specific category and difficulty
$query = "SELECT * FROM problems WHERE category = '$category' AND difficulty = '$difficulty' ORDER BY id ASC";
$result = mysqli_query($conn2, $query);
$problems = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Counters for difficulty-level problem identification
$easy_counter = 1;
$medium_counter = 1;
$hard_counter = 1;

// Find the matching problem using the label and the counter for the respective difficulty
$problem = null;

foreach ($problems as $prob) {
    if ($prob['difficulty'] === 'easy' && $difficulty === 'easy' && $easy_counter === $problem_number) {
        $problem = $prob;
        break;
    } elseif ($prob['difficulty'] === 'medium' && $difficulty === 'medium' && $medium_counter === $problem_number) {
        $problem = $prob;
        break;
    } elseif ($prob['difficulty'] === 'hard' && $difficulty === 'hard' && $hard_counter === $problem_number) {
        $problem = $prob;
        break;
    }

    // Increment the counter for each difficulty
    if ($prob['difficulty'] === 'easy') {
        $easy_counter++;
    } elseif ($prob['difficulty'] === 'medium') {
        $medium_counter++;
    } elseif ($prob['difficulty'] === 'hard') {
        $hard_counter++;
    }
}

if (!$problem) {
    die('Problem not found.');
}

$feedback = ''; // Initialize feedback variable

// Check if the form is submitted and if the 'answer' key exists in the POST array
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'])) {
    $selected_answer = $_POST['answer'];

    // Check if the selected answer is correct
    if ($selected_answer === $problem['correct_answer']) {
        $feedback = 'Correct! Well done!';
    } else {
        $feedback = 'Wrong answer. Try again!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($problem['category']); ?> (<?php echo $problem_label; ?>)</title>
    <link rel="stylesheet" href="css/problem_details.css">
</head>
<body>

    <div class="question-container">
        <h1><?php echo $problem_label; ?></h1>
        <div class="question-text">
            <p><?php echo $problem['question']; ?></p>
        </div>

        <form method="post">
            <div class="answers">
                <label><input type="radio" name="answer" value="a"> A) <?php echo $problem['answer_a']; ?></label><br>
                <label><input type="radio" name="answer" value="b"> B) <?php echo $problem['answer_b']; ?></label><br>
                <label><input type="radio" name="answer" value="c"> C) <?php echo $problem['answer_c']; ?></label><br>
                <label><input type="radio" name="answer" value="d"> D) <?php echo $problem['answer_d']; ?></label><br>
            </div>
            <button type="submit">Submit Answer</button>
        </form>

        <p><?php echo $feedback; ?></p>

        <!-- Navigation buttons -->
        <div class="navigation">
            <!-- Navigation will need custom handling based on the problem_label and actual difficulty -->
            <?php // Add Previous and Next navigation buttons if needed ?>
        </div>
    </div>

</body>
</html>
