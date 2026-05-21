<!DOCTYPE html>
<html>
<head>
    <title>myMilestone Tracker</title>
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="StyleSheets/Main Page.css">
    <link rel="stylesheet" href="StyleSheets/CalenderStyle.css">
    <link rel='icon' type="image.png" href="Images/download.png">
</head>
<body>
<?php
    session_start();
    include('Login-1/LoginAuth.php');
    date_default_timezone_set('America/Chicago');
?>
<header>
    <a href="Milestone Tracker.php"><img id='logo' src="Images/download.png"></a>    
    <div class='w3-display-topmiddle w3-padding-small'>
        <h1>Calender</h1>
    </div>
    <div class='w3-display-topright w3-padding-small'>
        <form method="post" action="Login-1/logout.php">
            <button class='w3-button w3-red w3-round w3-padding-small'>Sign Out</button>
        </form>
    </div>
</header>
<nav class='w3-bar w3-card-4'>
    <a href="Milestone Tracker.php" class="w3-bar-item w3-button" id='navBar'>Home</a>
    <a href="Calender.php" class="w3-bar-item w3-button" id='navBar'>Calender</a>
    <a href="Goals.php" class="w3-bar-item w3-button" id='navBar'>Goals</a>
    <a href="Timeline.php" class="w3-bar-item w3-button" id='navBar'>Timeline</a>
</nav>
<main>
    <div class='month'>
        <ul>
            <li>
                <?php
                echo date('F');
                echo '<br>';
                echo date('Y');
                ?>
            </li>
        </ul>
    </div>
    <ul class="weekdays">
        <li>Mo</li>
        <li>Tu</li>
        <li>We</li>
        <li>Th</li>
        <li>Fr</li>
        <li>Sa</li>
        <li>Su</li>
    </ul>
    <ul class='days'>
    <?php
    for($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); $i++) {
        if($i == date('d')){
            echo '<li>';
            echo '<span class="active">';
            echo $i;
            echo '</span>';
            echo '</li>';
        }
        else {
            echo '<li>';
            echo $i;
            echo '</li>';
        }
    }
    ?>
    </ul>
</main>
<footer>
    <p></p>
</footer>
</body>
</html>
