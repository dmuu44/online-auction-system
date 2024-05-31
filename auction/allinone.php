<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction Result</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Auction Result</h2>
            <div class="text-center">
                <?php
                require('connection.php');
                if (isset($_GET['winner_id'])) {
                    
                    $winnerId = $_GET['winner_id'];
                    $bidAmount = $_GET['bid_amount'];

                    
                    $getWinnerSql = "SELECT * FROM players WHERE id='$winnerId' LIMIT 1";
                    $winnerResult = $conn->query($getWinnerSql);

                    if ($winnerResult->num_rows > 0) {
                        $winnerRow = $winnerResult->fetch_assoc();
                        $winnerName = $winnerRow['player_name'];
                        echo "<p class='card-text'>The player: <strong>$winnerName</strong> with a bid of ₹$bidAmount</p>";
                    } else {
                        echo "<p class='card-text'>No player sold.</p>";
                    }
                } elseif (isset($_GET['unsold']) && $_GET['unsold'] == 'true') {
                    
                    echo "<p class='card-text'>The player remains unsold.</p>";
                } else {
                    
                    echo "<p class='card-text'>Invalid request.</p>";
                }
                ?>
            </div>
            <div class="text-center">
                <button class="btn btn-primary" onclick="goBack()">Bid for other player</button>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
