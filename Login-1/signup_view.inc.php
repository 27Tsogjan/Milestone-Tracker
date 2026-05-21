 <?php
 //declare(strict_types=1);

//model, view control ..
// view

// allow type declarations - 
// don't need to do; prevent more errors due to typos/submitting more data;

function check_signup_errors()
{
    if (isset($_SESSION['errors_signup'])) {
        $errors = $_SESSION['errors_signup'];

        unset($_SESSION['errors_signup']);

        echo "test<br>";

        foreach ($errors as $error) {
            echo '<p class="form_error"></p>' . $error . '</p>';
        }

        unset($_SESSION['errors_signup']);
    
    // check if there's a certain get method
    } else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo '<br>';
        echo '<p class="form-success">Signup success!</p>';
    }
}