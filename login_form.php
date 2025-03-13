<?php

@include 'config.php';

session_start();

//If form has been submitted
if(isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);


    //Executes a query to check if there is already a user with the same email and password
    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);


    if(mysqli_num_rows($result) > 0) {
        
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if($row['user_type'] == 'admin'){

            $_SESSION['admin_name'] = $row['name'];
            header('location:admin_page.php');

        } 
        elseif($row['user_type'] == 'user'){

            $_SESSION['user_name'] = $row['name'];
            header('location:user_page.php');
        }

    }
    else{
        $error[] = 'Incorrect email or password!';
    }
}


?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            // Toggle the type attribute of the password field
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle the eye icon
            this.src = type === 'password' ? 'icons/eye.png' : 'icons/eye-close-up.png';
        });
    });
</script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>

    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="form-container">
    <form action="" method="post">
        <h3>Login Now</h3>
        <?php
        if(isset($error)) {
            foreach($error as $error) {
                echo '<span class="error-msg">'.$error.'</span>';
            }
        }

        ?>
        <input type="text" name="email" required placeholder="Enter Your Email">

        <div class="password-container">
            <input type="password" name="password" id="password" required placeholder="Enter Your Password">
            <img src="icons/eye.png" id="togglePassword" class="toggle-password" alt="Show/Hide Password">
        </div>

        <input type="submit" name="submit" value="Login Now" class="form-btn">
        <p>Don't have an account? <a href="register_form.php">Register Now</a></p>


    </form>
</div>


    
</body>
</html>