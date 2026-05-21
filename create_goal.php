<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $content = $_POST['entries'];

    if (empty($content)) {
        die("Content cannot be empty.");
    }

    try{  
        if (!isset($_SESSION['Username'])) {
            die("User is not logged in.");
        }
        require_once 'Login-1/dbh.inc.php';

        $username = $_SESSION['Username'];

        $checkUserQuery = "SELECT * FROM registration WHERE Username = :username LIMIT 1";
        $stmt = $pdo->prepare($checkUserQuery);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            die("User not found in the database.");
        }

        $query = "INSERT INTO goalentries (Username, entries) VALUES (:username, :entries)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':entries', $content, PDO::PARAM_STR);
        $stmt->execute();

        header('Location: Goals.php');

        echo "Content submitted successfully!";
    }
    catch(PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}

?>