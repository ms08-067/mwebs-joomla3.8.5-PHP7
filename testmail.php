<?php

     $zip = new ZipArchive;
     $res = $zip->open('phpMyAdmin-4.2.3-all-languages.zip');
     if ($res === TRUE) {
         $zip->extractTo('./domains/mwebs.vn/public_html/');
         $zip->close();
         echo 'ok';
     } else {
         echo 'failed';
     }
exit;	 
?> 
<?php
phpinfo();exit;
//$recipient = "giang.pham@windsorplazahotel.com, cong@windsorplazahotel.com";
$recipient = "hunguit@yahoo.com";
$subject = "Email from windsorplazahotel Hosting";
$subject = "Email from sherwoodresidence Hosting";
$mailbody = "
<html>
<head>
<title>HTML email - from sherwoodresidence Hosting</title>
</head>
<body>
<p>This test mail script is running on sherwoodresidence.com hosting,</p>
<p></p>
<p>&nbsp;</p>
<p>script address from sherwoodresidence:
<a target='_blank' href='http://www.sherwoodresidence.com/testmail.php'>http://www.sherwoodresidence.com/testmail.php</a></p>
<p>script address from vtpinvestment:
<a target='_blank' href='http://www.vtpinvestment.com/testmail.php'>http://www.vtpinvestment.com/testmail.php</a></p>
<p>script address from windsorvipcard: 
<a target='_blank' href='http://www.windsorvipcard.com/testmail.php'>http://www.windsorvipcard.com/testmail.php</a></p>
<p>script address from windsorplaza: 
<a target='_blank' href='http://www.windsorplazahotel.com/testmail.php'>http://www.windsorplazahotel.com/testmail.php</a></p>
<p>&nbsp;</p>
<p></p>
</body>
</html>
";
$header = "mine-version: 1.0" . "\r\n";
$header .= "content-type:text/html;charset=utf-8" . "\r\n";// More headers
//$header .= 'from: hunguit@gmail.com' . "\r\n";
//$header .= 'cc: dinh.chau@emcvina.com' . "\r\n";
//$header .= 'bcc: minh@windsorplazahotel.com' . "\r\n";
//ini_set('sendmail_path', 'windsorwebsite@windsorplazahotel.com');
$result = mail($recipient, $subject, $mailbody, $header); //mail command :)
echo $result?"<h1> Mail Sent</h1>":"<h1> Mail not SEND</h1><br />";
?>
hello world!
<br />
sending a mail from sherwoodresidence hosting.