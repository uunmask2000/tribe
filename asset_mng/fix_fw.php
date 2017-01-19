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
			<form action="?mode=fix_fw" method="post">
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
						F/W
					</td>
				</tr>
				<?php
if($_GET['mode']=='fix_fw')
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
				  ///ISP 資料
				 $isp_type   = trim($_POST['isp_type']);
				 $isp_members   = trim($_POST['isp_members']);
				 $isp_pohoe   = trim($_POST['isp_pohoe']);
				 $isp_note   = trim($_POST['isp_note']);				 
				/// 用電紀錄
				$power_position   = trim($_POST['power_position']);
				$name_of_subsidy   = trim($_POST['name_of_subsidy']);
				$contact_telephone_number   = trim($_POST['contact_telephone_number']);	

			$sql = " UPDATE `ass_grouter` SET `ass_name`='$a1',`ass_opennms`='$a2',`ass_version`='$a3',`ass_sn`='$a4',`ass_ip`='$a5',`ass_mac`='$a6',`ass_note`='$a7',`ass_pn`='$a8',isp_type='$isp_type',isp_members='$isp_members',isp_pohoe='$isp_pohoe',isp_note='$isp_note',power_position='$power_position',name_of_subsidy='$name_of_subsidy',contact_telephone_number='$contact_telephone_number' WHERE ass_grouter_id='$uid'";
		 	$result = execute_sql($database_name, $sql, $link);
			//echo"<script>alert('Router修改成功');window.location.href = 'view_fw.php';</script>";
		echo"<script>alert('資料已更新');history.back();document.URL=location.href;</script>";
			}else{  ?><script>alert('104!?');document.location.href="view_fw.php";</script><?php       }
			
			    
			
		
		}
	
		
		
		?>
				
				
				<?php

       			$id= $_GET['id'];
				$sql = "SELECT *  FROM ass_grouter where ass_grouter_id='$id' ";
				$result = execute_sql($database_name, $sql, $link);
				while ($row = mysql_fetch_assoc($result))
				{			
						$a1 = $row['ass_name'];
						$a2 = $row['ass_opennms'];
						$a3 = $row['ass_version'];
						$a4 = $row['ass_sn'];
						$a5 = $row['ass_ip'];
						$a6 = $row['ass_mac'];
						$a7 = $row['ass_name'];
						$a8 = $row['ass_pn'];
						///ISP 資料
						$isp_type   = trim($row['isp_type']);
						$isp_members   = trim($row['isp_members']);
						$isp_pohoe   = trim($row['isp_pohoe']);
						$isp_note   = trim($row['isp_note']);				 
						// ,'$isp_type','$isp_members','$isp_pohoe','$isp_note'
						/// 用電紀錄
						$power_position   = trim($row['power_position']);
						$name_of_subsidy   = trim($row['name_of_subsidy']);
						$contact_telephone_number   = trim($row['contact_telephone_number']);	
						
						
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
				<!---------------------------------->
				
						<tr>
						<td>ISP類型</td>
						<td>
						<input type="text" name="isp_type"  value="<?=$isp_type ;?>" >	
						</td>
						</tr>
						<tr>
						<td>ISP業者</td>
						<td>
						<input type="text" name="isp_members"  value="<?=$isp_members ;?>" >	
						</td>
						</tr>
						<tr>
						<td>ISP聯絡電話</td>
						<td>
						<input type="text" name="isp_pohoe"  value="<?=$isp_pohoe ;?>" >	
						</td>
						</tr>
						<tr>
						<td>ISP備註</td>
						<td>
						<input type="text" name="isp_note"  value="<?=$isp_note ;?>" >	
						</td>
						</tr>
				  
				
				<!-------------------------------------->
				<tr>
						<td>用電位置</td>
						<td>
						<input type="text" name="power_position"  value="<?=$power_position ;?>" >	
						</td>
						</tr>
						<tr>
						<td>補助人名</td>
						<td>
						<input type="text" name="name_of_subsidy"  value="<?=$name_of_subsidy ;?>" >	
						</td>
						</tr>
						<tr>
						<td>連絡電話</td>
						<td>
						<input type="text" name="contact_telephone_number"  value="<?=$contact_telephone_number ;?>" >	
						</td>
						</tr>
				
				
				
				
				
				<!---------------------------------->
				
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
