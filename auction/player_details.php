<?php
require("connection.php");

session_start();

function getCurrentAuction() {
  global $conn;
  $currentAuctionSql = "SELECT player_id, UNIX_TIMESTAMP(start_time) AS start_time FROM current_auction LIMIT 1";
  $currentAuctionResult = $conn->query($currentAuctionSql);
  if ($currentAuctionResult->num_rows > 0) {
      return $currentAuctionResult->fetch_assoc();
  } else {
      return false;
  }
}
$currentAuction = getCurrentAuction();

if ($currentAuction !== false) {
    $playerId = $currentAuction['player_id'];
    $auctionStartTime = $currentAuction['start_time'];
    $_SESSION['auction_start_time'] = $auctionStartTime;
    $_SESSION['player_id'] = $playerId;
} else {
    $lockSql = "SELECT GET_LOCK('player_selection_lock', 20) AS acquired";
    $lockResult = $conn->query($lockSql);
    $lockRow = $lockResult->fetch_assoc();
    $lockAcquired = $lockRow['acquired'];

    if ($lockAcquired) {
        $selectSql = "SELECT * FROM players WHERE completed = 0 ORDER BY id ASC LIMIT 1";
        $selectResult = $conn->query($selectSql);

        if ($selectResult->num_rows > 0) {
            $row = $selectResult->fetch_assoc();
            $playerId = $row['id'];

            $updateSql = "UPDATE players SET completed = 1 WHERE id='$playerId'";
            $conn->query($updateSql);

            $insertAuctionSql = "INSERT INTO current_auction (player_id, start_time) VALUES ('$playerId', NOW())";
            $conn->query($insertAuctionSql);

            $auctionStartTime = time();
            $_SESSION['auction_start_time'] = $auctionStartTime; 
            $_SESSION['player_id'] = $playerId; 
        } else {
            echo "No players available for auction.";
            $releaseSql = "DO RELEASE_LOCK('player_selection_lock')";
            $conn->query($releaseSql);
            exit();
        }

        $releaseSql = "DO RELEASE_LOCK('player_selection_lock')";
        $conn->query($releaseSql);
    } else {
        echo "Failed to acquire lock. Please try again later.";
        exit();
    }
}
$playerSql = "SELECT * FROM players WHERE id='$playerId'";
$playerResult = $conn->query($playerSql);
$row = $playerResult->fetch_assoc();
$currentBid = $row['price'];
$lastBidTime = $row['last_bid_time']; 

if (!isset($_SESSION['auction_start_time'])) {
    $_SESSION['auction_start_time'] = $auctionStartTime; 
}

$auctionDuration = 30; 
$elapsedTime = time() - $_SESSION['auction_start_time'];
$remainingTime = max(0, $auctionDuration - $elapsedTime);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Player Details</h2>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['player_image']); ?>"
                     class="card-img-top"
                     alt="<?php echo $row['player_name']; ?>"
                     style="width: 100%; height: auto;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['player_name']; ?></h5>
                    <p class="card-text">Position / Role: <?php echo $row['player_role']; ?></p>
                    <p class="card-text">Base Price: ₹<?php echo $row['base_price']; ?></p>
                    <p class="card-text">Current Bid: ₹<span id="currentBid"><?php echo $currentBid; ?></span></p>
                    <button class="btn btn-primary" onclick="incrementBid(5000)">+ ₹5000</button>
                    <button class="btn btn-primary" onclick="incrementBid(10000)">+ ₹10000</button>
                    <div id="timerContainer" class="mt-3">
                        <?php if ($remainingTime <= 0): ?>
                            <p class="text-danger">Auction completed!</p>
                        <?php else: ?>
                            <p class="text-danger">Time remaining: <span id="timeRemaining"><?php echo $remainingTime; ?></span>s</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    
    function incrementBid(amount) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                var currentBid = parseInt(document.getElementById("currentBid").textContent); 
                document.getElementById("currentBid").textContent = currentBid + amount;
                if (response.remainingTime > 0) {
                    document.getElementById("timeRemaining").textContent = response.remainingTime;
                }
            }
        };
        xhttp.open("GET", "update_bid.php?player_id=<?php echo $playerId; ?>&bid_amount=" + amount, true);
        xhttp.send();
    }

    
function startTimer() {
    var countdown;
    var remainingTime = <?php echo $remainingTime; ?>;
    document.getElementById("timeRemaining").textContent = remainingTime;
    clearInterval(countdown); 
    countdown = setInterval(function() {
        remainingTime--;
        if (remainingTime <= 0) {
            clearInterval(countdown);
            document.getElementById("timerContainer").innerHTML = '<p class="text-danger">Auction completed!</p>';
            
            document.querySelectorAll(".btn").forEach(btn => btn.disabled = true);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText); 
                    handleAuctionCompletion();
                }
            };
            xhttp.open("GET", "truncate.php", true);
            xhttp.send();
        } else {
            document.getElementById("timeRemaining").textContent = remainingTime;
        }
    }, 1000);
}

function handleAuctionCompletion() {
  window.location.href = "handle_auction_completion.php";
    }

window.onload = startTimer;
  
</script>
</body>
</html>
