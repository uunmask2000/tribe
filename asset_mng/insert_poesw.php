<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<script type="text/javascript" src="../js/jquery-latest.js"></script>
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
<link href="../include/style.css" rel="stylesheet" type="text/css" />


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
		if($_GET['mode']=='insert_poesw')
		{
		
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
			
			$sql = " INSERT INTO `ass_poesw`( `ass_poesw_city`, `ass_poesw_twon`, `ass_poesw_tribe`, `ass_poesw_address`, `ass_poesw_name`, `ass_poesw_opennms`, `ass_poesw_version`, `ass_poesw_sn`, `ass_poesw_ip`, `ass_poesw_mac`, `ass_poesw_note`, `ass_poesw_pn`) VALUES('$city','$town','$tribe','$address','$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8')";
		 	$result = execute_sql($database_name, $sql, $link);
			
			$sql = "SELECT  MAX(ass_poesw_id) FROM ass_poesw  ";
			$result = execute_sql($database_name, $sql, $link);
			while ($row = mysql_fetch_assoc($result))
			{
			     //ass_other_id
				 $MAX_id = $row['MAX(ass_poesw_id)'];
				 
			}
			$now_time = date("Y-m-d H:i:s");
			$sql2 = " INSERT INTO ass_change_poe_sw(`ass_change_tribe_poe_sw`, `ass_change_own_poe_sw`, `ass_change_name_poe_sw`, `ass_change_sn_poe_sw`, `ass_change_mac_poe_sw`, `ass_change_pn_poe_sw`, `ass_change_note_poe_sw`, `ass_change_time_poe_sw`, ass_change_label_poe_sw) VALUES('$tribe','$MAX_id','$a1','$a4','$a6','$a8','建立','$now_time','3')";
		 	
			$result2 = execute_sql($database_name, $sql2, $link);
			
			
			
			echo"<script>alert('新增poesw');window.location.href = 'view_poesw.php';</script>";
			
		
		}
	
		
		
		?>

		<?php include("../include/asset_nav.php"); ?>
		
		<div class="tab_container">
			<table cellpadding="5" cellspacing="0" class="edit">
				<tr>
					<th colspan="2">新增資產</th>
				</tr>
				<tr>
					<td>資產類型</td>
					<td>
					POE Switch
					</td>
				</tr>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
				<tr>
					<td>資產位置</td>
					<td>
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
				<form action="?mode=insert_poesw" method="post">
					<input type="hidden" name="string" value="<?=$string?>">
				<tr>
					<td>資產名稱</td>
					<td><input type="text" name="data1"  value="" ></td>
				</tr>
				<tr>
					<td>OPEN NMS</td>
					<td>
					<input type="text" name="data2"  value="" >	
					</td>
				</tr>
				<tr>
					<td>品牌</td>
					<td>
					<input type="text" name="data3"  value="" >	
					</td>
				</tr>
				<tr>
					<td>SN</td>
					<td>
					<input type="text" name="data4"  value="" >	
					</td>
				</tr>
				<tr>
					<td>IP</td>
					<td>
					<input type="text" name="data5"  value="" >	
					</td>
				</tr>
				<tr>
					<td>MAC</td>
					<td>
					<input type="text" name="data6"  value="" >	
					</td>
				</tr>
					<tr>
					<td>note</td>
					<td>
					<input type="text" name="data7"  value="" >	
					</td>
				</tr>

					<tr>
					<td>pn</td>
					<td>
					<input type="text" name="data8"  value="" >	
					</td>
				</tr>



				<tr>
					<td colspan="2" align="center">
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
