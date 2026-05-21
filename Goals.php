<!DOCTYPE html>
<html>
<head>
    <title>myMilestone Tracker</title>
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="StyleSheets/Main Page.css">
    <link rel="stylesheet" href="StyleSheets/GoalsStyle.css">
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
        <h1>Goals</h1>
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
    <form method="post" action="create_goal.php">
        <h3><label for="content">New Goal</label></h3>
        <br>
        <textarea id='cEntry' placeholder="Create New Goal" name="entries" required></textarea>
        <br>
        <button id='CrtBtn' type='submit'>Create</button>
    </form>
    <ul>
        <?php
            require_once 'Login-1/dbh.inc.php';
            //require_once  'GoalCompleted.php';


            if (isset($_SESSION['Username'])) {
                $username = $_SESSION['Username'];
            }

            $query = "SELECT goal_id, entries, entryDate, completed FROM goalentries WHERE Username = :username";
            
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            
            $content = $stmt->fetchAll(PDO::FETCH_ASSOC); 

            foreach ($content as $row): 
        ?>
                <li>
                    <h3>Entry <?php echo htmlspecialchars($row['entryDate']); ?></h3>
                    <textarea id="goals" readonly><?php echo htmlspecialchars($row['entries']); ?></textarea>
                    <form method="post" action="GoalCompleted.php">
                        <input type="hidden" name="goal_id" value="<?php echo $row['goal_id']; ?>">
                        <label for="completed">Mark as completed</label>
                        <input type="checkbox" name="completed" value="1" <?php echo $row['completed'] ? 'checked' : ''; ?>>
                        <button type="submit" id='CrtBtn'>Save Changes</button>
                    </form>
                    <br><br>
                </li>
        <?php 
            endforeach; 
        ?>
    </ul>
</main>
<footer>
    <p></p>
</footer>
</body>
</html>