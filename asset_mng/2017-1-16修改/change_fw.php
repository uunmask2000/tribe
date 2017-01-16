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
if($_GET['mode']=='change_router')
		{
		
		 				
	$ckeck_key =$_POST['ckeck_key'];
                       if($ckeck_key=='check')
			{
			
			$uid =$_POST['uid'];
//echo $today = date("Y_m_d_H:i");

     /*
      
      * ass_router_name
				ass_router_sn
				ass_router_mac
				ass_router_pn
				* message
				* */
				
                 //new  //ass_change_label_router   //ass_grouter_label
			     $ass_router_name   = trim($_POST['ass_router_name']);
				 $ass_router_sn   = trim($_POST['ass_router_sn']);
				 $ass_router_mac   = trim($_POST['ass_router_mac']);
				 $ass_router_pn   = trim($_POST['ass_router_pn']);
				 $message   = trim($_POST['message']);
				  $ass_grouter_label   = trim($_POST['ass_grouter_label']);
				 
				 //old_ass_router_tribe
				  $old_ass_router_name   = trim($_POST['old_ass_router_name']);
				  $old_ass_router_tribe   = trim($_POST['old_ass_router_tribe']);
				  $old_ass_router_sn   = trim($_POST['old_ass_router_sn']);
				 $old_ass_router_mac   = trim($_POST['old_ass_router_mac']);
				 $old_ass_router_pn   = trim($_POST['old_ass_router_pn']);
				 $old_ass_grouter_label   = trim($_POST['old_ass_grouter_label']);
				 
				 //
				 $today = date("Y-m-d H:i");
				 if(empty($ass_router_name ))
				 {
					?><script>alert('資產名稱空白?');history.back()</script><?php 
					exit();   
				 }
				 if(empty($ass_router_sn ))
				 {
					$ass_router_sn  ='SN未填寫'; 
				 }
				 if(empty($ass_router_mac ))
				 {
					$ass_router_mac  ='MAC未填寫';  
				 }
				   
				 
				 if(empty($message ))
				 {
					?><script>alert('更換理由?');history.back()</script><?php 
					exit();   
				 }

			$sql =" UPDATE ass_grouter SET ass_name='$ass_router_name',ass_sn='$ass_router_sn',ass_mac='$ass_router_mac',ass_pn='$ass_router_pn' ,ass_grouter_label='$ass_grouter_label' WHERE ass_grouter_id='$uid' ";
			$result = execute_sql($database_name, $sql, $link);
			 //exit();
			//'$old_ass_router_tribe','$uid ','$old_ass_router_name','$old_ass_router_sn','$old_ass_router_mac','$old_ass_router_pn'	,'$message','$today'
			$sql ="INSERT INTO `ass_change_router`(`ass_change_tribe_router`, `ass_change_own_router`, `ass_change_name_router`, `ass_change_sn_router`, `ass_change_mac_router`, `ass_change_pn_router`, `ass_change_note_router`, `ass_change_time_router`,ass_change_label_router,keyin_man)
			VALUES ('$old_ass_router_tribe','$uid ','$ass_router_name','$ass_router_sn','$ass_router_mac','$ass_router_pn'	,'$message','$today','$ass_grouter_label','$keyin_man')";
			$result = execute_sql($database_name, $sql, $link);
			//exit(); 
						
			//echo"<script>alert('更換 Router_ok');window.location.href = 'view_fw.php';</script>";
		echo"<script>alert('資料已更換');history.back();document.URL=location.href;</script>";
			}else{  ?><script>alert('104!?');document.location.href="view_fw.php";</script><?php       }
			
			    
			
		
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
					<td>理由</td>
					<td>期別</td>
					</tr>
					<?php
					$id= $_GET['id'];
					$sql = "SELECT *  FROM ass_change_router where ass_change_own_router='$id'  ORDER BY `ass_change_router`.`ass_change_id_router` DESC ";
					$result = execute_sql($database_name, $sql, $link);
					while ($row = mysql_fetch_assoc($result))
					{			
					$ass_change_time_router = $row['ass_change_time_router'];
					$ass_change_name_router = $row['ass_change_name_router'];
					$ass_change_sn_router= $row['ass_change_sn_router'];
					$ass_change_mac_router = $row['ass_change_mac_router'];
					$ass_change_pn_router= $row['ass_change_pn_router'];
					$ass_change_note_router= $row['ass_change_note_router'];
					$ass_change_label_router = $row['ass_change_label_router'];
					
					
					?>
					<tr>
					<td>
					<?=$ass_change_time_router ;?>
					</td>
					<td>
					<?=$ass_change_name_router ;?>
					</td>
					<td>
					<?=$ass_change_sn_router ;?>
					</td>
					<td><?=$ass_change_mac_router ;?></td>
					<td>
					<?=$ass_change_pn_router ;?>
					</td>
					<td><?=$ass_change_note_router ;?></td>
					<td><?=$ass_change_label_router ;?></td>
					</tr>
					<?php
					}
					?>
					</table>	
		
			<?php

					$id= $_GET['id'];
					$sql = "SELECT *  FROM ass_grouter where ass_grouter_id='$id' ";
					$result = execute_sql($database_name, $sql, $link);
					while ($row = mysql_fetch_assoc($result))
					{			
					$ass_router_name = $row['ass_name'];
					$ass_router_tribe= $row['ass_grouter_tribe'];
					$ass_router_sn = $row['ass_sn'];
					$ass_router_mac= $row['ass_mac'];
					$ass_router_pn= $row['ass_pn'];
					$ass_grouter_label= $row['ass_grouter_label'];
					}
			?>
					<table cellpadding="5" cellspacing="0" class="edit">
					<tr>
					<th colspan="2">目前資產資料</th>
					</tr>
					<tr>
					<td>資產類型</td>
					<td>
					Router
					</td>
					</tr>
					<tr>
					<td>資產名稱</td>
					<td>
					<?=$ass_router_name ;?>
					</td>
					</tr>
					<tr>
					<td>SN</td>
					<td>
					<?=$ass_router_sn ;?>
					</td>
					</tr>
					<tr>
					<td>MAC</td>
					<td>
					<?=$ass_router_mac ;?>
					</td>
					</tr>
					<tr>
					<td>P/N</td>
					<td>
					<?=$ass_router_pn ;?>
					</td>
					</tr>
					<tr>
					<td>期別</td>
					<td>
					<?=$ass_grouter_label ;?>
					</td>
					</tr>
					</table>

		
		
			<form action="?mode=change_router" method="post">
			<table cellpadding="5" cellspacing="0" class="edit">
				<tr>
					<th colspan="2">更換資產</th>
				</tr>

				<tr>
					<td>資產類型</td>
					<td>
						Router
					</td>
				</tr>

				
				
			

                                  
			
				<tr>
					<td>資產名稱</td>
					<td><input type="text" name="ass_router_name"   ></td>
				</tr>
				
				<tr>
					<td>SN</td>
					<td>
					<input type="text" name="ass_router_sn"  >	
					</td>
				</tr>
				
				
				<tr>
					<td>MAC</td>
					<td>
					<input type="text" name="ass_router_mac"   >	
					</td>
				</tr>
					

					<tr>
					<td>P/N</td>
					<td>
					<input type="text" name="ass_router_pn" >	
					</td>
				</tr>
				
					
				<tr>
					<td>期別</td> 
					<td>
					<select  name="ass_grouter_label" >
						<option value="2"  selected  >二期</option>
						  <option value="3"   >三期</option>
						
					</select>
					</td>
				</tr>
				
				
				
					<tr>
					<td>更換理由</td>
					<td>
					<input type="text" name="message"  value=""  >	
					</td>
				</tr>
					<input type="hidden" name="ckeck_key"  value="check" >
				<input type="hidden" name="uid"  value="<?=$id;?>" >

				<input type="hidden" name="old_ass_router_name"  value="<?=$ass_router_name;?>" >
				<input type="hidden" name="old_ass_router_tribe"  value="<?=$ass_router_tribe;?>" >
				<input type="hidden" name="old_ass_router_sn"  value="<?=$ass_router_sn;?>" >
				<input type="hidden" name="old_ass_router_mac"  value="<?=$ass_router_mac;?>" >
				<input type="hidden" name="old_ass_router_pn"  value="<?=$ass_router_pn;?>" >
				<input type="hidden" name="old_ass_grouter_label"  value="<?=$ass_grouter_label;?>" >
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
