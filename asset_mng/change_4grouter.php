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
if($_GET['mode']=='change_4grouter')
		{
		
		 				
	$ckeck_key =$_POST['ckeck_key'];
                       if($ckeck_key=='check')
			{
			
			$uid =$_POST['uid'];
//echo $today = date("Y_m_d_H:i");

     /*
      
      * ass_4grouter_name
				ass_4grouter_sn
				ass_4grouter_mac
				ass_4grouter_pn
				* message
				* */
				
                 //new  //ass_change_label_4Grouter  //ass_4Ggrouter_label
			     $ass_4grouter_name   = trim($_POST['ass_4grouter_name']);
				 $ass_4grouter_sn   = trim($_POST['ass_4grouter_sn']);
				 $ass_4grouter_mac   = trim($_POST['ass_4grouter_mac']);
				 $ass_4grouter_pn   = trim($_POST['ass_4grouter_pn']);
				 $message   = trim($_POST['message']);
				 $ass_4Ggrouter_label   = trim($_POST['ass_4Ggrouter_label']);
				 
				 //old_ass_4grouter_tribe
				  $old_ass_4grouter_name   = trim($_POST['old_ass_4grouter_name']);
				  $old_ass_4grouter_tribe   = trim($_POST['old_ass_4grouter_tribe']);
				  $old_ass_4grouter_sn   = trim($_POST['old_ass_4grouter_sn']);
				 $old_ass_4grouter_mac   = trim($_POST['old_ass_4grouter_mac']);
				 $old_ass_4grouter_pn   = trim($_POST['old_ass_4grouter_pn']);
				 $old_ass_4Ggrouter_label   = trim($_POST['old_ass_4Ggrouter_label']);
				 //
				 $today = date("Y-m-d H:i");
						if(empty($ass_4grouter_name ))
						{
						?><script>alert('資產名稱空白?');history.back()</script><?php 
						exit();   
						}
						if(empty($ass_4grouter_sn ))
						{

						$ass_4grouter_sn = 'SN空白';
						}
						 if(empty($ass_4grouter_mac ))
						{

						$ass_4grouter_mac = 'MAC空白';					
						}
						 if(empty($message ))
						{
						?><script>alert('更換理由?');history.back()</script><?php 
						exit();   
						}
	
	       // exit();   
			$sql =" UPDATE  ass_4Ggrouter SET ass_4Gname='$ass_4grouter_name',ass_4Gsn='$ass_4grouter_sn',ass_4Gmac='$ass_4grouter_mac',ass_4Gpn='$ass_4grouter_pn',ass_4Ggrouter_label='$ass_4Ggrouter_label' WHERE ass_4Ggrouter_id='$uid' ";
			$result = execute_sql($database_name, $sql, $link);
			
			//'$old_ass_4grouter_tribe','$uid ','$old_ass_4grouter_name','$old_ass_4grouter_sn','$old_ass_4grouter_mac','$old_ass_4grouter_pn'	,'$message','$today'
			$sql ="INSERT INTO `ass_change_4Grouter`( `ass_change_tribe_4Grouter`, `ass_change_own_4Grouter`, `ass_change_name_4Grouter`, `ass_change_sn_4Grouter`, `ass_change_mac_4Grouter`, `ass_change_pn_4Grouter`, `ass_change_note_4Grouter`, `ass_change_time_4Grouter`,ass_change_label_4Grouter,keyin_man)
			VALUES ('$old_ass_4grouter_tribe','$uid ','$ass_4grouter_name','$ass_4grouter_sn','$ass_4grouter_mac','$ass_4grouter_pn'	,'$message','$today','$ass_4Ggrouter_label','$keyin_man')";
			$result = execute_sql($database_name, $sql, $link);
			// exit(); 
						
			//echo"<script>alert('更換4G Router_ok');window.location.href = 'view_4grouter.php';</script>";
		echo"<script>alert('資料已更換');history.back();document.URL=location.href;</script>";
			}else{  ?><script>alert('104!?');document.location.href="view_4grouter.php";</script><?php       }
			
			    
			
		
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
					<?php
if( ($_SESSION['user_id'])==1  )
{
echo  '<td>編輯</td>';
}

?>

					</tr>
					<?php
					$id= $_GET['id'];
					$sql = "SELECT *  FROM ass_change_4Grouter where ass_change_own_4Grouter='$id' ORDER BY `ass_change_4Grouter`.`ass_change_id_4Grouter` desc ";
					$result = execute_sql($database_name, $sql, $link);
					while ($row = mysql_fetch_assoc($result))
					{			
					$ass_change_time_4Grouter = $row['ass_change_time_4Grouter'];
					$ass_change_name_4Grouter = $row['ass_change_name_4Grouter'];
					$ass_change_sn_4Grouter= $row['ass_change_sn_4Grouter'];
					$ass_change_mac_4Grouter = $row['ass_change_mac_4Grouter'];
					$ass_change_pn_4Grouter= $row['ass_change_pn_4Grouter'];
					$ass_change_note_4Grouter= $row['ass_change_note_4Grouter'];
					
					
					$ass_change_label_4Grouter = $row['ass_change_label_4Grouter'];
					?>
					<tr>
					<td>
					<?=$ass_change_time_4Grouter ;?>
					</td>
					<td>
					<?=$ass_change_name_4Grouter ;?>
					</td>
					<td>
					<?=$ass_change_sn_4Grouter ;?>
					</td>
					<td><?=$ass_change_mac_4Grouter ;?></td>
					<td>
					<?=$ass_change_pn_4Grouter ;?>
					</td>
					<td><?=$ass_change_note_4Grouter ;?></td>
					<td><?=$ass_change_label_4Grouter ;?></td>
<?php
if( ($_SESSION['user_id'])==1  )
{
//echo  '<td><a href="../html-link.htm" target="popup" onclick="window.open('../html-link.htm','name','width=600,height=400')">Open page in new window</a></td>';
//echo  '<td>刪除</td>';
?>
<td><a href="#" target="popup" onclick="window.open('frame/edit_history_4G.php?uid=<?=$row['ass_change_id_4Grouter'];?>','name','width=600,height=400')">編輯</a></td>
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
				$sql = "SELECT *  FROM ass_4Ggrouter where ass_4Ggrouter_id='$id' ";
				$result = execute_sql($database_name, $sql, $link);
				while ($row = mysql_fetch_assoc($result))
				{			
				$ass_4grouter_name = $row['ass_4Gname'];
				$ass_4grouter_tribe= $row['ass_4Ggrouter_tribe'];
				$ass_4grouter_sn = $row['ass_4Gsn'];
				$ass_4grouter_mac= $row['ass_4Gmac'];
				$ass_4grouter_pn= $row['ass_4Gpn'];
				$ass_4Ggrouter_label= $row['ass_4Ggrouter_label'];
				}



				?>
					
					
					
					<table cellpadding="5" cellspacing="0" class="edit">
					<tr>
					<th colspan="2">目前資產資料</th>
					</tr>
					<tr>
					<td>資產類型</td>
					<td>
					4G Router
					</td>
					</tr>
					<tr>
					<td>資產名稱</td>
					<td>
					<?=$ass_4grouter_name ;?>
					</td>
					</tr>
					<tr>
					<td>SN</td>
					<td>
					<?=$ass_4grouter_sn ;?>
					</td>
					</tr>
					<tr>
					<td>MAC</td>
					<td>
					<?=$ass_4grouter_mac ;?>
					</td>
					</tr>
					<tr>
					<td>P/N</td>
					<td>
					<?=$ass_4grouter_pn ;?>
					</td>
					</tr>
					<tr>
					<td>期別</td>
					<td>
					<?=$ass_4Ggrouter_label ;?>
					</td>
					</tr>
					</table>
		
		
		
		
		
		
			<form action="?mode=change_4grouter" method="post">
			<table cellpadding="5" cellspacing="0" class="edit">
				<tr>
					<th colspan="2">更換資產</th>
				</tr>

				<tr>
					<td>資產類型</td>
					<td>
						4G Router
					</td>
				</tr>
			
				
				
				

                                  
				<input type="hidden" name="ckeck_key"  value="check" >
				<input type="hidden" name="uid"  value="<?=$id;?>" >
				
				 <input type="hidden" name="old_ass_4grouter_name"  value="<?=$ass_4grouter_name;?>" >
				  <input type="hidden" name="old_ass_4grouter_tribe"  value="<?=$ass_4grouter_tribe;?>" >
				   <input type="hidden" name="old_ass_4grouter_sn"  value="<?=$ass_4grouter_sn;?>" >
				    <input type="hidden" name="old_ass_4grouter_mac"  value="<?=$ass_4grouter_mac;?>" >
				    <input type="hidden" name="old_ass_4grouter_pn"  value="<?=$ass_4grouter_pn;?>" >
					<input type="hidden" name="old_ass_4Ggrouter_label"  value="<?=$ass_4Ggrouter_label;?>" >
				<tr>
					<td>資產名稱</td>
					<td><input type="text" name="ass_4grouter_name"  value="" ></td>
				</tr>
				
				<tr>
					<td>SN</td>
					<td>
					<input type="text" name="ass_4grouter_sn"  value="" >	
					</td>
				</tr>
				
				
				<tr>
					<td>MAC</td>
					<td>
					<input type="text" name="ass_4grouter_mac"  value="" >	
					</td>
				</tr>
					

					<tr>
					<td>P/N</td>
					<td>
					<input type="text" name="ass_4grouter_pn"  value="" >	
					</td>
				</tr>
				
				
				
				
				<tr>
					<td>期別</td> 
					<td>
					<select  name="ass_4Ggrouter_label" >
						  <option value="2"   selected  >二期</option>
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
