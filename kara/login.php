<?php 
require_once "./models/classDB.php";
if(isset($_POST['submit']) && !empty($_POST['password'])) {
	if($_POST['password'] == "good"){
		setcookie("pass", "good", time() + 60*60*5 );
		header('Location: admin.php');
	}
	
}	
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Check login</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css">
<script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
</head>
<body>
	
    <form style="background: #CCC;border-radius: 5px;" id="frm" action="" method="post">
    
        
        <!--<label for="text-basic">Tên Đăng Nhập</label>
        <input name="tenbh" id="text-basic" value="" type="text">-->
        <label for="text-basic">Mật Khẩu</label>
        <input name="password" id="password" value="" autocomplete="off" type="password">
		<?php 
			if(isset($_POST['submit']) && !empty($_POST['password'])) {
				if($_POST['password'] != "good"){
					echo "<label style='color: red;' for='text-basic'>Nhập sai mật khẩu</label><br/>";
				}
				
			}
		?>	
        
        <input data-theme="b" data-inline="true" value="Đăng nhập" type="submit" name="submit" />
    
    </form>
</body>
</html>