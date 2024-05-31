<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require("connection.php");

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT password, name FROM registration WHERE email= '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['password']; 

        if ($password == $stored_password) {
            $_SESSION['username'] = $row['name'];
            header("Location: homepage.php");
            exit();
        } else {
            echo "Incorrect password";
            exit();
        }
    } else {
        echo "Username not found";
        exit();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script>
    function validateForm() {
      var email = document.forms["loginForm"]["email"].value;
      var password = document.forms["loginForm"]["password"].value;

      if (email == "" || password == "") {
        alert("All fields must be filled out");
        return false;
      }

      var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
      if (!email.match(emailPattern)) {
        alert("Please enter a valid email address");
        return false;
      }

      return true;
    }
  </script>
</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center">Login</h2>
    <form name="loginForm" action="login.php" onsubmit="return validateForm()" method="post">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email">
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>
</body>
</html>
