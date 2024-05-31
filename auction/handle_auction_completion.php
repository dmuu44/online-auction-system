<?php
require("connection.php");
session_start();

$playerId = $_SESSION['player_id'];

$getWinnerSql = "SELECT player_name, price FROM players WHERE id = $playerId";
$winnerResult = $conn->query($getWinnerSql);

if ($winnerResult && $winnerResult->num_rows > 0) {
    $winnerData = $winnerResult->fetch_assoc();
    $winnerName = $winnerData['name'];
    $bidAmount = $winnerData['price'];

    header("Location: allinone.php?winner_id=$playerId&bid_amount=$bidAmount&winner_name=$winnerName");
    exit();
} else {
    header("Location: allinone.php?unsold=true");
    exit();
}
?>
