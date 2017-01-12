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
	
	<?php
		if($_GET['mode'] == 'del_user')
			{
			$id = $_GET['id'];
			$sql = "DELETE FROM web_user WHERE user_id ='$id' " ;
			$result = execute_sql($database_name, $sql, $link);
			echo"<script>alert('刪除使用者成功');window.location.href = 'user.php';</script>";					
			}
	?>
	
		<div id="main">
		<?php include("../alert/alert2.php"); ?>

		<?php include("../include/nav.php"); ?>
				<div class="tab_container">
			<table cellpadding="0" cellspacing="0" class="bar">
			<tr>
				<?php
				if(($_SESSION['user_lv'])==1)
				{
				?>
				<td width="200"><a class="add" href="insert_user.php" targer="_self" >新增使用者</a></td>
				<?php
				}
				?>
			</tr>
			</table>
		
		
			<table id="table1" class="asset">
			<thead>
			<tr>
				<th>使用者</th>
				<th>帳號</th>
				<th>E-maill</th>
				<th>使用層級</th>
				<th>編輯</th>
					<?php
						if(($_SESSION['user_lv'])==1)
						{
						?>
						<th>刪除</th>
						<?php
						}
					?>
				
			</tr>
			</thead>
			<tbody>
				<?php
				$sql_user = "SELECT *  FROM  web_user where user_id<>1 ";
				$result_user = execute_sql($database_name, $sql_user, $link);
				while ($row_user = mysql_fetch_assoc($result_user))
				{
					?>
						<tr>
							<td><?=$row_user['user_name'];?></td>
							<td><?=$row_user['user_acc'];?></td>
							<td><?=$row_user['user_maill'];?></td>
							<td><?php 
										$i = $row_user['user_lv'];
										switch ($i) {
										case 1:
										echo "最高使用者";
										break;
										case 2:
										echo "網管人員";
										break;
										case 3:
										echo "專管人員";
										break;
										case 4:
										echo "原民會";
										break;
										}
										
										?></td>
						<?php
					if($_SESSION['user_lv']==1)
					{
						?>
						<td>
							<a href="fix_user.php?id=<?=$row_user['user_id'];?>"><img src="../images/icon_edit.png" class="adm_icon" align="absmiddle"></a>
						</td>
						<?php
					}else if($row_user['user_id']==$_SESSION['user_id'])
					{
						?>
						<td>
							<a href="fix_user.php?id=<?=$row_user['user_id'];?>"><img src="../images/icon_edit.png"  class="adm_icon"align="absmiddle"></a>
						</td>
						<?php
						
					}else{
						echo '<td></td>' ;
					}
					
					?>
					<?php
					 if(($_SESSION['user_lv'])==1)
					{
						?>
						<td>
						<a href="javascript:if(confirm('確定要刪除嗎??'))location='?mode=del_user&id=<?=$row_user['user_id'];?>'"><img src="../images/icon_del.png"  class="adm_icon"align="absmiddle"></a>
						</td>
						<?php
					}
					?>
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
      $("#table1").dataTable(opt);
      });
</script>
</html>