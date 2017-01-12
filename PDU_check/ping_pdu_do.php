<?php

 function create_connection()
  {
   // $link = mysql_connect("localhost", "root", "")
   //   or die("無法建立資料連接<br><br>" . mysql_error());
	$link = @mysql_connect("localhost","root","0932969495","AP_data") or die("無法建立連接");
    //$link = @mysql_connect("localhost","mooncat0301","12345678","counter") or die("無法建立連接");  	
    mysql_query("SET NAMES utf8");
			   	
    return $link;
  }
	
  function execute_sql($database, $sql, $link)
  {
    $db_selected = mysql_select_db($database, $link)
      or die("開啟資料庫失敗<br><br>" . mysql_error($link));
						 
    $result = mysql_query($sql, $link);
		
    return $result;
  }
  $database_name = "AP_data";   /// 之後 SQL 語法帶入參數 
$link = create_connection();
$base = dirname(dirname(__FILE__)); 

//require_once "Net_Ping-2.4.4/Ping.php";
?>

 <?php
date_default_timezone_set("Asia/Taipei");

	   
	  $sql_PDU="SELECT ass_pdu_tribe,ass_pdu_name,ass_pdu_ip,tribe_name
							FROM ass_pdu  as A
							INNER JOIN tribe  as B
							ON A.ass_pdu_tribe=B.tribe_id
							 ORDER BY A.ass_pdu_tribe ASC
							
							";
				$result_PDU= execute_sql($database_name, $sql_PDU, $link);
				while ($row_PDU= mysql_fetch_assoc($result_PDU)  )
				{
					 $NOWm   = date("Y-m-d H:i:s");
                    $ass_pdu_tribe  = $row_PDU['ass_pdu_tribe'];
					//echo '這是第一行<br>';
					$ass_pdu_name   = $row_PDU['ass_pdu_name'];
					//echo '這是第一行<br>';
					$ass_pdu_ip     = $row_PDU['ass_pdu_ip'];
					$tribe_name      = $row_PDU['tribe_name']; 
	   
							$host=$ass_pdu_ip ;

					$sql1= "SELECT * FROM PDU_check WHERE PDU_check_IP='$host' ";
					$result1= execute_sql($database_name, $sql1, $link);
					//取得記錄數
					$num= mysql_num_rows($result1);
					//echo $sql1;
					if( $num>0  )
					{ 

						$host=$ass_pdu_ip ;
						exec("ping -c 1 " . $host, $output, $result);	
						
							if ($result == 0)
							{
							echo  $host.'連線正常';
							$sql = "UPDATE PDU_check SET PDU_check_state='連線正常',PDU_check_written='$NOWm' where PDU_check_IP='$host' ";
							execute_sql($database_name, $sql, $link);
							}
							else
							{
							//echo "Ping unsuccessful!";
							echo $host.'失去連線';
							$sql = "UPDATE PDU_check SET PDU_check_state='失去連線',PDU_check_written='$NOWm' where PDU_check_IP='$host' ";
							execute_sql($database_name, $sql, $link);
							}	
						echo '<br>';
				

					}else{
					$sql = "INSERT INTO  PDU_check(PDU_check_tribe,PDU_check_IP) VALUES ('$tribe_name','$host')";
					execute_sql($database_name, $sql, $link);	

					$host=$ass_pdu_ip ;
						exec("ping -c 1 " . $host, $output, $result);	
						
							if ($result == 0)
							{
							echo  $host.'連線正常';
							$sql = "UPDATE PDU_check SET PDU_check_state='連線正常',PDU_check_written='$NOWm' where PDU_check_IP='$host' ";
							execute_sql($database_name, $sql, $link);
							}
							else
							{
							//echo "Ping unsuccessful!";
							echo $host.'失去連線';
							$sql = "UPDATE PDU_check SET PDU_check_state='失去連線',PDU_check_written='$NOWm' where PDU_check_IP='$host' ";
							execute_sql($database_name, $sql, $link);
							}	

						echo '<br>';
					
					}
					
					
					
					
					
					
					
					
				}
?>