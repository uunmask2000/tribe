<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Client_Number</title>
  </head>
  <body>
    <h1 align="center">Client_Number</h1>
    <?php
      require_once("dbtools.inc.php");
			
      //指定每頁顯示幾筆記錄
      $records_per_page = 200;
			
      //取得要顯示第幾頁的記錄
      if (isset($_GET["page"]))
	{
 			$page = $_GET["page"];

	}      
      else
	{
	
        $page = 1;
	}			
      //建立資料連接
      $link = create_connection();
			
      //執行 SQL 命令
      $sql = "SELECT  `timestamp`, `Client_Number_zone`, `Client_Number_radio`, `ssid_irreibe`, `ssid_irreibe_max_client`, `ssid_irreibe_min_client`  FROM Client_Number ORDER BY timestamp DESC ";	
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
      echo "<table border='1' align='center' width='800'>";
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
  </body>
</html>
