<?php

@include 'config.php';

//If form has been submitted
if(isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['passwordc']);
    $user_type = $_POST['user_type'];


    //Executes a query to check if there is already a user with the same email and password
    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0) {
        $error[] = 'user already exist!';

    }
    else {
        if($pass != $cpass) {
            $error[] = 'password not matched';
        }
        else {
            //Creates a new user
            $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name', '$email', '$pass', '$user_type')";
            mysqli_query($conn, $insert);
            header('location:login_form.php');
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register form</title>

    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="form-container">
    <form action="" method="post">
        <h3>Register Now</h3>
        <?php
        if(isset($error)) {
            foreach($error as $error) {
                echo '<span class="error-msg">'.$error.'</span>';
            }
        }

        ?>
        <input type="text" name="name" required placeholder="Enter Your Name">
        <input type="email" name="email" required placeholder="Enter Your Email">
        <input type="password" name="password" required placeholder="Enter Your Password">
        <input type="password" name="passwordc" required placeholder="Confirm Your Password">
        <select name="user_type">
            <option value="user">user</option>
            <option value="admin">admin</option>
        </select>
        <input type="submit" name="submit" value="Register Now" class="form-btn">
        <p>Already have an account? <a href="login_form.php">Login Now</a></p>
    </form>
</div>


    
</body>
</html>