<?php
include 'db.php';
    $result = $conn->query("SELECT * FROM tasks ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>MY TO DO LIST</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class = "container">
        <h1>Task Manager</h1>
        <form action = "add_task.php" method = "POST">
            <input type = "text" name = "task" placeholder = "Enter Task" required>

            <select name = "category" required>
                <option value="">Select Category</option>
                <option value="Work">Work</option>
                <option value="Personal">Personal</option>
                <option value="Study">Study</option>
            </select>

            <select name = "priority" required>
                <option value="">Select Priority</option>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>

            <button type = "submit">Add Task</button>
        </form>
        <hr>
        <table>
            <tr>
                <th>Task</th>
                <th>Category</th>
                <th>Priority</th>
                <th>Status</th>
            </tr>
            <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['task']; ?></td>
                <td><?php echo $row['category']; ?></td>
                <td><?php echo $row['priority']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td>
                    <a href="edit_task.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                    <a href="delete_task.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this task?');">Delete</a>
                </td>
            </tr>
            <?php } ?>
</div>
</body>
</html>