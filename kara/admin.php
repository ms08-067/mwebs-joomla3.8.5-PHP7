<?php 
if(isset($_COOKIE['pass']) && $_COOKIE['pass'] == 'good'):
require_once "./models/classDB.php";
if(isset($_POST['submit']) && !empty($_POST['tenbh'])) {

	$db = new db;
	$db->addToList($_POST);
	
}	
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Karaoke</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css">
<script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
</head>
<body>
	<div class="ui-bar ui-bar-b">
		<a href="index.php" data-role="button" data-inline="true" data-mini="true">Home</a>
	</div>
	
    <form id="frm" action="admin.php" method="post">
    
        <label for="text-basic">Mã số bài hát: </label>
        <input name="mabh" pattern="[0-9]*" id="number-pattern" value="" type="number">
        <label for="text-basic">Tên bài hát:</label>
        <input name="tenbh" id="text-basic" value="" type="text">
        <label for="text-basic">Ca Sĩ:</label>
        <input name="casi" id="text-basic" value="" type="text">
        <label for="text-basic">Nhạc Sĩ:</label>
        <input name="nhacsi" id="text-basic" value="" type="text">
        <label for="textarea">Lời bài hát:</label>
        <textarea cols="40" rows="8" name="loibh" id="textarea"></textarea>
        <input data-theme="b" data-inline="true" value="Nhập Dữ Liệu" type="submit" name="submit" />
    
    </form>
    <!-------------------->
    <div data-role="footer" data-id="foo1" data-position="fixed">
	<div data-role="navbar">
		<ul>
			<li><a href="casi.php">Ca Sĩ</a></li>
            <li><a href="index.php" class="ui-btn-active ui-state-persist">Bài Hát</a></li>
			<li><a href="loibh.php" data-transition="slide" data-inline="true">Lời Bài Hát</a></li>
			<li><a href="member.php">Member</a></li>
		</ul>
	</div><!-- /navbar -->
</div><!-- /footer -->
</body>
</html>
<?php 
else: 
	header('Location: index.php');
endif;
?>