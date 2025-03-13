<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
    header('location:login_form.php');
}

if(isset($_POST['submit'])) {
    $question = mysqli_real_escape_string($conn2, $_POST['question']);
    $answer_a = mysqli_real_escape_string($conn2, $_POST['answer_a']);
    $answer_b = mysqli_real_escape_string($conn2, $_POST['answer_b']);
    $answer_c = mysqli_real_escape_string($conn2, $_POST['answer_c']);
    $answer_d = mysqli_real_escape_string($conn2, $_POST['answer_d']);
    $correct_answer = mysqli_real_escape_string($conn2, $_POST['correct_answer']);
    $category = mysqli_real_escape_string($conn2, $_POST['category']);
    $difficulty = mysqli_real_escape_string($conn2, $_POST['difficulty']);
    
    $query = "INSERT INTO problems (question, answer_a, answer_b, answer_c, answer_d, correct_answer, category, difficulty)
                  VALUES ('$question', '$answer_a', '$answer_b', '$answer_c', '$answer_d', '$correct_answer', '$category', '$difficulty')";
    
    if(mysqli_query($conn2, $query)) {
        $success = "Problem successfully created!";
        header('location:admin_page.php');
    } 
    else {
        $error = "Error: " . mysqli_error($conn2);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <link rel="stylesheet" href="css/style.css">

</head>
<body>


<div class="container">

    <!-- <section class="wrapper">
        <div id="stars"></div>
        <div id="stars2"></div>
        <div id="stars3"></div>
    </section> -->

    <div class="content">
        <h3>Hi, <span><?php echo $_SESSION['admin_name']?></span></h3>
        <h1>Welcome!</h1>
        <p>This is an admin page</p>
        <a href="logout.php" class="btn">Logout</a>
    </div>

</div>

<div class="form-container">
    <form action="" method="post">
        <h3>Create Problem</h3>
        <?php
        if(isset($error)) {
            foreach($error as $error) {
                echo '<span class="error-msg">'.$error.'</span>';
            }
        }

        ?>
        <textarea name="question" required placeholder="Enter Problem Question" rows="1" class="question-input"></textarea>
        <input type="text" name="answer_a" required placeholder="Enter Answer Choice A">
        <input type="text" name="answer_b" required placeholder="Enter Answer Choice B">
        <input type="text" name="answer_c" required placeholder="Enter Answer Choice C">
        <input type="text" name="answer_d" required placeholder="Enter Answer Choice D">

        <select name="correct_answer">
            <option value="" disabled selected>Select Correct Answer</option>
            <option value="a">A</option>
            <option value="b">B</option>
            <option value="c">C</option>
            <option value="d">D</option>
        </select>

        <input type="text" name="category" required placeholder="Enter Problem Category">

        <select name="difficulty">
            <option value="" disabled selected>Select Difficulty</option>
            <option value="easy">Easy</option>
            <option value="medium">Medium</option>
            <option value="hard">Hard</option>
        </select>

        <input type="submit" name="submit" value="Create Problem" class="form-btn">
    </form>
</div>




<script>
    const textarea = document.querySelector('.question-input');
    
    textarea.addEventListener('input', function() {
        this.style.height = 'auto'; // Reset the height
        this.style.height = this.scrollHeight + 'px'; // Set the height to the scroll height
    });
</script>

</body>
</html>