<?php
  function create_connection()
  {
   // $link = mysql_connect("localhost", "root", "")
   //   or die("無法建立資料連接<br><br>" . mysql_error());
	$link = @mysql_connect("localhost","root","0932969495","Copy_date") or die("無法建立連接");
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
  $database_name = "Copy_date";   /// 之後 SQL 語法帶入參數 


?>

<?php
//include_once("../../SQL/dbtools.inc2.php");
$link = create_connection();



//require_once(__DIR__.'/../mail_fulsion/mail/PHPMailer/PHPMailerAutoload.php');
//
//require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
require_once(__DIR__.'/Classes/PHPExcel.php');
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', '年/月')
			->setCellValue('B1', '期別')
			->setCellValue('C1', '縣市')
			->setCellValue('D1', '地區')
			->setCellValue('E1', '部落')
			->setCellValue('F1', '總使用人次')
			->setCellValue('G1', '總使用人數')
			->setCellValue('H1', '總使用時間(分)')
			->setCellValue('I1', '總流量(MB)')
			->setCellValue('J1', '總上行流量(MB)')
			->setCellValue('K1', '總下行流量(MB)');
$day =  date("Y-m", strtotime("-1 month"));
$rowCount = 2;
		$sql_sum="SELECT * FROM `monthly_report_itw_total` WHERE    Period ='2'  and `Time_interval` ='$day'";
		$result_sum = execute_sql($database_name, $sql_sum, $link);
		$jj=0;
		while ($row_sum= mysql_fetch_assoc($result_sum) )
		{						
		$Period =$row_sum['Period'];
		$County =$row_sum['County'];
		$area =$row_sum['area'];
		$tribe =$row_sum['tribe'];

		//
		$filter_number =$row_sum['filter_number'];
		$device_number =$row_sum['device_number'];
		//1個設備  200 , 分母為 1/ 200
		$Denominator  = $device_number*200;
		//

		$Use_of_people_itw =$row_sum['Use_of_people'];
		$Number_of_users_itw =$row_sum['Number_of_users'];
		$Total_usage_time_itw = $row_sum['Total_usage_time'];
		$Upload_traffic_itw =  $row_sum['Upload_traffic'];
		$Download_traffic_itw = $row_sum['Download_traffic'];	

		$array1[$jj][0] =$Period ;
		$array1[$jj][1] =$County ;
		$array1[$jj][2] =$area ;
		$array1[$jj][3] =$tribe ;
		$array1[$jj][4] =$Use_of_people_itw ;
		$array1[$jj][5] =$Number_of_users_itw ;
		$array1[$jj][6] =$Total_usage_time_itw ;
		$array1[$jj][7] =$Upload_traffic_itw ;
		$array1[$jj][8] =$Download_traffic_itw ;
		$array1[$jj][9] =ceil($filter_number / $Denominator) ;

		$jj++;
		}

				$sql_sum="SELECT * FROM `monthly_report_itr_total` WHERE    Period ='2'  and `Time_interval` ='$day'";
				$result_sum = execute_sql($database_name, $sql_sum, $link);
				$jjj=0;
				while ($row_sum= mysql_fetch_assoc($result_sum) )
				{						
				$Period =$row_sum['Period'];
				$County =$row_sum['County'];
				$area =$row_sum['area'];
				$tribe =$row_sum['tribe'];

				//
				$filter_number =$row_sum['filter_number'];
				$device_number =$row_sum['device_number'];
				//1個設備  200 , 分母為 1/ 200
				$Denominator  = $device_number*200;
				//

				$Use_of_people_itr =$row_sum['Use_of_people'];
				$Number_of_users_itr =$row_sum['Number_of_users'];
				$Total_usage_time_itr = $row_sum['Total_usage_time'];
				$Upload_traffic_itr =  $row_sum['Upload_traffic'];
				$Download_traffic_itr = $row_sum['Download_traffic'];	

				$array2[$jjj][0] =$Period ;
				$array2[$jjj][1] =$County ;
				$array2[$jjj][2] =$area ;
				$array2[$jjj][3] =$tribe ;
				$array2[$jjj][4] =$Use_of_people_itr ;
				$array2[$jjj][5] =$Number_of_users_itr ;
				$array2[$jjj][6] =$Total_usage_time_itr ;
				$array2[$jjj][7] =$Upload_traffic_itr ;
				$array2[$jjj][8] =$Download_traffic_itr ;
				$array2[$jjj][9] =ceil($filter_number / $Denominator) ;

				 $jjj++;
				}
	 $rowCount =2 ;
	 $count_array = count($array2);
	// $ii = 0 ;
	for ($i =0;$i < $count_array; $i++) 
	{
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $day);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $array2[$i][0]);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $array2[$i][1]);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $array2[$i][2]);
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $array2[$i][3]);
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $array1[$i][4]+$array2[$i][4]);
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $array1[$i][5]+$array2[$i][5]);
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, ceil(($array1[$i][6]+$array2[$i][6])/60));
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount,  ceil(($array1[$i][7]+$array2[$i][7]+$array1[$i][8]+$array2[$i][8])/(1024*1000)));
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount,  ceil(($array1[$i][7]+$array2[$i][7])/(1024*1000)));
			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount,  ceil(($array1[$i][8]+$array2[$i][8])/(1024*1000)));
			$rowCount++;
			//$ii++;
	}



$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save('1234.xlsx');
//$objWriter->save('Fire_down/不分類'.$day.'.xlsx');





?>