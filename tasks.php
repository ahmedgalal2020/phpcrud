<?php
session_start();

// Include database connection
include './inc/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Handle task submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $userId = $_SESSION['user_id']; 

    $sql = "INSERT INTO tasks (UserID, Title, Description, Status) VALUES ('$userId', '$title', '$description', 'Not Started')";
    if (!mysqli_query($conn, $sql)) {
        echo "<script>alert('Error adding task: " . mysqli_error($conn) . "');</script>";
    }
}

?>
<?php include_once './parts/header.php'; ?>


<div class="container mt-5">
    <h2>Add New Task</h2>
    <form method="post">
        <div class="form-group">
            <label for="title">Task Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
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
            $userId = $_SESSION['user_id'];
            $sql = "SELECT * FROM tasks WHERE UserID = '$userId'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".htmlspecialchars($row['Title'])."</td>";
                    echo "<td>".htmlspecialchars($row['Description'])."</td>";
                    echo "<td>".htmlspecialchars($row['Status'])."</td>";
                    echo "<td>
                            <a href='edit_task.php?id={$row['TaskID']}' class='btn btn-info btn-sm'>Edit</a>
                            <a href='delete_task.php?id={$row['TaskID']}' class='btn btn-danger btn-sm'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No tasks found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php
include './inc/closedb.php';
?>

<?php include_once './parts/footer.php'; ?>
