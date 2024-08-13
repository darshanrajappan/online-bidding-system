<?php
session_start();
include 'database.php';

$auction_id = $_GET['id'];
$query = "SELECT * FROM auctions WHERE id='$auction_id'";
$result = mysqli_query($conn, $query);
$auction = mysqli_fetch_assoc($result);

$bid_query = "SELECT * FROM bids WHERE auction_id='$auction_id' ORDER BY bid_time DESC";
$bid_result = mysqli_query($conn, $bid_query);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $auction['title']; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container mt-5">
        <h1 class="text-center mb-4"><?php echo $auction['title']; ?></h1>
        <div class="card mb-4">
            <div class="card-body">
                <h5>Description</h5>
                <p><?php echo $auction['description']; ?></p>
                <h5>Current Price</h5>
                <p>$<?php echo $auction['current_price']; ?></p>
                <h5>End Time</h5>
                <p><?php echo $auction['end_time']; ?></p>
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <form method="POST" action="bid.php" class="mt-4">
                        <input type="hidden" name="auction_id" value="<?php echo $auction['id']; ?>">
                        <div class="form-group">
                            <label>Bid Amount:</label>
                            <input type="number" name="bid_amount" step="0.01" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Place Bid</button>
                    </form>
                <?php } else { ?>
                    <p><a href="login.php" class="btn btn-warning btn-block">Login</a> to place a bid.</p>
                <?php } ?>
            </div>
        </div>

        <h2 class="mb-4">Bids</h2>
        <div class="list-group">
            <?php while ($bid = mysqli_fetch_assoc($bid_result)) { ?>
                <div class="list-group-item mb-2">
                    <p><strong>User ID:</strong> <?php echo $bid['user_id']; ?></p>
                    <p><strong>Bid Amount:</strong> $<?php echo $bid['bid_amount']; ?></p>
                    <p><strong>Bid Time:</strong> <?php echo $bid['bid_time']; ?></p>
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
