<?php
declare(strict_types=1);

//model, view control ..
// model - only querying, submitting, updating, deleting data; only interacting with database

// allow type declarations - 
// don't need to do; prevent more errors due to typos/submitting more data;

// don't need to declare type in PHP but here we do
// in order to prevent any declaration that would provide inappropriate type

// can also specify return type using :bool for example
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

function is_username_taken(object $pdo, string $username)
{
    // filter_var is a built-in function in PHP.
    // FILTER_VALIDATE_EMAIL is a built-in email validation
    // produce error if username is taken
    if (get_username($pdo, $username)) {
        // go inside the if condition to check IS the username inside the DB
        // if it IS, then we return this condition as true
        // if it is NOT, then we return this as FALSE
        echo "Username taken <br>";
        return true;
    }
    // not an error if username is NOT taken
    else
    {
        echo "Username not taken <br>";
        return false;
    }
    return get_username($pdo, $username);
    // then we go back and 
}

function create_user(object $pdo, string $first_name, string $username, string $passw)
{
    echo "Inside create_user<br>";
    set_user($pdo, $first_name, $username, $passw);
}