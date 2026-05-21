<?php
// to make more secure while in session (mandatory when in sessions)
// can change in php.ini file as well
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

// accept array inside params; change lifetime of cookie,
// change domain to work on; any sort of subpaths
session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost', // prevent cookie theft
    'path' => '/',      // any sort of subdirectory within website currently running within domain
    'secure' => true,    // for https; only use cookie inside secure connection
    'httponly' => true  // restricts access from client; prevents use of scripts (like Javascript)
]);

session_start();

echo "Begin session<br>";
// accept array inside params; change lifetime of cookie,
// change domain to work on; any sort of subpaths
$_SESSION["currSession"]=empty($_SESSION["currSession"]) ? 0 : $_SESSION["currSession"];
echo $_SESSION["currSession"] . "<br>";

// for login; nested ;
// check first to see if we have a session variable that is 
// = to user_id;
// haven't created yet user_id. This is something we WILL create
// when have user IN instead of login.inc.php file; just note that we
// WILL have a user_id when the user is logged in
if (isset($_SESSION["$user_id"])) {

    // for when user IS logged in. But instead of regenerate_session_id()
        // get code to run when user is NOT logged in;
    // this is the sign in
    if (!isset($_SESSION["last_regeneration"])) {
        regenerate_session_id(); // make id better and even more secure IITLW .. 
    } else {
        $interval = 10;
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerate_session_id();
            
        }
        else
        {
            $interval = 10;
            if (time() - $_SESSION["last_renegeration"] >= $interval) {
                regenerate_session_id();
            }
        }
    }
} else {
    // get code to run when user is NOT logged in;
    // this is the sign in
    if (isset($_SESSION["last_regeneration"])) {
        regenerate_session_id();
    } else {
        $interval = 10;
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerate_session_id();
        }
        else
        {
            $interval = 10;
            if (time() - $_SESSION["last_renegeration"] >= $interval) {
                regenerate_session_id();
            }
        }
    }
}

function regenerate_session_id() {
    session_regenerate_id();                    // when is the last time we went and updated session ID? 
                                                    // Because that is going to be the last session timestamp in session ID
    $_SESSION["last_regeneration"] = time();    // time simply gets the current
                                                // time in the server
    $_SESSION["currSession"]++;
}

function regenerate_session_id_loggedin() {
    session_regenerate_id();
    $userID = $_SESSION["user_id"];

    // can access user_id from session variable
    $newSessionId = session_create_id();
    $sessionId = $newSessionId . "_" . $userID;
    session_id($sessionId);

    $_SESSION["last_regeneration"] = time();
}