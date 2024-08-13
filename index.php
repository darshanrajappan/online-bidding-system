<?php
session_start();
include 'database.php';

$query = "SELECT * FROM auctions WHERE end_time > NOW() ORDER BY end_time ASC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Online Bidding System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Bidding System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="jumbotron text-center">
        <h1 class="display-4">Welcome to the Online Bidding System</h1>
        <p class="lead">Bid on amazing items and get the best deals.</p>
        <a class="btn btn-primary btn-lg" href="register.php" role="button">Get Started</a>
    </div>

    <!-- Auction Listings -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Current Auctions</h2>
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

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="container p-4">
            <p>&copy; 2024 Online Bidding System. All rights reserved.</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                <li class="list-inline-item"><a href="#">Terms of Service</a></li>
            </ul>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>
