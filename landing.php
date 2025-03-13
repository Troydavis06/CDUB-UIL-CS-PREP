<?php

?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>

    <link rel="stylesheet" href="css/landing.css">
</head>

<body>
    <header class="header">
    <a href="#" class="logo">
        <img src="https://www.txhslogoproject.com/wp-content/uploads/2018/12/Cypress-Woods-Wildcats1-large.png" alt="Logo" class="logo-img">
        <span>CDUB UIL CS Prep</span>
    </a>
        
        <nav class="navbar">
            <a href="landing.php" class="active">Home</a>
            <a href="credits.php">Credits</a>
            <a href="login_form.php" class="login-btn">Login</a>
            
        </nav>

    </header>

    <section class="home">
        <div class="home-content">
            <h1>Welcome to <span>CDUB UIL CS PREP!</span></h1>
            <p>State Champs Made Here!</p>
        </div>
    </section>

    <div id="bg"></div>
        <script type="text/javascript" src="js/particles.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>



    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const header = document.querySelector('.header');
            const homeSection = document.querySelector('.home');
            homeSection.style.marginTop = header.offsetHeight + 'px';
        });
    </script>


</body>


</html>