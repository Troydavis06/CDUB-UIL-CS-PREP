<?php

?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>

    <link rel="stylesheet" href="css/credits.css">
</head>

<body>
    <header class="header">
    <a href="#" class="logo">
        <img src="https://www.txhslogoproject.com/wp-content/uploads/2018/12/Cypress-Woods-Wildcats1-large.png" alt="Logo" class="logo-img">
        <span>CDUB UIL CS Prep</span>
    </a>
        
        <nav class="navbar">
            <a href="landing.php">Home</a>
            <a href="credits.php" class="active">Credits</a>
            <a href="login_form.php" class="login-btn">Login</a> 
        </nav>
    </header>


    <section class="credits-section">
        <div class="team-member">
            <img src="images/member1.jpg" alt="Profile Picture 1" class="team-photo">
            <div class="member-info">
                <h2>Troy Davis</h2>
                <p>Goat</p>
            </div>
        </div>

        <div class="team-member">
            <img src="images/member2.jpg" alt="Profile Picture 2" class="team-photo">
            <div class="member-info">
                <h2>Henry Fong</h2>
                <p>O' Hanlon Lover</p>
            </div>
        </div>

        <div class="team-member">
            <img src="images/member3.jpg" alt="Profile Picture 3" class="team-photo">
            <div class="member-info">
                <h2>Nikhil Shanmugham</h2>
                <p>i love henry fong</p>
            </div>
        </div>
    </section>
    


    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const header = document.querySelector('.header');
            const homeSection = document.querySelector('.home');
            homeSection.style.marginTop = header.offsetHeight + 'px';
        });
    </script>


</body>


</html>