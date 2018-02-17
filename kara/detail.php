<?php 
include "./models/classDB.php";
if(isset($_GET['id']) && $_GET['id'] != ''){
	$db = new db;
	$id = $_GET['id'];
	settype($id,"int");
	$detail = $db->detail($id);
	$row = mysql_fetch_assoc($detail);
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- 1140px Grid styles for IE -->
<!--[if lte IE 9]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" /><![endif]-->
<!-- The 1140px Grid - http://cssgrid.net/ -->
<link rel="stylesheet" href="css/1140.css" type="text/css" media="screen" />
<!-- Your styles -->
<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen" />
<!--css3-mediaqueries-js - http://code.google.com/p/css3-mediaqueries-js/ - Enables media queries in some unsupported browsers-->
<script type="text/javascript" src="js/css3-mediaqueries.js"></script>
<title>Chi tiet Bai Hat</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css">
<script src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>

<script type="text/javascript" src="js/mkara.js"></script>
<!--Delete embedded styles, just for example.-->
<style type="text/css">
body {
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}
.container p {
	color: #fff;
	line-height: 100px;
	background: #000;
	text-align: center;
	margin: 20px 0 0 0;
}
</style>
</head>
<body>
	<div class="ui-bar ui-bar-b">
		<a href="index.php" data-role="button" data-inline="true" data-mini="true">Home</a>&nbsp;&nbsp;
		<a <?php if($_COOKIE['pass'] =='good'){ echo 'href="admin.php" '; } else { echo  ' href="login.php"  data-rel="dialog" '; }?> data-role="button" data-inline="true" data-mini="true">Nhập Bài Hát</a>
		
	</div><br/>
    <div class="container">
	<div class="row">
		<div class="twelvecol last">
			<h3><?php echo $row['tenbh'];?></h3>
		</div>
		<div class="twocol"><p>Hinh Ca Si</p></div>
		<div class="tencol last">
			<strong>Mã Bài Hát: </strong><input data-mini="true" <?php if((!isset($_COOKIE['pass'])) && ($_COOKIE['pass'] !='good')) echo "readonly" ?> type="text" value="<?php echo $row['mabh']; ?>" id="mabh" name="mabh" />
			
			<?php if((isset($_COOKIE['pass'])) && ($_COOKIE['pass'] =='good')): ?>
				<a id="update" href="#" data-role="button" data-inline="true" data-theme="b" data-mini="true">Cập Nhật Mã Bài Hát</a><?php endif;?><br/>
			<input type="hidden" name="idBH" id="idBH" value="<?php echo $_GET['id'];?>" />
			<strong>Ca Sĩ:</strong> <?php echo $row['casi']; ?><br/>
			<strong>Nhạc Sĩ: </strong><?php echo $row['nhacsi']; ?>
		</div>
		<div class="twelvecol last">
			<br/>
			<?php echo $row['loibh']; ?>
		</div>
	</div>
</div>
    <!-------------------->
    <div data-role="footer" data-id="foo1" data-position="fixed">
	<div data-role="navbar">
		<ul>
			<li><a href="casi.php" data-transition="slide" data-inline="true">Ca Sĩ</a></li>
            <li><a href="index.php" class="ui-btn-active ui-state-persist" data-transition="slide" data-inline="true">Bài Hát</a></li>
			<li><a href="loibh.php" data-transition="slide" data-inline="true">Lời Bài Hát</a></li>
			<li><a href="member.php" data-transition="slide" data-inline="true">Member</a></li>
		</ul>
	</div><!-- /navbar -->
</div><!-- /footer -->
</body>
</html>