<?php
declare(strict_types=1);    // allow type declarations;
                            // this is something we allow inside code

//model, view control ..
// model - only querying, submitting, updating, deleting data; only interacting with database

// allow type declarations - 
// don't need to do; prevent more errors due to typos/submitting more data;

// only file allowed to do queries

//require_once 'dbh.inc.php'

// at this point, need to run PDO connection

function check_signup_errors()
{
    if (isset($_SESSION['errors_signup'])) {
        $errors = $_SESSION['errors_signup'];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="form-error"></p>' . $error . '</p>';
        }

        unset($_SESSION['errors_signup']);
    }
}
function get_username(object $pdo, string $username)
{
    $query = "SELECT Username FROM registration WHERE Username = :username;";
    // send in query separately; separate user from query
    // prevents SQL injection
    $stmt = $pdo -> prepare($query);
    $stmt -> bindParam(":username", $username);

    // query database using execute statement
    $stmt -> execute();

    // grab only 1 piece of data from database (different from fetchall)
    // fetch as FETCH_ASSOC - meaning associative array; means we refer
    // refer to the data ; we can basically take this data and return it
    $result = $stmt -> fetch(PDO::FETCH_ASSOC);
    echo "result:" . $result . "<br>";

    // return the variable as result. Which means when we run this function,
    // we grab data OR when the username does NOT exist, we get a false statement
    return $result;
}

function set_user(object $pdo, string $first_name, string $username, string $passw)
{
    // grab connection to database
    echo "username: " | $username | "\n";

    require_once "dbh.inc.php";  // link to file
    echo "Begin insert. <br>";
    $query="INSERT INTO registration(first_name, Username, user_password, salt) VALUES (:fname, :username, :passw, :salt);";
    
    $stmt = $pdo->prepare($query);

    /*$options=[
        'cost' => 12
    ];*/
    $salt = bin2hex(random_bytes(16));
    //$hashedPassw= password_hash($passw, PASSWORD_BCRYPT);
    $hashedPassw = manualHash($passw, $salt);
    //$hashedPassw= $passw;

    $stmt->bindParam(":fname",$first_name);
    $stmt->bindParam(":Username",$username);
    $stmt->bindParam(":passw",$hashedPassw);
    $stmt->bindParam(":salt",$salt);

    $stmt->execute();
}