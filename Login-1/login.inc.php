<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["Username"];
    $pwd = trim($_POST["user_password"]);

    try {
        echo "test1<br>";

        require_once 'dbh.inc.php';
        echo "test2<br>";

        require_once 'login_model.inc.php';
        echo "test3<br>";

        require_once 'login_contr.inc.php';
        echo "finish test<br>";

        require_once 'manualHashing.inc.php';

        $errors = [];

        if (is_input_empty($username, $pwd)) {
            // at this point, we're to wait w/ putting in code inside this condition
            $errors["empty_input"] = "Fill in all fields.";
        }
        
        echo "Begin get_user<br>";
        $result = get_user($pdo, $username);
        
        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        //echo "pwd: " . password_hash($pwd, PASSWORD_BCRYPT) . "<br>";
        echo "pwd: " . $pwd . "<br>";

        echo "stored pwd: " . $result["user_password"] . "<br>";
        echo "salt: " . $result["salt"] . "<br>";
        //echo "hashedPwd: " . password_hash($pwd, PASSWORD_BCRYPT) . "<br>";

        // see if password from user input matches PW from DB query
        //if (!is_username_wrong($result) && is_password_wrong($pwd, $result["Passw"])) {
        if (!is_username_wrong($result) && !verifyHash($pwd, $result["salt"], $result["user_password"])) {
            $errors["login_incorrect"] = "Incorrect password for user!";
            echo "Incorrect password<br>";
        }
                
        // grab session config file, which goes in and updates session ID
        // which been awhile goes in and updates cookie; inside browser
        // session security
        echo "Begin config_session<br>";
        require_once 'config_session.inc.php';
        echo "End config_session<br>";

        // if use types wrong into login form needs to resubmit
        // unlike signup, which if there was only 1 thing incorrect;
        // then don't want them to retype everything again
        if($errors) {
            // Store errors in the session
            $_SESSION["loginStatus"] = "failure";

            $_SESSION["errors_login"] = $errors;

            $_SESSION["login_data"] = ["username" => $username];

            // Redirect to the login page
            header("Location: ../loginPage.php");
            exit();
        }

        // This is not a session regenenerate id,
        // which only regenerates existing ID.
        // This is actually a session CREATE ID.
        $newSessionId = session_create_id();    // thus we can simply append
                                                // user-created ID to created
        // append ID of the user with our session ID
        $sessionID = $newSessionID . "_" . $result["id"];
        session_id($sessionID);   // which sets our session ID equal to ID that we give it
                        // inside the parentheses here

        // if user exists with the right control. Set up user inside
        // privileged area within website
        $_SESSION["acount_id"] = $result["id"];
        $_SESSION["Username"] = htmlspecialchars($result["Username"]);

        // reset the time after login as well
        $_SESSION["last_regeneration"] = time();

        $_SESSION["loginStatus"] = "success";

        header("Location: ../Milestone Tracker.php?login=success");
        $pdo = NULL;
        $statement = NULL;
        
        exit();
    } catch(PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
// if user did not submit a "POST" request
// (ie. access the page legitimately)
else {
    header("Location: ../Milestone Tracker.php");    // send to front page
    die();  // kill off script
}