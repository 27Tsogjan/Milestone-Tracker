<?php
declare(strict_types=1);

function is_input_empty(string $username, string $pwd)
{
    // check to see if any one of these variables is empty
    // or has data inside of them ..
    // OR is another one of these empty
    // then we want to run a certain block of code
    if (empty($username) || empty($pwd)) {
        return true;
    }
    // else return a false boolean . 
    else {
        return false;
    }
}
function is_username_wrong($result) {
// if no user in DB, then that would return as boolean
// rather than results
    //echo "here<br>";
    if ($result == false) {
        return true;
    } else {
        return false;
    }
}

function is_password_wrong(string $pwd, string $hashedPwd)
{
    /*$options=[
        'cost' => 12
    ];*/
    // check if password matches DB data
   // echo "is_password_wrong? " . (password_hash($pwd,PASSWORD_DEFAULT)) . "<br>";

    //if (!password_verify(password_hash($pwd, PASSWORD_BCRYPT), $hashedPwd)) {
    if (!password_verify($pwd, $hashedPwd)) {
        return true;
    } else {
        return false;
    }
}

function logout() {
    session_start();
    session_unset();
    session_destroy();
    header('Location: ../loginPage.php?message=logged_out');
    exit();
}
?>