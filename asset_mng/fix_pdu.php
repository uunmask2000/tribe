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
			<form action="?mode=fix_pdu" method="post">
			<table cellpadding="5" cellspacing="0" class="edit">
				<tr>
					<td>資產位置</td>
					<td><?=$_GET['LONG_TXT'];?></td>
				</tr>
				<tr>
					<th colspan="6">修改資產</th>
				</tr>

				<tr>
					<td colspan="2">資產類型</td>
					<td colspan="4">
						PDU
					</td>
				</tr>
				<?php
				if($_GET['mode']=='fix_pdu')
				{
					$port = $_POST['port'];
					$portname = $_POST['portname'];
					$portip = $_POST['portip'];	
					$port = implode('-',$port);
					$portname = implode('-',$portname);
					$portip = implode('-',$portip);
				
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

			$sql = " UPDATE `ass_pdu` SET `ass_pdu_name`='$a1',`ass_pdu_opennms`='$a2',`ass_pdu_version`='$a3',`ass_pdu_sn`='$a4',`ass_pdu_ip`='$a5',`ass_pdu_mac`='$a6',`ass_pdu_note`='$a7',`ass_pdu_pn`='$a8' , `port`='$port ',`portname`='$portname',`portip`='$portip' WHERE ass_pdu_id='$uid'";
		 	$result = execute_sql($database_name, $sql, $link);
						
			//echo"<script>alert('pdu修改成功');window.location.href = 'view_pdu.php';</script>";
		echo"<script>alert('資料已更新');history.back();document.URL=location.href;</script>";
					}
			else
				{ 
				?>
				<script>alert('104!?');document.location.href="view_pdu.php";</script>
				<?php       
				}		
				}
			?>
				
				
				<?php

       			$id= $_GET['id'];
				$sql = "SELECT *  FROM ass_pdu where ass_pdu_id='$id' ";
				$result = execute_sql($database_name, $sql, $link);
				while ($row = mysql_fetch_assoc($result))
				{			
				      $a1 = $row['ass_pdu_name'];
					   $a2 = $row['ass_pdu_opennms'];
 						$a3 = $row['ass_pdu_version'];
					$a4 = $row['ass_pdu_sn'];
 					$a5 = $row['ass_pdu_ip'];
					$a6 = $row['ass_pdu_mac'];
				     $a7 = $row['ass_pdu_note'];
					 $a8 = $row['ass_pdu_pn'];
					
						 $port = $row['port'];
						 $portname = $row['portname'];
						 $portip = $row['portip'];
					
				       $port = explode("-",$port);
					   $portname = explode("-",$portname);
				 	   $portip = explode("-",$portip);
				}



				?>

                                  
				<input type="hidden" name="ckeck_key"  value="check" >
					 <input type="hidden" name="uid"  value="<?=$id;?>" >
				<tr>
					<td colspan="2">資產名稱</td>
					<td colspan="4"><input type="text" name="data1"  value="<?=$a1;?>" ></td>
				</tr>
				<tr>
					<td colspan="2">OPEN NMS</td>
					<td colspan="4">
					<input type="text" name="data2"  value="<?=$a2 ;?>" >	
					</td>
				</tr>
				<tr>
					<td colspan="2">品牌</td>
					<td colspan="4">
					<input type="text" name="data3"  value="<?=$a3 ;?>" >	
					</td>
				</tr>
				<tr>
					<td colspan="2">S/N</td>
					<td colspan="4">
					<input type="text" name="data4"  value="<?=$a4 ;?>" >	
					</td>
				</tr>
				<tr>
					<td colspan="2">IP</td>
					<td colspan="4">
					<input type="text" name="data5"  value="<?=$a5 ;?>" >	
					</td>
				</tr>
				<tr>
					<td colspan="2">MAC</td>
					<td colspan="4">
					<input type="text" name="data6"  value="<?=$a6 ;?>" >	
					</td>
				</tr>
					

					<tr>
					<td colspan="2">P/N</td>
					<td colspan="4">
					<input type="text" name="data8"  value="<?=$a8 ;?>" >	
					</td>
				       </tr>

					<tr>
					<td colspan="2">備註</td>
					<td colspan="4">
					<input type="text" name="data7"  value="<?=$a7 ;?>" >	
					</td>
					</tr>



	<tr>
		
					<!-------------------------------->
			<td>port1</td>
						<td>
								<input type="hidden" name="port[]"  value="<?= $port[0];?>" >	
						</td>
				<td>port1_name</td>
						<td>
							<input type="text" name="portname[]"  value="<?= $portname[0];?>" >
						</td>
					
						<td>port1_ip</td>
						<td>
							<input type="text" name="portip[]"  value="<?=  $portip[0];?>" >
						</td>
					</tr>
					<!-------------------------------->
					<td>port2</td>
						<td>
								<input type="hidden" name="port[]"  value="<?= $port[1];?>" >	
						</td>
				<td>port2_name</td>
						<td>
							<input type="text" name="portname[]"  value="<?= $portname[1];?>" >
						</td>
					
						<td>port2_ip</td>
						<td>
							<input type="text" name="portip[]"  value="<?=  $portip[1];?>" >
						</td>
					</tr>
					<!-------------------------------->
				<td>port3</td>
						<td>
								<input type="hidden" name="port[]"  value="<?= $port[2];?>" >	
						</td>
				<td>port3_name</td>
						<td>
							<input type="text" name="portname[]"  value="<?= $portname[2];?>" >
						</td>
					
						<td>port3_ip</td>
						<td>
							<input type="text" name="portip[]"  value="<?=  $portip[2];?>" >
						</td>
					</tr>
					<!-------------------------------->
			<td>port4</td>
						<td>
								<input type="hidden" name="port[]"  value="<?= $port[3];?>" >	
						</td>
				<td>port4_name</td>
						<td>
							<input type="text" name="portname[]"  value="<?= $portname[3];?>" >
						</td>
					
						<td>port4_ip</td>
						<td>
							<input type="text" name="portip[]"  value="<?=  $portip[3];?>" >
						</td>
					</tr>
					<!-------------------------------->
		<td>port5</td>
						<td>
								<input type="hidden" name="port[]"  value="<?= $port[4];?>" >	
						</td>
				<td>port5_name</td>
						<td>
							<input type="text" name="portname[]"  value="<?= $portname[4];?>" >
						</td>
					
						<td>port5_ip</td>
						<td>
							<input type="text" name="portip[]"  value="<?=  $portip[4];?>" >
						</td>
					</tr>
					<!-------------------------------->
<td>port6</td>
						<td>
								<input type="hidden" name="port[]"  value="<?= $port[5];?>" >	
						</td>
				<td>port6_name</td>
						<td>
							<input type="text" name="portname[]"  value="<?= $portname[5];?>" >
						</td>
					
						<td>port6_ip</td>
						<td>
							<input type="text" name="portip[]"  value="<?=  $portip[5];?>" >
						</td>
					</tr>
					<!-------------------------------->
<td>port7</td>
						<td>
								<input type="hidden" name="port[]"  value="<?= $port[6];?>" >	
						</td>
				<td>port7_name</td>
						<td>
							<input type="text" name="portname[]"  value="<?= $portname[6];?>" >
						</td>
					
						<td>port7_ip</td>
						<td>
							<input type="text" name="portip[]"  value="<?=  $portip[6];?>" >
						</td>
					</tr>
					<!-------------------------------->
<td>port8</td>
						<td>
								<input type="hidden" name="port[]"  value="<?= $port[7];?>" >	
						</td>
				<td>port8_name</td>
						<td>
							<input type="text" name="portname[]"  value="<?= $portname[7];?>" >
						</td>
					
						<td>port8_ip</td>
						<td>
							<input type="text" name="portip[]"  value="<?=  $portip[7];?>" >
						</td>
					</tr>
					<!-------------------------------->
				



				
				<tr>
					<td colspan="6" align="center">
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
