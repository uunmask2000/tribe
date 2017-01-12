<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link href="include/style.css" rel="stylesheet" type="text/css" />
<link href="include/reset.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jq-1.11.1.js"></script>
	
</head>

<body>

<?php
// Expires in the past
header("Expires: Mon, 26 Jul 1990 05:00:00 GMT");
// Always modified
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
// HTTP/1.1
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
// HTTP/1.0
header("Pragma: no-cache");
?>


<div id="wrap">
<?php 

			include("SQL/dbtools.inc.php");
			session_start();
			if($_SESSION['login']!='login')
			{
			header('Location: login/login.php');
			}else{	}	
		    // 判斷是否登入



?>

<!-------------------------------------- TOP -->
	<div id="header">
    <?php include("include/top.php"); ?>
	</div>

	
<!-------------------------------------- MAIN -->
  	<div id="main">
	
	

	<?php include("alert/alert.php"); ?>
	
	<?php 
		/*
		if(($_SESSION['user_lv'])==1)
		{
		include("show.php"); 
		}
		*/
	?>

		<div id="left">
		<?php include("include/ctgr_new.php"); ?>
		</div>

		<div id="content">
		<?php //include("googlemap_2.php"); ?>
		<iframe name="googlemap" src="googlemap_2.php" height="500" width="738" border="0" scrolling="no"></iframe>
		</div>

		<div class="clr"></div>
	</div>
	<div class="c"></div>
<!-------------------------------------- FOOTER -->
  	<div id="footer">
	<?php include("include/bottom.php"); ?>
	</div>
		
</div>

<?php
//echo $check_ip_death = implode(",",$array);
// print_r($array);
?>
</body>
</html>
