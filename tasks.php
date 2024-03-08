<?php
session_start();
include './inc/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Edit Task Preparation
$edit = false;
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $editTaskId = $_GET['id'];
    $editQuery = "SELECT * FROM tasks WHERE TaskID = '$editTaskId' AND UserID = '".$_SESSION['user_id']."'";
    $editResult = mysqli_query($conn, $editQuery);
    if ($editResult && mysqli_num_rows($editResult) == 1) {
        $edit = true;
        $taskToEdit = mysqli_fetch_assoc($editResult);
    }
}

// Task Submission (Add & Edit)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $userId = $_SESSION['user_id'];

    if (isset($_POST['task_id']) && !empty($_POST['task_id'])) {
        // Update task
        $taskId = $_POST['task_id'];
        $updateSql = "UPDATE tasks SET Title='$title', Description='$description', Status='$status' WHERE TaskID='$taskId' AND UserID='$userId'";
        mysqli_query($conn, $updateSql);
    } else {
        // Insert new task
        $insertSql = "INSERT INTO tasks (UserID, Title, Description, Status) VALUES ('$userId', '$title', '$description', '$status')";
        mysqli_query($conn, $insertSql);
    }
}

// Delete Task
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $deleteTaskId = $_GET['id'];
    $deleteSql = "DELETE FROM tasks WHERE TaskID='$deleteTaskId' AND UserID='".$_SESSION['user_id']."'";
    mysqli_query($conn, $deleteSql);
    header("Location: tasks.php"); // Redirect to avoid re-deletion on refresh
    exit;
}
?>
<?php include_once './parts/header.php'; ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Time Manager</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="btn btn-danger" href="./parts/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2><?php echo $edit ? "Edit Task" : "Add New Task"; ?></h2>
    <form action="tasks.php" method="post">
        <?php if ($edit): ?>
            <input type="hidden" name="task_id" value="<?php echo $taskToEdit['TaskID']; ?>">
        <?php endif; ?>
        <div class="form-group">
            <label for="title">Task Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="<?php echo $edit ? $taskToEdit['Title'] : ""; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control" rows="3" required><?php echo $edit ? $taskToEdit['Description'] : ""; ?></textarea>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control">
                <option value="Not Started" <?php echo $edit && $taskToEdit['Status'] == 'Not Started' ? 'selected' : ''; ?>>Not Started</option>
                <option value="In Progress" <?php echo $edit && $taskToEdit['Status'] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                <option value="Completed" <?php echo $edit && $taskToEdit['Status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo $edit ? "Update Task" : "Add Task"; ?></button>
    </form>
    
    <h3 class="mt-5">Your Tasks</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $tasksSql = "SELECT * FROM tasks WHERE UserID='".$_SESSION['user_id']."'";
            $tasksResult = mysqli_query($conn, $tasksSql);
            while ($task = mysqli_fetch_assoc($tasksResult)) {
                echo "<tr>";
                echo "<td>".htmlspecialchars($task['Title'])."</td>";
                echo "<td>".htmlspecialchars($task['Description'])."</td>";
                echo "<td>".htmlspecialchars($task['Status'])."</td>";
                echo "<td>
                    <a href='?action=edit&id=".$task['TaskID']."' class='btn btn-sm btn-info'>Edit</a>
                    <a href='?action=delete&id=".$task['TaskID']."' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php
include './inc/closedb.php';
?>

<?php include_once './parts/footer.php'; ?>
