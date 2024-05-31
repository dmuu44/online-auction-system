<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require("connection.php");

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }

    
    $sql = "INSERT INTO registration (name, email, password) VALUES ('$name', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        header("Location: registrationsuccess.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script>
    function validateForm() {
      var name = document.forms["registerForm"]["name"].value;
      var email = document.forms["registerForm"]["email"].value;
      var password = document.forms["registerForm"]["password"].value;
      var confirmPassword = document.forms["registerForm"]["confirm_password"].value;

      if (name == "" || email == "" || password == "" || confirmPassword == "") {
        alert("All fields must be filled out");
        return false;
      }

      var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
      if (!email.match(emailPattern)) {
        alert("Please enter a valid email address");
        return false;
      }

      if (password !== confirmPassword) {
        alert("Passwords do not match");
        return false;
      }

      return true;
    }
  </script>
</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center">Register</h2>
    <form name="registerForm" action="register.php" onsubmit="return validateForm()" method="post">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name">
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email">
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <div class="form-group">
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
    </form>
  </div>
</body>
</html>
