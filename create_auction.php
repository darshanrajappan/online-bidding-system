<?php
session_start();
include 'database.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start_price = $_POST['start_price'];
    $end_time = $_POST['end_time'];

    $query = "INSERT INTO auctions (user_id, title, description, start_price, current_price, end_time) 
              VALUES ('$user_id', '$title', '$description', '$start_price', '$start_price', '$end_time')";
    mysqli_query($conn, $query);

    header('Location: dashboard.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Auction</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-4">Create Auction</h1>
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Title:</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Start Price:</label>
                        <input type="number" name="start_price" step="0.01" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>End Time:</label>
                        <input type="datetime-local" name="end_time" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Create</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>
