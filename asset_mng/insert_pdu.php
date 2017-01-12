<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<script type="text/javascript" src="../js/jquery-latest.js"></script>
<link href="../include/style.css" rel="stylesheet" type="text/css" />
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrap">

<!-------------------------------------- TOP -->
	<div id="header">
	  <?php include("../include/top.php"); 
		include_once("../SQL/dbtools.inc.php");
		$link = create_connection(); ?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">

		<?php include("../alert/alert2.php"); ?>

		<?php
		date_default_timezone_set('Asia/Taipei');
		if($_GET['mode']=='insert_pdu')
		{
		
				//	port[]
			//	portname[]
		//	portip[]
				 $port = $_POST['port'];
				 $portname = $_POST['portname'];
				 $portip = $_POST['portip'];
			/*
		print_r($port);
			echo '<br>';
			print_r($portname);
			echo '<br>';
			print_r($portip);
			echo '<br>';
			*/
			$port = implode('-',$port);
			$portname = implode('-',$portname);
			$portip = implode('-',$portip);
			/*
			echo $port;
			echo '<br>';
			
			echo $portname;
			echo '<br>';
			
			echo $portip;
			echo '<br>';
			*/
			//exit();
			
			////
			
		 				 $string = $_POST['string'];
						$string = explode("-", $string);

						$city =  $string[0]; // piece1
						$town =  $string[1]; // piece2
						$tribe =  $string[2]; // piece2
						$address =  $string[3]; // piece2
			 if(empty($city))
			  {
							  echo"<script>alert(' 未選擇城市   ');history.go(-1);</script>";
				  exit();
				  
			  }else  if(empty($town))
			  {
							  echo"<script>alert(' 未選擇town    ');history.go(-1);</script>";
				   exit();
			  }else  if(empty($tribe))
			  {
							  echo"<script>alert(' 未選擇tribe   ');history.go(-1);</script>";
				   exit();
			  }else  if(empty($address))
			  {
							  echo"<script>alert(' 未選擇 address   ');history.go(-1);</script>";
				   exit();
			  }       
			
			
			
			     $a1   = trim($_POST['data1']);
				 $a2   = trim($_POST['data2']);
				 $a3   = trim($_POST['data3']);
				 $a4   = trim($_POST['data4']);
				 $a5   = trim($_POST['data5']);
				 $a6   =trim($_POST['data6']);
				 $a7   = trim($_POST['data7']);
				 $a8   = trim($_POST['data8']);
				$port =   trim($port);
				$portname =  trim($portname);
				$portip =  trim($portip);
				
			
			$sql = " INSERT INTO `ass_pdu`( `ass_pdu_city`, `ass_pdu_twon`, `ass_pdu_tribe`, `ass_pdu_address`, `ass_pdu_name`, `ass_pdu_opennms`, `ass_pdu_version`, `ass_pdu_sn`, `ass_pdu_ip`, `ass_pdu_mac`, `ass_pdu_note`, `ass_pdu_pn`, `port`, `portname`, `portip`) VALUES('$city','$town','$tribe','$address','$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$port','$portname','$portip')";
		 	$result = execute_sql($database_name, $sql, $link);
			
			$sql = "SELECT  MAX(ass_pdu_id) FROM ass_pdu  ";
			$result = execute_sql($database_name, $sql, $link);
			while ($row = mysql_fetch_assoc($result))
			{
			     //ass_other_id
				 $MAX_id = $row['MAX(ass_pdu_id)'];
				 
			}
			$now_time = date("Y-m-d H:i:s");
			$sql2 = " INSERT INTO ass_change_PDU(`ass_change_tribe_PDU`, `ass_change_own_PDU`, `ass_change_name_PDU`, `ass_change_sn_PDU`, `ass_change_mac_PDU`, `ass_change_pn_PDU`, `ass_change_note_PDU`, `ass_change_time_PDU`, ass_change_label_PDU) VALUES('$tribe','$MAX_id','$a1','$a4','$a6','$a8','建立','$now_time','3')";
		 	
			$result2 = execute_sql($database_name, $sql2, $link);
			
			
			echo"<script>alert('新增pdu');window.location.href = 'view_pdu.php';</script>";
			
		
		}
	
		
		
		?>

		<?php include("../include/asset_nav.php"); ?>
		
		<div class="tab_container">
			<table cellpadding="5" cellspacing="0" class="edit">
				<tr>
					<th colspan="6">新增資產</th>
				</tr>
				<tr>
					<td>資產類型</td>
					<td>
						PDU
					</td>
				</tr>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
				<tr>
					<td colspan="2">資產位置</td>
					<td colspan="4">
						<select id="list" name="city" onchange="this.form.submit();">
					<option value=""selected >全部</option>
					<?php
					//執行 SQL 命令
					$sql = "SELECT *  FROM  city_array ORDER BY city_sort ASC  ";
					$result = execute_sql($database_name, $sql, $link);
					while ($row = mysql_fetch_assoc($result))
						{
							$A = $row['id'] ;
							$B =  $_GET['city'] ;
                                                    ?>
		       						<option value="<?=$A;?>" <?php if($A==$B){echo 'selected';}else{};	?> ><?php   echo $row['city_name'] ;?></option>

							<?php

						}
					?>
					
						
					</select>

					<select id="list" name="town" onchange="this.form.submit();">
						<option value="" selected disabled="disabled">請選擇地區</option>
						
	<?php
		//執行 SQL 命令
                                         
		$sql1 = "SELECT *  FROM  city_township where township_city='$B'  ";
		$result1 = execute_sql($database_name, $sql1, $link);
	while ($row1 = mysql_fetch_assoc($result1))
	{
		$A1 = $row1['township_id'] ;
		$B1 =  $_GET['town'] ;
         	?>
	<option value="<?=$A1;?>" <?php if($A1==$B1){echo 'selected';}else{};	?> ><?php   echo $row1['township_name'] ;?></option>
		<?php

	}
	?>

					</select>



	<select id="list" name="tribe" onchange="this.form.submit();">
						<option value="" selected disabled="disabled">請選擇部落</option>
						
	<?php
		//執行 SQL 命令
                                         
		$sql2 = "SELECT *  FROM  tribe where township_id='$B1'  ";
		$result2 = execute_sql($database_name, $sql2, $link);
	while ($row2 = mysql_fetch_assoc($result2))
	{
		$A11 = $row2['tribe_id'] ;
		$B11 =  $_GET['tribe'] ;
         	?>
	<option value="<?=$A11;?>" <?php if($A11==$B11){echo 'selected';}else{};	?> ><?php   echo $row2['tribe_name'] ;?></option>
		<?php

	}
	?>

	</select>
						<select id="list" name="assets_address" onchange="this.form.submit();">
						<option value="" selected disabled="disabled">請選擇錨點</option>
						
					<?php
						//執行 SQL 命令

						$sql3 = "SELECT *  FROM  assets_address where tribe_ass_own='$B11'  ";
						$result3 = execute_sql($database_name, $sql3, $link);
					while ($row3 = mysql_fetch_assoc($result3))
					{
						$A111 = $row3['ass_address_id'] ;
						$B111 =  $_GET['assets_address'] ;
							?>
					<option value="<?=$A111;?>" <?php if($A111==$B111){echo 'selected';}else{};	?> ><?php   echo $row3['tribe_ass_name'] ;?></option>
						<?php

					}
					?>

					</select>
				
				
						<?php                  $string =  $B.'-'.$B1.'-'.$B11.'-'.$B111;          ?>
					</td>
				</tr>
				</form>


				<form action="?mode=insert_pdu" method="post">
					<input type="hidden" name="string" value="<?=$string?>">
				<tr>
					<td colspan="2">資產名稱</td>
					<td colspan="4"><input type="text" name="data1"  value="" ></td>
				</tr>
				<tr>
					<td colspan="2">OPEN NMS</td>
					<td colspan="4">
					<input type="text" name="data2"  value="" >	
					</td>
				</tr>
				<tr>
					<td colspan="2">品牌</td>
					<td colspan="4">
					<input type="text" name="data3"  value="" >	
					</td>
				</tr>
				<tr>
					<td colspan="2">S/N</td>
					<td colspan="4">
					<input type="text" name="data4"  value="" >	
					</td>
				</tr>
				<tr>
					<td colspan="2">IP</td>
					<td colspan="4">
					<input type="text" name="data5"  value="" >	
					</td>
				</tr>
				<tr>
					<td colspan="2">MAC</td>
					<td colspan="4">
					<input type="text" name="data6"  value="" >	
					</td>
				</tr>
					

					<tr>
					<td colspan="2">P/N</td>
					<td colspan="4">
					<input type="text" name="data8"  value="" >	
					</td>
					</tr>
			
                                    <tr> 

					<tr>
					<td colspan="2">備註</td>
					<td colspan="4">
					<input type="text" name="data7"  value="" >	
					</td>
					</tr>
 
						
						<th colspan="6" align="center">
								PDU 8 port
						</th>
					</tr>
					
				<tr>
					<!-------------------------------->
			<td>port1</td>
						<td>
								<input type="hidden" name="port[]"  value="1" >	
						</td>
				<td>port1_name</td>
						<td>
							<input type="text" name="portname[]"  value="分控箱一">
						</td>
					
						<td>port1_ip</td>
						<td>
							<input type="text" name="portip[]"  value="" >
						</td>
					</tr>
					<!-------------------------------->
					<td>port2</td>
						<td>
								<input type="hidden" name="port[]"  value="2" >	
						</td>
				<td>port2_name</td>
						<td>
							<input type="text" name="portname[]"  value="分控箱二" >
						</td>
					<td>port2_ip</td>
						<td>
							<input type="text" name="portip[]"  value=""" >
						</td>
					</tr>
					<!-------------------------------->
				<td>port3</td>
						<td>
								<input type="hidden" name="port[]"  value="3" >	
						</td>
				<td>port3_name</td>
						<td>
							<input type="text" name="portname[]"  value="未使用" >
						</td>
				<td>port3_ip</td>
						<td>
							<input type="text" name="portip[]"  value="" >
						</td>
					</tr>
					<!-------------------------------->
			<td>port4</td>
						<td>
								<input type="hidden" name="port[]"  value="4" >	
						</td>
				<td>port4_name</td>
						<td>
							<input type="text" name="portname[]"  value="未使用" >
						</td>
			<td>port4_ip</td>
						<td>
							<input type="text" name="portip[]"  value="" >
						</td>
					</tr>
					<!-------------------------------->
		<td>port5</td>
						<td>
								<input type="hidden" name="port[]"  value="5" >	
						</td>
				<td>port5_name</td>
						<td>
							<input type="text" name="portname[]"  value="風扇" >
						</td>
		<td>port5_ip</td>
						<td>
							<input type="text" name="portip[]"  value="" >
						</td>
					</tr>
					<!-------------------------------->
	<td>port6</td>
						<td>
								<input type="hidden" name="port[]"  value="6" >	
						</td>
				<td>port6_name</td>
						<td>
							<input type="text" name="portname[]"  value="PoE與4G_Router" >
						</td>
	<td>port6_ip</td>
						<td>
							<input type="text" name="portip[]"  value="" >
						</td>
					</tr>
					<!-------------------------------->
	<td>port7</td>
						<td>
								<input type="hidden" name="port[]"  value="7" >	
						</td>
				<td>port7_name</td>
						<td>
							<input type="text" name="portname[]"  value="Firewall" >
						</td>
	<td>port7_ip</td>
						<td>
							<input type="text" name="portip[]"  value="" >
						</td>
					</tr>
					<!-------------------------------->
	<td>port8</td>
						<td>
								<input type="hidden" name="port[]"  value="8" >	
						</td>
				<td>port8_name</td>
						<td>
							<input type="text" name="portname[]"  value="5_port排插" >
						</td>
	<td>port8_ip</td>
						<td>
							<input type="text" name="portip[]"  value="" >
						</td>
					</tr>
					<!-------------------------------->
				
		
					
						
						
			

				<tr>
					<td colspan="6" align="center">
						<input class="edit_btn" type="submit" value="儲存">
						<input class="edit_btn" type="button" onClick="history.back()" value="回上頁">
					</td>
				</tr>
					
					</form>
			</table>
		</div>	
	</div>	

<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>
		
</div>

</body>
</html>
