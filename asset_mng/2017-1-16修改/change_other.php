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
	<?php
	session_start();
			$keyin_man = $_SESSION['user_name'] ;
	date_default_timezone_set("Asia/Taipei");
	if($_GET['mode']=='change_other')
	{


	$ckeck_key =$_POST['ckeck_key'];
	if($ckeck_key=='check')
	{

	$uid =$_POST['uid'];
	//echo $today = date("Y_m_d_H:i");

	/*

	* ass_other_name
	ass_other_sn
	ass_other_mac
	ass_other_pn
	* message
	* */

	//new   //ass_change_label_other   //ass_other_label
	$ass_other_name   = trim($_POST['ass_other_name']);
	$ass_other_sn   = trim($_POST['ass_other_sn']);
	$ass_other_mac   = trim($_POST['ass_other_mac']);
	$ass_other_pn   = trim($_POST['ass_other_pn']);
	$message   = trim($_POST['message']);
	$ass_other_label   = trim($_POST['ass_other_label']);


	//old_ass_other_tribe
	$old_ass_other_name   = trim($_POST['old_ass_other_name']);
	$old_ass_other_tribe   = trim($_POST['old_ass_other_tribe']);
	$old_ass_other_sn   = trim($_POST['old_ass_other_sn']);
	$old_ass_other_mac   = trim($_POST['old_ass_other_mac']);
	$old_ass_other_pn   = trim($_POST['old_ass_other_pn']);

	$old_ass_other_label  = trim($_POST['old_ass_other_label']);
	//
	$today = date("Y-m-d H:i");
	if(empty($ass_other_name ))
	{
	?><script>alert('資產名稱空白?');history.back()</script><?php 
	exit();   
	}else if(empty($ass_other_sn ))
	{
	?><script>alert('SN空白?');history.back()</script><?php 
	exit();   
	}else if(empty($message ))
	{
	?><script>alert('更換理由?');history.back()</script><?php 
	exit();   
	}


	$sql =" UPDATE ass_other SET ass_other_name='$ass_other_name',ass_other_sn='$ass_other_sn',ass_other_mac='$ass_other_mac',ass_other_pn='$ass_other_pn',ass_other_label='$ass_other_label' WHERE ass_other_id='$uid' ";
	$result = execute_sql($database_name, $sql, $link);
	//'$old_ass_other_tribe','$uid ','$old_ass_other_name','$old_ass_other_sn','$old_ass_other_mac','$old_ass_other_pn'	,'$message','$today'
	$sql ="INSERT INTO ass_change_other (`ass_change_tribe_other`, `ass_change_own_other`, `ass_change_name_other`, `ass_change_sn_other`, `ass_change_mac_other`, `ass_change_pn_other`, `ass_change_note_other`, `ass_change_time_other`,ass_change_label_other,keyin_man) 
	VALUES ('$old_ass_other_tribe','$uid ','$ass_other_name','$ass_other_sn','$ass_other_mac','$ass_other_pn'	,'$message','$today','$ass_other_label','$keyin_man')";
	$result = execute_sql($database_name, $sql, $link);
	//exit();
	//$sql = " UPDATE ass_other SET `ass_other_name`='$a1',`ass_other_opennms`='$a2',`ass_other_version`='$a3',`ass_other_sn`='$a4',`ass_other_ip`='$a5',`ass_other_mac`='$a6',`ass_other_note`='$a7',`ass_other_pn`='$a8' WHERE ass_other_id='$uid'";
	//$result = execute_sql($database_name, $sql, $link);

	//echo"<script>alert('更換other_ok');window.location.href = 'view_other.php';</script>";
	echo"<script>alert('資料已更換');history.back();document.URL=location.href;</script>";
	}else{  ?><script>alert('104!?');document.location.href="view_other.php";</script><?php       }




	}



	?>

<!-------------------------------------- MAIN -->
	<div id="main">

		<?php include("../alert/alert2.php"); ?>

		<?php include("../include/asset_nav.php"); ?>

		<div class="tab_container">
			
			<table cellpadding="5" cellspacing="0" class="edit">
		<tr>
		<td>資產位置</td>
		<td colspan="6"><?=$_GET['LONG_TXT'];?></td>
		</tr>

		<tr>
					<th colspan="7">履歷清單</th>
				</tr>
				<tr>
					<td>時間</td>
                    <td>資產名稱</td>
					<td>S/N</td>
					<td>MAC</td>
					<td>P/N</td>
					<td>期別</td>
					<td>理由</td>
				</tr>
				<?php
				$id= $_GET['id'];
				$sql = "SELECT *  FROM ass_change_other where ass_change_own_other='$id' ";
				$result = execute_sql($database_name, $sql, $link);
				while ($row = mysql_fetch_assoc($result))
				{			
					   $ass_change_time_other = $row['ass_change_time_other'];
						$ass_change_name_other = $row['ass_change_name_other'];
 						$ass_change_sn_other= $row['ass_change_sn_other'];
 						$ass_change_mac_other = $row['ass_change_mac_other'];
 						$ass_change_pn_other= $row['ass_change_pn_other'];
						$ass_change_note_other= $row['ass_change_note_other'];
						
						$ass_change_label_other = $row['ass_change_label_other'];
						
						?>
						<tr>
					<td>
						 <?=$ass_change_time_other ;?>
						  </td>
                      <td>
						  <?=$ass_change_name_other ;?>
						  </td>
					<td>
						<?=$ass_change_sn_other ;?>
					</td>
					<td><?=$ass_change_mac_other ;?></td>
					<td>
						<?=$ass_change_pn_other ;?>
					</td>
					<td>
						<?=$ass_change_label_other ;?>
					</td>
					
					
					<td><?=$ass_change_note_other ;?></td>
					
					

				</tr>
				
						
						<?php
				}

				
				
				
				?>
				
				
				
				
				
				
				
			</table>
					<?php

					$id= $_GET['id'];
					$sql = "SELECT *  FROM ass_other where ass_other_id='$id' ";
					$result = execute_sql($database_name, $sql, $link);
					while ($row = mysql_fetch_assoc($result))
					{			
					$ass_other_name = $row['ass_other_name'];
					$ass_other_tribe= $row['ass_other_tribe'];
					$ass_other_sn = $row['ass_other_sn'];
					$ass_other_mac= $row['ass_other_mac'];
					$ass_other_pn= $row['ass_other_pn'];

					$ass_other_label= $row['ass_other_label'];
					}

					?>


			
			<table cellpadding="5" cellspacing="0" class="edit">
					<tr>
					<th colspan="2">目前資產資料</th>
					</tr>
					<tr>
					<td>資產類型</td>
					<td>
					other
					</td>
					</tr>
					<tr>
					<td>資產名稱</td>
					<td>
					<?=$ass_other_name ;?>
					</td>
					</tr>
					<tr>
					<td>SN</td>
					<td>
					<?=$ass_other_sn ;?>
					</td>
					</tr>
					<tr>
					<td>MAC</td>
					<td>
					<?=$ass_other_mac ;?>
					</td>
					</tr>
					<tr>
					<td>P/N</td>
					<td>
					<?=$ass_other_pn ;?>
					</td>
					</tr>
					<tr>
					<td>期別</td>
					<td>
					<?=$ass_other_label ;?>
					</td>
					</tr>
					</table>
			
			
			
			<form action="?mode=change_other" method="post">
			<table cellpadding="5" cellspacing="0" class="edit">
				<tr>
					<th colspan="2">更換資產</th>
				</tr>

				<tr>
					<td>資產類型</td>
					<td>
						other
					</td>
				</tr>
				
				
				

                                  
				<input type="hidden" name="ckeck_key"  value="check" >
				<input type="hidden" name="uid"  value="<?=$id;?>" >
				
				 <input type="hidden" name="old_ass_other_name"  value="<?=$ass_other_name;?>" >
				  <input type="hidden" name="old_ass_other_tribe"  value="<?=$ass_other_tribe;?>" >
				   <input type="hidden" name="old_ass_other_sn"  value="<?=$ass_other_sn;?>" >
				    <input type="hidden" name="old_ass_other_mac"  value="<?=$ass_other_mac;?>" >
				    <input type="hidden" name="old_ass_other_pn"  value="<?=$ass_other_pn;?>" >
					<input type="hidden" name="old_ass_other_label"  value="<?=$ass_other_label;?>" >
				<tr>
					<td>資產名稱</td>
					<td><input type="text" name="ass_other_name"   ></td>
				</tr>
				
				<tr>
					<td>SN</td>
					<td>
					<input type="text" name="ass_other_sn"   >	
					</td>
				</tr>
				
				
				<tr>
					<td>MAC</td>
					<td>
					<input type="text" name="ass_other_mac"  >	
					</td>
				</tr>
					

					<tr>
					<td>P/N</td>
					<td>
					<input type="text" name="ass_other_pn"  >	
					</td>
				</tr>
				
				<tr>
					<td>期別</td> 
					<td>
					<select  name="ass_other_label" >
						 <option value="2"  selected  >二期</option>
						  <option value="3"    >三期</option>
						
					</select>
					</td>
				</tr>
				
				
				
				
					<tr>
					<td>更換理由</td>
					<td>
					<input type="text" name="message"   >	
					</td>
				</tr>
				
				<tr>
					<td colspan="2" align="center">
						<input class="edit_btn" type="submit" value="儲存">
						<input class="edit_btn" type="button" onClick="history.back()" value="回上頁">
					</td>
				</tr>
			</table>
				</form>
		</div>	
	</div>	

<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>
		
</div>

</body>
</html>
