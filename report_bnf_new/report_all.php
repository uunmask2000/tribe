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
		<!-----------讀取資料特效------------->
		<style>
		div.loadingdiv{
			height: 100vh;
			width: 100%;
			position: absolute;
			z-index: 90;
			left: 0;
			display: block;
			text-align: center;
			background: #FFF;
			filter: alpha(Opacity=80);
			opacity: 0.8;
		}
		img.loading {
			position: relative;
			top: 250px;
		}
		</style>
		<script>
		function showloading(){
		document.getElementById('loading').style.display = 'block';
		}
		function init(){
		document.getElementById("loading").style.display = "none";
		}
		if(window.attachEvent)
		{window.attachEvent('onload', init);}
		else
		{window.addEventListener('load', init, false);}
		</script>
		<!------------------------>
</head>
<body onload="init()" >

<div class="loadingdiv" id="loading">
   <img class="loading" src="../blockUI/ajax-loader.gif" alt="">
</div>

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
			<a href="/report_bnf_new/report_all.php"
			<?php if (preg_match("/report_all/i", $_SERVER['PHP_SELF'])) {echo 'style="background: #126389"'; } ?>
			>年報表</a>
			<a href="/report_bnf_new/Export_query.php">月報表</a>
		</div>
		<?php
		include_once("../SQL/dbtools_ps.php");
		require_once("dbtools.inc.php");
		$link = create_connection();
		$link2 = create_connection2();
		?>

		<div class="report_bar">
				<form action="<?php echo $_SERVER['PHP_SELF'];?>?mode=query" method="post">
				
				<select name="A" onchange="this.form.submit();">
				<option value=" " selected disabled  >請選擇期別</option> 
				<option value="2" <?php if($_POST['A']=='2'){echo 'selected';}else{}; 	?>  >第二期</option>
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

				<select name="realm" size="1" > 
				<option  disabled selected>請選擇單位</option>
				<option value="all" <?php if($_POST['realm']=='all'){echo 'selected'; }?> ><?php  echo  '全部'; echo '</option>';	?>
				<option value="itr" <?php if($_POST['realm']=='itr'){echo 'selected'; }?> ><?php  echo  '愛部落'; echo '</option>';	?>
				<option value="itw" <?php if($_POST['realm']=='itw'){echo 'selected'; }?> ><?php  echo  '愛台灣'; echo '</option>';	?>
				</select>
					<input type='submit' value='檢視報表' onclick="showloading()">
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
		if(empty($label_tribe))
		{
			echo '期別空白';
		}
		if(empty($tribe))
		{
			echo '部落空白';
		}
		if(empty($year))
		{
			echo '年份空白';
		}
		if(empty($realm))
		{
			echo '當位空白';
			exit();
		}
		
		 
		 if($realm=="all")
		 {
		    // echo  "A1";
			
					 $month = array('01','02','03','04','05','06','07','08','09','10','11','12');
			?> 
			 <table id="show_date" class="display" cellspacing="0" width="100%">
			 
        <thead>
            <tr>
			    <th>期別</th>
				<th>部落</th>
				<th>單位</th>
				<th>月份</th>
				<th>使用人次</th>
				<th>使用人數</th>
			　	<th>使用時間(時)</th>
				<th>總流量(MB)</th>
				<th>上行流量(MB)</th>
				<th>下行流量(MB)</th>
				<th> 設備妥善率</th>
			</tr>
        </thead>

        <tbody>
	
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
						$sql="SELECT SUM(acctsessiontime),SUM(acctinputoctets),SUM(acctoutputoctets),SUM(acctstartdelay),SUM(acctstopdelay),acctstarttime  FROM radacct  where   realm<>'itw' and nasipaddress IN ('$string') and acctstarttime like '%$year-$month[$ii]%' ";
						$result = execute_sql($database_name, $sql, $link);
						//echo $sql;
						//echo '<br>';
						//
						$sql1="SELECT radacctid FROM radacct where realm<>'itw'and nasipaddress IN ('$string') and acctstarttime like '%$year-$month[$ii]%'";
						$result1 = execute_sql($database_name, $sql1, $link);
						$number1 = mysql_num_rows($result1);
					  // echo $sql1;
					  // echo '<br>';
						///
						$sql2="SELECT callingstationid   FROM radacct where realm<>'itw'and nasipaddress IN ('$string') and acctstarttime like '%$year-$month[$ii]%'  GROUP BY callingstationid ";
						$result2 = execute_sql($database_name, $sql2, $link);
						$number2 = mysql_num_rows($result2);
						
						while ($row = mysql_fetch_assoc($result) )
						{
										$acctsessiontime=$row['SUM(acctsessiontime)']/(60);
										$acctinputoctets=$row['SUM(acctinputoctets)']/(1024*1000);
										$acctoutputoctets=$row['SUM(acctoutputoctets)']/(1024*1000);
										$new_SUM=($acctoutputoctets+$acctinputoctets);
										$acctsessiontime=  number_format($acctsessiontime);
										$acctinputoctets=  number_format($acctinputoctets);
										$acctoutputoctets= number_format($acctoutputoctets);
										$new_SUM= number_format($new_SUM);
										
										
										?>
										<td><?=$label_tribe;?></td>
										<td><?=$tribe_name;?></td>
										<td>愛部落</td>
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
						$sql="SELECT SUM(acctsessiontime),SUM(acctinputoctets),SUM(acctoutputoctets),SUM(acctstartdelay),SUM(acctstopdelay),acctstarttime  FROM radacct  where   realm='itw'  and nasipaddress IN ('$string') and acctstarttime like '%$year-$month[$ii]%' ";
						$result = execute_sql($database_name, $sql, $link);
						//echo $sql;
						//echo '<br>';
						//
						$sql1="SELECT radacctid FROM radacct where realm='itw' and nasipaddress IN ('$string') and acctstarttime like '%$year-$month[$ii]%'";
						$result1 = execute_sql($database_name, $sql1, $link);
						$number1 = mysql_num_rows($result1);
					  // echo $sql1;
					  // echo '<br>';
						///
						$sql2="SELECT callingstationid   FROM radacct where realm='itw' and nasipaddress IN ('$string') and acctstarttime like '%$year-$month[$ii]%'  GROUP BY callingstationid ";
						$result2 = execute_sql($database_name, $sql2, $link);
						$number2 = mysql_num_rows($result2);
						
						while ($row = mysql_fetch_assoc($result) )
						{
										$acctsessiontime=$row['SUM(acctsessiontime)']/(60);
										$acctinputoctets=$row['SUM(acctinputoctets)']/(1024*1000);
										$acctoutputoctets=$row['SUM(acctoutputoctets)']/(1024*1000);
										$new_SUM=($acctoutputoctets+$acctinputoctets);
										$acctsessiontime=  number_format($acctsessiontime);
										$acctinputoctets=  number_format($acctinputoctets);
										$acctoutputoctets= number_format($acctoutputoctets);
										$new_SUM= number_format($new_SUM);
										
										
										?>
										<td><?=$label_tribe;?></td>
										<td><?=$tribe_name;?></td>
										<td>愛台灣</td>
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
				
        </tbody>
    </table>
	<?php
			
			
			
		 }else{
			//echo  "A2";
			//exit(); 
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
				<th>期別</th>
				<th>部落</th>
				<th>單位</th>
				<th>月份</th>
				<th>使用人次</th>
				<th>使用人數</th>
			　	<th>使用時間(時)</th>
				<th>總流量(MB)</th>
				<th>上行流量(MB)</th>
				<th>下行流量(MB)</th>
				<th> 設備妥善率</th>
			</tr>
        </thead>
       
        <tbody>
	
            <?php
				if($realm =='itw')
				{
					$filename= '愛台灣';
				}else{
					$filename= '愛部落';
				}
				
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
						$sql2="SELECT callingstationid   FROM radacct where $key_string and nasipaddress IN ('$string') and acctstarttime like '%$year-$month[$ii]%'  GROUP BY callingstationid ";
						$result2 = execute_sql($database_name, $sql2, $link);
						$number2 = mysql_num_rows($result2);
						
						while ($row = mysql_fetch_assoc($result) )
						{
										$acctsessiontime=$row['SUM(acctsessiontime)']/(60);
										$acctinputoctets=$row['SUM(acctinputoctets)']/(1024*1000);
										$acctoutputoctets=$row['SUM(acctoutputoctets)']/(1024*1000);
										$new_SUM=($acctoutputoctets+$acctinputoctets);
										$acctsessiontime=  number_format($acctsessiontime);
										$acctinputoctets=  number_format($acctinputoctets);
										$acctoutputoctets= number_format($acctoutputoctets);
										$new_SUM= number_format($new_SUM);
										
										
										?>
										<td><?=$label_tribe;?></td>
										<td><?=$tribe_name;?></td>
										<td><?=$filename;?></td>
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
				
        </tbody>
    </table>
	
			<?php	
			 
		 }
	 
	
	}else{
		
		
		
		echo '尚未選擇條件';
	}
		

	?>	
		

		</div>
	</div>
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
				
				"bFilter": false, //开关，是否启用客户端过滤器
				"bPaginate": false, //开关，是否显示分页器
				"bInfo": true, //开关，是否显示表格的一些信息，允许或者禁止表信息的显示，默认为 true，显示信息。
			 dom: 'Bfrtip',	 buttons: 
			 [
				{ extend: 'excelHtml5', text: '匯出服務效益分析總表' ,title: '<?= date("Y-m-d");?><?=$filename;?>  <?=$tribe_name;?>:服務效益分析年報表' },
				{ extend: 'print', text: '列印 <style>td,th {border:#000 1px solid;}</style>',title: '<?= date("Y-m-d");?> <?=$filename;?> 服務效益分析年報表' },	
				//'pageLength',				
			],
	   };
  $("#show_date").dataTable(opt);
  });
</script>

<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</div>
</body>
</html>
