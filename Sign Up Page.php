<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link type="">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="StyleSheets/cssStyleSheet.css">
    <link rel='icon' type="image.png" href="Images/download.png">
</head>
<body>
    <?php
    session_start();
     if (isset($_SESSION['registrationStatus']) && $_SESSION['registrationStatus'] === 'failure'): ?>
        <div id="error-message" style="color: white; background-color: red; padding: 10px; border-radius: 5px; position: relative; z-index: 1;">
            <?php echo 'Username Taken'?>
        </div>
        <script>
            // You can customize this behavior with JavaScript if needed
            setTimeout(function() {
                document.getElementById('error-message').style.display = 'none';
            }, 5000); // Hide message after 5 seconds
        </script>
    <?php unset($_SESSION['registrationStatus']); unset($_SESSION['errors_registration']); endif; ?>

<header class='w3-display-topmiddle'>
        <img src='' width=100%>
    </header>
    <main>
        <div id='LoginBox' class="w3-display-middle w3-bar w3-padding-medium w3-white w3-card-4">
            <h1>Sign Up</h1>
            <form method='post' action='Login-1/signup.inc.php'>
                <input type='text'id='login' placeholder='First Name' name='fname'>
                <input type='text' name='Username' id='login' placeholder='Username' required>
                <input type='password' name='user_password' id='login' placeholder='Password' required>
                <br>
                <button type='submit' id='login'class="w3-button w3-round-xlarge w3-indigo">Sign Up</button>
                <hr>
            </form>
            <p>Already have an acount?</p>
            <a href='loginPage.php'><button id='login' class="w3-button w3-round-xlarge w3-indigo">Sign In</button></a>
        </div>
    </main>
</body>
</html>