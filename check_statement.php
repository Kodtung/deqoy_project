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


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="css/statement.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>

    <title>WebBank</title>
</head>

<body>
    <h1>Statement , <?php echo $user['username']; ?></h1>
    <div class="main-statement container-fluid">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <!-- <th>id</th> -->
                    <th>Balance</th>
                    <th>DateTime</th>
                    <th>Withdraw</th>
                    <th>Deposit</th>
                </tr>
            </thead>
            <tbody>

                <?php
                while ($result = $result->fetch_assoc()) {
                    echo "<tr>";
                    // echo "<td>" . $statement["id"] . "</td>";
                    echo "<td>" . $result["Balance"] . "</td>";
                    echo "<td>" . $result["dTime"] . "</td>";
                    echo "<td>" . $result["withdraw"] . "</td>";
                    echo "<td>" . $result["deposit"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <form action="home.php">
        <button type="submit" margin-left="3px">BACK</button>
    </form>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                order: [[1, 'desc']],
            });
            
        });
    </script>
</body>


</html>