<?php

declare(strict_types=1);

function get_user(object $pdo, string $username) {
    // select not only username but every column from within table

    $query = "SELECT * FROM registration WHERE Username = :username;";
   
    $stmt = $pdo -> prepare($query);
    $stmt -> bindParam(":username", $username);
    $stmt -> execute();

    // get top result from database
    $result = $stmt -> fetch(PDO::FETCH_ASSOC);

    if ($result === false) {
        echo "No user found with that username.<br>";
        return false;  // Return false if no user was found
    }

    echo "Username: " . $result['Username'] . "<br>";
    //echo "user_password: " . $result['user_password'] . "<br>";
    //echo "salt: " . $result['salt'] . "<br>";
    var_dump($result); // This will show the structure of $result and all its data

if (isset($result['id'])) {
    echo "User ID: " . $result['id'];
} else {
    echo "User ID is not set.";
}
    return $result;
}