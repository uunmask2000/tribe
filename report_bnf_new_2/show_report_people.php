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
		
		<h1 class="report">使用人次統計分析明細表</h1>

	<?php
	require_once("dbtools.inc.php");
	$link = create_connection();
	$link2 = create_connection2();

	?>

		<div class="report_bar">
		<form action="<?php echo $_SERVER['PHP_SELF'];?>?mode=query" method="post">
	<select id="list" name="A" onchange="this.form.submit();">
<option value="NO" selected disabled="disabled">請選擇期別</option>	
<?php
///echo '1231465';
$sql_prj = "SELECT Project_name,Project_number FROM Project ";
$result_prj = execute_sql($database_name2, $sql_prj, $link2);
while ($row_prj = mysql_fetch_assoc($result_prj))
{
echo $row_prj['Project_name'] ;
?>
<option value="<?=$row_prj['Project_number'] ;?>" <?php if($_POST['A']==$row_prj['Project_number']){echo 'selected'; }?>><?=$row_prj['Project_name'] ;?></option>
<?php
}
/*
<option value="2" <?php if($_POST['A']==2){echo 'selected'; }?>>2期</option>
<option value="3" <?php if($_POST['A']==3){echo 'selected'; }?>>3期</option>	
*/

?>

					
</select>

		
		<select  name="tribe" size="1"   onchange="this.form.submit();">
					<option  disabled selected>請選擇部落</option>
					<?php
					$key = $_POST['A'];
					$sql_tribe="SELECT * FROM tribe  where tribe_label='$key' ORDER BY `tribe`.`tribe_name` ASC";
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
					
					
					<select  name="month" size="1" >
					<option  disabled selected>請選擇月份</option>

						<option value="01" <?php if($_POST['month']=='01'){echo 'selected'; }?>>01月</option>
						<option value="02" <?php if($_POST['month']=='02'){echo 'selected'; }?>>02月</option>
						<option value="03" <?php if($_POST['month']=='03'){echo 'selected'; }?>>03月</option>
						<option value="04" <?php if($_POST['month']=='04'){echo 'selected'; }?>>04月</option>
						<option value="05" <?php if($_POST['month']=='05'){echo 'selected'; }?>>05月</option>
						<option value="06" <?php if($_POST['month']=='06'){echo 'selected'; }?>>06月</option>
						<option value="07" <?php if($_POST['month']=='07'){echo 'selected'; }?>>07月</option>
						<option value="08" <?php if($_POST['month']=='08'){echo 'selected'; }?>>08月</option>
						<option value="09" <?php if($_POST['month']=='09'){echo 'selected'; }?>>09月</option>
						<option value="10" <?php if($_POST['month']=='10'){echo 'selected'; }?>>10月</option>
						<option value="11" <?php if($_POST['month']=='11'){echo 'selected'; }?>>11月</option>
						<option value="12" <?php if($_POST['month']=='12'){echo 'selected'; }?>>12月</option>

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
	// Period   tribe  year realm
	$Period =$_POST['A'] ;
	$tribe_sid =$_POST['tribe'] ;
	$year =$_POST['year'] ;
	$month =$_POST['month'] ;
	$realm =$_POST['realm'] ;
				if($Period==NULL or $Period==' ' )
				{
				$msger = 1 ;
				/*
				?>
				<script>
				alert("請選擇期別!");history.back();
				</script>			
				<?php
				//exit();
				*/
				}	
				if($tribe_sid==NULL or $tribe_sid==' ' )
				{
				$msger = 1 ;
				}
				if($year==NULL or $year==' ' )
				{
				$msger = 1 ;
				}
				if($month==NULL or $month==' ' )
				{
				$msger = 1 ;
				}
				if($realm==NULL or $realm==' ' )
				{
				$msger = 1 ;
				}

				if($msger =='1')
				{
				//echo  '有條件未選擇';
				}else{
					?>
					<table id="show_date" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
						<th width="60">期別</th>
						<th width="60">日期</th>
						<th>縣市</th>
						<th>地區</th>
						<th>部落</th>
						<th>單位</th>

						<th>設備名稱</th>
						<th>使用人次</th>
						<th>使用人數</th>
						</tr>
					</thead>

					<tbody>
					
					<?php
					
					
					
							if($realm =='all')
							{
								$Time_interval = $year.'-'.$month; 
									$sql2="SELECT * FROM monthly_report_itr WHERE tribe_sid='$tribe_sid' and Time_interval='$Time_interval'";
									$result2 = execute_sql($database_name, $sql2, $link);
									while ($row = mysql_fetch_assoc($result2) )
									{
									$Period = $row['Period'];
									$County = $row['County'];
									$area = $row['area'];
									$tribe = $row['tribe'];
									$Use_of_people = $row['Use_of_people'];
									$Number_of_users = $row['Number_of_users'];
									$aroused_general_interest = $row['aroused_general_interest'];
									?>
									<tr>
									<th width="60"><?=$Period ;?></th>
									<th width="60"><?=$Time_interval ;?></th>
									<th><?=$County ;?></th>
									<th><?=$area ;?></th>
									<th><?=$tribe ;?></th>
									<th>愛部落</th>
									<th><?=$aroused_general_interest ;?></th>
									<th><?=$Use_of_people ;?></th>
									<th><?=$Number_of_users ;?></th>
									</tr>
									<?php
									}
									
									$Time_interval = $year.'-'.$month; 
									$sql2="SELECT * FROM monthly_report_itw WHERE tribe_sid='$tribe_sid' and Time_interval='$Time_interval'";
									$result2 = execute_sql($database_name, $sql2, $link);
									while ($row = mysql_fetch_assoc($result2) )
									{
									$Period = $row['Period'];
									$County = $row['County'];
									$area = $row['area'];
									$tribe = $row['tribe'];
									$Use_of_people = $row['Use_of_people'];
									$Number_of_users = $row['Number_of_users'];
									$aroused_general_interest = $row['aroused_general_interest'];
									?>
									<tr>
									<th width="60"><?=$Period ;?></th>
									<th width="60"><?=$Time_interval ;?></th>
									<th><?=$County ;?></th>
									<th><?=$area ;?></th>
									<th><?=$tribe ;?></th>
									<th>愛台灣</th>
									<th><?=$aroused_general_interest ;?></th>
									<th><?=$Use_of_people ;?></th>
									<th><?=$Number_of_users ;?></th>
									</tr>
									<?php
									}


							}else  	if($realm =='itr')
							{
								
								
									$Time_interval = $year.'-'.$month; 
									$sql2="SELECT * FROM monthly_report_itr WHERE tribe_sid='$tribe_sid' and Time_interval='$Time_interval'";
									$result2 = execute_sql($database_name, $sql2, $link);
									while ($row = mysql_fetch_assoc($result2) )
									{
									$Period = $row['Period'];
									$County = $row['County'];
									$area = $row['area'];
									$tribe = $row['tribe'];
									$Use_of_people = $row['Use_of_people'];
									$Number_of_users = $row['Number_of_users'];
									$aroused_general_interest = $row['aroused_general_interest'];
									?>
									<tr>
									<th width="60"><?=$Period ;?></th>
									<th width="60"><?=$Time_interval ;?></th>
									<th><?=$County ;?></th>
									<th><?=$area ;?></th>
									<th><?=$tribe ;?></th>
									<th>愛部落</th>
									<th><?=$aroused_general_interest ;?></th>
									<th><?=$Use_of_people ;?></th>
									<th><?=$Number_of_users ;?></th>
									</tr>
									<?php
									}
								

							}else  	if($realm =='itw')
							{
								$Time_interval = $year.'-'.$month; 
								$sql2="SELECT * FROM monthly_report_itw WHERE tribe_sid='$tribe_sid' and Time_interval='$Time_interval'";
								$result2 = execute_sql($database_name, $sql2, $link);
								while ($row = mysql_fetch_assoc($result2) )
								{
								$Period = $row['Period'];
								$County = $row['County'];
								$area = $row['area'];
								$tribe = $row['tribe'];
								$Use_of_people = $row['Use_of_people'];
								$Number_of_users = $row['Number_of_users'];
								$aroused_general_interest = $row['aroused_general_interest'];
								?>
								<tr>
								<th width="60"><?=$Period ;?></th>
								<th width="60"><?=$Time_interval ;?></th>
								<th><?=$County ;?></th>
								<th><?=$area ;?></th>
								<th><?=$tribe ;?></th>
								<th>愛台灣</th>
								<th><?=$aroused_general_interest ;?></th>
								<th><?=$Use_of_people ;?></th>
								<th><?=$Number_of_users ;?></th>
								</tr>
								<?php

									}

							}

					
					
					
					
					
					//echo  'OK';
					?>
					</tbody>
					</table>	
					<?php

				}		

	
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
				{ extend: 'excelHtml5', text: '匯出使用人次統計分析明細表' ,title: '<?= date("Y-m-d");?>:使用人次統計分析明細表' },
				{ extend: 'print', text: '列印 <style>td,th {border:#000 1px solid;}</style>',title: '<?= date("Y-m-d");?> <?=$filename;?> 使用人次統計分析明細表' },	
				//'pageLength',				
			],
	   };
  $("#show_date").dataTable(opt);
  });
</script>
</html>