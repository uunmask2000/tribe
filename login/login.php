<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link href="../include/style.css" rel="stylesheet" type="text/css" />
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrap">

<!-------------------------------------- TOP -->
	<div id="header">
	<?php 
  session_start();
		include("../include/top.php"); 
		include_once("../SQL/dbtools.inc.php");
		$link = create_connection();
	?>
	</div>

<!-------------------------------------- MAIN -->
	 <?php
	if($_GET['mode']=='go')
	{
		$A =$_POST['username'];
		$B =$_POST['password'];
		
				$sql = "SELECT *  FROM web_user    where  	user_acc='$A' and user_pwd='$B'  ";
				$result = execute_sql($database_name, $sql, $link);
		  		 $check = mysql_num_rows($result);
		
		    if($check>0)
			{
				  while ($row = mysql_fetch_assoc($result))
				{
					    $_SESSION['user_name'] =  $row['user_name']   ;
				        $_SESSION['user_lv'] =  $row['user_lv']   ;
						$_SESSION['user_photo'] =  $row['user_photo']   ;
						$_SESSION['user_id'] =  $row['user_id']   ;
						
					    $_SESSION['login'] =  'login'   ;
						$name = $row['user_name']   ;
						$iipp = $_SERVER["REMOTE_ADDR"];
						
						
						$sql = "INSERT INTO login_log ( `login_log_name`, `login_log_ip`   ) VALUES('$name','$iipp') ";
						$result = execute_sql($database_name, $sql, $link);
						
							?>
							 <script>alert('登入成功');document.location.href="../index.php";</script>
							<?php
				  }
			             
				
				
						?>
					  <script>alert('登入成功');document.location.href="../index.php";</script>
						<?php
			
			
			}else{
			
			?><script> alert("登入不成功"); history.back() ;</script> <?php
			}
	
		
		
		
	}
	
	
	?>
	<div id="main">
	<div style="text-align:center;position: relative; top: 25px;">- 本系統建議使用 Chrome 瀏覽器 -</div>
	<form action="login.php?mode=go" method="post">
		<div id="login_tb">
			<table width="100%" cellpadding="10" cellspacing="0" border="0">
				<tr>
					<td>帳號</td>
					<td style="background:#fff"><input type="text" class="form-control" id="username" name="username" placeholder="Username" autofocus="autofocus"></td>
				</tr>
				<tr>
					<td>密碼</td>
					<td style="background:#fff"><input type="password" class="form-control" id="password" name="password" placeholder="Password"></td>
				</tr>
				<tr>
					<td colspan="2" style="background:#eee"><input type="submit" class="form-control" id="login_btn" name="" value="登入"></td>
				</tr>
			</table>
		</div>
		</form>
	</div>
	
<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</div>

</body>
</html>
