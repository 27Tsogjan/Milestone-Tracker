<?php
 if (!isset($_SESSION['Username'])) {
    // If not logged in, redirect to login page
    header("Location: loginPage.php");
    exit();
}
?>