<!DOCTYPE html>
<!--[if lt IE 9]>
<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<html>
<head>
 <!--------dataTables---------->
  <link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.2/themes/hot-sneaks/jquery-ui.css" rel="stylesheet">
  <link href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" rel="stylesheet">
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.0.min.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.2/jquery-ui.min.js"></script>
  <!---CDN
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
  -->
  <script type="text/javascript" src="../../dataTables/jquery.dataTables.min.js"></script>
</head>



<?php
 //Unicode
// header("Content-Type:text/html; charset=utf-8");
 
 //Get json
 $file = file_get_contents('http://172.20.0.14/DB_817/JSON/KMS.php');
  
 //decode
 $m_json = json_decode($file, true);
 
 
 $JSON_DATE = json_encode($m_json);  //JOSN
 
 
 /// ECHO $JSON_DATE ;
 
 $JSON_DATE_arry  =json_decode($JSON_DATE, true);
  // print_r($JSON_DATE_arry );
	$array_rows_all=count($JSON_DATE_arry);
	$array_rows=count($JSON_DATE_arry[0]);
?>

    
	
	
	
	 <table id="show_date">
      <thead>
           <tr>
		   <?php
		   for($iii=0;$iii<$array_rows;$iii++)
				{
					?>
					 <th><?=$JSON_DATE_arry[0][$iii];?></th>
					<?php
				}
		   
		   ?>
		  
		  
            </tr>
      </thead>
      <tbody>
        
		  <?php
		  for($i=1;$i<=$array_rows_all;$i++)
			{
				echo '<tr>';
				for($ii=0;$ii<$array_rows;$ii++)
				{
					echo'<td>'.$JSON_DATE_arry[$i][$ii].'</td>';
				}
				
				echo '</tr>';
				
			}
		  
		  
		  ?>
              
          
         
      </tbody>
  </table>
  <script language="JavaScript">
    $(document).ready(function(){ 
      var opt={"oLanguage":{"sProcessing":"處理中...",
                            "sLengthMenu":"顯示 _MENU_ 項結果",
                            "sZeroRecords":"沒有匹配結果",
                            "sInfo":"顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
                            "sInfoEmpty":"顯示第 0 至 0 項結果，共 0 項",
                            "sInfoFiltered":"(從 _MAX_ 項結果過濾)",
                            "sSearch":"搜索:",
                            "oPaginate":{"sFirst":"首頁",
                                         "sPrevious":"上頁",
                                         "sNext":"下頁",
                                         "sLast":"尾頁"}
		            }
	       };
      $("#show_date").dataTable(opt);
      });
  </script>





