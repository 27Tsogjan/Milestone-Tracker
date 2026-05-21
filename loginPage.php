<!DOCTYPE html>
<html>
<head>
    <title>My Mileston Tracker - Login</title>
    <link rel="stylesheet" href="StyleSheets/cssStyleSheet.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
    <link rel='icon' type="image.png" href="Images/download.png">
</head>
<body>
    <?php
    session_start();
    if (isset($_SESSION['loginStatus']) && $_SESSION['loginStatus'] === 'failure'): ?>
        <div id="error-message" class='w3-card-4' style="color: white; background-color: red; padding: 10px; border-radius: 5px; position: relative; z-index: 1;">
            <?php echo 'Username Incorrect'?>
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('error-message').style.display = 'none';
            }, 5000);
        </script>
    <?php unset($_SESSION['loginStatus']); unset($_SESSION['errors_login']); endif; ?>

    <header class='w3-display-topmiddle'>
        <img src='' width=100%>
    </header>
    <main>
        <div id='LoginBox' class="w3-display-middle w3-bar w3-padding-medium w3-white w3-card-4">
            <h1>Login</h1>
            <form method='POST' action='Login-1/login.inc.php'>
                <input type='text' name='Username' id='login' placeholder='Username' required>
                <input type='password' name='user_password' id='login' placeholder='Password' required>
                <br>
                <button type='submit' id='login'class="w3-button w3-round-xlarge w3-indigo">Sign In</button>
                <hr>
            </form>
            <p>Don't have an acount?</p>
            <a href='Sign Up Page.php'><button id='login' class="w3-button w3-round-xlarge w3-indigo">Sign Up</button></a>
        </div>
    </main>
</body>
</html>