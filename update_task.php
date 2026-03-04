<?php
include 'db.php';
    $id = $_GET['id']; 
    $task = $_GETT['task']; 
    $category = $_GET['category'];
    $priority = $_GET['priority']; 
    
    $sql = "UPDATE tasks SET task='$task', category='$category', priority='$priority' WHERE id=$id"; 
     // SQL query to update the task in the database

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating task: " . $conn->error;
    }
$conn->close();
?>
