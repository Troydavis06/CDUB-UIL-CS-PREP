<?php
@include 'config.php';

$category = $_GET['category'];
$difficulty = $_GET['difficulty'];

// Prepare the base query
$query = "SELECT * FROM problems WHERE category = '$category'";

// If difficulty is not random, add the difficulty filter
if ($difficulty !== 'random') {
    $query .= " AND difficulty = '$difficulty'";
}

// Execute the query
$result = mysqli_query($conn2, $query);
$problems = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Create counters for each difficulty level
$easy_counter = 1;
$medium_counter = 1;
$hard_counter = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problems for <?php echo ucfirst($category); ?> (<?php echo ucfirst($difficulty); ?>)</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Problems for <?php echo ucfirst($category); ?> (<?php echo ucfirst($difficulty); ?>)</h1>

    <?php if (count($problems) > 0): ?>
        <ul class="problem-list">
            <?php foreach ($problems as $problem): ?>
                <?php
                // Generate problem label based on difficulty and increment the appropriate counter
                if ($problem['difficulty'] === 'easy') {
                    $problem_label = $category . "_E" . $easy_counter;
                    $easy_counter++;
                } elseif ($problem['difficulty'] === 'medium') {
                    $problem_label = $category . "_M" . $medium_counter;
                    $medium_counter++;
                } elseif ($problem['difficulty'] === 'hard') {
                    $problem_label = $category . "_H" . $hard_counter;
                    $hard_counter++;
                }
                ?>

                <li>
                    <!-- Pass the problem label and actual difficulty -->
                    <a href="problem_details.php?problem_label=<?php echo urlencode($problem_label); ?>&category=<?php echo $category; ?>&difficulty=<?php echo $problem['difficulty']; ?>">
                        <?php echo $problem_label; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No problems found for this category and difficulty.</p>
    <?php endif; ?>
</body>
</html>
