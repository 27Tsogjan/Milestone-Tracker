<!DOCTYPE html>
<html lang="en">
<head>
    <title>myMilestone Tracker</title>
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="StyleSheets/Main Page.css">
    <link rel="stylesheet" href="StyleSheets/TimelineStyle.css">
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
        <h1>Timeline</h1>
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
    <div class="timeline">
        <?php

            require_once 'Login-1/dbh.inc.php';

            if (isset($_SESSION['Username'])) {
                $username = $_SESSION['Username'];
            

                $query = "SELECT goal_id, entries, entryDate FROM goalentries WHERE completed = 1 AND Username = :username"; // Only completed goals (completed = 1)
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->execute();

                $count = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $goal_id = $row['goal_id'];
                    $entry_text = $row['entries'];
                    $entry_date = $row['entryDate'];

                    if($count% 2 ==0) {
                        echo'<div class="container left">';
                    }
                    else {
                        echo'<div class="container right">';
                    }
                    echo'<div class="content">';
                    echo"<h2>".date('Y', strtotime($entry_date))."</h2>";
                    echo'<p>'.htmlspecialchars($entry_text).'</p>';
                    echo'</div>';
                    echo'</div>';

                    $count++;
                }
            }
        ?>
    </div>
</main>
<footer>
    <p></p>
</footer>
</body>
</html>