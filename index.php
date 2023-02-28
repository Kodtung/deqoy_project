<?php session_start(); ?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <title>Basic Login PHP, SESSION and condition</title>
        <style>
        body {
        background-image: url('https://www.tisco.co.th/content/tisco-bank/en/personal/loan/home-for-cash/_jcr_content/root/responsivegrid/core_columnctrl/col_0/image_2027699417_cop.img.png/1596423765674.png');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
        }
        </style>
    </head>
    <body>
        <div class="container" style="margin-top: 150px;">
            <div class="row">
                <div class="col-sm-8"></div>
                <div class="col-sm-4">
                    <h4>เข้าสู่ระบบผู้ใช้</h4>
                    <form action="" method="post">
                        username
                        <input type="text" id="username" name="username" class="form-control" required placeholder="username">
                        
                        password
                        <input type="password" id="password" name="password" class="form-control" required placeholder="password">
                        <br>
                        <button type="submit" name="login">Login</button>
                        <br>
                        <button type="submit" name="register">Register</button>
                    </form>
                </div>
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
    header("Location: dashboard.php");
  } else {
    echo "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
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