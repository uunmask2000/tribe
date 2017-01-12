<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<script type="text/javascript" src="../js/jquery-latest.js"></script>
<link href="../include/style.css" rel="stylesheet" type="text/css" />
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
<!--匯出excel-->
<script src="./js/excellentexport.js"></script>

<script language="javascript">
	function printdiv(printpage)
	{
	var headstr = "<html><head><title></title></head><body>";
	var footstr = "</body>";
	var newstr = document.all.item(printpage).innerHTML;
	var oldstr = document.body.innerHTML;
	document.body.innerHTML = headstr+newstr+footstr;
	window.print();
	document.body.innerHTML = oldstr;
	return false;
	}
</script>

</head>
<style> td, th { padding:5px; border:#000 1px solid;}</style>
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

    <h1 align="center">radacct - SHOW ALL</h1>
	 <a download="somedata.csv" href="#" onclick="return ExcellentExport.csv(this, 'datatable');">Export to CSV</a>

	<div style="height:400px; margin:20px; overflow:auto;">
    <?php
      require_once("dbtools.inc.php");
			
      //指定每頁顯示幾筆記錄
      $records_per_page = 500;
			
      //取得要顯示第幾頁的記錄
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
				
      //建立資料連接
      $link = create_connection();
			
      //執行 SQL 命令
      $sql = "SELECT *  FROM radacct where nasipaddress='172.21.9.131' ORDER BY acctsessiontime DESC";	
      $result = execute_sql($database_name, $sql, $link);
			
      //取得欄位數
      $total_fields = mysql_num_fields($result);
			
      //取得記錄數
      $total_records = mysql_num_rows($result);
			
      //計算總頁數
      $total_pages = ceil($total_records / $records_per_page);
			
      //計算本頁第一筆記錄的序號
      $started_redcord = $records_per_page * ($page - 1);
			
      //將記錄指標移至本頁第一筆記錄的序號
      mysql_data_seek($result, $started_redcord);
		  
      //顯示欄位名稱
      echo "<table style='border:#000 1px solid;' align='center' id='datatable' >";
      echo "<tr>";			
      for ($i = 0; $i < $total_fields; $i++)
        echo "<th style='border:#000 1px solid; background:#ddd;'>" . mysql_field_name($result, $i) . "</th>";					
      echo "</tr>";
			
      //顯示記錄
      $j = 1;
      while ($row = mysql_fetch_row($result) and $j <= $records_per_page)
      {
        echo "<tr>";		
        for($i = 0; $i < $total_fields; $i++)
          echo "<td style=' border:#000 1px solid;'>$row[$i]</td>";	
					
        $j++;
        echo "</tr>";		
      }
      echo "</table></div>" ;
			
      //產生導覽列
      echo "<p align='center'>";
      if ($page > 1)
        echo "<a href='?page=". ($page - 1) . "'>上一頁</a> ";
				
      for ($i = 1; $i <= $total_pages; $i++)
      {
        if ($i == $page)
          echo "$i ";
        else
          echo "<a href='?page=$i'>$i</a> ";		
      }
			
      if ($page < $total_pages)
        echo "<a href='?page=". ($page + 1) . "'>下一頁</a> ";	
				
			echo "</p>";
			
      //釋放記憶體空間
      mysql_free_result($result);
      mysql_close($link);
    ?>

<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</div>

</body>
</html>
