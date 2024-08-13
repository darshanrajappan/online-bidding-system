<?php
session_start();
include 'database.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM auctions WHERE user_id=$user_id ORDER BY end_time DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container mt-5">
        <h1 class="text-center mb-4">Dashboard</h1>
        <div class="d-flex justify-content-between mb-4">
            <a href="create_auction.php" class="btn btn-success">Create Auction</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
        <h2 class="mb-4">My Auctions</h2>
        <div class="row">
            <?php while ($auction = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $auction['title']; ?></h5>
                            <p class="card-text"><?php echo $auction['description']; ?></p>
                            <p class="card-text"><strong>Current Price:</strong> $<?php echo $auction['current_price']; ?></p>
                            <p class="card-text"><strong>End Time:</strong> <?php echo $auction['end_time']; ?></p>
                            <a href="auction.php?id=<?php echo $auction['id']; ?>" class="btn btn-primary">View Auction</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>
