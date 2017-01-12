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
	<?php include("../alert/alert2.php"); ?>
	<?php include("../include/nav.php"); ?>

		<div class="tab_container">
		<table cellpadding="0" cellspacing="0" class="bar">
		<tr><td width="200"><a class="add" href="#" onclick="insert()" >新增聯絡人</a></td></tr>
		</table>

		<div class="container">
		<table id="table1" class="asset">
			<thead>
			<tr>
				<th>排序</th>	
				<th>使用者</th>				
				<th>E-maill</th>		
				<th>編輯</th>
				<th>刪除</th>				
				<?php
				/*
				if(($_SESSION['user_lv'])==1)
				{
				?>
				<th>刪除</th>
				<?php
				}
				*/
				?>
				
			</tr>
			</thead>
			<tbody>

<?php
			//require_once("dbtools.inc.php");
			include("../SQL/dbtools.inc.php");
			$link = create_connection();
                $j = 1 ;
				$sql_view="SELECT * FROM  alert_contacts	 ORDER by alert_contacts_id asc";
				$result_view= execute_sql($database_name, $sql_view, $link);
				while ($row_view= mysql_fetch_assoc($result_view)  )
				{
						$alert_contacts_id=$row_view['alert_contacts_id'];
						$alert_contacts_email=$row_view['alert_contacts_email'];
						$alert_contacts_name=$row_view['alert_contacts_name'];
						?>
						<tr>
							<td><?=$j;?></td>
							<td><?=$row_view['alert_contacts_name'];?></td>
							<td><?=$row_view['alert_contacts_email'];?></td>
							<td>
							<a onclick="fix()" href="Identification.php?mode=A2&key=<?=$alert_contacts_id;?>"><img src="../images/icon_edit.png" class="adm_icon" align="absmiddle"></a>
							</td>
							<td>
							<a href="javascript:if(confirm('確定要刪除嗎??'))location='Identification.php?mode=A3&key=<?=$alert_contacts_id;?>'" ><img src="../images/icon_del.png"  class="adm_icon" align="absmiddle"></a>
							</td>
						</tr>
						<?php
						$j++ ;
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
      $("#table1").dataTable(opt);
      });
</script>

<script type="text/javascript">
// For demo to fit into DataTables site builder...
$('#table1')
	.removeClass( 'display' )
	.addClass('table table-striped table-bordered');
</script>

<script type="text/javascript">
function insert() 
{
//alert('insert');
window.location.href = 'Identification.php?mode=A1';
}
function fix() 
{
//alert('fix');

//window.location.href = 'Identification.php?mode=A2&key=<?=$_GET['key'];?>';
}
function del() 
{
//alert('del');
//window.location.href = 'Identification.php?mode=A3&key=<?=$_GET['key'];?>';
}
</script>
</html>