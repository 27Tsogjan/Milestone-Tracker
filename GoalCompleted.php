<?php
    session_start();

    if (!isset($_SESSION['Username'])) {
        die("You must be logged in to mark goals as completed.");
    }
    if (isset($_POST['goal_id'])) {
        $goal_id = $_POST['goal_id'];

        require_once 'Login-1/dbh.inc.php';
    
        try {
            $checkQuery = "SELECT COUNT(*) FROM timeline WHERE goal_id = :goal_id";
            $checkStmt = $pdo->prepare($checkQuery);
            $checkStmt->bindParam(':goal_id', $goal_id, PDO::PARAM_INT);
            $checkStmt->execute();
            $goalExists = $checkStmt->fetchColumn();

            if ($goalExists > 0) {
                header('Location: Goals.php');
                die("This goal is already marked as completed.");
            }

            echo 'test';

            $updateQuery = "UPDATE goalentries SET completed = 1 WHERE goal_id = :goal_id";
            $updateStmt = $pdo->prepare($updateQuery);
            $updateStmt->bindParam(':goal_id', $goal_id, PDO::PARAM_INT);
            $updateStmt->execute();
    
            echo "Goal marked as completed!";

            $selectQuery = "SELECT goal_id, entries FROM goalentries WHERE goal_id = :goal_id";
            $selectStmt = $pdo->prepare($selectQuery);
            $selectStmt->bindParam(':goal_id', $goal_id, PDO::PARAM_INT);
            $selectStmt->execute();
            $row = $selectStmt->fetch(PDO::FETCH_ASSOC);

            if($row) {
                $entry_text = $row['entries'];
                $insert_query = "INSERT INTO timeline (goal_id, entry_text, entry_date) 
                                VALUES (:goal_id, :entry_text, NOW())";
                $insert_stmt = $pdo->prepare($insert_query);
                $insert_stmt->bindParam(':goal_id', $goal_id, PDO::PARAM_INT);
                $insert_stmt->bindParam(':entry_text', $entry_text, PDO::PARAM_STR);
                $insert_stmt->execute();

                header('Location: Goals.php');
                exit();
            }
        } catch (PDOException $e) {
            die("Error updating goal: " . $e->getMessage());
        }
    } else {
        die("Goal ID not set.");
    }
?>