<?php
include 'db.php';
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* =========================
   ADD TASK
========================= */
if (isset($_POST['add'])) {

    $stmt = $conn->prepare("INSERT INTO tasks (task, category, priority, status) VALUES (?, ?, ?, 'pending')");
    $stmt->bind_param("sss", $_POST['task'], $_POST['category'], $_POST['priority']);
    $stmt->execute();
    $stmt->close();

    header("Location: todo.php");
    exit();
}

/* =========================
   UPDATE TASK
========================= */
if (isset($_POST['update'])) {

    $stmt = $conn->prepare("UPDATE tasks SET task=?, category=?, priority=? WHERE id=?");
    $stmt->bind_param("sssi", $_POST['task'], $_POST['category'], $_POST['priority'], $_POST['id']);
    $stmt->execute();
    $stmt->close();

    header("Location: todo.php");
    exit();
}

/* =========================
   DELETE TASK
========================= */
if (isset($_GET['delete'])) {

    $stmt = $conn->prepare("DELETE FROM tasks WHERE id=?");
    $stmt->bind_param("i", $_GET['delete']);
    $stmt->execute();
    $stmt->close();

    header("Location: todo.php");
    exit();
}

/* =========================
   TOGGLE STATUS
========================= */
if (isset($_GET['toggle'])) {

    $id = $_GET['toggle'];
    $result = $conn->query("SELECT status FROM tasks WHERE id=$id");
    $row = $result->fetch_assoc();

    $newStatus = ($row['status'] == 'pending') ? 'completed' : 'pending';

    $stmt = $conn->prepare("UPDATE tasks SET status=? WHERE id=?");
    $stmt->bind_param("si", $newStatus, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: todo.php");
    exit();
}

/* =========================
   FETCH TASKS
========================= */
$result = $conn->query("SELECT * FROM tasks");

/* =========================
   FETCH TASK FOR EDITING
========================= */
$editTask = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editResult = $conn->query("SELECT * FROM tasks WHERE id=$id");
    $editTask = $editResult->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">

<h1>Task Manager</h1>

<!-- ================= ADD / EDIT FORM ================= -->

<form method="POST">

    <input type="hidden" name="id" value="<?php echo $editTask['id'] ?? ''; ?>">

    <input type="text" name="task"
        value="<?php echo $editTask['task'] ?? ''; ?>"
        placeholder="Enter Task" required>

    <select name="category" required>
        <option value="">Select Category</option>
        <option value="Work">Work</option>
        <option value="Personal">Personal</option>
        <option value="Study">Study</option>
    </select>

    <select name="priority" required>
        <option value="">Select Priority</option>
        <option value="Low">Low</option>
        <option value="Medium">Medium</option>
        <option value="High">High</option>
    </select>

    <?php if ($editTask): ?>
        <button type="submit" name="update">Update Task</button>
    <?php else: ?>
        <button type="submit" name="add">Add Task</button>
    <?php endif; ?>

</form>

<hr>

<!-- ================= TASK TABLE ================= -->

<table border="1" cellpadding="8">
<tr>
    <th>Task</th>
    <th>Category</th>
    <th>Priority</th>
    <th>Status</th>
    <th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?php echo $row['task']; ?></td>
    <td><?php echo $row['category']; ?></td>
    <td><?php echo $row['priority']; ?></td>
    <td>
        <a href="?toggle=<?php echo $row['id']; ?>">
            <?php echo $row['status']; ?>
        </a>
    </td>
    <td>
        <a href="?edit=<?php echo $row['id']; ?>">Edit</a> |
        <a href="?delete=<?php echo $row['id']; ?>"
           onclick="return confirm('Delete this task?');">
           Delete
        </a>
    </td>
</tr>
<?php endwhile; ?>

</table>

</div>
</body>
</html>

<?php $conn->close(); ?>