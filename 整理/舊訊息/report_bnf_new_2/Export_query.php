<!DOCTYPE html>
<html>
	<head>
		<title>無線AP網管系統</title>
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
			<!--------dataTablesw套件---------->
	<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.12.3.js"></script>
	<!---CDN
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
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
	

<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
	
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>



	
<body>
<form action="<?php echo $_SERVER['PHP_SELF'];?>?mode=query" method="post">
		<select name="realm">
			<option  disabled selected>請選擇單位</option>
			<option value="itw" <?php if($_POST['realm']=='itw'){echo 'selected'; }?> >愛台灣</option>
			<option value="<>itw" <?php if($_POST['realm']=='<>itw'){echo 'selected'; }?> >愛部落</option>
		</select>		
		<select  name="year" size="1" >
				<option  disabled selected>請選擇年份</option>

				<?php
				$dat_y = date("Y")+2;
				for($y=2016 ; $y<=$dat_y  ; $y++)
				{
				?>
				<option value="<?=$y;?>" <?php if($_POST['year']==$y){echo 'selected'; }?> ><?=$y;?>年</option>
				<?php
				}
				?>
		</select>
		<select  name="month" size="1" >
				<option  disabled selected>請選擇月份</option>
					
				<?php
				$month = array('01','02','03','04','05','06','07','08','09','10','11','12');

				for($ii=0;$ii<12;$ii++)
				{
				?>
				<option value="<?=$month[$ii];?>" <?php if($_POST['month']==$month[$ii]){echo 'selected'; }?> ><?=$month[$ii];?>月</option>
				<?php
				}

				?>
		</select>	　
　<select name="A">
				  <option value=" " selected  >請選擇期別</option> 
				　<option value="2" <?php if($_POST['A']=='2'){echo 'selected';}else{};	?> >第二期</option>
				　<option value="3" <?php if($_POST['A']=='3'){echo 'selected';}else{};	?> >第三期</option>
</select>
<input type="submit" value="查詢報表">
</form> 

<?php
    if($_GET['mode']=='query')
	{

$realm = $_POST['realm'];
$year = $_POST['year'];
$month = $_POST['month'];
$label_tribe = $_POST['A'];

		if($realm==NULL)
		 {
		
		
		
		?><script> alert("單位空白");window.history.back();</script><?php
			 exit();
		
		 }else if($year==NULL)
		 {
		
		
		?><script> alert("年份空白");window.history.back();</script><?php
			 exit();
		
		
		 }else 	if($month==NULL)
		 {
		
		
		?><script> alert("月份空白");window.history.back();</script><?php
			 exit();
		
		
		 }else if($label_tribe==NULL)
		 {
			 //echo '單位空白';
			 ?><script> alert("期別空白");window.history.back();</script><?php
			 exit();
		 }else{
			 
		 
		require_once("dbtools.inc.php");
		include_once("../SQL/dbtools_ps.php");
		$link = create_connection();
		$link2 = create_connection2();
		
		
		if($realm=='itw')
		{
			$key="realm='itw' ";
			$key_sting= "愛台灣";
		}else{
			$key="realm<>'itw' ";
			$key_sting= "愛部落";
		}
		$day = $year.'-'.$month;
		/*
		$years = date("Y"); //用date()函式取得目前年份格式0000
		$months = date("m"); //用date()函式取得目前月份格式00
		$days = date("d"); //用date()函式取得目前日期格式00
		$day = date("Y-m",mktime(0,0,0,$months-1,$days,$years));
		*/
		
		//echo $day;
		//echo '<br>';
		
		?>

	<?php echo   $day;    ?>
		<table class="table2excel"  id="table2excel">
		  <thead>
					<tr>
						<th>縣市</th>
						<th>地區</th>
						<th>部落</th>
						<th>期別</th>
							<th>總使用人次</th>
							<th>總使用人數</th>
							<th>總使用時間(分)</th>
							<th>總流量(MB)</th>
							<th>總上行流量(MB)</th>
							<th>總下行流量(MB)</th>
							<th>設備妥尚率</th>
							<!---計算--->
							<th>平均使用人次使用時間(分)</th>
							<th>平均使用人次使用流量(MB)</th>
							<th>平均使用人數使用時間(分)</th>
							<th>平均使用人數使用流量(MB)</th>
					</tr>
		  </thead>			
					<tbody>
<?php

		 //$sql_tribe="SELECT * FROM  tribe where tribe_label =2 ";
		  $sql_tribe="SELECT * FROM `tribe` where tribe_label='$label_tribe'  ORDER BY `tribe_label`,`city_id`,`township_id`,`tribe_name` ASC ";
		  
		  $result_tribe= execute_sql($database_name2, $sql_tribe, $link2);
		  $ii = 0;
while ($row_tribe= mysql_fetch_assoc($result_tribe)  )
{
				$tribe_id = $row_tribe['tribe_id'];
				
				
					  ?>
					  
							
							<?php
							$sql_ap="SELECT GROUP_CONCAT(ass_ap_ip)   FROM  ass_ap  where  	ass_ap_tribe='$tribe_id'  ";
							$result_ap= execute_sql($database_name2, $sql_ap, $link2);
						
							while ($row_ap= mysql_fetch_assoc($result_ap)  )
							{
								$ass_ap_ip  = $row_ap['GROUP_CONCAT(ass_ap_ip)'];
								$string2 = $ass_ap_ip;
								$ass_ap_ip = str_replace (",","','",$ass_ap_ip);
								//echo	$ass_ap_ip;	
								//echo '<br>';
							
							
											$sql_sum="SELECT SUM(acctsessiontime),SUM(acctinputoctets),SUM(acctoutputoctets),SUM(acctstartdelay),SUM(acctstopdelay),acctstarttime  FROM radacct  where nasipaddress IN ('$ass_ap_ip') and $key  and acctstarttime like '%$day%'";
											$result_sum = execute_sql($database_name, $sql_sum, $link);
											
											
											$sql1="SELECT radacctid FROM radacct where  nasipaddress IN ('$ass_ap_ip') and $key and acctstarttime like '%$day%' ";
											$result1 = execute_sql($database_name, $sql1, $link);
											$number1 = mysql_num_rows($result1);
										//echo $sql1;
										//echo '<br>';
											///
											$sql2="SELECT username   FROM radacct where  nasipaddress IN ('$ass_ap_ip') and $key and acctstarttime like '%$day%' GROUP BY username ";
											$result2 = execute_sql($database_name, $sql2, $link);
											$number2 = mysql_num_rows($result2);
											
											//echo $sql_sum;
											//echo '<br>';
							
											?>
													<tr> 
													<?php
														while ($row_sum= mysql_fetch_assoc($result_sum) )
														{

															$acctsessiontime=$row_sum['SUM(acctsessiontime)']/(60);
															$acctinputoctets=$row_sum['SUM(acctinputoctets)']/(1024*1000);
															$acctoutputoctets=$row_sum['SUM(acctoutputoctets)']/(1024*1000);
                                                            $sum_total =  $acctinputoctets+ $acctoutputoctets ;
															
															$acctsessiontime=  number_format($acctsessiontime);
															$acctinputoctets=  number_format($acctinputoctets);
															$acctoutputoctets= number_format($acctoutputoctets);
															$sum_total= number_format($sum_total);
															$A = $acctsessiontime;  // 總時間
															$A1 = $sum_total;      // 總流量
															
															$B = $number1 ;      // 總使用人次
															$B1 = $number2 ;     // 總使用人數
															
															$A = preg_replace("/,/",'',$A);
															$A1 = preg_replace("/,/",'',$A1);
															$B = preg_replace("/,/",'',$B);
															$B1 = preg_replace("/,/",'',$B1);
															$average_A = $A/$B   ;
															$average_B = $A1/$B  ;
															
															$average_C =  $A/$B1  ;
															$average_D = $A1/$B1   ;
															?>
															<td>
															<?php
															//city_array
															$id1 =$row_tribe['city_id'];
															$sql_city_array="SELECT city_name FROM city_array WHERE id ='$id1' ";
															$result_city_array= execute_sql($database_name2, $sql_city_array, $link2);
															while ($row_city_array= mysql_fetch_assoc($result_city_array)  )
															{
															   echo $row_city_array['city_name'];
															}
															
															?>
															</td>
															<td>
															<?php
															//city_township
															$id2 =$row_tribe['township_id'];
															$sql_township="SELECT township_name FROM city_township WHERE township_id ='$id2' ";
															$result_township= execute_sql($database_name2, $sql_township, $link2);
															while ($row_township= mysql_fetch_assoc($result_township)  )
															{
															   echo $row_township['township_name'];
															}
															
															?>
															</td>
															<td><?=$row_tribe['tribe_name'];?></td>
															<td><?=$row_tribe['tribe_label'];?></td>
															<td><?=$number1;?></td>
															<td><?=$number2;?></td>

															<td><?=$acctsessiontime;?></td>
															<td><?=$sum_total;?></td>
															<td><?=$acctinputoctets;?></td>
															<td><?=$acctoutputoctets;?></td>
															<td>
															<?php
$output = explode(",", $string2);
//print_r($output);
$output_count = count($output);
 $j = 0 ;
// echo $output_count;
for($doo = 0 ; $doo <  $output_count ; $doo ++)
{
	$key_ipp = $output[$doo];
	//echo $output[$doo];
	$sql_ipinterface ="SELECT * FROM ipinterface where ipaddr ='$key_ipp' ";
	$result_ipinterface = pg_query($conn,$sql_ipinterface );
	while ($row_ipinterface = pg_fetch_assoc($result_ipinterface) )
	{
		$nodeid = $row_ipinterface['nodeid'];
							$sql_events ="SELECT * FROM events where nodeid	 ='$nodeid' ORDER BY eventid DESC ";
							$result_events = pg_query($conn,$sql_events );
							$rows_count = pg_num_rows($result_events);	
							//echo '<Ol>';
							while ($row_events = pg_fetch_assoc($result_events)   )
							{
	$eventid = $row_events['eventid'];
	$sql_text ="SELECT iflostservice,ifregainedservice,ifserviceid  FROM outages where svclosteventid ='$eventid' and ifregainedservice is not NULL and iflostservice like '%$day%' ";
	//echo  $sql_text ;
	//echo '<br>';
	$result_outages = pg_query($conn,$sql_text );
						while ($row_outages = pg_fetch_assoc($result_outages) and $j <9999999 )
							{
							//各設備斷線資料										
							$iflostservice = substr($row_outages['iflostservice'], 0, 19) ;
							//echo '<br>';
							$ifregainedservice =  substr($row_outages['ifregainedservice'], 0, 19) ;
							//echo '-'.strtotime($ifregainedservice)-strtotime($iflostservice) ;
							//echo	$year.'-'.$month[$ii];

							//echo '<br>';
							$sum_s = strtotime($ifregainedservice)-strtotime($iflostservice) ;
							$arrry[$ii][$j] = $sum_s;
							$j++;
							//echo $sum_s;
							
							//echo '<br>';
							}					
						}
	
	}
}
				$total_sum =  $doo;  // IP總數
				$month_sum_s= 30*24*60*60;
				$total_sum  = (array_sum($arrry[$ii])/($month_sum_s*$doo))*100 ;
				$total_sum =  100- $total_sum ;
				$total_sum_1=  floor($total_sum);
				echo  $total_sum_1;								
															
															
															
															
															
															?>
															</td>
																<!------->
															<td><?=number_format($average_A);?></td>
															<td><?=number_format($average_B);?></td>
															<td><?=number_format($average_C);?></td>
															<td><?=number_format($average_D);?></td>
															<?php
														}
														?>
													</tr>
											<?php	
											}	
																		
							?>
							
							
							
					  
					  
					  <?php
				$ii ++;				
		    }

       }

	}else{
		
		echo '選擇功能';
		
	}
?>				</tbody>
		</table>
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
				lengthMenu: [
				[ 10, 25, 50, -1 ],
				[ '10 筆', '25 筆', '50 筆', '全部' ]
				],
			 dom: 'Bfrtip',	 buttons: 
			 [
				{ extend: 'excelHtml5', text: '匯出<?=$key_sting ;?>服務效益月報表' ,title: '<?= date("Y-m-d");?><?=$key_sting ;?>服務效益月報表' },
				//{ extend: 'print', text: '列印',title: '<?= date("Y-m-d");?>服務效益分析年報表' },	
				'pageLength',				
			],
	   };
  $("#table2excel").dataTable(opt);
  });
</script>
		<?php
		/*
		
		<!---
		//快速匯出
		<script src="execl_95/jquery.table2excel.js"></script>


		<script>
		
		$(function() {
		$(".table2excel").table2excel({
		exclude: ".noExl",
		name: "Excel Document Name",
		filename: "<?=//$day;?>愛台灣服務效益月報表",
		fileext: ".xls",
		exclude_img: true,
		exclude_links: true,
		exclude_inputs: true
		});
		window.close();
		}
		);

		</script>
		-->		
		*/
		?>
			
	</body>
</html>
