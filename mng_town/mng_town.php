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
		include_once("../SQL/dbtools.inc.php");
		$link = create_connection();
	?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">

		<?php include("../alert/alert2.php"); ?>
		<?php include("../include/nav.php"); ?>
	
		<div class="tab_container">
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		<table cellpadding="0" cellspacing="0" class="bar">
		<tr>
			<td width="200"><a class="add" href="insert_town.php" target="_self" >新增地區</a></td>
			<td align="right">
				縣市 
				<select id="list" name="city" onchange="this.form.submit();">
				<option value=""selected >全部</option>
				<?php
				//執行 SQL 命令
				$sql = "SELECT *  FROM  city_array ORDER BY city_sort ASC  ";
				$result = execute_sql($database_name, $sql, $link);
				while ($row = mysql_fetch_assoc($result))
				{
				$A = $row['id'] ;
				$B =  $_POST['city'] ;
								?>
				<option value="<?=$A;?>" <?php if($A==$B){	 echo 'selected';}else{};	?> ><?php   echo $row['city_name'] ;?></option>

				<?php
				}
				?>
				</select>
			</td>
		</tr>
		</table>
		</form>
									
									
		<table id="show_date" class="asset">
		<thead>
			<tr>
				<th>縣市</th>
				<th>地區</th>
				<th>編輯</th>
				<th>刪除</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$city = $_POST['city'] ;
			if($city>0)
			{
						 
			$sql1 = "SELECT *  FROM  city_township where township_city='$city' ORDER BY township_city ASC ";
			$result1 = execute_sql($database_name, $sql1, $link);			
			}else
			{
			$sql1 = "SELECT *  FROM  city_township  ORDER BY township_city ASC ";
			$result1 = execute_sql($database_name, $sql1, $link);			
			} 
			
			while ($row1 = mysql_fetch_assoc($result1))
				{
					
					
					$township_city = $row1['township_city'];
					$sql2 = "SELECT *  FROM  city_array where id='$township_city'  ";
					$result2 = execute_sql($database_name, $sql2, $link);
					while ($row2 = mysql_fetch_assoc($result2))
					{
					?>
					<tr>
					<td><?=$row2['city_name'];?></td>
					<?php
					}
					?>
					<td><?=$row1['township_name'];?></td>
					<td><a href="fix_town.php?id=<?=$row1['township_id'];?>"><img src="../images/icon_edit.png"  class="adm_icon"align="absmiddle"></a></td>
					<td>
					<a href="javascript:if(confirm('確定要刪除嗎?'))location='mng_town_proc.php?mode=del_town&id=<?=$row1['township_id'];?>'"><img src="../images/icon_del.png"  class="adm_icon"align="absmiddle"></a>
					</td>
					 </tr>
					<?php
				}
		?>
		</tbody>
		</table>

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
				lengthMenu: [
				[ 10, 25, 50, -1 ],
				[ '10 筆', '25 筆', '50 筆', '全部' ]
				],
		dom: 'Bfrtip',	 buttons: [
				'pageLength',				
			],
	   };
      $("#show_date").dataTable(opt);
      });
</script>	
</html>
