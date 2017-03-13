<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link href="include/style.css" rel="stylesheet" type="text/css" />
<link href="include/reset.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jq-1.11.1.js"></script>
</head>

<body>
<div id="wrap">

<!-------------------------------------- TOP -->
<div id="header">
	<?php

		include("include/top.php");
		include_once("SQL/dbtools.inc.php");
		$link = create_connection();

	?>

    <?php
		//$_GET['ip'] = '172.21.19.5';
		$IP=$_GET['ip'];


  // $datetime = date ("H:i" , mktime(date('H')+8, date('i'))) ;
 	//echo  $datetime;
	//echo '<br>';



				$sql = "SELECT *  FROM ass_pdu where ass_pdu_ip='$IP' ";
				$result = execute_sql($database_name, $sql, $link);
				while ($row = mysql_fetch_assoc($result))
				{
				 		 $port = $row['port'];
						 $portname = $row['portname'];
				    	 $portip = $row['portip'];
						 $ass_pdu_tribe = $row['ass_pdu_tribe'];
                   //echo   $port;
                   //echo   $portname;
                   //echo   $portip;
				       $port = explode("-",$port);
					$portname = explode("-",$portname);
				 	$portip = explode("-",$portip);
				 	

				}
				
				
				$SQL2 = "SELECT *  FROM ass_pdu
						INNER JOIN tribe ON  tribe.tribe_id = ass_pdu.ass_pdu_tribe
						INNER JOIN city_township ON city_township.township_id = ass_pdu.ass_pdu_twon
						INNER JOIN city_array ON  city_array.id = ass_pdu.ass_pdu_city
						where  ass_pdu.ass_pdu_ip = '$IP'
						ORDER BY city_array.city_sort";
				$result2 = execute_sql($database_name, $SQL2, $link);
				while ($row2 = mysql_fetch_assoc($result2))
				{
				$tribe_name = $row2['tribe_name'];
				}
				
 //$port ='A1-A2-A3-A4-A5-A6-A7-A8';
 //$portname='分空箱1POE_SW-分空箱2POE_SW-未使用-未使用-風扇-主空箱2POE_SW與4G_Router-Firewall-中華電信小烏龜';
 //$portip='A1-A2-A3-A4-A5-A6-A7-A8';


            			      // $port = explode("-",$port);
					//$portname = explode("-",$portname);
				 	//$portip = explode("-",$portip);
    ?>

	</div>

	<?php
	if($_GET['do']=='off' and $_GET['id']!=null)
	{


		$host = $IP ;

		$port = 6722;
		// No Timeout
		$id =	$_GET['id'];
		$time = '00';
		//
		set_time_limit(0);
		$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("無法建立連線\n");
		$result = socket_connect($socket, $host, $port) or die("無法連線\n");
		//$message="21:00";
		$message = $id.':'.$time;
		socket_write($socket, $message, strlen($message)) or die("訊息無法傳達\n");
		$result = socket_read ($socket, 1024) or die("無法讀取伺服器回饋訊息\n");

		socket_close($socket);

			//header("Location: ap_data.php?ip=$IP");
			?>
			<script>
			setTimeout("location.href='ap_data.php?ip=<?=$IP;?>'",1000);
			</script>
			<?php

	}else if($_GET['do']=='on' and $_GET['id']!=null)
	{

	    $host = $IP ;
		$port = 6722;
		//echo $host;
		// No Timeout
		$id =	$_GET['id'];
		$time = '00';
                //
		set_time_limit(0);
		$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("無法建立連線\n");
		$result = socket_connect($socket, $host, $port) or die("無法連線\n");
		//$message="11:00";
		$message = $id.':'.$time;

		socket_write($socket, $message, strlen($message)) or die("訊息無法傳達\n");
		$result = socket_read ($socket, 1024) or die("無法讀取伺服器回饋訊息\n");

		socket_close($socket);

			//header("Location: ap_data.php?ip=$IP");
			?>
			<script>
			setTimeout("location.href='ap_data.php?ip=<?=$IP;?>'",1000);
			</script>
			<?php
			
	}else  if($_GET['do']=='re' and $_GET['id']!=null)
	{
		$host = $IP ;
		$port = 6722;
		// No Timeout
		$id =	$_GET['id'];
		$time = $_GET['time'];
                //
		set_time_limit(0);
		$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("無法建立連線\n");
		$result = socket_connect($socket, $host, $port) or die("無法連線\n");
		//$message="11:00";
		$message = $id.':'.$time;

		socket_write($socket, $message, strlen($message)) or die("訊息無法傳達\n");
		$result = socket_read ($socket, 1024) or die("無法讀取伺服器回饋訊息\n");

		socket_close($socket);

    	header("Location: ap_data.php?ip=$IP&do_F5=do_F5");



	}else
	{

              if($_GET['do_F5']=='do_F5')
		{
		$host = $IP ;
		$port = 6722;
		// No Timeout
		set_time_limit(0);
		$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("無法建立連線\n");
		$result = socket_connect($socket, $host, $port) or die("無法連線\n");
		$message="00:00";
		socket_write($socket, $message, strlen($message)) or die("訊息無法傳達\n");
		$result = socket_read ($socket, 1024) or die("無法讀取伺服器回饋訊息\n");
		//echo "Reply From Server  :".$result;
		socket_close($socket);
		$byte= $result;

		//$byte ="00000001";
		$Arr2 =str_split($byte,1);
                  ?>
		<script>
			setTimeout("location.href='ap_data.php?ip=<?=$IP;?>'",10000);
		</script>

               <?php






		}else
		{



		//$host = "172.21.201.23";
		$host = $IP ;
		$port = 6722;
		// No Timeout
		set_time_limit(0);
		$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("無法建立連線\n");
		$result = socket_connect($socket, $host, $port) or die("無法連線\n");
		$message="00:00";
		socket_write($socket, $message, strlen($message)) or die("訊息無法傳達\n");
		$result = socket_read ($socket, 1024) or die("無法讀取伺服器回饋訊息\n");
		//echo "Reply From Server  :".$result;
		socket_close($socket);
		$byte= $result;

		//$byte ="00000001";
		$Arr2 =str_split($byte,1);

		}

	}


	?>
	<!--
<script language="JavaScript">
function myrefresh()
{
   window.location.reload();
}
setTimeout('myrefresh()',1000); //指定1秒刷新一次
</script>
        -->
<!-------------------------------------- MAIN -->
	<div id="main">


		<?php include("alert/alert.php"); ?>

		<div id="content0">
			<div id="port_data">
				<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td>　部落:<?php echo $tribe_name;?></td>
					<td>　IP:<?php echo $IP;?></td>
				</tr>
				</table>
			</div>
			<?php



			?>
			<table width="718px" cellpadding="5" cellspacing="0" class="port">
				<tr>
					<td width="100">設備開關</td>
					<td><div class="data_wid"><a href="<?=$portip[0]?>" target="_blank"><?=$portname[0];?></a></div></td>
					<td><div class="data_wid"><a href="<?=$portip[1]?>" target="_blank"><?=$portname[1];?></a></div></td>
					<td><div class="data_wid"><a href="<?=$portip[2]?>" target="_blank"><?=$portname[2];?></a></div></td>
					<td><div class="data_wid"><a href="<?=$portip[3]?>" target="_blank"><?=$portname[3];?></a></div></td>
				</tr>
				<tr>
					<td>狀態</td>
					<td><div class="port_power">
							<?php
								//echo  $Arr2[0];
							if($Arr2[0]==0)
							{
								?>
								<img src="images/active.png" alt="on" height="100%" >
								<?php
							}else
							{
								?>
								<img src="images/inactive.png" alt="off" height="100%" >
								<?php
							}

							?>
						</div></td>
					<td><div class="port_power"><?php
								//echo  $Arr2[0];
							if($Arr2[1]==0)
							{
								?>
								<img src="images/active.png" alt="on" height="100%" >
								<?php
							}else
							{
								?>
								<img src="images/inactive.png" alt="off" height="100%" >
								<?php
							}

							?></div></td>
					<td><div class="port_power"><?php
								//echo  $Arr2[0];
							if($Arr2[2]==0)
							{
								?>
								<img src="images/active.png" alt="on" height="100%" >
								<?php
							}else
							{
								?>
								<img src="images/inactive.png" alt="off" height="100%" >
								<?php
							}

							?></div></td>
					<td><div class="port_power"><?php
								//echo  $Arr2[0];
							if($Arr2[3]==0)
							{
								?>
								<img src="images/active.png" alt="on" height="100%" > 重要
								<?php
							}else
							{
								?>
								<img src="images/inactive.png" alt="off" height="100%" > 重要
								<?php
							}

							?></div></td>
				</tr>
				<tr>
					<td>控制</td>
					<td>
						<div class="switch">
						<?php
								//echo  $Arr2[0];
							if($Arr2[0]==0)
							{
								?>
								<input class="on" type="button" value="" onclick="location.href='ap_data.php?do=on&id=11&ip=<?php echo $_GET['ip']; ?>'">

								<?php
							}else
							{
								?>
								<input class="off" type="button" value="" onclick="location.href='ap_data.php?do=off&id=21&ip=<?php echo $_GET['ip']; ?>'">

								<?php
							}

							?>

							<!-- <input class="reset" type="button" value="重置" onclick="location.href='ap_data.php?do=re&id=1'">  -->
						</div>
					</td>
					<td>
						<div class="switch">
						<?php
								//echo  $Arr2[0];
							if($Arr2[1]==0)
							{
								?>
								<input class="on" type="button" value="" onclick="location.href='ap_data.php?do=on&id=12&ip=<?php echo $_GET['ip']; ?>'">

								<?php
							}else
							{
								?>
								<input class="off" type="button" value="" onclick="location.href='ap_data.php?do=off&id=22&ip=<?php echo $_GET['ip']; ?>'">

								<?php
							}

							?>

							<!-- <input class="reset" type="button" value="重置" onclick="location.href='ap_data.php?do=re&id=2'">  -->
						</div>
					</td>
					<td>
						<div class="switch">
						<?php
								//echo  $Arr2[0];
							if($Arr2[2]==0)
							{
								?>
								<input class="on" type="button" value="" onclick="location.href='ap_data.php?do=on&id=13&ip=<?php echo $_GET['ip']; ?>'">

								<?php
							}else
							{
								?>
								<input class="off" type="button" value="" onclick="location.href='ap_data.php?do=off&id=23&ip=<?php echo $_GET['ip']; ?>'">

								<?php
							}

							?>

							<!-- <input class="reset" type="button" value="重置" onclick="location.href='ap_data.php?do=re&id=3'">  -->
						</div>
					</td>
					<td>
						<div class="switch">
						<?php
								//echo  $Arr2[0];
							if($Arr2[3]==0)
							{
								/*
								?>
								<input class="on" type="button" value="" onclick="location.href='ap_data.php?do=on&id=14&ip=<?php echo $_GET['ip']; ?>'">

								<?php
								*/
							}else
							{
								?>
								<input class="off" type="button" value="" onclick="location.href='ap_data.php?do=off&id=24&ip=<?php echo $_GET['ip']; ?>'">

								<?php
							}

							?>
			<input class="reset" type="button" value="斷電10秒開機" onclick="location.href='ap_data.php?do=re&id=14&time=10&ip=<?php echo $_GET['ip']; ?>'">

						</div>
					</td>
				</tr>
			</table>

			<table width="718px" cellpadding="5" cellspacing="0" class="port">
				<tr>
					<td width="100">設備開關</td>
					<td><div class="data_wid"><a href="<?=$portip[4]?>" target="_blank"><?=$portname[4];?></a></div></td>
					<td><div class="data_wid"><a href="<?=$portip[5]?>" target="_blank"><?=$portname[5];?></a></div></td>
					<td><div class="data_wid"><a href="<?=$portip[6]?>" target="_blank"><?=$portname[6];?></a></div></td>
					<td><div class="data_wid"><a href="<?=$portip[7]?>" target="_blank"><?=$portname[7];?></a></div></td>
				</tr>
				<tr>
					<td>狀態</td>
					<td><div class="port_power"><?php
								//echo  $Arr2[0];
							if($Arr2[4]==0)
							{
								?>
								<img src="images/active.png" alt="on" height="100%" >
								<?php
							}else
							{
								?>
								<img src="images/inactive.png" alt="off" height="100%" >
								<?php
							}

							?></div></td>
					<td><div class="port_power"><?php
								//echo  $Arr2[0];
							if($Arr2[5]==0)
							{
								?>
								<img src="images/active.png" alt="on" height="100%" >
								<?php
							}else
							{
								?>
								<img src="images/inactive.png" alt="off" height="100%" >
								<?php
							}

							?></div></td>
					<td><div class="port_power"><?php
								//echo  $Arr2[0];
							if($Arr2[6]==0)
							{
								?>
								<img src="images/active.png" alt="on" height="100%" > 重要
								<?php
							}else
							{
								?>
								<img src="images/inactive.png" alt="off" height="100%" > 重要
								<?php
							}

							?></div></td>
					<td><div class="port_power"><?php
								//echo  $Arr2[0];
							if($Arr2[7]==0)
							{
								?>
								<img src="images/active.png" alt="on" height="100%" > 重要
								<?php
							}else
							{
								?>
								<img src="images/inactive.png" alt="off" height="100%" > 重要
								<?php
							}

							?></div></td>
				</tr>
				<tr>
					<td>控制</td>
					<td>
						<div class="switch">
						自動關機時間：每日23:59<br>
						自動開機時間：每日06:30<br>
						<?php
								//echo  $Arr2[0];
							if($Arr2[4]==0)
							{/*
								?>
								<input class="on" type="button" value="" onclick="location.href='ap_data.php?do=on&id=15&ip=<?php echo $_GET['ip']; ?>'">

								<?php
								*/
							}else
							{
								?>
								<input class="off" type="button" value="" onclick="location.href='ap_data.php?do=off&id=25&ip=<?php echo $_GET['ip']; ?>'">

								<?php
							}

							?>
						<!--
							<input class="reset" type="button" value="重置" onclick="location.href='ap_data.php?do=re&id=5'">  -->
						</div>
					</td>
					<td>
						<div class="switch">
						<?php
								//echo  $Arr2[0];
							if($Arr2[5]==0)
							{
								?>
								<input class="on" type="button" value="" onclick="location.href='ap_data.php?do=on&id=16&ip=<?php echo $_GET['ip']; ?>'">

								<?php
							}else
							{
								?>
								<input class="off" type="button" value="開" onclick="location.href='ap_data.php?do=off&id=26&ip=<?php echo $_GET['ip']; ?>'">

								<?php
							}

							?>
						<!--
							<input class="reset" type="button" value="重置" onclick="location.href='ap_data.php?do=re&id=6'"> -->
						</div>
					</td>
					<td>
						<div class="switch">
						<?php
								//echo  $Arr2[0];
							if($Arr2[6]==0)
							{/*
								?>
								<input class="on" type="button" value="" onclick="location.href='ap_data.php?do=on&id=17&ip=<?php echo $_GET['ip']; ?>'">

								<?php
								*/
							}else
							{
								?>
								<input class="off" type="button" value="" onclick="location.href='ap_data.php?do=off&id=27&ip=<?php echo $_GET['ip']; ?>'">

								<?php
							}

							?>
						<input class="reset" type="button" value="斷電10秒開機" onclick="location.href='ap_data.php?do=re&id=17&time=10&ip=<?php echo $_GET['ip']; ?>'">

					</td>
					<td>
						<div class="switch">
							自動重開機時間：每6小時<br>
						<?php
								//echo  $Arr2[0];
							if($Arr2[7]==0)
							{/*
								?>
								<input class="on" type="button" value="" onclick="location.href='ap_data.php?do=on&id=18&ip=<?php echo $_GET['ip']; ?>'">

								<?php
								*/
							}else
							{

								?>
								<input class="off" type="button" value="" onclick="location.href='ap_data.php?do=off&id=28&ip=<?php echo $_GET['ip']; ?>'">

								<?php
							}

							?>
		<?php
		/*
		<input class="reset" type="button" value="斷電10秒開機" onclick="location.href='ap_data.php?do=re&id=18&time=10&ip=<?php echo $_GET['ip']; ?>'">
		*/							
		?>
							
						</div>
					</td>
				</tr>
			</table>

		</div>
		<div class="clr"></div>

	</div>

<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("include/bottom.php"); ?>
	</div>

</div>

</body>
</html>
