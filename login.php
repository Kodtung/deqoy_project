<?php session_start(); ?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="css/login_style.scss">
        <title>WebBank</title>
        <style>
        body {
        }
        </style>
    </head>
    <body>
        <div class="container">
                <div class="col-sm-4">
                    <h4>Sign IN</h4>
                    <form action="" method="post">
                      <div class="info">
                        <input type="text" id="username" name="username" class="form-control" required placeholder="username">
                        <input type="password" id="password" name="password" class="form-control" required placeholder="password">
                      </div>
                      <div class="login">
                        <button type="submit" name="login">Login</button>
                        <button type="submit" name="register">Register</button>
                      </div>
                    </form>
                </div>
        </div>
<?php
// สร้างการเชื่อมต่อฐานข้อมูล
$conn = mysqli_connect("localhost", "root", "", "bank");

// เข้าสู่ระบบ
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  if (mysqli_num_rows($result) == 1) {
    session_start();
    $_SESSION['id'] = $row['id'];
    header("Location: home.php");
  } else {
    echo '<script>alert("Username or Password is incorrect!!")</script>';
  }
}
// การลงทะเบียนผู้ใช้งาน
if (isset($_POST["register"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
  if ($conn->query($sql) === TRUE) {
      echo "Registration successful!";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
$conn->close();
  ?>