<?php
session_start();
include 'database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$auction_id = $_POST['auction_id'];
$bid_amount = $_POST['bid_amount'];

$query = "SELECT * FROM auctions WHERE id='$auction_id'";
$result = mysqli_query($conn, $query);
$auction = mysqli_fetch_assoc($result);

if ($bid_amount > $auction['current_price']) {
    $bid_time = date('Y-m-d H:i:s');
    $bid_query = "INSERT INTO bids (auction_id, user_id, bid_amount, bid_time) VALUES ('$auction_id', '$user_id', '$bid_amount', '$bid_time')";
    mysqli_query($conn, $bid_query);

    $update_query = "UPDATE auctions SET current_price='$bid_amount' WHERE id='$auction_id'";
    mysqli_query($conn, $update_query);

    header("Location: auction.php?id=$auction_id");
} else {
    echo "Bid amount must be higher than the current price.";
}
?>
