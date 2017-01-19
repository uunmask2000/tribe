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
	if($_GET['mode']=='change_pdu')
	{


	$ckeck_key =$_POST['ckeck_key'];
	if($ckeck_key=='check')
	{

	$uid =$_POST['uid'];
	//echo $today = date("Y_m_d_H:i");

	/*

	* ass_pdu_name
	ass_pdu_sn
	ass_pdu_mac
	ass_pdu_pn
	* message
	* */

	//new
	$ass_pdu_name   = trim($_POST['ass_pdu_name']);
	$ass_pdu_sn   = trim($_POST['ass_pdu_sn']);
	$ass_pdu_mac   = trim($_POST['ass_pdu_mac']);
	$ass_pdu_pn   = trim($_POST['ass_pdu_pn']);
	$message   = trim($_POST['message']);
	$ass_pdu_label   = trim($_POST['ass_pdu_label']);

	//old_ass_pdu_tribe
	$old_ass_pdu_name   = trim($_POST['old_ass_pdu_name']);
	$old_ass_pdu_tribe   = trim($_POST['old_ass_pdu_tribe']);
	$old_ass_pdu_sn   = trim($_POST['old_ass_pdu_sn']);
	$old_ass_pdu_mac   = trim($_POST['old_ass_pdu_mac']);
	$old_ass_pdu_pn   = trim($_POST['old_ass_pdu_pn']);
	$old_ass_pdu_label   = trim($_POST['old_ass_pdu_label']);
	//
	$today = date("Y-m-d H:i");
	if(empty($ass_pdu_name ))
	{
	?><script>alert('資產名稱空白?');history.back()</script><?php 
	exit();   
	}
	if(empty($ass_pdu_sn ))
	{
	?><script>alert('SN空白?');history.back()</script><?php 
	exit();   
	}
	if(empty($message ))
	{
	?><script>alert('更換理由?');history.back()</script><?php 
	exit();   
	}


	$sql =" UPDATE ass_pdu SET ass_pdu_name='$ass_pdu_name',ass_pdu_sn='$ass_pdu_sn',ass_pdu_mac='$ass_pdu_mac',ass_pdu_pn='$ass_pdu_pn',ass_pdu_label='$ass_pdu_label' WHERE ass_pdu_id='$uid' ";
	$result = execute_sql($database_name, $sql, $link);

	//exit();
	//'$old_ass_pdu_tribe','$uid ','$old_ass_pdu_name','$old_ass_pdu_sn','$old_ass_pdu_mac','$old_ass_pdu_pn'	,'$message','$today'
	$sql ="INSERT INTO `ass_change_PDU`(`ass_change_tribe_PDU`, `ass_change_own_PDU`, `ass_change_name_PDU`, `ass_change_sn_PDU`, `ass_change_mac_PDU`, `ass_change_pn_PDU`, `ass_change_note_PDU`, `ass_change_time_PDU`,ass_change_label_PDU,keyin_man)
	VALUES ('$old_ass_pdu_tribe','$uid ','$ass_pdu_name','$ass_pdu_sn','$ass_pdu_mac','$ass_pdu_pn'	,'$message','$today','$ass_pdu_label','$keyin_man')";
	$result = execute_sql($database_name, $sql, $link);
	//echo $sql;
	//exit();


	//echo"<script>alert('更換PDU_ok');window.location.href = 'view_pdu.php';</script>";
	echo"<script>alert('資料已更換');history.back();document.URL=location.href;</script>";
	}else{  ?><script>alert('104!?');document.location.href="view_pdu.php";</script><?php       }




	}



	?>

<!-------------------------------------- MAIN -->
	<div id="main">

		<?php include("../alert/alert2.php"); ?>

		<?php include("../include/asset_nav.php"); ?>

		<div class="tab_container">
		<table cellpadding="7" cellspacing="0" class="edit">
		<tr>
		<td>資產位置</td>
		<td colspan="6"><?=$_GET['LONG_TXT'];?></td>
		</tr>
		<tr>
		<td>IP</td>
		<td colspan="6"><?=$_GET['LONG_TXT2'];?></td>
		</tr>

		</tr>
		
		
					<tr>
					<th colspan="7">履歷清單</th>
					</tr>
					<tr>
					<td>
					時間
					</td>
					<td>
					資產名稱
					</td>
					<td>
					S/N
					</td>
					<td>MAC</td>
					<td>
					P/N
					</td>
					<td>理由</td>
					<td>期別</td>
										<?php
if( ($_SESSION['user_id'])==1  )
{
echo  '<td>編輯</td>';
}

?>
					</tr>
					<?php
					$id= $_GET['id'];
					$sql = "SELECT *  FROM ass_change_PDU where ass_change_own_PDU='$id' ";
					$result = execute_sql($database_name, $sql, $link);
					while ($row = mysql_fetch_assoc($result))
					{			
					$ass_change_time_PDU = $row['ass_change_time_PDU'];
					$ass_change_name_PDU = $row['ass_change_name_PDU'];
					$ass_change_sn_PDU= $row['ass_change_sn_PDU'];
					$ass_change_mac_PDU = $row['ass_change_mac_PDU'];
					$ass_change_pn_PDU= $row['ass_change_pn_PDU'];
					$ass_change_note_PDU= $row['ass_change_note_PDU'];
					
					
					$ass_change_label_PDU = $row['ass_change_label_PDU'];
					?>
					<tr>
					<td>
					<?=$ass_change_time_PDU ;?>
					</td>
					<td>
					<?=$ass_change_name_PDU ;?>
					</td>
					<td>
					<?=$ass_change_sn_PDU ;?>
					</td>
					<td><?=$ass_change_mac_PDU ;?></td>
					<td>
					<?=$ass_change_pn_PDU ;?>
					</td>
					<td><?=$ass_change_note_PDU ;?></td>
					<td><?=$ass_change_label_PDU ;?></td>
					<?php
if( ($_SESSION['user_id'])==1  )
{
//echo  '<td><a href="../html-link.htm" target="popup" onclick="window.open('../html-link.htm','name','width=600,height=400')">Open page in new window</a></td>';
//echo  '<td>刪除</td>';
?>
<td><a href="#" target="popup" onclick="window.open('frame/edit_history_pdu.php?uid=<?=$row['ass_change_id_PDU'];?>','name','width=600,height=400')">編輯</a></td>
<?php

}
?>

					</tr>
					<?php
					}
					?>
					</table>
				<?php

				$id= $_GET['id'];
				$sql = "SELECT *  FROM ass_pdu where ass_pdu_id='$id' ";
				$result = execute_sql($database_name, $sql, $link);
				while ($row = mysql_fetch_assoc($result))
				{			
				$ass_pdu_name = $row['ass_pdu_name'];
				$ass_pdu_tribe= $row['ass_pdu_tribe'];
				$ass_pdu_sn = $row['ass_pdu_sn'];
				$ass_pdu_mac= $row['ass_pdu_mac'];
				$ass_pdu_pn= $row['ass_pdu_pn'];
				$ass_pdu_label= $row['ass_pdu_label'];
				}



				?>

					
		<table cellpadding="5" cellspacing="0" class="edit">
					<tr>
					<th colspan="2">目前資產資料</th>
					</tr>
					<tr>
					<td>資產類型</td>
					<td>
					PDU
					</td>
					</tr>
					<tr>
					<td>資產名稱</td>
					<td>
					<?=$ass_pdu_name ;?>
					</td>
					</tr>
					<tr>
					<td>SN</td>
					<td>
					<?=$ass_pdu_sn ;?>
					</td>
					</tr>
					<tr>
					<td>MAC</td>
					<td>
					<?=$ass_pdu_mac ;?>
					</td>
					</tr>
					<tr>
					<td>P/N</td>
					<td>
					<?=$ass_pdu_pn ;?>
					</td>
					</tr>
					<tr>
					<td>期別</td>
					<td>
					<?=$ass_pdu_label ;?>
					</td>
					</tr>
					</table>
		
		
		
		
		
		
		
			<form action="?mode=change_pdu" method="post">
			<table cellpadding="5" cellspacing="0" class="edit">
				<tr>
					<th colspan="2">更換資產</th>
				</tr>

				<tr>
					<td>資產類型</td>
					<td>
						PDU
					</td>
				</tr>
				
				
				<?php

       			$id= $_GET['id'];
				$sql = "SELECT *  FROM ass_pdu where ass_pdu_id='$id' ";
				$result = execute_sql($database_name, $sql, $link);
				while ($row = mysql_fetch_assoc($result))
				{			
						$ass_pdu_name = $row['ass_pdu_name'];
 						$ass_pdu_tribe= $row['ass_pdu_tribe'];
 						$ass_pdu_sn = $row['ass_pdu_sn'];
 						$ass_pdu_mac= $row['ass_pdu_mac'];
						$ass_pdu_pn= $row['ass_pdu_pn'];
						$ass_pdu_label= $row['ass_pdu_label'];
				}



				?>

                                  
				<input type="hidden" name="ckeck_key"  value="check" >
				<input type="hidden" name="uid"  value="<?=$id;?>" >
				
				 <input type="hidden" name="old_ass_pdu_name"  value="<?=$ass_pdu_name;?>" >
				  <input type="hidden" name="old_ass_pdu_tribe"  value="<?=$ass_pdu_tribe;?>" >
				   <input type="hidden" name="old_ass_pdu_sn"  value="<?=$ass_pdu_sn;?>" >
				    <input type="hidden" name="old_ass_pdu_mac"  value="<?=$ass_pdu_mac;?>" >
				    <input type="hidden" name="old_ass_pdu_pn"  value="<?=$ass_pdu_pn;?>" >
					<input type="hidden" name="old_ass_pdu_label"  value="<?=$ass_pdu_label;?>" >
				<tr>
					<td>資產名稱</td>
					<td><input type="text" name="ass_pdu_name"  ></td>
				</tr>
				
				<tr>
					<td>SN</td>
					<td>
					<input type="text" name="ass_pdu_sn"   >	
					</td>
				</tr>
				
				
				<tr>
					<td>MAC</td>
					<td>
					<input type="text" name="ass_pdu_mac"  >	
					</td>
				</tr>
					

					<tr>
					<td>P/N</td>
					<td>
					<input type="text" name="ass_pdu_pn"   >	
					</td>
				</tr>
				
				
				<tr>
					<td>期別</td> 
					<td>
					<select  name="ass_pdu_label" >
						  <option value="2" selected  >二期</option>
						  <option value="3"   >三期</option>
						
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
						<input class="edit_btn" type="button" onClick="window.close()" value="關閉視窗">
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
