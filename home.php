<?php
session_start();
// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่ หากไม่ได้เข้าสู่ระบบให้ redirect ไปหน้า login
if (!isset($_SESSION['id'])) {
  header("Location: login.php");
}

// สร้างการเชื่อมต่อฐานข้อมูล
$conn = mysqli_connect("localhost", "root", "", "bank");

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);


// ค้นหาข้อมูลผู้ใช้
if (isset($_POST['search'])) {
  $search_text = $_POST['search_text'];
  $sql = "SELECT * FROM users WHERE username LIKE '%$search_text%'";
  $result = mysqli_query($conn, $sql);
}

// แสดงข้อมูลผู้ฝาก
if (isset($_POST['show'])) {
  $sql = "SELECT * FROM users";
  $result = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WebBank</title>
</head>
<body>
<h1>Welcome! , <?php echo $user['username']; ?></h1>
<p>Balance : <?php echo number_format($user['balance'], 2); ?> THB</p>

<div class="form">
  <form action="withdraw.php">
    <div class="withdraw">
      <button type="submit">
        <img src="img/cash-withdrawal.png" alt="withdraw">
      </button>
    <label for="">Withdraw</label>
    </div>
  </form>
  <form action="deposit.php">
    <div class="deposit">
      <button type="submit">
        <img src="img/deposit.png" alt="deposit">
      </button>
      <label for="">Deposit</label>
    </div>
  </form>
  <form action="check_statement.php">
    <div class="statement">                    
      <button type="submit">
        <img src="img/income.png" alt="statement">
      </button>
      <label for="">Check Statement</label>
    </div>
  </form>
</div>

</body>
</html>



<!doctype html>
<html lang="en">
    <a href="logout.php" onclick="return confirm('Are you confirm to logout?');"> <img src="img/logout.png" alt=""></a>