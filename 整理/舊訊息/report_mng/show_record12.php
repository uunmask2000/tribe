<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link href="../include/style.css" rel="stylesheet" type="text/css" />
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrap">

<!-------------------------------------- TOP -->
	<div id="header">
	<?php include("../include/top.php"); 
		include_once("../SQL/dbtools.inc.php");
		$link = create_connection(); ?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">

		<div id="alert">
		<?php include("../alert/alert2.php"); ?>
		</div>
    <h1 align="center">System_Resource_Utilization</h1>
    <?php
		include("bar.php");
      require_once("SQL/dbtools.inc.php");
		

///

      //指定每頁顯示幾筆記錄
      $records_per_page = 100;
			
      //取得要顯示第幾頁的記錄
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
				
      //建立資料連接
      $link1 = create_connection1();
			
      //執行 SQL 命令
      $sql = "SELECT    *  FROM System_Resource_Utilization";
//$database_name
 $result = execute_sql1($database_name, $sql, $link);	
     // $result = execute_sql("product", $sql, $link);
			
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
	?>

	<div class="report">

	<?php
      //顯示欄位名稱
      echo "<table border='1' align='center' width='100%'>";
      echo "<tr align='center'>";			
      for ($i = 0; $i < $total_fields; $i++)
        echo "<td>" . mysql_field_name($result, $i) . "</td>";					
      echo "</tr>";
			
      //顯示記錄
      $j = 1;
      while ($row = mysql_fetch_row($result) and $j <= $records_per_page)
      {
        echo "<tr>";		
        for($i = 0; $i < $total_fields; $i++)
          echo "<td>$row[$i]</td>";	
					
        $j++;
        echo "</tr>";		
      }
      echo "</table>" ;
	?>

	</div>

	<?php
      //產生導覽列
      echo "<div id='page'><p align='center'>";
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
				
			echo "</p></div>";
			
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
