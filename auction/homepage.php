<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
       
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .social-icons a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }
    </style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Auction</title>
</head>
<body class="bg-secondary">
  <nav class="navbar navbar-expand-lg navbar-light bg-info">
    <a class="navbar-brand" href="#">Online Auction</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Logout
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            
            <a class="dropdown-item" href="logout.php">logout</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-8 text-center">
        <h1>Welcome 
         <?php
        session_start();
        echo $_SESSION['username'];
        ?>
        </h1>
        
        <p class="lead">Find unique items and bid on your favorites!</p>
        <p class="lead">Here you can find all types of auction items!</p>


      </div>
    </div>

    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card">
          <img src="IMAGES/iplauction.jpg" height="400" width="200" class="card-img-top" alt="Auction Image">
          <div class="card-body">
            <h5 class="card-title">IPL 2050</h5>
            <p class="card-text">Anyone can buy your player. Come and buy your favorite player.</p>
            <a href="players_ready_for_auction.php" class="btn btn-primary">show players</a>
            <div id="timer"></div>
            <?php
            $currentTime = gmdate('H:i');
            if ($currentTime < '01:55') {
              echo '<button id="auctionButton" class="btn btn-primary" disabled>View Auction</button>';
            } else {
              echo '<a href="player_details.php" class="btn btn-primary" id="auctionButton">View Auction</a>';
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card">
          <img src="IMAGES/electronic.jpeg" height="400" width="200" class="card-img-top" alt="Auction Image">
          <div class="card-body">
            <h5 class="card-title">Electronic auction</h5>
            <p class="card-text">Anyone can buy your device. Come and buy your favorite items.</p>
            <p class="card-text text-success text-bold">Auction completed</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card">
          <img src="IMAGES/olx.png" height="400" width="200" class="card-img-top" alt="Auction Image">
          <div class="card-body">
            <h5 class="card-title">olx aution</h5>
            <p class="card-text">Anyone can buy second-hand. Come and buy your what you want.</p>
            <p class="card-text text-danger bold">Not Organized</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <a href="https://www.facebook.com" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/durgasairam44" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
                    
                    <a href="https://www.linkedin.com/in/" target="_blank" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </footer>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    function updateTimer() {
      var now = new Date();
      var target = new Date(now);
      target.setUTCHours(1, 55, 0, 0);

      var difference = target - now;

      if (difference <= 0) {
        document.getElementById("timer").innerHTML = "";
        clearInterval(timerInterval); 
        var auctionButton = document.getElementById("auctionButton");
        auctionButton.disabled = false; 
        auctionButton.outerHTML = '<a href="player_details.php" class="btn btn-primary" id="auctionButton">View Auction</a>';
        return;
      }

      var hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((difference % (1000 * 60)) / 1000);

      document.getElementById("timer").innerHTML = "Time remaining until 07:00 UTC: " + hours + "h " + minutes + "m " + seconds + "s";
    }

    var timerInterval = setInterval(updateTimer, 1000);
    window.onload = updateTimer;
  </script>
</body>
</html>
