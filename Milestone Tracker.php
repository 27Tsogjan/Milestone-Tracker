<!DOCTYPE html>
<html lang="en">
<head>
    <title>myMilestone Tracker</title>
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="StyleSheets/Main Page.css">
    <link rel='icon' type="image.png" href="Images/download.png">
</head>
<body>
<?php
    session_start();
    include('Login-1/LoginAuth.php');
?>
<header>
    <a href="Milestone Tracker.php"><img id='logo' src="Images/download.png"></a>
    <div class='w3-display-topmiddle w3-padding-small'>
        <h1>Home</h1>
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
    <h1 id='Welcome'>Welcome to myMilestone!</h1>
    <p id='Welcome'>We're excited to have you here! myMilestone is designed to help you achieve your goals and track your progress in one place. </p>
        <ul>
            <li id='Welcome'><p>Calendar: Keep track of dates, deadlines, and milestones.</p></li>
            <li id='Welcome'><p>Goals: Set and track personal or professional goals.</p></li>
            <li id='Welcome'><p>Timeline: Review your progress and achievements over time.</p></li>
        </ul>
    <p id='Welcome'>myMilestone is here to help you stay on track and motivated.</p></p>
</main>
<footer>
    <p></p>
</footer>
</body>
</html>