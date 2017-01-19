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
			
	
				date_default_timezone_set("Asia/Taipei");
			session_start();
			$keyin_man = $_SESSION['user_name'] ;	
				
				
if($_GET['mode']=='change_ap')
		{
		
		 				
	$ckeck_key =$_POST['ckeck_key'];
                       if($ckeck_key=='check')
			{
			
			$uid =$_POST['uid'];
//echo $today = date("Y_m_d_H:i");

     /*
      
      * ass_ap_name
				ass_ap_sn
				ass_ap_mac
				ass_ap_pn
				* message
				* */
				
                 //new
			     $ass_ap_name   = trim($_POST['ass_ap_name']);
				 $ass_ap_sn   = trim($_POST['ass_ap_sn']);
				 $ass_ap_mac   = trim($_POST['ass_ap_mac']);
				 $ass_ap_pn   = trim($_POST['ass_ap_pn']);
				 $message   = trim($_POST['message']);
				 $ass_ap_label = $_POST['ass_ap_label'];
				 //old_ass_ap_tribe
			$old_ass_ap_name   = trim($_POST['old_ass_ap_name']);
			$old_ass_ap_tribe   = trim($_POST['old_ass_ap_tribe']);
			$old_ass_ap_sn   = trim($_POST['old_ass_ap_sn']);
			$old_ass_ap_mac   = trim($_POST['old_ass_ap_mac']);
			$old_ass_ap_pn   = $_POST['old_ass_ap_pn'];
			$old_ass_ap_label   = $_POST['old_ass_ap_label'];
				
				 //echo  $ass_ap_label;
				 //exit();
				 //
				  $today = date("Y-m-d H:i");
				  if(empty($ass_ap_name ))
				 {
					?><script>alert('資產名稱空白?');history.back()</script><?php 
					exit();   
				 }else if(empty($ass_ap_sn ))
				 { 
					$ass_ap_sn = 'SN空白';
				 }else if(empty($ass_ap_mac ))
				 {
					 
					$ass_ap_mac = 'MAC空白';
				 }else if(empty($message ))
				 {
					?><script>alert('更換理由?');history.back()</script><?php 
					exit();   
				 }
	
	        
			$sql =" UPDATE ass_ap SET ass_ap_name='$ass_ap_name',ass_ap_sn='$ass_ap_sn',ass_ap_mac='$ass_ap_mac',ass_ap_pn='$ass_ap_pn',ass_ap_label='$ass_ap_label' WHERE ass_ap_id='$uid' ";
			$result = execute_sql($database_name, $sql, $link);
			//echo $sql;
			//'$old_ass_ap_tribe','$uid ','$old_ass_ap_name','$old_ass_ap_sn','$old_ass_ap_mac','$old_ass_ap_pn'	,'$message','$today'
			$sql ="INSERT INTO ass_change_ap (`ass_change_tribe_ap`, `ass_change_own_ap`, `ass_change_name_ap`, `ass_change_sn_ap`, `ass_change_mac_ap`, `ass_change_pn_ap`, `ass_change_note_ap`, `ass_change_time_ap`,ass_change_label_ap,keyin_man) 
			VALUES ('$old_ass_ap_tribe','$uid ','$ass_ap_name','$ass_ap_sn','$ass_ap_mac','$ass_ap_pn'	,'$message','$today','$ass_ap_label','$keyin_man')";
			$result = execute_sql($database_name, $sql, $link);
			//echo $sql;
			//exit();			
			//echo"<script>alert('更換AP_ok');window.location.href = 'view_ap.php';</script>";
		echo"<script>alert('資料已更換');history.back();document.URL=location.href;</script>";
			}else{  ?><script>alert('104!?');document.location.href="view_ap.php";</script><?php       }
			
			    
			
		
		}
	
		
		
		?>
<!-------------------------------------- MAIN -->
	<div id="main">

		<?php include("../alert/alert2.php"); ?>

		<?php include("../include/asset_nav.php"); ?>
		
					<table cellpadding="7" cellspacing="0" class="edit">
		<tr>
		<td>資產位置</td>
		<td colspan="6"><?=$_GET['LONG_TXT'];?></td>
		</tr>
		<tr>
		<td>IP</td>
		<td colspan="6"><?=$_GET['LONG_TXT2'];?></td>
		</tr>
		
		<tr><th colspan="7">履歷清單</th></tr>
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
					<td>更換原因</td>
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
					$sql = "SELECT *  FROM ass_change_ap where ass_change_own_ap='$id' order by ass_change_id_ap desc";
					$result = execute_sql($database_name, $sql, $link);
					while ($row = mysql_fetch_assoc($result))
					{			
					$ass_change_time_ap = $row['ass_change_time_ap'];
					$ass_change_name_ap = $row['ass_change_name_ap'];
					$ass_change_sn_ap= $row['ass_change_sn_ap'];
					$ass_change_mac_ap = $row['ass_change_mac_ap'];
					$ass_change_pn_ap= $row['ass_change_pn_ap'];
					$ass_change_note_ap= $row['ass_change_note_ap'];
					$ass_change_label_ap= $row['ass_change_label_ap'];
					?>
					<tr>
					<td>
					<?=$ass_change_time_ap ;?>
					</td>
					<td>
					<?=$ass_change_name_ap ;?>
					</td>
					<td>
					<?=$ass_change_sn_ap ;?>
					</td>
					<td><?=$ass_change_mac_ap ;?></td>
					<td>
					<?=$ass_change_pn_ap ;?>
					</td>
					<td><?=$ass_change_note_ap ;?></td>
					<td><?=$ass_change_label_ap ;?></td>
					<?php
if( ($_SESSION['user_id'])==1  )
{
//echo  '<td><a href="../html-link.htm" target="popup" onclick="window.open('../html-link.htm','name','width=600,height=400')">Open page in new window</a></td>';
//echo  '<td>刪除</td>';
?>
<td><a href="#" target="popup" onclick="window.open('frame/edit_history_ap.php?uid=<?=$row['ass_change_id_ap'];?>','name','width=600,height=400')">編輯</a></td>
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
				$sql = "SELECT *  FROM ass_ap where ass_ap_id='$id' ";
				$result = execute_sql($database_name, $sql, $link);
				while ($row = mysql_fetch_assoc($result))
				{			
						$ass_ap_name = $row['ass_ap_name'];
 						$ass_ap_tribe= $row['ass_ap_tribe'];
 						$ass_ap_sn = $row['ass_ap_sn'];
 						$ass_ap_mac= $row['ass_ap_mac'];
						$ass_ap_pn= $row['ass_ap_pn'];
						$ass_ap_label= $row['ass_ap_label'];
						
				}
				?>					
					<table cellpadding="5" cellspacing="0" class="edit">
					<tr>
					<th colspan="2">目前資產資料</th>
					</tr>
					<tr>
					<td>資產類型</td>
					<td>
					AP
					</td>
					</tr>
					<tr>
					<td>資產名稱</td>
					<td>
					<?=$ass_ap_name ;?>
					</td>
					</tr>
					<tr>
					<td>SN</td>
					<td>
					<?=$ass_ap_sn ;?>
					</td>
					</tr>
					<tr>
					<td>MAC</td>
					<td>
					<?=$ass_ap_mac ;?>
					</td>
					</tr>
					<tr>
					<td>P/N</td>
					<td>
					<?=$ass_ap_pn ;?>
					</td>
					</tr>
					<tr>
					<td>期別</td>
					<td>
					<?=$ass_ap_label ;?>
					</td>
					</tr>
					</table>

		
		
		

		<div class="tab_container">
			<form action="?mode=change_ap" method="post">
			<table cellpadding="5" cellspacing="0" class="edit">
				<tr>
					<th colspan="2">更換資產</th>
				</tr>

				<tr>
					<td>資產類型</td>
					<td>
						AP
					</td>
				</tr>
			
				
				

                                  
				<input type="hidden" name="ckeck_key"  value="check" >
				<input type="hidden" name="uid"  value="<?=$id;?>" >
				
				 <input type="hidden" name="old_ass_ap_name"  value="<?=$ass_ap_name;?>" >
				  <input type="hidden" name="old_ass_ap_tribe"  value="<?=$ass_ap_tribe;?>" >
				   <input type="hidden" name="old_ass_ap_sn"  value="<?=$ass_ap_sn;?>" >
				    <input type="hidden" name="old_ass_ap_mac"  value="<?=$ass_ap_mac;?>" >
				    <input type="hidden" name="old_ass_ap_pn"  value="<?=$ass_ap_pn;?>" >
					<input type="hidden" name="old_ass_ap_label"  value="<?=$ass_ap_label;?>" >
				<tr>
					<td>資產名稱</td>
					<td><input type="text" name="ass_ap_name"   ></td>
				</tr>
				
				<tr>
					<td>SN</td>
					<td>
					<input type="text" name="ass_ap_sn"  >	
					</td>
				</tr>
				
				
				<tr>
					<td>MAC</td>
					<td>
					<input type="text" name="ass_ap_mac"   >	
					</td>
				</tr>
					

					<tr>
					<td>P/N</td>
					<td>
					<input type="text" name="ass_ap_pn"   >	
					</td>
					
					
				<tr>
					<td>期別</td> 
					<td>
					<select  name="ass_ap_label" >
						 <option value="2"   selected  >二期</option>
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
