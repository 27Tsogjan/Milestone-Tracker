<?php

// see if user accesses page legitimately
// check for request method, which is going to be POST

// if the request method is a post method,
// that means user DID get here correctly. 
//if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["Username"];
    $pwd = trim($_POST["user_password"]);
    $first_name = $_POST['fname'];

    echo htmlspecialchars($username);

    // no sanitation
    // no doing html special characters until outputs something
    //htmlspecialchars();

    try {
        // code ..
        // thus we want to run a PDO exception with a
        // variable $e, which is the exception
        echo "test<br>";
        require_once 'dbh.inc.php';
        echo "test1<br>";

        require_once 'signup_model.inc.php';
        echo "test2<br>";

    //    require_once 'signup_view.inc.php';
        require_once 'signup_contr.inc.php';
        echo "test3<br>";

        require_once 'manualHashing.inc.php';
        echo "test4<br>";

        // ERROR HANDLERS - way for us to go in and actually do
        // any sort of prevention to make sure things are running
        // appropriately ..
        $errors = [];   // what we'll do is if there is an error inside any one of
        // these conditions; then we assign this error insde this array up here.
        // so we get a bunch of data within this array and depending on how many
        // errors we get inside this array, then that means we get an error; then we
        // get prevent signing up of user
        if (is_input_empty($first_name, $username, $pwd)) {
            // at this point, we're to wait w/ putting in code inside this condition
            // may not make sense until later on
            $errors["empty_input"] = "Fill in all fields.";
        }
        // second function that checks for something else
        // see if there's an invalid email
    
        if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Username taken";
        }

        require_once 'config_session.inc.php';

        if($errors) {
            $_SESSION["errors_signup"] = $errors;
            $signupData = [
                "username" => $username,
            ];
            $_SESSION["signup_data"] = $signupData;

            $_SESSION["registrationStatus"] = "failure";

            header("Location: ../Sign Up Page.php");
            die();
        }
        echo "Begin create_user<br>";
        //echo "pdo: $pdo<br>";
        echo $pdo->getAttribute(constant("PDO::ATTR_CONNECTION_STATUS")) . "<br>";
        echo "fname: $first_name<br>";
        echo "username: $username<br>";
        echo "passw: $pwd<br>";

        $salt = bin2hex(random_bytes(16));
        echo "salt: $salt<br>";

        //$hashedPassw= password_hash($passw, PASSWORD_BCRYPT);
        $hashedPassw = manualHash($pwd, $salt);
        echo "Finished Hashing<br>";
        //$hashedPassw= $passw;
    
        //create_user($pdo,  $username,  $passw,  $email,  $phone);

        $query='INSERT INTO registration(first_name, Username, user_password, salt) VALUES (:fname, :username, :passw, :salt);';
        echo "Construct query<br>";

        //$hashedPassw= password_hash($pwd, PASSWORD_BCRYPT);
        //$hashedPassw= $passw;
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":fname", $first_name);
        echo "Construct query 1<br>";

        $stmt->bindParam(":username",$username);
        echo "Construct query 2<br>";

        $stmt->bindParam(":passw",$hashedPassw);
        echo "Construct query 3<br>";

        $stmt->bindParam(":salt",$salt);
        
        echo 'query constructed<br>';

        echo "pdo prepared<br>";

        /*$options=[
            'cost' => 12
        ];*/
        echo "password: $pwd<br>";
       // $hashedPassw= password_hash($pwd, PASSWORD_BCRYPT);
        echo "hashedPassw: $hashedPassw<br>";
    
        echo "stmt bindParam finished<br>";

        echo "$query<br>";

        $stmt->execute();
        echo "stmt->executed";

        $_SESSION["registrationStatus"] = "success";

        header("location: ../loginPage.php?signup=success");

        $pdo = null;
        $stmt = null;

        die();
        // because in this file we already have a session started.

    // best not to do 
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
//}
// if they did not get here correctly
/*else
{
    // access the PHP file in order to send it back to the front page
    header("Location: ../indexPHP.php");
    die();  // die function to stop the script from running
}*/