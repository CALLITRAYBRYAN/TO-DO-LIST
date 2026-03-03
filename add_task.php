<?php
include 'db.php'; // Includes the database connection file

    $task = $_POST['task']; // Gets the task that was typed in from the form
    $category = $_POST['category']; // Gets the category that was selected from the form
    $priority = $_POST['priority']; // Gets the priority that was selected from the form
    
    $sql = "INSERT INTO tasks (task, category, priority, status) VALUES ('$task', '$category', '$priority', 'pending')";
     // SQL query to insert the new task into the database

    if ($conn->query($sql) === TRUE) {
        echo "Task added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header("Location: index.php"); // Redirects back to the main page after adding the task

$conn->close(); // Closes the database connection
?>