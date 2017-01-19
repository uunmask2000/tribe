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

		<?php include("../include/asset_nav.php"); ?>

		<div class="tab_container">
			<form action="?mode=fix_ap" method="post">
			<table cellpadding="5" cellspacing="0" class="edit">
			<tr>
				<td>資產位置</td>
				<td><?=$_GET['LONG_TXT'];?></td>
			</tr>
				<tr>
					<th colspan="2">修改資產</th>
				</tr>

				<tr>
					<td>資產類型</td>
					<td>
						AP
					</td>
				</tr>
				<?php
if($_GET['mode']=='fix_ap')
		{
		
		 				
	$ckeck_key =$_POST['ckeck_key'];
                       if($ckeck_key=='check')
			{
			
			$uid =$_POST['uid'];


			     $a1   = trim($_POST['data1']);
				 $a2   = trim($_POST['data2']);
				 $a3   = trim($_POST['data3']);
				 $a4   = trim($_POST['data4']);
				 $a5   = trim($_POST['data5']);
				 $a6   =trim($_POST['data6']);
				 $a7   = trim($_POST['data7']);
				 $a8   = trim($_POST['data8']);
	
	
			
			$sql = " UPDATE `ass_ap` SET `ass_ap_name`='$a1',`ass_ap_opennms`='$a2',`ass_ap_version`='$a3',`ass_ap_sn`='$a4',`ass_ap_ip`='$a5',`ass_ap_mac`='$a6',`ass_ap_note`='$a7',`ass_ap_pn`='$a8' WHERE ass_ap_id='$uid'";
		 	$result = execute_sql($database_name, $sql, $link);
						
			//echo"<script>alert('AP修改成功');window.location.href = 'view_ap.php';</script>";
		echo"<script>alert('資料已更新');history.back();document.URL=location.href;</script>";
			}else{  ?><script>alert('104!?');document.location.href="view_ap.php";</script><?php       }
			
			    
			
		
		}
	
		
		
		?>
				
				
				<?php

       			$id= $_GET['id'];
				$sql = "SELECT *  FROM ass_ap where ass_ap_id='$id' ";
				$result = execute_sql($database_name, $sql, $link);
				while ($row = mysql_fetch_assoc($result))
				{			
				      $a1 = $row['ass_ap_name'];
					   $a2 = $row['ass_ap_opennms'];
 						$a3 = $row['ass_ap_version'];
					$a4 = $row['ass_ap_sn'];
 					$a5 = $row['ass_ap_ip'];
					$a6 = $row['ass_ap_mac'];
				     $a7 = $row['ass_ap_note'];
					$a8 = $row['ass_ap_pn'];
				}



				?>

                                  
				<input type="hidden" name="ckeck_key"  value="check" >
					 <input type="hidden" name="uid"  value="<?=$id;?>" >
				<tr>
					<td>資產名稱</td>
					<td><input type="text" name="data1"  value="<?=$a1;?>" ></td>
				</tr>
				<tr>
					<td>OPEN NMS</td>
					<td>
					<input type="text" name="data2"  value="<?=$a2 ;?>" >	
					</td>
				</tr>
				<tr>
					<td>品牌</td>
					<td>
					<input type="text" name="data3"  value="<?=$a3 ;?>" >	
					</td>
				</tr>
				<tr>
					<td>SN</td>
					<td>
					<input type="text" name="data4"  value="<?=$a4 ;?>" >	
					</td>
				</tr>
				<tr>
					<td>IP</td>
					<td>
					<input type="text" name="data5"  value="<?=$a5 ;?>" >	
					</td>
				</tr>
				<tr>
					<td>MAC</td>
					<td>
					<input type="text" name="data6"  value="<?=$a6 ;?>" >	
					</td>
				</tr>
					

					<tr>
					<td>P/N</td>
					<td>
					<input type="text" name="data8"  value="<?=$a8 ;?>" >	
					</td>
				</tr>
<tr>
					<td>備註</td>
					<td>
					<input type="text" name="data7"  value="<?=$a7 ;?>" >	
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
