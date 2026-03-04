<?php
include 'db.php';
?>

<form method="POST" action="edit.php">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    <input type="text" name="task" value="<?php echo $row['task']; ?>" required>

    <select name="category">
        <option value="Work">Work</option>
        <option value="Personal">Personal</option>
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
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating task: " . $conn->error;
    }
}

$conn->close();
?>