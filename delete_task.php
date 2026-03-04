<?php
include 'db.php'; // Includes the database connection file

    $id = $_GET['id']; // Gets the id of the task to be deleted from the URL

    $sql = "DELETE FROM tasks WHERE id=$id"; // SQL query to delete the task from the database

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirects back to the main page after deleting the task
        exit();
    } else {
        echo "Error deleting task: " . $conn->error;
    }

    
$conn->close(); // Closes the database connection
?>
