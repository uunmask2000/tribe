<html>
<head>
	<meta charset="utf-8">
	<title>無線AP網管系統</title>
	<link href="../include/style.css" rel="stylesheet" type="text/css" />
	<link href="../include/reset.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="../include/tablesort_style.css" />
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

		<h1 class="report">服務效益分析總表</h1>
		<div class="report_nav">
			<a href="/report_bnf_new/report_all.php">年報表分析</a>
			<a href="/report_bnf_new/Export_query.php" target="_blank">匯出服務效益分析總表</a>
		</div>
		<?php
		include_once("../SQL/dbtools_ps.php");
		require_once("dbtools.inc.php");
		$link = create_connection();
		$link2 = create_connection2();
		?>

		<div class="report_bar">
				<form action="<?php echo $_SERVER['PHP_SELF'];?>?mode=query" method="post">	　
				<select name="realm" size="1" > 
				<option  disabled selected>請選擇單位</option>
				<option value="itr" <?php if($_POST['realm']=='itr'){echo 'selected'; }?> ><?php  echo  '愛部落'; echo '</option>';	?>
				<option value="itw" <?php if($_POST['realm']=='itw'){echo 'selected'; }?> ><?php  echo  '愛台灣'; echo '</option>';	?>
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

				<select name="A" onchange="this.form.submit();">
				<option value=" " selected  >請選擇期別</option> 
				<option value="2" <?php if($_POST['A']=='2'){echo 'selected';}else{};	?> >第二期</option>
				<option value="3" <?php if($_POST['A']=='3'){echo 'selected';}else{};	?> >第三期</option>
				</select>

				<select  name="tribe" size="1"   onchange="this.form.submit();">
				<option  disabled selected>請選擇部落</option>
				<?php
				$key = $_POST['A'];
				$sql_tribe="SELECT * FROM tribe  where tribe_label='$key'";
				$result_tribe= execute_sql($database_name2, $sql_tribe, $link2);
				while ($row_tribe= mysql_fetch_assoc($result_tribe)  )
				{
				?>
				<option value="<?=$row_tribe['tribe_id'];?>"  <?php if($_POST['tribe']==$row_tribe['tribe_id']){  echo 'selected';  }?> ><?=$row_tribe['tribe_name'];?></option>
				<?php
				}					
				?>
				</select>
		
				<input type="submit" value="送出表單"/>
				</form>
		</div>

		<div class="report">
	<?php
	if($_GET['mode']=='query')
	{
		
		
		$realm = $_POST['realm'];
		$year = $_POST['year'];
		$label_tribe = $_POST['A'];
		$tribe = $_POST['tribe'];
		
		$sql_total="SELECT * FROM tribe  where tribe_id='$tribe'";
		$result_total= execute_sql($database_name2, $sql_total, $link2);
		while ($row_total= mysql_fetch_assoc($result_total)  )
		{
		$tribe_name =  $row_total['tribe_name'];

		}
		
		
		 if($realm==NULL)
		 {
			 //echo '單位空白';
			 ?><script> alert("單位空白");window.history.back();</script><?php
			 exit();
		 }else if($year==NULL)
		 {
		 
			//echo '年份空白';
			?><script> alert("年份空白");window.history.back();</script><?php
			 exit();
		 }
		 if($label_tribe==NULL)
		 {
		 
			//echo '期別空白';
			?><script> alert("期別空白");window.history.back();</script><?php
			exit();
		 }
		 if($tribe==NULL)
		 {
		 
			
		 }else{
			 
					if($realm=='itw')
					{
					$key_string = "realm='itw'";
					}else{
					$key_string = "realm<>'itw'";
					}
			 $month = array('01','02','03','04','05','06','07','08','09','10','11','12');
			?>
			 <table id="show_date" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
				<th>月份</th>
				<th>使用人次</th>
				<th>使用人數</th>
			　	<th>使用時間(時)</th>
				<th>總流量(MB)</th>
				<th>上行流量(MB)</th>
				<th>下行流量(MB)</th>
				<th>設備妥善率（%）</th>
			</tr>
        </thead>
       
        <tbody>
		<?=$realm ;?>
            <?php
			
				
					 $sql001="SELECT  GROUP_CONCAT(ass_ap_ip)  FROM ass_ap where ass_ap_tribe='$tribe'    ";
					 $result001= execute_sql($database_name2, $sql001, $link2);
						while ($row001 = mysql_fetch_assoc($result001) )
						{
							$ass_ap_ip  = $row001['GROUP_CONCAT(ass_ap_ip)'];	
							$string2 = $ass_ap_ip;
							$ass_ap_ip = str_replace (",","','",$ass_ap_ip);
							$string = $ass_ap_ip;
							
							//echo $string;
						}			 
					
					
					for($ii=0;$ii<12;$ii++)
					{
						echo '<tr>';
						$sql="SELECT SUM(acctsessiontime),SUM(acctinputoctets),SUM(acctoutputoctets),SUM(acctstartdelay),SUM(acctstopdelay),acctstarttime  FROM radacct  where   $key_string  and nasipaddress IN ('$string') and acctstarttime like '%$year-$month[$ii]%' ";
						$result = execute_sql($database_name, $sql, $link);
						//echo $sql;
						//echo '<br>';
						//
						$sql1="SELECT radacctid FROM radacct where $key_string and nasipaddress IN ('$string') and acctstarttime like '%$year-$month[$ii]%'";
						$result1 = execute_sql($database_name, $sql1, $link);
						$number1 = mysql_num_rows($result1);
					  // echo $sql1;
					  // echo '<br>';
						///
						$sql2="SELECT username   FROM radacct where $key_string and nasipaddress IN ('$string') and acctstarttime like '%$year-$month[$ii]%'  GROUP BY username ";
						$result2 = execute_sql($database_name, $sql2, $link);
						$number2 = mysql_num_rows($result2);
						
						while ($row = mysql_fetch_assoc($result) )
						{
										$acctsessiontime=$row['SUM(acctsessiontime)']/(60);
										$acctinputoctets=$row['SUM(acctinputoctets)']/(1024);
										$acctoutputoctets=$row['SUM(acctoutputoctets)']/(1024);
										$new_SUM=($acctoutputoctets+$acctinputoctets);
										$acctsessiontime=  number_format($acctsessiontime);
										$acctinputoctets=  number_format($acctinputoctets);
										$acctoutputoctets= number_format($acctoutputoctets);
										$new_SUM= number_format($new_SUM);
										
										
										?>
										<td><?=$year.'-'.$month[$ii];?></td>
										<td><?=$number1;?></td>
										<td><?=$number2;?></td>
										
											<td><?=$acctsessiontime;?></td>
											<td><?=$new_SUM; ?></td>
											<td><?=$acctinputoctets;?></td>
											<td><?=$acctoutputoctets;?></td>
											<td>
											<?PHP
											//like '%$year-$month[$ii]%'
											//echo $string2 ;
			$output = explode(",", $string2);
			//print_r($output);
			 $output_count = count($output);
			 $j = 0 ;
			// echo $output_count;
			for($doo = 0 ; $doo <  $output_count ; $doo ++)
			{
					$key_ipp = $output[$doo];
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
								$sql_text ="SELECT iflostservice,ifregainedservice,ifserviceid  FROM outages where svclosteventid ='$eventid' and ifregainedservice is not NULL and iflostservice like '%$year-$month[$ii]%' ";
								//echo  $sql_text ;
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
										
											//echo $sum_s
										//	echo '<li>';
											//echo $key_ipp.'-'.$sum_s ;
										  //  echo $j.'-'.$ii.'-'.$doo.'-'.$sum_s;
											  //echo $sum_s;
											//echo '</li>';
											//echo $j ;
											$arrry[$ii][$j] = $sum_s;
											$j++;
											//echo $sum_s;
							
							//echo '<br>';
											
										}
								
									
					
								
							}
							//各設備斷線資料總數
							
							
							
							//echo '</Ol>';	
						
					}
					//30*24*60*60
					
			
			}
			$total_sum =  $doo;  // IP總數
			$month_sum_s= 30*24*60*60;
			$total_sum  = (array_sum($arrry[$ii])/($month_sum_s*$doo))*100 ;
		    $total_sum =  100- $total_sum ;
			$total_sum_1=  floor($total_sum);
			echo  $total_sum_1;
			//echo array_sum($arrry[$ii]);
			//echo $output_count;		
				//echo $rows_count;									
				//echo 'AA';	
                //echo 
								
											?></td>
										<?php	
								
						}
						echo '</tr>';
					}
					
					
					
					?>
					<?php
					//echo array_sum($arr_result_row[8]);
					//print_r($arr_result_row[8][0]);
					//print_r($arr_result_row[8][1]);
                 	//print_r($aaaaaaaaa);			
				
					?>
        </tbody>
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
				{ extend: 'excelHtml5', text: '匯出服務效益分析總表' ,title: '<?= date("Y-m-d");?>  <?=$tribe_name;?>:服務效益分析年報表' },
				{ extend: 'print', text: '列印',title: '<?= date("Y-m-d");?>服務效益分析年報表' },	
				'pageLength',				
			],
	   };
  $("#show_date").dataTable(opt);
  });
</script>	
			<?php	
			 
		 }
	 
	
	}else{
		
		
		
		echo '尚未選擇條件';
	}
		

	?>	
		

		</div>
	</div>
	
	
 <!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</div>
</body>
</html>
