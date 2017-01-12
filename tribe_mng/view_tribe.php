<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<script type="text/javascript" src="../js/jquery-latest.js"></script>
<link href="../include/style.css" rel="stylesheet" type="text/css" />
<link href="../include/reset.css" rel="stylesheet" type="text/css" />

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

		<div class="tab_container">
		
			<form action="<?=$_SERVER['PHP_SELF'];?>" method="post" class="period">
			　<select name="A" onchange="this.form.submit();">
				  <option value=" " <?php if($_POST['A']==' '){echo 'selected';}else{};	?>  >全部</option> 
				　<option value="2" <?php if($_POST['A']=='2'){echo 'selected';}else{};	?> >第二期</option>
				　<option value="3" <?php if($_POST['A']=='3'){echo 'selected';}else{};	?> >第三期</option>
				　
				</select>
			</form>

			<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
			<table cellpadding="0" cellspacing="0" class="bar">
				<tr>
				<td width="200"><a class="add" href="insert_tribe.php" targer="_self" >新增部落</a></td>
				<td align="right">
					位置 
					<select id="list" name="city" onchange="this.form.submit();">
					<option value=""selected >全部</option>
					<?php
					$_POST['tribe_label'] = " ";
					//執行 SQL 命令
					$sql = "SELECT *  FROM  city_array ORDER BY city_sort ASC  ";
					$result = execute_sql($database_name, $sql, $link);
					while ($row = mysql_fetch_assoc($result))
						{
							$A = $row['id'] ;
							$B =  $_POST['city'] ;
                                                    ?>
			<option value="<?=$A;?>" <?php if($A==$B){echo 'selected';}else{};	?> ><?php   echo $row['city_name'] ;?></option>

							<?php

						}
					?>
					
						
					</select>

					<select id="list" name="town" onchange="this.form.submit();">
						<option value="" selected disabled="disabled">請選擇地區</option>
						
					<?php
					//執行 SQL 命令
                                         
					$sql1 = "SELECT *  FROM  city_township where township_city='$B'  ";
					$result1 = execute_sql($database_name, $sql1, $link);
					while ($row1 = mysql_fetch_assoc($result1))
						{
							$A1 = $row1['township_id'] ;
							$B1 =  $_POST['town'] ;
                                                    ?>
							<option value="<?=$A1;?>" <?php if($A1==$B1){echo 'selected';}else{};	?> ><?php   echo $row1['township_name'] ;?></option>

							<?php

						}


					?>

					</select>


				</td>
				</tr>
			</table>
 			</form> 
			
			
	
<table id="show_date">
      <thead>
          <tr>
		<th width="10%">縣市</th>
		<th width="10%">地區</th>
		<th width="60%">部落</th>
		<th>編輯</th>
		<th>刪除</th>
          </tr>
      </thead>
      <tbody>
	  
	  <?php
	 
	          
				$city = $_POST['city'] ;
				$town = $_POST['town'] ;
				$tribe_label = $_POST['A'] ;
				
				//if(isset($tribe_label))
				if($tribe_label>0)
				{
					$sql2 = "SELECT *  FROM  tribe where tribe_label='$tribe_label' ORDER BY city_id ASC ";
				}else{
					
						if($city>0){
						$sql2 = "SELECT *  FROM  tribe  where  city_id='$city'  ORDER BY city_id ASC ";

						if($town>0 ){
						$sql2 = "SELECT *  FROM  tribe  where  city_id='$city' and township_id ='$town' ORDER BY city_id ASC ";

						}
						}else{

						$sql2 = "SELECT *  FROM  tribe  ORDER BY city_id ASC ";

						}
				}
				
	           // echo $sql2;
				$result2 = execute_sql($database_name, $sql2, $link);
				while ($row2 = mysql_fetch_assoc($result2) )
				{
                ?>
				 <tr>
             <td>

					<?php

						$key=$row2['city_id'];
						$sql22 = "SELECT *  FROM  city_array  where id='$key' ";
						$result22 = execute_sql($database_name, $sql22, $link);
						while ($row22 = mysql_fetch_assoc($result22))
						{
						     echo $row22['city_name'];
						}
					?>
				
				</td>
            <td>
					<?php
						$key2=$row2['township_id'];
						$sql23 = "SELECT *  FROM  city_township  where township_id='$key2' ";
						$result23 = execute_sql($database_name, $sql23, $link);
						while ($row23 = mysql_fetch_assoc($result23))
						{
						     echo $row23['township_name'];
						}


					?>


				</td>
              	<td><?=$row2['tribe_name'];?></td>
			<td><a href="fix_tribe.php?id=<?=$row2['tribe_id'];?>"><img src="../images/icon_edit.png" class="adm_icon" lign="absmiddle"></a></td>
			<td>
			<a href="javascript:if(confirm('確定要刪除嗎?'))location='mng_tribe_proc.php?mode=del_tribe&id=<?=$row2['tribe_id'];?>'"><img src="../images/icon_del.png"  class="adm_icon"align="absmiddle"></a>
		       </td>
          </tr>
				
				<?php
				}
				
	  
	  
	  
	  
	  ?>
	  
		  
      </tbody>
  </table>
            <div style="clear:both;"></div>
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
