<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
}

if (!$conn2) {
    die('Connection failed: ' . mysqli_connect_error());
}

$_SESSION['sidebar_collapsed'] = false;

// Fetch unique categories from the problems table
$query_categories = "SELECT DISTINCT category FROM problems";
$result_categories = mysqli_query($conn2, $query_categories);

$categories = mysqli_fetch_all($result_categories, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel="stylesheet" href="css/user.css">
</head>
<body>

<div class="wrapper">
    <nav class="sidebar expanded">
        <div class="sidebar-header">
            <h3>CDUB UIL CS Prep</h3>
        </div>

        <ul class="components">
            <li><a href="user_page.php">Problems</a></li>
            <li><a href="leaderboard.php">Leaderboard</a></li>
            <li><a href="history.php">History</a></li>
            <li><a href="logout.php" class="btn-logout">Logout</a></li>
        </ul>
    </nav>

    <div class="sidebar-toggle"></div>

    <div class="content">
        <div class="content-wrapper">
            <h1>Select Category and Difficulty</h1>
            <!-- Table for displaying categories and difficulty buttons -->
            <table>
                <thead>
                    <tr>
                        <th>Category</th>
                        <th colspan="4">Difficulty</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <!-- Display the category name -->
                            <td><?php echo $category['category']; ?></td>
                            
                            <!-- Easy Button -->
                            <td>
                                <a href="problems.php?category=<?php echo urlencode($category['category']); ?>&difficulty=easy" class="btn-difficulty">Easy</a>
                            </td>

                            <!-- Medium Button -->
                            <td>
                                <a href="problems.php?category=<?php echo urlencode($category['category']); ?>&difficulty=medium" class="btn-difficulty">Medium</a>
                            </td>

                            <!-- Hard Button -->
                            <td>
                                <a href="problems.php?category=<?php echo urlencode($category['category']); ?>&difficulty=hard" class="btn-difficulty">Hard</a>
                            </td>

                            <!-- Random Button -->
                            <td>
                                <a href="problems.php?category=<?php echo urlencode($category['category']); ?>&difficulty=random" class="btn-difficulty">Random</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const sidebar = document.querySelector('.sidebar');
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebarWidth = 275;

    let isSidebarCollapsed = false;

    sidebarToggle.addEventListener('click', function() {
        isSidebarCollapsed = !isSidebarCollapsed;

        if (isSidebarCollapsed) {
            sidebar.classList.add('collapsed');
        } else {
            sidebar.classList.remove('collapsed');
        }
    });

    setTimeout(() => {
        sidebarToggle.style.opacity = '0';
    }, 6000);

    document.addEventListener('mousemove', function(e) {
        const mouseX = e.clientX;

        if (isSidebarCollapsed) {
            if (mouseX <= 50) {
                sidebarToggle.style.opacity = '1'; 
            } else {
                sidebarToggle.style.opacity = '0'; 
            }
        } else {
            if (mouseX >= sidebarWidth - 50 && mouseX <= sidebarWidth) {
                sidebarToggle.style.opacity = '1'; 
            } else {
                sidebarToggle.style.opacity = '0'; 
            }
        }
    });
</script>

</body>
</html>
