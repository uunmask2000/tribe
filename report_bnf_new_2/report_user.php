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

		<h1 class="report">使用者資訊查詢報表</h1>

	<?php
		include_once("../SQL/dbtools_ps.php");
		require_once("dbtools.inc.php");
		$link = create_connection();
		$link2 = create_connection2();
	?>

	
		<div class="report_bar">
			<form action="<?php echo $_SERVER['PHP_SELF'];?>?mode=query" method="post">
		
			<select name="A" onchange="this.form.submit();">
			
			<option value=" " selected  >請選擇期別</option> 
			　<option value="2" <?php if($_POST['A']=='2'){echo 'selected';}else{};	?> >第二期</option>
			　<option value="3" <?php if($_POST['A']=='3'){echo 'selected';}else{};	?> >第三期</option>
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
			
			<select  name="year" size="1" onchange="this.form.submit();" >
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
			
					<select  name="month" size="1" onchange="this.form.submit();">
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

			
            <select  name="ass_ap_ip" size="1"   onchange="this.form.submit();">
			<option  disabled selected>請選擇設備</option>
				<?php
				$key2 = $_POST['tribe'];
				$sql_ap="SELECT * FROM `ass_ap` WHERE ass_ap_tribe='$key2 ' ";
				$result_ap= execute_sql($database_name2, $sql_ap, $link2);
				while ($row_ap= mysql_fetch_assoc($result_ap)  )
				{

			?>
			<option value="<?=$row_ap['ass_ap_id'];?>"  <?php if($_POST['ass_ap_ip']==$row_ap['ass_ap_id']){  echo 'selected';  }?> ><?=$row_ap['ass_ap_name'];?></option>
			<?php
			}					
			?>
			</select>

			
			<select name="realm" size="1" onchange="this.form.submit();">
			<option  disabled selected>請選擇單位</option>
			<option value="all" <?php if($_POST['realm']=='all'){echo 'selected'; }?> ><?php  echo  '全部'; echo '</option>';	?>
			<option value="itr" <?php if($_POST['realm']=='itr'){echo 'selected'; }?> ><?php  echo  '愛部落'; echo '</option>';	?>
			<option value="itw" <?php if($_POST['realm']=='itw'){echo 'selected'; }?> ><?php  echo  '愛台灣'; echo '</option>';	?>
			</select>

			<input type="submit" value="檢視報表"/>
			</form>
		</div>
		
		<div class="report">
<?php
   if($_GET['mode']=='query')
	{
		$realm = $_POST['realm'];
		$year = $_POST['year'];
		$month = $_POST['month'];
		$label_tribe = $_POST['A'];
		$tribe = $_POST['tribe'];
		$ass_ap_id =  $_POST['ass_ap_ip'];
			
			if($label_tribe==NULL)
			{
			echo '期別空白';
			//exit();
			$msger = 1 ;
			}	
			if($tribe==NULL)
			{
			echo '尚未選擇部落';
			//exit();
			$msger = 1 ;
			}
			if($year==NULL)
			{
			echo '年份空白';
			//exit();
			$msger = 1 ;
			}			
			if($month==NULL)
			{
			echo '月份空白';
			//exit();
			$msger = 1 ;
			}
			
			
			if($ass_ap_id==NULL or $ass_ap_id=="")
			{

			//echo 'A';
			echo '尚未選擇設備';
			
			//exit();
			$msger = 1 ;
			}
			if($realm==NULL)
			{

			//echo 'A';
			echo '尚未選擇單位';
			//exit();
			$msger = 1 ;
			}

	if($msger ==1 )
	{
		echo '尚未選擇';
	}		
	 else{	 
			if($realm=='all')
		 {
			// echo 'A1';
			 
			
				
				//$key_rem = "愛部落";
				

				?>		
				<table id="show_date" class="display" cellspacing="0" width="100%">
				<thead>

				<tr>
				<th>期別</th>
				<th>縣市</th>
				<th>地區</th>

				<th>部落</th>
				<th>單位</th>
				<th>設備名稱</th>
				<th style="word-break:break-all;">使用者帳戶</th>
				<th>配發IP</th>
				<th>使用開始時間</th>
				<th>使用結束時間</th>
				</tr>
				</thead>
				<tbody>
				<?php
						$key_string = "realm<>'itw'";
						$time_string = $year.'-'.$month;	
						//$ass_ap_id
						$sql_ap_1="SELECT * FROM ass_ap WHERE ass_ap_id='$ass_ap_id ' ";
						//echo  $sql_ap_1 ;
						$result_ap_1= execute_sql($database_name2, $sql_ap_1, $link2);
						while ($row_ap_1= mysql_fetch_assoc($result_ap_1)  )
						{
						$key_ip = $row_ap_1['ass_ap_ip'];
						$ass_ap_city = $row_ap_1['ass_ap_city'];
						$ass_ap_twon = $row_ap_1['ass_ap_twon'];
						$ass_ap_tribe = $row_ap_1['ass_ap_tribe'];
						$ass_ap_name = $row_ap_1['ass_ap_name'];
						$sql2="SELECT * FROM radacct  where nasipaddress IN ('$key_ip')  and  $key_string  and acctstarttime like '%$time_string%' ";
						$result2 = execute_sql($database_name, $sql2, $link);
						while ($row2= mysql_fetch_assoc($result2) )
						{				
						echo '<tr>';
						echo  '<td>'.$label_tribe.'</td>';			
						echo  '<td>';
						$sql_0="SELECT * FROM city_array WHERE id='$ass_ap_city ' ";
						$result_0= execute_sql($database_name2, $sql_0, $link2);
						while ($row_0= mysql_fetch_assoc($result_0)  )
						{
						echo   $row_0['city_name'];
						}

						echo '</td>';


						echo  '<td>';
						$sql_0="SELECT * FROM city_township WHERE township_id='$ass_ap_twon ' ";
						$result_0= execute_sql($database_name2, $sql_0, $link2);
						while ($row_0= mysql_fetch_assoc($result_0)  )
						{
						echo   $row_0['township_name'];
						}

						echo '</td>';

						echo  '<td>';
						$sql_0="SELECT * FROM tribe WHERE tribe_id='$ass_ap_tribe ' ";
						$result_0= execute_sql($database_name2, $sql_0, $link2);
						while ($row_0= mysql_fetch_assoc($result_0)  )
						{
						echo   $row_0['tribe_name'];
						}
						echo '<td>'.'愛部落'.'</td>'; 
						echo '</td>';					
						echo  '<td>'.$ass_ap_name.'</td>';					
						echo  '<td>'.trim($row2['callingstationid']).'</td>';
						echo  '<td>'.$row2['framedipaddress'].'</td>';
						echo  '<td>'.$row2['acctstarttime'].'</td>';
						echo  '<td>'.$row2['acctstoptime'].'</td>';							
						echo '</tr>';	

						}
						}
                ////////////////
						$key_string = "realm='itw'";
						$time_string = $year.'-'.$month;	
						//$ass_ap_id
						$sql_ap_1="SELECT * FROM ass_ap WHERE ass_ap_id='$ass_ap_id ' ";
						//echo  $sql_ap_1 ;
						$result_ap_1= execute_sql($database_name2, $sql_ap_1, $link2);
						while ($row_ap_1= mysql_fetch_assoc($result_ap_1)  )
						{
						$key_ip = $row_ap_1['ass_ap_ip'];
						$ass_ap_city = $row_ap_1['ass_ap_city'];
						$ass_ap_twon = $row_ap_1['ass_ap_twon'];
						$ass_ap_tribe = $row_ap_1['ass_ap_tribe'];
						$ass_ap_name = $row_ap_1['ass_ap_name'];
						$sql2="SELECT * FROM radacct  where nasipaddress IN ('$key_ip')  and  $key_string  and acctstarttime like '%$time_string%' ";
						$result2 = execute_sql($database_name, $sql2, $link);
						while ($row2= mysql_fetch_assoc($result2) )
						{				
						echo '<tr>';
						echo  '<td>'.$label_tribe.'</td>';			
						echo  '<td>';
						$sql_0="SELECT * FROM city_array WHERE id='$ass_ap_city ' ";
						$result_0= execute_sql($database_name2, $sql_0, $link2);
						while ($row_0= mysql_fetch_assoc($result_0)  )
						{
						echo   $row_0['city_name'];
						}

						echo '</td>';


						echo  '<td>';
						$sql_0="SELECT * FROM city_township WHERE township_id='$ass_ap_twon ' ";
						$result_0= execute_sql($database_name2, $sql_0, $link2);
						while ($row_0= mysql_fetch_assoc($result_0)  )
						{
						echo   $row_0['township_name'];
						}

						echo '</td>';

						echo  '<td>';
						$sql_0="SELECT * FROM tribe WHERE tribe_id='$ass_ap_tribe ' ";
						$result_0= execute_sql($database_name2, $sql_0, $link2);
						while ($row_0= mysql_fetch_assoc($result_0)  )
						{
						echo   $row_0['tribe_name'];
						}
						echo '<td>'.'愛台灣'.'</td>'; 
						echo '</td>';					
						echo  '<td>'.$ass_ap_name.'</td>';					
						echo  '<td>'.trim($row2['callingstationid']).'</td>';
						echo  '<td>'.$row2['framedipaddress'].'</td>';
						echo  '<td>'.$row2['acctstarttime'].'</td>';
						echo  '<td>'.$row2['acctstoptime'].'</td>';							
						echo '</tr>';	

						}
						}



				?>


				</tbody>
				</table>

				<?php 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
		     //exit();
		 }else{
			 
				//echo 'A2';
				if($realm=='itw')
				{
				$key_string = "realm='itw'";
				$key_rem = "愛台灣";
				}else{
				$key_string = "realm<>'itw'";
				$key_rem = "愛部落";
				}

				?>		
				<table id="show_date" class="display" cellspacing="0" width="100%">
				<thead>

				<tr>
				<th>期別</th>
				<th>縣市</th>
				<th>地區</th>

				<th>部落</th>
				<th>單位</th>
				<th>設備名稱</th>
				<th style="word-break:break-all;">使用者帳戶</th>
				<th>配發IP</th>
				<th>使用開始時間</th>
				<th>使用結束時間</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$time_string = $year.'-'.$month;	
				//$ass_ap_id
				$sql_ap_1="SELECT * FROM ass_ap WHERE ass_ap_id='$ass_ap_id ' ";
				//echo  $sql_ap_1 ;
				$result_ap_1= execute_sql($database_name2, $sql_ap_1, $link2);
				while ($row_ap_1= mysql_fetch_assoc($result_ap_1)  )
				{
				$key_ip = $row_ap_1['ass_ap_ip'];
				$ass_ap_city = $row_ap_1['ass_ap_city'];
				$ass_ap_twon = $row_ap_1['ass_ap_twon'];
				$ass_ap_tribe = $row_ap_1['ass_ap_tribe'];
				$ass_ap_name = $row_ap_1['ass_ap_name'];
				$sql2="SELECT * FROM radacct  where nasipaddress IN ('$key_ip')  and  $key_string  and acctstarttime like '%$time_string%' ";
				$result2 = execute_sql($database_name, $sql2, $link);
				while ($row2= mysql_fetch_assoc($result2) )
				{				
				echo '<tr>';
				echo  '<td>'.$label_tribe.'</td>';			
				/*
				$sql000="SELECT ass_ap_name,tribe_name,township_name,city_name,ass_ap_ip FROM (SELECT * FROM ass_ap) AS  ass_ap
				INNER JOIN (SELECT * FROM tribe) AS tribe ON   ass_ap.ass_ap_tribe=tribe.tribe_id
				INNER JOIN (SELECT * FROM city_township) AS city_township ON   tribe.township_id= city_township.township_id
				INNER JOIN (SELECT * FROM city_array) AS city_array ON   tribe.city_id= city_array.id 
				where  ass_ap_ip='$key_ip'	";
				$result000= execute_sql($database_name2, $sql000, $link2);
				while ($row000= mysql_fetch_assoc($result000)  )
				{
				echo  '<td>'.$row000['city_name'].'</td>';
				echo  '<td>'.$row000['tribe_name'].'</td>';
				echo  '<td>'.$row000['ass_ap_name'].'</td>';
				}
				*/
				echo  '<td>';
				$sql_0="SELECT * FROM city_array WHERE id='$ass_ap_city ' ";
				$result_0= execute_sql($database_name2, $sql_0, $link2);
				while ($row_0= mysql_fetch_assoc($result_0)  )
				{
				echo   $row_0['city_name'];
				}

				echo '</td>';


				echo  '<td>';
				$sql_0="SELECT * FROM city_township WHERE township_id='$ass_ap_twon ' ";
				$result_0= execute_sql($database_name2, $sql_0, $link2);
				while ($row_0= mysql_fetch_assoc($result_0)  )
				{
				echo   $row_0['township_name'];
				}

				echo '</td>';

				echo  '<td>';
				$sql_0="SELECT * FROM tribe WHERE tribe_id='$ass_ap_tribe ' ";
				$result_0= execute_sql($database_name2, $sql_0, $link2);
				while ($row_0= mysql_fetch_assoc($result_0)  )
				{
				echo   $row_0['tribe_name'];
				}
				echo '<td>'.$key_rem.'</td>'; 
				echo '</td>';					
				echo  '<td>'.$ass_ap_name.'</td>';					
				echo  '<td>'.trim($row2['callingstationid']).'</td>';
				echo  '<td>'.$row2['framedipaddress'].'</td>';
				echo  '<td>'.$row2['acctstarttime'].'</td>';
				echo  '<td>'.$row2['acctstoptime'].'</td>';							
				echo '</tr>';	

				}
				}



				?>


				</tbody>
				</table>

				<?php 


			}
	
	
	  
		   
	   }
	   
	
	
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
				//lengthMenu: [
				//[ 10, 25, 50, -1 ],
				//[ '10 筆', '25 筆', '50 筆', '全部' ]
				//],
				"bFilter": false, //开关，是否启用客户端过滤器
				"bPaginate": false, //开关，是否显示分页器
				"bInfo": true, //开关，是否显示表格的一些信息，允许或者禁止表信息的显示，默认为 true，显示信息。
			 dom: 'Bfrtip',	 buttons: 
			 [
				{ extend: 'excelHtml5', text: '匯出<?=$key_rem;?>使用者資訊查詢報表' ,title: '<?= date("Y-m-d");?> <?=$key_rem;?> <?=$tribe_name;?>:使用者資訊查詢報表' },
				{ extend: 'print', text: '列印 <style>td,th {border:#000 1px solid;}</style>',title: '<?= date("Y-m-d");?>使用者資訊查詢報表' },	
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
