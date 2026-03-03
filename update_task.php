<?php
include 'db.php';
    $id = $_POST['id']; 
    $task = $_POST['task']; 
    $category = $_POST['category'];
    $priority = $_POST['priority']; 
    
    $sql = "UPDATE tasks SET task='$task', category='$category', priority='$priority' WHERE id=$id"; 
     // SQL query to update the task in the database

    if ($conn->query($sql) === TRUE) {
        echo "Task updated successfully";
    } else {
        echo "Error updating task: " . $conn->error;
    }

    header("Location: index.php");
$conn->close();
?>
