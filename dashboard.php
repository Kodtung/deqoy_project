<?php
session_start();
// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่ หากไม่ได้เข้าสู่ระบบให้ redirect ไปหน้า login
if (!isset($_SESSION['id'])) {
  header("Location: index.php");
}

// สร้างการเชื่อมต่อฐานข้อมูล
$conn = mysqli_connect("localhost", "root", "", "bank");

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// รับฝากเงิน
if (isset($_POST['deposit'])) {
  $amount = $_POST['amount'];
  $new_balance = $user['balance'] + $amount;
  $sql = "UPDATE users SET balance='$new_balance' WHERE id='$user_id'";
  mysqli_query($conn, $sql);
  $user['balance'] = $new_balance;
}

// ถอนเงิน
if (isset($_POST['withdraw'])) {
  $amount = $_POST['amount'];
  if ($amount > $user['balance']) {
    echo "ยอดเงินในบัญชีไม่เพียงพอ";
  } else {
    $new_balance = $user['balance'] - $amount;
    $sql = "UPDATE users SET balance='$new_balance' WHERE id='$user_id'";
    mysqli_query($conn, $sql);
    $user['balance'] = $new_balance;
  }
}

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

<h1>ยินดีต้อนรับ, <?php echo $user['username']; ?></h1>
<p>ยอดเงินในบัญชีของคุณ: <?php echo number_format($user['balance'], 2); ?> บาท</p>

<h2>ฝากเงิน</h2>
<form method="post">
  <label for="amount">จำนวนเงิน:</label>
  <input type="number" id="amount" name="amount" required>
  <button type="submit" name="deposit">ฝากเงิน</button>
</form>

<h2>ถอนเงิน</h2>
<form method="post">
  <label for="amount">จำนวนเงิน:</label>
  <input type="number" id="amount" name="amount" required>
  <button type="submit" name="withdraw">ถอนเงิน</button>
</form>

<!doctype html>
<html lang="en">
    <a href="logout.php" onclick="return confirm('ยืนยันการออกจากระบบ');">ออกจากระบบ</a>