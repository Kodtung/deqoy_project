<?php 
//ลบ session 
session_start();
session_destroy();

//เรียกใช้งาน sweetalert 
echo '
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  	';


  	echo '
					<script>
				       setTimeout(function() {
				        swal({
				            title: "Logout สำเร็จ !!",
				            type: "success"
				        }, function() {
				            window.location = "login.php";
				        });
				    });
				</script>
				';


//echo '<a href="session.php"> back to login </a> ';
?>