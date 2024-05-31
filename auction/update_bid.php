<?php
require("connection.php");
session_start();

$playerId = $_GET['player_id'];
$bidAmount = $_GET['bid_amount'];
$updateBidSql = "UPDATE players SET price = price + $bidAmount WHERE id = $playerId";
$conn->query($updateBidSql);

$response = array(
    'newBid' => $bidAmount
);
echo json_encode($response);
?>
