<?php
session_start();
require("connection.php");

// Fetch players who are ready for auction
$sql = "SELECT * FROM players WHERE completed = 0 ORDER BY id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Players Ready for Auction</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .card {
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .card-img-top {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }
    .card-body {
      flex: 1 1 auto;
    }
    .card-text {
      margin-bottom: 10px;
    }
    .card-container {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
    }
    .card-container .col-md-4 {
      display: flex;
      flex-direction: column;
      margin-bottom: 30px;
    }
  </style>
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

  <div class="container mt-5">
    <h2 class="text-center text-white">Players Ready for Auction</h2>
    <div class="row justify-content-center card-container mt-5">
      <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
        <div class="col-md-4">
          <div class="card mb-4">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['player_image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['player_name']); ?>">
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($row['player_name']); ?></h5>
              <p class="card-text">Position / Role: <?php echo htmlspecialchars($row['player_role']); ?></p>
              <p class="card-text">Base Price: ₹<?php echo htmlspecialchars($row['base_price']); ?></p>
            </div>
          </div>
        </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-center text-white">No players are currently ready for auction.</p>
      <?php endif; ?>
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

<?php
$conn->close();
?>
