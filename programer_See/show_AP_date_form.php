<!doctype html>
<html lang="zh-TW">
<head>
<meta charset="UTF-8">
<title>無線AP網管系統</title>
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
<link href="../include/style.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<!--------dataTablesw套件---------->
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.12.3.js"></script>
<!---CDN
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
-->
<script type="text/javascript" src="../dataTables/1.10.12/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../dataTables/1.10.12/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

</head>
<body>
<div id="wrap">
<!-------------------------------------- TOP -->
	<div id="header">
	<?php
	include("../include/top.php");
	?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">
	<?php include("../alert/alert2.php");?>

	
	<?php

		
		include("../SQL/dbtools.inc.php");
		$link = create_connection();
		//include("../SQL/dbtools_ps_2.php");
		//$conn= create_ps_connection();
				//Mail
				require_once('../mail_fulsion/mail/PHPMailer/PHPMailerAutoload.php');
				require_once('../mail_fulsion/mail/PHPMailer/mail_send.php');
				//Mail
			
		$sql_KID  = "select * from alert_ap_date_filter where calling_bar_id in (select calling_bar_id from alert_ap_date_filter group by calling_bar_id having count(calling_bar_id) > 1) and  calling_bar_id <> 0  ";
		$result_KID  = execute_sql($database_name, $sql_KID, $link);	
		$A=0 ;
		while ($row_KID   = mysql_fetch_assoc($result_KID))
		{
		$aaaa_array[$A] = $row_KID['calling_bar_id'];
		$A++;
		}	// 編號重複	

		 
			
	?>
	<div class="report_bar">
		<form action="<?php echo $_SERVER['PHP_SELF'];?>?mode=query" method="GET" style="margin:0 0 10px;">
				<select name="A"  onchange="this.form.submit();">
				<option value=" " selected  disabled>請選擇期別</option>
				<option value="2" <?php if($_GET['A']=='2'){echo 'selected';}else{};	?> >第二期</option>					
				<option value="3" <?php if($_GET['A']=='3'){echo 'selected';}else{};	?> >第三期</option>
				<option value="END" <?php if($_GET['A']=='END'){echo 'selected';}else{};	?> >已結案</option>
				</select>
		<input type='submit' value='檢視報表' onclick="showloading()">
		</form>
	</div>

	<?php
		$zzz = 0 ;
		
		//if(isset($_POST['A']))
		if(isset($_GET['A']))	
		{
			//$_POST['A']
	?>

	<div id="port_data">
	<table class="asset" id="show_date" >
		<thead>
		<tr>
		<th>No.</th>
		<th>叫修編號</th>
		<th>期別</th>
		<th>部落</th>
		<th>設備</th>
		<th>IP</th>
		<th>中斷時間</th>
		<th>恢復時間</th>
		<th>處理編號</th>			
		<th>狀態</th>
	<!---
	<th>處理</th>
	<th>處理流程</th>
	-->
		<th>管理流程</th>
					<th  style="display: none;">發信時間</th>
					<th  style="display: none;">首回覆資訊(時間,備註,處理人員)</th>
					<th  style="display: none;">派工資訊(時間,工程師,備註)</th>
					<th  style="display: none;">到場資訊(時間,工程師,備註)</th>
					<th  style="display: none;">處理資訊(時間,工程師,處理內容)</th>
					<th  style="display: none;">結案資訊(時間,工程師,備註)</th>

		</tr>
		</thead>		
		<tbody>	
		
		<?php	
		
		//print_r($aaaa_array);
		if($_GET['A']=='END')
		{
			$sql_alert_ap_date  = "SELECT * FROM alert_ap_date_filter where  `Processing_status`='已結案'    ORDER BY alert_ap_date_filter_id desc ";
			
		}else{
			
			//$sql_alert_ap_date_1  = "SELECT * FROM alert_ap_date_filter where  Period_AP =".$_GET['A']." and  alert_ap_date_time_ok='0000-00-00 00:00:00' ORDER BY `alert_ap_date_filter`.`alert_ap_date_filter_id` DESC";
			//$sql_alert_ap_date_1  = "SELECT * FROM alert_ap_date_filter where  Period_AP =".$_GET['A']." and `Processing_status`<>'已結案' and  alert_ap_date_time_ok<>'0000-00-00 00:00:00'   ORDER BY alert_ap_date_filter_id desc ";
			$sql_alert_ap_date_1  = "SELECT * FROM alert_ap_date_filter where  Period_AP =".$_GET['A']." and `Processing_status`<>'已結案'   ORDER BY alert_ap_date_filter_id desc ";
		}
			$result_alert_ap_date_1  = execute_sql($database_name, $sql_alert_ap_date_1, $link);
			while ($row_alert_ap_date  = mysql_fetch_assoc($result_alert_ap_date_1))
			{  
			$alert_ap_date_tribe=$row_alert_ap_date['alert_ap_date_tribe'];
			
			$alert_ap_date_setting=$row_alert_ap_date['alert_ap_date_setting'];
			$str = $alert_ap_date_setting;
			$str_sec = explode("-",$str);
			$zzz++;
			
			?>
			<tr>
			<td><?=$zzz ;?>   </td>
			<td><?=$row_alert_ap_date['alert_ap_date_filter_id'];?></td>
			<td><?=$row_alert_ap_date['Period_AP'];?></td>
			<td><a class="tb_link" href="../view_date/view_tribe_msg.php?key=<?=$str_sec[2];?>" target="_self" ><?=$row_alert_ap_date['alert_ap_date_tribe']; ?></a></td>
			<td><a class="tb_link" href="../view_date/view_tribe_AP_date.php?ip=<?=$row_alert_ap_date['alert_ap_date_ap_ip'];?>" target="_self" ><?=$row_alert_ap_date['alert_ap_date_ap_name']; ?></a></td>
			<td><?=$row_alert_ap_date['alert_ap_date_ap_ip']; ?></td>
			<td><?=$row_alert_ap_date['alert_written_time']; ?> </td> <!---信件送出時間--->
			<td><?=$row_alert_ap_date['alert_ap_date_time_ok']; ?> </td>
			<td
			<?php 
			$calling_bar_id = $row_alert_ap_date['calling_bar_id'];
						if (in_array($calling_bar_id, $aaaa_array))
						{
						//echo "A";
						echo 'bgcolor="#FF0000"';
						}
						else
						{
						//echo "B";
						//echo $calling_bar_id ;
						}
			?>
			>
			<?php
			$mail_type =$row_alert_ap_date['mail_type'];
			
			if($mail_type =='0')
			{
				echo '尚未通知</td><td></td><td></td>';
			}else{
				
				 if($calling_bar_id =='0')
				{
					echo '尚未處理';
				}else{
					echo  $calling_bar_id  ;
				}
			}	
			   
			?> 
						</td> <!---叫修編號--->
			<td><?php 
			$Processing_status = $row_alert_ap_date['Processing_status']; 
			if($mail_type =='0')
			{
				echo '';
			}else if($mail_type =='1')
			{
				echo $Processing_status;
			}else{
				echo $Processing_status;
			}
			
			
			?></td> 

			<?php 
			if($mail_type =='0')
			{
			
			
			}else{
				
					if($Processing_status =='已結案')
					{
							?>
							<td>
							<a href="edit_work.php?key=<?=$row_alert_ap_date['alert_ap_date_filter_id']; ?>">
							<img src="../images/icon_edit.png" class="adm_icon" align="absmiddle">
							</a>
							</td> 
							<?php
					}else{
					?>
							<?php
							if($Processing_status =='已發信')
							{
							?>
							<td>
							<a href="edit_work.php?key=<?=$row_alert_ap_date['alert_ap_date_filter_id']; ?>">
							<img src="../images/icon_edit.png" class="adm_icon" align="absmiddle">
							</a>
							</td> 
							<?php
							}else
							{
							?>
							<td>
							<a href="edit_work.php?key=<?=$row_alert_ap_date['alert_ap_date_filter_id']; ?>">
							<img src="../images/icon_edit.png" class="adm_icon" align="absmiddle">
							</a>
							</td> 
							<?php
							}

							?>
					
				
					
					
					<?php

					}
					?>
				<td  style="display: none;">
<?=$row_alert_ap_date['alert_written_time']; ?>

</td>
<td  style="display: none;">
[
<?=$row_alert_ap_date['Processing_time_A']; ?>,
<?=$row_alert_ap_date['note_A']; ?>,
<?=$row_alert_ap_date['Processor_A']; ?>
]
</td>
<td  style="display: none;">

<?php
$key_id = $row_alert_ap_date['alert_ap_date_filter_id'];
$sql_date_A  = "SELECT Equipment_Repair_time ,Equipment_Repair_engineer ,Equipment_Repair_remark FROM Equipment_Repair where Equipment_Repair_type='00' and Equipment_Repair_number='$key_id' " ;	$result_date_A  = execute_sql($database_name, $sql_date_A, $link);
while ($row_date_A  = mysql_fetch_assoc($result_date_A))
{ 
echo '[';
echo $row_date_A['Equipment_Repair_time'];
echo ',';
echo $row_date_A['Equipment_Repair_engineer'];
echo ',';
echo $row_date_A['Equipment_Repair_remark'];
//echo ',';
echo ']';

}

?>

</td>
<td  style="display: none;">

<?php
$sql_date_A  = "SELECT Equipment_Repair_time ,Equipment_Repair_engineer ,Equipment_Repair_remark FROM Equipment_Repair where Equipment_Repair_type='02' and Equipment_Repair_number='$key_id' " ;	$result_date_A  = execute_sql($database_name, $sql_date_A, $link);
while ($row_date_A  = mysql_fetch_assoc($result_date_A))
{ 
echo '[';
echo $row_date_A['Equipment_Repair_time'];
echo ',';
echo $row_date_A['Equipment_Repair_engineer'];
echo ',';
echo $row_date_A['Equipment_Repair_remark'];
//echo ',';
echo ']';

}
?>

</td>
<td  style="display: none;">

<?php
$sql_date_A  = "SELECT Equipment_Repair_time ,Equipment_Repair_engineer ,Equipment_Repair_remark FROM Equipment_Repair where Equipment_Repair_type='01' and Equipment_Repair_number='$key_id' " ;	$result_date_A  = execute_sql($database_name, $sql_date_A, $link);
while ($row_date_A  = mysql_fetch_assoc($result_date_A))
{ 
echo '[';
echo $row_date_A['Equipment_Repair_time'];
echo ',';
echo $row_date_A['Equipment_Repair_engineer'];
echo ',';
echo $row_date_A['Equipment_Repair_remark'];
//echo ',';
echo ']';
}
?>

</td>
<td  style="display: none;">

<?php
$sql_date_A  = "SELECT Equipment_Repair_time ,Equipment_Repair_engineer ,Equipment_Repair_remark FROM Equipment_Repair where Equipment_Repair_type='03' and Equipment_Repair_number='$key_id' " ;	$result_date_A  = execute_sql($database_name, $sql_date_A, $link);
while ($row_date_A  = mysql_fetch_assoc($result_date_A))
{ 
echo '[';
echo $row_date_A['Equipment_Repair_time'];
echo ',';
echo $row_date_A['Equipment_Repair_engineer'];
echo ',';
echo $row_date_A['Equipment_Repair_remark'];
//echo ',';
echo ']';
}
?>

</td>	
					</tr>
					<?php

					}
				
			}

			//$sql_alert_ap_date  = "SELECT * FROM alert_ap_date_filter where  Period_AP =".$_GET['A']." ORDER BY alert_written_time desc,Processing_status desc ,alert_ap_date_time_ok asc ";
			$result_alert_ap_date  = execute_sql($database_name, $sql_alert_ap_date, $link);
			while ($row_alert_ap_date  = mysql_fetch_assoc($result_alert_ap_date))
			{  
			$alert_ap_date_tribe=$row_alert_ap_date['alert_ap_date_tribe'];
			
			$alert_ap_date_setting=$row_alert_ap_date['alert_ap_date_setting'];
			$str = $alert_ap_date_setting;
			$str_sec = explode("-",$str);
			$zzz++;
			
			?>
			<tr>
			<td><?=$zzz ;?></td>
			<td><?=$row_alert_ap_date['alert_ap_date_filter_id'];?></td>
			<td><?=$row_alert_ap_date['Period_AP'];?></td>
			<td><a class="tb_link" href="../view_date/view_tribe_msg.php?key=<?=$str_sec[2];?>" target="_self" ><?=$row_alert_ap_date['alert_ap_date_tribe']; ?></a></td>
			<td><a class="tb_link" href="../view_date/view_tribe_AP_date.php?ip=<?=$row_alert_ap_date['alert_ap_date_ap_ip'];?>" target="_self" ><?=$row_alert_ap_date['alert_ap_date_ap_name']; ?></a></td>
			<td><?=$row_alert_ap_date['alert_ap_date_ap_ip']; ?></td>
			<td><?=$row_alert_ap_date['alert_written_time']; ?> </td> <!---信件送出時間--->
			<td><?=$row_alert_ap_date['alert_ap_date_time_ok']; ?> </td>
			<td
			<?php 
			$calling_bar_id = $row_alert_ap_date['calling_bar_id'];
						if (in_array($calling_bar_id, $aaaa_array))
						{
						//echo "A";
						echo 'bgcolor="#FF0000"';
						}
						else
						{
						//echo "B";
						//echo $calling_bar_id ;
						}
			?>
			>
			<?php
			$mail_type =$row_alert_ap_date['mail_type'];
			if($mail_type =='0')
			{
				echo '尚未通知</td><td></td><td></td>';
				
			}else{
				
				 if($calling_bar_id =='0')
				{
					echo '尚未處理';
				}else{
					echo  $calling_bar_id  ;
				}
			}	
			   
			?> 
						</td> <!---叫修編號--->
			<td><?php
			$Processing_status = $row_alert_ap_date['Processing_status']; 
			if($mail_type =='0')
			{
				echo '';
			}else if($mail_type =='1')
			{
				echo $Processing_status;
			}else{
				echo $Processing_status;
			}
			
			
			?></td> 

			<?php 
			
			if($mail_type =='0')
			{
			
			
			}else{
				
					if($Processing_status =='已結案')
					{
						?>
						<td>
						<a href="edit_work.php?key=<?=$row_alert_ap_date['alert_ap_date_filter_id']; ?>">
						<img src="../images/icon_edit.png" class="adm_icon" align="absmiddle">
						</a>
						</td> 
						<?php
					}else{
					
					
							if($Processing_status =='已發信')
							{
							?>
							<td>
							<a href="edit_work.php?key=<?=$row_alert_ap_date['alert_ap_date_filter_id']; ?>">
							<img src="../images/icon_edit.png" class="adm_icon" align="absmiddle">
							</a>
							</td> 
							<?php
							}else
							{
							?>
							<td>
							<a href="edit_work.php?key=<?=$row_alert_ap_date['alert_ap_date_filter_id']; ?>">
							<img src="../images/icon_edit.png" class="adm_icon" align="absmiddle">
							</a>
							</td> 
							<?php
							}
					}
					
					//view_proc_date.php = view_proc_date.php
					?>
					<td  style="display: none;">
<?=$row_alert_ap_date['alert_written_time']; ?>

</td>
<td  style="display: none;">
[
<?=$row_alert_ap_date['Processing_time_A']; ?>,
<?=$row_alert_ap_date['note_A']; ?>,
<?=$row_alert_ap_date['Processor_A']; ?>
]


</td>
<td  style="display: none;">

<?php
$key_id = $row_alert_ap_date['alert_ap_date_filter_id'];
$sql_date_A  = "SELECT Equipment_Repair_time ,Equipment_Repair_engineer ,Equipment_Repair_remark FROM Equipment_Repair where Equipment_Repair_type='00' and Equipment_Repair_number='$key_id' " ;	$result_date_A  = execute_sql($database_name, $sql_date_A, $link);
while ($row_date_A  = mysql_fetch_assoc($result_date_A))
{ 
echo '[';
echo $row_date_A['Equipment_Repair_time'];
echo ',';
echo $row_date_A['Equipment_Repair_engineer'];
echo ',';
echo $row_date_A['Equipment_Repair_remark'];
//echo ',';
echo ']';

}

?>

</td>
<td  style="display: none;">

<?php
$sql_date_A  = "SELECT Equipment_Repair_time ,Equipment_Repair_engineer ,Equipment_Repair_remark FROM Equipment_Repair where Equipment_Repair_type='02' and Equipment_Repair_number='$key_id' " ;	$result_date_A  = execute_sql($database_name, $sql_date_A, $link);
while ($row_date_A  = mysql_fetch_assoc($result_date_A))
{ 
echo '[';
echo $row_date_A['Equipment_Repair_time'];
echo ',';
echo $row_date_A['Equipment_Repair_engineer'];
echo ',';
echo $row_date_A['Equipment_Repair_remark'];
//echo ',';
echo ']';

}
?>

</td>
<td  style="display: none;">

<?php
$sql_date_A  = "SELECT Equipment_Repair_time ,Equipment_Repair_engineer ,Equipment_Repair_remark FROM Equipment_Repair where Equipment_Repair_type='01' and Equipment_Repair_number='$key_id' " ;	$result_date_A  = execute_sql($database_name, $sql_date_A, $link);
while ($row_date_A  = mysql_fetch_assoc($result_date_A))
{ 
echo '[';
echo $row_date_A['Equipment_Repair_time'];
echo ',';
echo $row_date_A['Equipment_Repair_engineer'];
echo ',';
echo $row_date_A['Equipment_Repair_remark'];
//echo ',';
echo ']';

}
?>

</td>
<td  style="display: none;">

<?php
$sql_date_A  = "SELECT Equipment_Repair_time ,Equipment_Repair_engineer ,Equipment_Repair_remark FROM Equipment_Repair where Equipment_Repair_type='03' and Equipment_Repair_number='$key_id' " ;	$result_date_A  = execute_sql($database_name, $sql_date_A, $link);
while ($row_date_A  = mysql_fetch_assoc($result_date_A))
{ 
echo '[';
echo $row_date_A['Equipment_Repair_time'];
echo ',';
echo $row_date_A['Equipment_Repair_engineer'];
echo ',';
echo $row_date_A['Equipment_Repair_remark'];
//echo ',';
echo ']';
}
?>

</td>
					
					</tr>
					<?php

					}
				
			}
		
		?>
		</tbody>		
	</table>
	</div>		
				<?php	
					
				
			}else{
				//$sql_alert_ap_date  = "SELECT * FROM alert_ap_date_filter where  Period_AP =2   ORDER BY alert_ap_date_time_ok asc ";
			}
			//$sql_alert_ap_date  = "SELECT * FROM alert_ap_date_filter where  Period_AP =2   ORDER BY alert_ap_date_time_ok asc ";
			
			
		?>

	
	</div>

<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</div>
</body>

<script language="JavaScript">
$(document).ready(function(){ 
  var opt={ "oLanguage":{"sProcessing":"處理中...",
						"sLengthMenu":"顯示 _MENU_ 項結果",
						"sZeroRecords":"沒有匹配結果",
						"sInfo":"顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
						"sInfoEmpty":"顯示第 0 至 0 項結果，共 0 項",
						"sInfoFiltered":"(從 _MAX_ 項結果過濾)",
						"sSearch":"搜索:",
						"oPaginate":{"sFirst":"首頁",
									 "sPrevious":"上頁",
									 "sNext":"下頁",
									 "sLast":"尾頁"},
						 
				},
				"bAutoWidth" :false,
				"bStateSave" :true,
				lengthMenu: [
				[ 10, 25, 50, -1 ],
				[ '10 筆', '25 筆', '50 筆', '全部' ]
				],
				"aoData": [   
						null,
						null,  
						null,  
						null, 
						null, 
						null,
						null,  
						null,  
						null, 
						null, 	
						{ "bSearchable": false } ,
						{ "bSearchable": false } ,
						{ "bSearchable": false } , 
						{ "bSearchable": false } , 
						{ "bSearchable": false } ,
						{ "bSearchable": false } , 						
						//{ "bSortable": false, "bSearchable": false } 
						],
				"bProcessing":true,
		dom: 'Bfrtip',	
		buttons: [
			    { extend: 'excelHtml5', text: '匯出服務中斷數量統計表' ,title: '<?= date("Y-m-d");?>服務中斷數量統計表' },
				//{ extend: 'print', text: '列印',title: '<?= date("Y-m-d");?>斷線數量統計表' },	
				'pageLength',				
			],
	   };
  $("#show_date").dataTable(opt);
  });
</script>
</html>