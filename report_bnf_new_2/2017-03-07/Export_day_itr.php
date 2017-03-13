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
<!-----------LOADING套件------------->
	<link href="../blockUI/load.css" rel="stylesheet" type="text/css" />
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
<body onload="init()" >	
<form action="<?php echo $_SERVER['PHP_SELF'];?>?mode=query" method="post">
		<select name="A">
		<option value=" " selected  >請選擇期別</option> 

		<option value="2" <?php if($_POST['A']=='2'){echo 'selected';}else{};	?> >第二期</option>
		
		<option value="3" <?php if($_POST['A']=='3'){echo 'selected';}else{};	?> >第三期</option>			
		
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

			<option value="01" <?php if($_POST['month']=='01'){echo 'selected'; }?>>01</option>
			<option value="02" <?php if($_POST['month']=='02'){echo 'selected'; }?>>02</option>
			<option value="03" <?php if($_POST['month']=='03'){echo 'selected'; }?>>03</option>
			<option value="04" <?php if($_POST['month']=='04'){echo 'selected'; }?>>04</option>
			<option value="05" <?php if($_POST['month']=='05'){echo 'selected'; }?>>05</option>
			<option value="06" <?php if($_POST['month']=='06'){echo 'selected'; }?>>06</option>
			<option value="07" <?php if($_POST['month']=='07'){echo 'selected'; }?>>07</option>
			<option value="08" <?php if($_POST['month']=='08'){echo 'selected'; }?>>08</option>
			<option value="09" <?php if($_POST['month']=='09'){echo 'selected'; }?>>09</option>
			<option value="10" <?php if($_POST['month']=='10'){echo 'selected'; }?>>10</option>
			<option value="11" <?php if($_POST['month']=='11'){echo 'selected'; }?>>11</option>
			<option value="12" <?php if($_POST['month']=='12'){echo 'selected'; }?>>12</option>

			</select>
			
			
			<select  name="day" size="1" >
			<option  disabled selected>請選擇日份</option>
			<?php
			for($aa=1 ; $aa <= 31 ; $aa++)
			{
				$aa =sprintf("%02d", $aa);
				?>
				<option value="<?=$aa;?>" <?php if($_POST['day']==$aa){echo 'selected'; }?>><?=$aa;?></option>
				<?php
			}
			?>

			</select>
			
					

		<input type='submit' value='檢視報表' onclick="showloading()">
		</form>	
<?php
		require_once("dbtools.inc.php");
		$link = create_connection();
		$link2 = create_connection2();
		
		$Period =$_POST['A'] ;
		$year =$_POST['year'] ;
		$month =$_POST['month'] ;
		$day_2 =  $_POST['day'] ;
		//$day = $year.'-'.$month.'-'.$day_2.' ';
		
		
		$day = $year.'-'.$month.'-'.$day_2.' ';
		
?>		
<table class="table2excel"  id="table2excel">
		  <thead>
					<tr>
							<th>年/月/日</th>
							<th>期別</th>
							<th>縣市</th>
							<th>地區</th>
							<th>部落</th>							
							<th>總流量(MB)</th>
							<th>總上行流量(MB)</th>
							<th>總下行流量(MB)</th>
					</tr>
		  </thead>	
<!---<tbody style="display:none">-->
<tbody>
 <?php
$sql_sum="SELECT * FROM `sum_day_hr_itr` WHERE    Period ='$Period'  and `time_zone_h` like '%$day%' ORDER BY tribe asc,time_zone_h asc ";
$result_sum = execute_sql($database_name, $sql_sum, $link);
$jj=0;
while ($row_sum= mysql_fetch_assoc($result_sum) )
{						
$Period =$row_sum['Period'];
$County =$row_sum['County'];
$area =$row_sum['area'];
$tribe =$row_sum['tribe'];
$time_zone_h =  $row_sum['time_zone_h'];
//
$filter_number =$row_sum['filter_number'];
$device_number =$row_sum['device_number'];
//1個設備  200 , 分母為 1/ 200
$Denominator  = $device_number*200;
//

$Use_of_people_itw =$row_sum['Use_of_people'];
$Number_of_users_itw =$row_sum['Number_of_users'];
$Total_usage_time_itw = $row_sum['Total_usage_time'];
$Upload_traffic_itw =  $row_sum['Upload_traffic'];
$Download_traffic_itw = $row_sum['Download_traffic'];	

$array1[$jj][0] =$Period ;
$array1[$jj][1] =$County ;
$array1[$jj][2] =$area ;
$array1[$jj][3] =$tribe ;
$array1[$jj][4] =$Use_of_people_itw ;
$array1[$jj][5] =$Number_of_users_itw ;
$array1[$jj][6] =$Total_usage_time_itw ;
$array1[$jj][7] =$Upload_traffic_itw ;
$array1[$jj][8] =$Download_traffic_itw ;
$array1[$jj][9] =ceil($filter_number / $Denominator) ;
$array1[$jj][10] = $time_zone_h ;
$jj++;

}

//print_r($array1);
for($ii=0;$ii < $jj ;$ii++)
			{
				?>
						<tr>
							<td><?=$array1[$ii][10] ; ?></td>
							<td><?=$array1[$ii][0] ; ?></td>
							<td><?=$array1[$ii][1] ; ?></td>
							<td><?=$array1[$ii][2] ; ?></td>
							<td><?=$array1[$ii][3] ; ?></td>
							<td><?php 
								$SUM_2  = ($array2[$ii][7]+$array1[$ii][7]+$array2[$ii][8]+$array1[$ii][8])/(1024*1000) ;
								echo ceil($SUM_2) ;
							           ?></td>
							<td><?php
							$Upload_traffic=($array2[$ii][7]+$array1[$ii][7])/(1024*1000) ; 
							echo ceil($Upload_traffic) ;
							?></td>
							<td><?php
							$Download_traffic =($array2[$ii][8]+$array1[$ii][8])/(1024*1000) ;
							echo ceil($Download_traffic) ;
							 ?></td>

						</tr>	
				<?php			
				
			}	


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
				//lengthMenu: [
				//[ 10, 25, 50, -1 ],
				//[ '10 筆', '25 筆', '50 筆', '全部' ]
				//],
					"pageLength":" 50",
					"bFilter": false, //开关，是否启用客户端过滤器
					"bPaginate": false, //开关，是否显示分页器
					"bInfo": false, //开关，是否显示表格的一些信息，允许或者禁止表信息的显示，默认为 true，显示信息。
			 dom: 'Bfrtip',	 buttons: 
			 [
				{ extend: 'excelHtml5', text: '匯出服務效益愛部落日報表' ,title: '<?= date("Y-m-d");?>服務效益愛部落日報表' },
				//{ extend: 'print', text: '列印',title: '<?= date("Y-m-d");?>服務效益分析年報表' },	
				//'pageLength',				
			],
	   };
  $("#table2excel").dataTable(opt);
  });
</script>

		
</body>