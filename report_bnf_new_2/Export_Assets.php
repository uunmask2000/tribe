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

		<h1 class="report">部落資產總表</h1>
		
		<div class="report_bar">
			<form action="<?php echo $_SERVER['PHP_SELF'];?>?mode=query" method="post">
			<select name="A" >
			<option value=" " selected  >請選擇期別</option> 
			<option value="2" <?php if($_POST['A']=='2'){echo 'selected';}else{};	?> >第二期</option>
			<option value="3" <?php if($_POST['A']=='3'){echo 'selected';}else{};	?> >第三期</option>
			</select>
			<input type="submit" value="查詢">
			</form>
		</div>
		
		<div class="report">
<?php
    if($_GET['mode']=='query')
	{
		$label_tribe = $_POST['A'];
		//echo  $label_tribe;
		 if($label_tribe==NULL or $label_tribe==" ")
		 {
			 //echo '單位空白';
			 ?><script> alert("期別不能空白");window.history.back();</script><?php
			 exit();
		 }else{
		   $A = $label_tribe ;
		require_once("dbtools.inc.php");
		include_once("../SQL/dbtools_ps.php");
		$link = create_connection();
		$link2 = create_connection2();
		?>
		<table class="table2excel"  id="table2excel">
		 <thead style="display:none">
		<tr>
			<th>期別</th>
			<th>縣市</th>
			<th>地區</th>
			<th>部落</th>
			<th>錨點</th>
			<th>設備類型</th>
			<th>設備名稱</th>
			<th>SN</th>
			<th>IP</th>
			<th>MAC</th>
			<th>P/N</th>									
		</tr>
		   </thead>			
					<tbody style="display:none">
		<?php 
		 
		 
	    $sql_tribe="SELECT * FROM tribe WHERE tribe_label='$label_tribe' ORDER BY `tribe`.`city_id` ASC ,`tribe`.`tribe_name` ASC ";
		$result_tribe= execute_sql($database_name2, $sql_tribe, $link2);
			while ($row_tribe= mysql_fetch_assoc($result_tribe)  )
			{
				$tribe_id = $row_tribe['tribe_id'];
				$tribe_label = $row_tribe['tribe_label'];
				
						
						//FW
						$sql_FW ="SELECT * FROM `ass_grouter` WHERE `ass_grouter_tribe` = '$tribe_id' ";
						$result_FW= execute_sql($database_name2, $sql_FW, $link2);
						while ($row_FW= mysql_fetch_assoc($result_FW)  )
						{
						echo  '<tr>';
						echo   '<td>'.$row_tribe['tribe_label'].'&nbsp;</td>';
						$city_id = $row_tribe['city_id'];
						$township_id = $row_tribe['township_id'] ;
						$ass_grouter_address=$row_FW['ass_grouter_address'] ;
						//
						$sql_city = "SELECT * FROM `city_array` WHERE `id` = '$city_id' ";
						$result_city= execute_sql($database_name2, $sql_city, $link2);
						while ($row_city= mysql_fetch_assoc($result_city)  )
						{
							echo   '<td>'.$row_city['city_name'].'&nbsp;</td>';
						}
						//
						$sql_township= "SELECT * FROM `city_township` WHERE `township_id` = '$township_id' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
							echo   '<td>'.$row_township['township_name'].'&nbsp;</td>';
						}
											
						echo   '<td>'.$row_tribe['tribe_name'].'&nbsp;</td>';
						$sql_township= "SELECT * FROM `assets_address` WHERE `ass_address_id` = '$ass_grouter_address' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
						echo   '<td>'.$row_township['tribe_ass_name'].'&nbsp;</td>';
						}	

						
							echo '<td>'.'Router'.'&nbsp;</td>';
							//echo '<td>'.$sql_FW.'&nbsp;</td>';	
							echo '<td>'.$row_FW['ass_name'].'&nbsp;</td>';
							echo '<td>'.$row_FW['ass_sn'].'&nbsp;</td>'	;
							echo '<td>'.$row_FW['ass_ip'].'&nbsp;</td>'	;
							echo '<td>'.$row_FW['ass_mac'].'&nbsp;</td>'	;							
							echo '<td>'.$row_FW['ass_pn'].'&nbsp;</td>'	;
							echo  '</tr>';	
						}
						
						//4G_Router
						$sql_4Gg_Router ="SELECT * FROM `ass_4Ggrouter` WHERE `ass_4Ggrouter_tribe` = '$tribe_id' ";
						$result_4Gg_Router= execute_sql($database_name2, $sql_4Gg_Router, $link2);
						while ($row_4Gg_Router= mysql_fetch_assoc($result_4Gg_Router)  )
						{
							$ass_4Ggrouter_address = $row_4Gg_Router['ass_4Ggrouter_address'];
							echo  '<tr>';
						echo   '<td>'.$row_tribe['tribe_label'].'&nbsp;</td>';
						$city_id = $row_tribe['city_id'];
						$township_id = $row_tribe['township_id'] ;
						//
						$sql_city = "SELECT * FROM `city_array` WHERE `id` = '$city_id' ";
						$result_city= execute_sql($database_name2, $sql_city, $link2);
						while ($row_city= mysql_fetch_assoc($result_city)  )
						{
							echo   '<td>'.$row_city['city_name'].'&nbsp;</td>';
						}
						//
						$sql_township= "SELECT * FROM `city_township` WHERE `township_id` = '$township_id' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
							echo   '<td>'.$row_township['township_name'].'&nbsp;</td>';
						}
						
						echo   '<td>'.$row_tribe['tribe_name'].'&nbsp;</td>';
						
						$sql_township= "SELECT * FROM `assets_address` WHERE `ass_address_id` = '$ass_4Ggrouter_address' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
						echo   '<td>'.$row_township['tribe_ass_name'].'&nbsp;</td>';
						}
						
						
							echo '<td>'.'4G Router'.'&nbsp;</td>';
							//echo '<td>'.$sql_FW.'&nbsp;</td>';	
							echo '<td>'.$row_4Gg_Router['ass_4Gname'].'&nbsp;</td>';
							echo '<td>'.$row_4Gg_Router['ass_4Gsn'].'&nbsp;</td>'	;
							echo '<td>'.$row_4Gg_Router['ass_4Gip'].'&nbsp;</td>'	;
							echo '<td>'.$row_4Gg_Router['ass_4Gmac'].'&nbsp;</td>'	;							
							echo '<td>'.$row_4Gg_Router['ass_4Gpn'].'&nbsp;</td>'	;
							
							echo  '</tr>';	
						}
						
						//AP
						$sql_AP ="SELECT * FROM `ass_ap` WHERE `ass_ap_tribe` = '$tribe_id' ";
						$result_AP= execute_sql($database_name2, $sql_AP, $link2);
						while ($row_AP= mysql_fetch_assoc($result_AP)  )
						{
							$ass_ap_address = $row_AP['ass_ap_address'] ;
							
							echo  '<tr>';
						echo   '<td>'.$row_tribe['tribe_label'].'&nbsp;</td>';
						$city_id = $row_tribe['city_id'];
						$township_id = $row_tribe['township_id'] ;
						//
						$sql_city = "SELECT * FROM `city_array` WHERE `id` = '$city_id' ";
						$result_city= execute_sql($database_name2, $sql_city, $link2);
						while ($row_city= mysql_fetch_assoc($result_city)  )
						{
							echo   '<td>'.$row_city['city_name'].'&nbsp;</td>';
						}
						//
						$sql_township= "SELECT * FROM `city_township` WHERE `township_id` = '$township_id' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
							echo   '<td>'.$row_township['township_name'].'&nbsp;</td>';
						}					
						echo   '<td>'.$row_tribe['tribe_name'].'&nbsp;</td>';
						
						
						$sql_township= "SELECT * FROM `assets_address` WHERE `ass_address_id` = '$ass_ap_address' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
						echo   '<td>'.$row_township['tribe_ass_name'].'&nbsp;</td>';
						}

						
							echo '<td>'.'AP'.'&nbsp;</td>';
							//echo '<td>'.$sql_FW.'&nbsp;</td>';	
							echo '<td>'.$row_AP['ass_ap_name'].'&nbsp;</td>';
							echo '<td>'.$row_AP['ass_ap_sn'].'&nbsp;</td>'	;
							echo '<td>'.$row_AP['ass_ap_ip'].'&nbsp;</td>'	;
							echo '<td>'.$row_AP['ass_ap_mac'].'&nbsp;</td>'	;							
							echo '<td>'.$row_AP['ass_ap_pn'].'&nbsp;</td>'	;
							
							echo  '</tr>';	
						}
						
						//ass_poesw
						$sql_poesw ="SELECT * FROM `ass_poesw` WHERE `ass_poesw_tribe` = '$tribe_id' ";
						$result_poesw= execute_sql($database_name2, $sql_poesw, $link2);
						while ($row_poesw= mysql_fetch_assoc($result_poesw)  )
						{
							$ass_poesw_address = $row_poesw['ass_poesw_address'] ;
							
							echo  '<tr>';
						echo   '<td>'.$row_tribe['tribe_label'].'&nbsp;</td>';
						$city_id = $row_tribe['city_id'];
						$township_id = $row_tribe['township_id'] ;
						//
						$sql_city = "SELECT * FROM `city_array` WHERE `id` = '$city_id' ";
						$result_city= execute_sql($database_name2, $sql_city, $link2);
						while ($row_city= mysql_fetch_assoc($result_city)  )
						{
							echo   '<td>'.$row_city['city_name'].'&nbsp;</td>';
						}
						//
						$sql_township= "SELECT * FROM `city_township` WHERE `township_id` = '$township_id' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
							echo   '<td>'.$row_township['township_name'].'&nbsp;</td>';
						}					
						echo   '<td>'.$row_tribe['tribe_name'].'&nbsp;</td>';
						
						
						$sql_township= "SELECT * FROM `assets_address` WHERE `ass_address_id` = '$ass_poesw_address' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
						echo   '<td>'.$row_township['tribe_ass_name'].'&nbsp;</td>';
						}
						
						
							echo '<td>'.'PoE/SW'.'&nbsp;</td>';
							//echo '<td>'.$sql_FW.'&nbsp;</td>';	
							echo '<td>'.$row_poesw['ass_poesw_name'].'&nbsp;</td>';
							echo '<td>'.$row_poesw['ass_poesw_sn'].'&nbsp;</td>'	;
							echo '<td>'.$row_poesw['ass_poesw_ip'].'&nbsp;</td>'	;
							echo '<td>'.$row_poesw['ass_poesw_mac'].'&nbsp;</td>'	;							
							echo '<td>'.$row_poesw['ass_poesw_pn'].'&nbsp;</td>'	;
							
							echo  '</tr>';	
						}
						
						//ass_pdu
						$sql_pdu ="SELECT * FROM `ass_pdu` WHERE `ass_pdu_tribe` = '$tribe_id' ";
						$result_pdu= execute_sql($database_name2, $sql_pdu, $link2);
						while ($row_pdu= mysql_fetch_assoc($result_pdu)  )
						{
							$ass_pdu_address = $row_pdu['ass_pdu_address'] ;
							
							echo  '<tr>';
						echo   '<td>'.$row_tribe['tribe_label'].'&nbsp;</td>';
						$city_id = $row_tribe['city_id'];
						$township_id = $row_tribe['township_id'] ;
						//
						$sql_city = "SELECT * FROM `city_array` WHERE `id` = '$city_id' ";
						$result_city= execute_sql($database_name2, $sql_city, $link2);
						while ($row_city= mysql_fetch_assoc($result_city)  )
						{
							echo   '<td>'.$row_city['city_name'].'&nbsp;</td>';
						}
						//
						$sql_township= "SELECT * FROM `city_township` WHERE `township_id` = '$township_id' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
							echo   '<td>'.$row_township['township_name'].'&nbsp;</td>';
						}					
						echo   '<td>'.$row_tribe['tribe_name'].'&nbsp;</td>';
						$sql_township= "SELECT * FROM `assets_address` WHERE `ass_address_id` = '$ass_pdu_address' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
						echo   '<td>'.$row_township['tribe_ass_name'].'&nbsp;</td>';
						}
						
						//ass_pdu_address
							echo '<td>'.'PDU'.'&nbsp;</td>';
							//echo '<td>'.$sql_FW.'&nbsp;</td>';	
							echo '<td>'.$row_pdu['ass_pdu_name'].'&nbsp;</td>';
							echo '<td>'.$row_pdu['ass_pdu_sn'].'&nbsp;</td>'	;
							echo '<td>'.$row_pdu['ass_pdu_ip'].'&nbsp;</td>'	;
							echo '<td>'.$row_pdu['ass_pdu_mac'].'&nbsp;</td>'	;							
							echo '<td>'.$row_pdu['ass_pdu_pn'].'&nbsp;</td>'	;
							
							echo  '</tr>';	
						}
						
						//ass_other
						$sql_other ="SELECT * FROM `ass_other` WHERE `ass_other_tribe` = '$tribe_id' ";
						$result_other= execute_sql($database_name2, $sql_other, $link2);
						while ($row_other= mysql_fetch_assoc($result_other)  )
						{
							$ass_other_address = $row_other['ass_other_address'] ;
							
							echo  '<tr>';
						echo   '<td>'.$row_tribe['tribe_label'].'&nbsp;</td>';
						$city_id = $row_tribe['city_id'];
						$township_id = $row_tribe['township_id'] ;
						//
						$sql_city = "SELECT * FROM `city_array` WHERE `id` = '$city_id' ";
						$result_city= execute_sql($database_name2, $sql_city, $link2);
						while ($row_city= mysql_fetch_assoc($result_city)  )
						{
							echo   '<td>'.$row_city['city_name'].'&nbsp;</td>';
						}
						//
						$sql_township= "SELECT * FROM `city_township` WHERE `township_id` = '$township_id' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
							echo   '<td>'.$row_township['township_name'].'&nbsp;</td>';
						}					
						echo   '<td>'.$row_tribe['tribe_name'].'&nbsp;</td>';
						$sql_township= "SELECT * FROM `assets_address` WHERE `ass_address_id` = '$ass_other_address' ";
						$result_township= execute_sql($database_name2, $sql_township, $link2);
						while ($row_township= mysql_fetch_assoc($result_township)  )
						{
						echo   '<td>'.$row_township['tribe_ass_name'].'&nbsp;</td>';
						}
						
						
							echo '<td>'.'其他'.'&nbsp;</td>';
							//echo '<td>'.$sql_FW.'&nbsp;</td>';	
							echo '<td>'.$row_other['ass_other_name'].'&nbsp;</td>';
							echo '<td>'.$row_other['ass_other_sn'].'&nbsp;</td>'	;
							echo '<td>'.$row_other['ass_other_ip'].'&nbsp;</td>'	;
							echo '<td>'.$row_other['ass_other_mac'].'&nbsp;</td>'	;							
							echo '<td>'.$row_other['ass_other_pn'].'&nbsp;</td>'	;
							
							echo  '</tr>';	
						}
						
						
						
						
					
			
			}

		 ?>
		 </tbody>
		</table>
		</div>
	</div>


<?php

			}

	}else{

		echo  '請選擇期別';
	}
?>

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
				{ extend: 'excelHtml5', text: '匯出第<?=$A ;?>期部落資產總表' ,title: '<?= date("Y-m-d");?>第<?=$A ;?> 期部落資產總表' },
				//{ extend: 'print', text: '列印',title: '<?= date("Y-m-d");?>服務效益分析年報表' },	
				//'pageLength',				
			],
	   };
  $("#table2excel").dataTable(opt);
  });
</script>
</html>