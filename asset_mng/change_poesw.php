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
if($_GET['mode']=='change_ap')
{


$ckeck_key =$_POST['ckeck_key'];
if($ckeck_key=='check')
{

$uid =$_POST['uid'];
//echo $today = date("Y_m_d_H:i");
/*
* 
* 
* 
* $ass_poesw_name = $row['ass_poesw_name'];
$ass_poesw_tribe= $row['ass_poesw_tribe'];
$ass_poesw_sn = $row['ass_poesw_sn'];
$ass_poesw_mac= $row['ass_poesw_mac'];
$ass_poesw_pn= $row['ass_poesw_pn'];
* 
* 
* */


//new ass_poesw_label
$ass_poesw_name   = trim($_POST['ass_poesw_name']);
$ass_poesw_sn   = trim($_POST['ass_poesw_sn']);
$ass_poesw_mac   = trim($_POST['ass_poesw_mac']);
$ass_poesw_pn   = trim($_POST['ass_poesw_pn']);
$message   = trim($_POST['message']);
$ass_poesw_label   = trim($_POST['ass_poesw_label']);
//old_ass_ap_tribe
$old_ass_poesw_name   = trim($_POST['old_ass_poesw_name']);
$old_ass_poesw_tribe  = trim($_POST['old_ass_poesw_tribe']);
$old_ass_poesw_sn   = trim($_POST['old_ass_poesw_sn']);
$old_ass_poesw_mac   = trim($_POST['old_ass_poesw_mac']);
$old_ass_poesw_pn   = trim($_POST['old_ass_poesw_pn']);
$old_ass_poesw_label   = trim($_POST['old_ass_poesw_label']);
//
$today = date("Y-m-d H:i");
if(empty($ass_poesw_name ))
{
?><script>alert('資產名稱空白?');history.back()</script><?php 
exit();   
}else if(empty($ass_poesw_sn ))
{
$ass_poesw_sn  = 'SN空白';  
}else if(empty($ass_poesw_mac ))
{
$ass_poesw_mac  = 'MAC空白';    
}else if(empty($message ))
{
?><script>alert('更換理由?');history.back()</script><?php 
exit();   
}

// exit();
$sql =" UPDATE ass_poesw SET ass_poesw_name='$ass_poesw_name',ass_poesw_sn='$ass_poesw_sn',ass_poesw_mac='$ass_poesw_mac',ass_poesw_pn='$ass_poesw_pn',ass_poesw_label='$ass_poesw_label' WHERE ass_poesw_id='$uid' ";
$result = execute_sql($database_name, $sql, $link);
//'$old_ass_ap_tribe','$uid ','$old_ass_ap_name','$old_ass_ap_sn','$old_ass_ap_mac','$old_ass_ap_pn'	,'$message','$today'

$sql ="INSERT INTO `ass_change_poe_sw`(`ass_change_tribe_poe_sw`, `ass_change_own_poe_sw`, `ass_change_name_poe_sw`, `ass_change_sn_poe_sw`, `ass_change_mac_poe_sw`, `ass_change_pn_poe_sw`, `ass_change_note_poe_sw`, `ass_change_time_poe_sw`,ass_change_label_poe_sw,keyin_man) 
VALUES ('$old_ass_poesw_tribe','$uid ','$ass_poesw_name','$ass_poesw_sn','$ass_poesw_mac','$ass_poesw_pn'	,'$message','$today','$ass_poesw_label','$keyin_man')";
$result = execute_sql($database_name, $sql, $link);

//exit();			
//echo"<script>alert('更換PoE S/W_ok');window.location.href = 'view_poesw.php';</script>";
echo"<script>alert('資料已更換');history.back();document.URL=location.href;</script>";
}else{  ?><script>alert('104!?');document.location.href="view_poesw.php";</script><?php       }




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

		<tr><th colspan="7">履歷清單</th>
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
					<td>設備來源</td>
										<?php
if( ($_SESSION['user_id'])==1  )
{
echo  '<td>編輯</td>';
}

?>
					</tr>
					<?php
					$id= $_GET['id'];
					$sql = "SELECT *  FROM ass_change_poe_sw where ass_change_own_poe_sw='$id' ORDER BY `ass_change_poe_sw`.`ass_change_id_poe_sw` DESC";
					$result = execute_sql($database_name, $sql, $link);
					while ($row = mysql_fetch_assoc($result))
					{			
					$ass_change_time_poe_sw = $row['ass_change_time_poe_sw'];
					$ass_change_name_poe_sw = $row['ass_change_name_poe_sw'];
					$ass_change_sn_poe_sw= $row['ass_change_sn_poe_sw'];
					$ass_change_mac_poe_sw = $row['ass_change_mac_poe_sw'];
					$ass_change_pn_poe_sw= $row['ass_change_pn_poe_sw'];
					$ass_change_note_poe_sw= $row['ass_change_note_poe_sw'];
					$ass_change_label_poe_sw= $row['ass_change_label_poe_sw'];
					?>
					<tr>
					<td>
					<?=$ass_change_time_poe_sw ;?>
					</td>
					<td>
					<?=$ass_change_name_poe_sw ;?>
					</td>
					<td>
					<?=$ass_change_sn_poe_sw ;?>
					</td>
					<td><?=$ass_change_mac_poe_sw ;?></td>
					<td>
					<?=$ass_change_pn_poe_sw ;?>
					</td>
					<td><?=$ass_change_note_poe_sw ;?></td>
					<td><?=$ass_change_label_poe_sw ;?></td>
					<?php
if( ($_SESSION['user_id'])==1  )
{
//echo  '<td><a href="../html-link.htm" target="popup" onclick="window.open('../html-link.htm','name','width=600,height=400')">Open page in new window</a></td>';
//echo  '<td>刪除</td>';
?>
<td><a href="#" target="popup" onclick="window.open('frame/edit_history_poe.php?uid=<?=$row['ass_change_id_poe_sw'];?>','name','width=600,height=400')">編輯</a></td>
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
					$sql = "SELECT * FROM ass_poesw where ass_poesw_id='$id' ";
					$result = execute_sql($database_name, $sql, $link);
					while ($row = mysql_fetch_assoc($result))
					{			
					$ass_poesw_name = $row['ass_poesw_name'];
					$ass_poesw_tribe= $row['ass_poesw_tribe'];
					$ass_poesw_sn = $row['ass_poesw_sn'];
					$ass_poesw_mac= $row['ass_poesw_mac'];
					$ass_poesw_pn= $row['ass_poesw_pn'];
					$ass_poesw_label= $row['ass_poesw_label'];
					//ass_poesw_label
					}

					//echo $sql;

					?>
		
		<table cellpadding="5" cellspacing="0" class="edit">
					<tr>
					<th colspan="2">目前資產資料</th>
					</tr>
					<tr>
					<td>資產類型</td>
					<td>
						POE Switch
					</td>
					</tr>
					<tr>
					<td>資產名稱</td>
					<td>
					<?=$ass_poesw_name ;?>
					</td>
					</tr>
					<tr>
					<td>SN</td>
					<td>
					<?=$ass_poesw_sn ;?>
					</td>
					</tr>
					<tr>
					<td>MAC</td>
					<td>
					<?=$ass_poesw_mac ;?>
					</td>
					</tr>
					<tr>
					<td>P/N</td>
					<td>
					<?=$ass_poesw_pn ;?>
					</td>
					</tr>
					<tr>
					<td>期別</td>
					<td>
					<?=$ass_poesw_label ;?>
					</td>
					</tr>
					</table>
		
		
		
			<form action="?mode=change_ap" method="post">
			<table cellpadding="5" cellspacing="0" class="edit">
				<tr>
					<th colspan="2">更換資產</th>
				</tr>

				<tr>
					<td>資產類型</td>
					<td>
						PoE S/W
					</td>
				</tr>
				
				
			

                                  
				<input type="hidden" name="ckeck_key"  value="check" >
				<input type="hidden" name="uid"  value="<?=$id;?>" >
				
				 <input type="hidden" name="old_ass_poesw_name"  value="<?=$ass_poesw_name;?>" >
				  <input type="hidden" name="old_ass_poesw_tribe"  value="<?=$ass_poesw_tribe;?>" >
				   <input type="hidden" name="old_ass_poesw_sn"  value="<?=$ass_poesw_sn;?>" >
				    <input type="hidden" name="old_ass_poesw_mac"  value="<?=$ass_poesw_mac;?>" >
				    <input type="hidden" name="old_ass_poesw_pn"  value="<?=$ass_poesw_pn;?>" >
					 <input type="hidden" name="old_ass_poesw_label"  value="<?=$ass_poesw_label;?>" >
				<tr>
					<td>資產名稱</td>
					<td><input type="text" name="ass_poesw_name"   ></td>
				</tr>
				
				<tr>
					<td>SN</td>
					<td>
					<input type="text" name="ass_poesw_sn"  >	
					</td>
				</tr>
				
				
				<tr>
					<td>MAC</td>
					<td>
					<input type="text" name="ass_poesw_mac"   >	
					</td>
				</tr>
					

					<tr>
					<td>P/N</td>
					<td>
					<input type="text" name="ass_poesw_pn"   >	
					</td>
				</tr>
				
					<tr>
					<td>期別</td> 
					<td>
					<select  name="ass_poesw_label" >
						  <option value="2"  selected >二期</option>
						  <option value="3"  >三期</option>
						
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
