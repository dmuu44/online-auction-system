<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Auction</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-secondary">
  <nav class="navbar navbar-expand-lg navbar-light bg-info">
    <a class="navbar-brand" href="#">Online Auction</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <?php if (isset($_SESSION['username'])): ?>
        <li class="nav-item">
          <a class="nav-link">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
        <?php else: ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Login
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="register.php">Sign In</a>
            <a class="dropdown-item" href="login.php">Login</a>
          </div>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-8 text-center">
        <h1>Welcome to Online Auction</h1>
        <p class="lead">Find unique items and bid on your favorites!</p>
      </div>
    </div>

    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card">
          <img src="IMAGES/electronic.jpeg" height="400" width="200" class="card-img-top" alt="Auction Image">
          <div class="card-body">
            <h5 class="card-title">Electronic auction</h5>
            <p class="card-text">Anyone can buy your device. Come and buy your favorite items.</p>
            <p class="card-text text-danger">Auction will start after login please login</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card">
          <img src="IMAGES/iplauction.jpg" height="400" width="200" class="card-img-top" alt="Auction Image">
          <div class="card-body">
            <h5 class="card-title">IPL 2050</h5>
            <p class="card-text">Anyone can buy your player. Come and buy your favorite player.</p>
            <p class="card-text text-danger">Auction will start after login please login</p>
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
            <p class="card-text text-danger ">Auction will start after login please login</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  

  <footer class="footer bg-dark text-white text-center py-3 mt-5">
    <p>&copy; 2024 Online Auction. All rights reserved.</p>
  </footer>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
