<?php
session_start(); // Start the session at the very beginning

// Include database connection
include './inc/db.php';

// Check if the user is logged in, using a session variable
if (!isset($_SESSION['user_id'])) {
    // User not logged in, redirect to login page
    header('Location: login.php');
    exit;
}

// Handle task submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Your task handling logic goes here
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $userId = $_SESSION['user_id']; // Use the session variable

    // Insert task into database
    $sql = "INSERT INTO tasks (UserID, Title, Description) VALUES ('$userId', '$title', '$description')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Task added successfully');</script>";
    } else {
        echo "<script>alert('Error adding task: " . mysqli_error($conn) . "');</script>";
    }
}

// Task display and management logic goes here

// Close database connection
include './inc/closedb.php';
?>


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
    </div>