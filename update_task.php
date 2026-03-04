<?php
include 'db.php';
?>

<form method="POST" action="edit.php">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    <input type="text" name="task" value="<?php echo $row['task']; ?>" required>

    <select name="category">
        <option value="Work" <?php if($row['category']=="Work") echo "selected"; ?>>Work</option>
        <option value="Personal" <?php if($row['category']=="Personal") echo "selected"; ?>>Personal</option>
        <option value="Study" <?php if($row['category']=="Study") echo "selected"; ?>>Study</option>
    </select>

    <select name="priority">
        <option value="Low">Low</option>
        <option value="Medium">Medium</option>
        <option value="High">High</option>
    </select>

    <button type="submit" name="update">Update</button>
</form>

<?php
if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $task = $_POST['task'];
    $category = $_POST['category'];
    $priority = $_POST['priority'];

    $sql = "UPDATE tasks 
            SET task='$task', category='$category', priority='$priority' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: todo.php");
        exit();
    } else {
        echo "Error updating task: " . $conn->error;
    }
}

$conn->close();
?>
