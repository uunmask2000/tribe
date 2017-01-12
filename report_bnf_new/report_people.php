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

		<h1 class="report">使用人次統計分析明細表</h1>
       
		<?php
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
		    $A = $_POST['A'];
			$tribe = $_POST['tribe'];
			$year = $_POST['year'];
			$month = $_POST['month'];
			$realm = $_POST['realm'];
				if(empty($A))
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
				if(empty($month))
				{
				echo '月份空白';
				}
				if(empty($realm))
				{
				echo '單位';
				exit();
				}			

		 if($realm=="all")
		 {
			
				
				$key_sql= "realm<>'itw'";
				$realm_key = "愛部落";
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
											<?php
			$sql2_2="SELECT * FROM `ass_ap`  where  ass_ap_tribe='$tribe'   ";
			$result2_2 = execute_sql($database_name2, $sql2_2, $link2);
			//echo $sql2_2;
			while ($row2_2= mysql_fetch_assoc($result2_2) )
			{
				$ass_ap_city =$row2_2['ass_ap_city'];
				$ass_ap_twon =$row2_2['ass_ap_twon'];
				$ass_ap_tribe =$row2_2['ass_ap_tribe'];
				$ass_ap_ip =$row2_2['ass_ap_ip'];
				$ass_ap_name =$row2_2['ass_ap_name'];

$sql1="SELECT radacctid FROM radacct where  nasipaddress IN ('$ass_ap_ip') and $key_sql and acctstarttime like '%$year-$month%'";
$result1 = execute_sql($database_name, $sql1, $link);
$number1 = mysql_num_rows($result1);
//echo  $sql1;
///
$sql2="SELECT callingstationid   FROM radacct where  nasipaddress IN ('$ass_ap_ip')  and $key_sql and acctstarttime like '%$year-$month%'  GROUP BY callingstationid ";
$result2 = execute_sql($database_name, $sql2, $link);
$number2 = mysql_num_rows($result2);
			
			  echo '<tr>';	
			    ?>
				<td><?=$A ;?></td>
				<td><?=$year.'-'.$month ;?></td>
				
				<td>
				<?php
				$sql0="SELECT * FROM `city_array`  where  id='$ass_ap_city'   ";
				$result0 = execute_sql($database_name2, $sql0, $link2);
				while ($row0= mysql_fetch_assoc($result0) )
				{
                    echo  $row0['city_name'];
				}	
				?>
				</td>
				<td>
				<?php
				$sql0="SELECT * FROM `city_township`  where  township_id='$ass_ap_twon'   ";
				$result0 = execute_sql($database_name2, $sql0, $link2);
				while ($row0= mysql_fetch_assoc($result0) )
				{
                    echo  $row0['township_name'];
				}	
				?>
				</td>
					<td>
				<?php
				$sql0="SELECT * FROM tribe  where  tribe_id='$ass_ap_tribe'   ";
				//echo  $sql0;
				$result0 = execute_sql($database_name2, $sql0, $link2);
				while ($row0= mysql_fetch_assoc($result0) )
				{
                    echo  $row0['tribe_name'];
				}	
				?>
				</td>
			
				<td><?=$realm_key ;?></td>
				<td><?=$ass_ap_name ;?></td>
				<td><?=$number1 ;?></td>
				<td><?=$number2 ;?></td>
			
				<?php
                                 
              echo '</tr>';	
			  
			}
							
							
							
							?>
							
	<?php
	$key_sql= "realm='itw'";
				$realm_key = "愛台灣";
			$sql2_2="SELECT * FROM `ass_ap`  where  ass_ap_tribe='$tribe'   ";
			$result2_2 = execute_sql($database_name2, $sql2_2, $link2);
			//echo $sql2_2;
			while ($row2_2= mysql_fetch_assoc($result2_2) )
			{
				$ass_ap_city =$row2_2['ass_ap_city'];
				$ass_ap_twon =$row2_2['ass_ap_twon'];
				$ass_ap_tribe =$row2_2['ass_ap_tribe'];
				$ass_ap_ip =$row2_2['ass_ap_ip'];
				$ass_ap_name =$row2_2['ass_ap_name'];

$sql1="SELECT radacctid FROM radacct where  nasipaddress IN ('$ass_ap_ip') and $key_sql and acctstarttime like '%$year-$month%'";
$result1 = execute_sql($database_name, $sql1, $link);
$number1 = mysql_num_rows($result1);
//echo  $sql1;
///
$sql2="SELECT callingstationid   FROM radacct where  nasipaddress IN ('$ass_ap_ip')  and $key_sql and acctstarttime like '%$year-$month%'  GROUP BY callingstationid ";
$result2 = execute_sql($database_name, $sql2, $link);
$number2 = mysql_num_rows($result2);
			
			  echo '<tr>';	
			    ?>
				<td><?=$A ;?></td>
				<td><?=$year.'-'.$month ;?></td>
				
				<td>
				<?php
				$sql0="SELECT * FROM `city_array`  where  id='$ass_ap_city'   ";
				$result0 = execute_sql($database_name2, $sql0, $link2);
				while ($row0= mysql_fetch_assoc($result0) )
				{
                    echo  $row0['city_name'];
				}	
				?>
				</td>
				<td>
				<?php
				$sql0="SELECT * FROM `city_township`  where  township_id='$ass_ap_twon'   ";
				$result0 = execute_sql($database_name2, $sql0, $link2);
				while ($row0= mysql_fetch_assoc($result0) )
				{
                    echo  $row0['township_name'];
				}	
				?>
				</td>
					<td>
				<?php
				$sql0="SELECT * FROM tribe  where  tribe_id='$ass_ap_tribe'   ";
				//echo  $sql0;
				$result0 = execute_sql($database_name2, $sql0, $link2);
				while ($row0= mysql_fetch_assoc($result0) )
				{
                    echo  $row0['tribe_name'];
				}	
				?>
				</td>
			
				<td><?=$realm_key ;?></td>
				<td><?=$ass_ap_name ;?></td>
				<td><?=$number1 ;?></td>
				<td><?=$number2 ;?></td>
			
				<?php
                                 
              echo '</tr>';	
			  
			}
							
							
							
							?>						
					</tbody>
				</table>









			 <?php
			 
			 

			
		 }else{
				if($realm=='itw')
				{
				$key_sql= "realm='itw'";
				$realm_key = "愛台灣";
				}else{
				$key_sql= "realm<>'itw'";
				$realm_key = "愛部落";
				}



				?>
			<div class="report">
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
			$sql2_2="SELECT * FROM `ass_ap`  where  ass_ap_tribe='$tribe'   ";
			$result2_2 = execute_sql($database_name2, $sql2_2, $link2);
			//echo $sql2_2;
			while ($row2_2= mysql_fetch_assoc($result2_2) )
			{
				$ass_ap_city =$row2_2['ass_ap_city'];
				$ass_ap_twon =$row2_2['ass_ap_twon'];
				$ass_ap_tribe =$row2_2['ass_ap_tribe'];
				$ass_ap_ip =$row2_2['ass_ap_ip'];
				$ass_ap_name =$row2_2['ass_ap_name'];

$sql1="SELECT radacctid FROM radacct where  nasipaddress IN ('$ass_ap_ip') and $key_sql and acctstarttime like '%$year-$month%'";
$result1 = execute_sql($database_name, $sql1, $link);
$number1 = mysql_num_rows($result1);
//echo  $sql1;
///
$sql2="SELECT callingstationid   FROM radacct where  nasipaddress IN ('$ass_ap_ip')  and $key_sql and acctstarttime like '%$year-$month%'  GROUP BY callingstationid ";
$result2 = execute_sql($database_name, $sql2, $link);
$number2 = mysql_num_rows($result2);
			
			  echo '<tr>';	
			    ?>
				<td><?=$A ;?></td>
				<td><?=$year.'-'.$month ;?></td>
				
				<td>
				<?php
				$sql0="SELECT * FROM `city_array`  where  id='$ass_ap_city'   ";
				$result0 = execute_sql($database_name2, $sql0, $link2);
				while ($row0= mysql_fetch_assoc($result0) )
				{
                    echo  $row0['city_name'];
				}	
				?>
				</td>
				<td>
				<?php
				$sql0="SELECT * FROM `city_township`  where  township_id='$ass_ap_twon'   ";
				$result0 = execute_sql($database_name2, $sql0, $link2);
				while ($row0= mysql_fetch_assoc($result0) )
				{
                    echo  $row0['township_name'];
				}	
				?>
				</td>
					<td>
				<?php
				$sql0="SELECT * FROM tribe  where  tribe_id='$ass_ap_tribe'   ";
				//echo  $sql0;
				$result0 = execute_sql($database_name2, $sql0, $link2);
				while ($row0= mysql_fetch_assoc($result0) )
				{
                    echo  $row0['tribe_name'];
				}	
				?>
				</td>
			
				<td><?=$realm_key ;?></td>
				<td><?=$ass_ap_name ;?></td>
				<td><?=$number1 ;?></td>
				<td><?=$number2 ;?></td>
			
				<?php
                                 
              echo '</tr>';	
			  
			}
							
							
							
							?>
			 <?php
			 
			 
		 }
		 
		 
		 
		 ?>
				</tbody>
			</table>
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
				{ extend: 'excelHtml5', text: '匯出使用人次統計分析明細表' ,title: '<?= date("Y-m-d");?> <?=$filename;?>   <?=$tribe_name;?>:使用人次統計分析明細表' },
				{ extend: 'print', text: '列印 <style>td,th {border:#000 1px solid;}</style>',title: '<?= date("Y-m-d");?> <?=$filename;?>  使用人次統計分析明細表' },	
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
