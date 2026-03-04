<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM tasks WHERE id=$id");
    $row = $result->fetch_assoc();
}
?>

<form action="update_task.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    <input type="text" name="task" value="<?php echo $row['task']; ?>" required>

    <select name="category">
        <option value="Work" <?php if ($row['category'] == "Work")
            echo "selected"; ?>>Work</option>
        <option value="Personal" <?php if ($row['category'] == "Personal")
            echo "selected"; ?>>Personal</option>
        <option value="Study" <?php if ($row['category'] == "Study")
            echo "selected"; ?>>Study</option>
    </select>

    <select name="priority">
        <option value="Low" <?php if ($row['priority'] == "Low")
            echo "selected"; ?>>Low</option>
        <option value="Medium" <?php if ($row['priority'] == "Medium")
            echo "selected"; ?>>Medium</option>
        <option value="High" <?php if ($row['priority'] == "High")
            echo "selected"; ?>>High</option>
    </select>

    <button type="submit">Update Task</button>
</form>