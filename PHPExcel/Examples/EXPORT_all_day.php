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
date_default_timezone_set("Asia/Taipei");


//require_once(__DIR__.'/../mail_fulsion/mail/PHPMailer/PHPMailerAutoload.php');
//
//require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';
require_once(__DIR__.'/../Classes/PHPExcel.php');
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', '年/月')
			->setCellValue('B1', '期別')
			->setCellValue('C1', '縣市')
			->setCellValue('D1', '地區')
			->setCellValue('E1', '部落')
			->setCellValue('F1', '總流量(MB)')
			->setCellValue('G1', '總上行流量(MB)')
			->setCellValue('H1', '總下行流量(MB)');
$day =  date("Y-m-d", strtotime("-1 day"));			
			
			$sql_sum="SELECT *,sum(Upload_traffic),sum(Download_traffic) 
									  FROM sum_day_hr_itw 
									  where  `time_zone_h` like '%$day%'
									  GROUP BY tribe 
									  ORDER BY tribe asc,time_zone_h asc";
							$result_sum = execute_sql($database_name, $sql_sum, $link);
							$jj=0;
							while ($row_sum= mysql_fetch_assoc($result_sum) )
							{						
							$Period =$row_sum['Period'];
							$County =$row_sum['County'];
							$area =$row_sum['area'];
							$tribe =$row_sum['tribe'];
							$time_zone_h =  $row_sum['time_zone_h'];
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
							$array1[$jj][10] = $time_zone_h ;
							$array1[$jj][11] = $row_sum['sum(Upload_traffic)']; 
							$array1[$jj][12] = $row_sum['sum(Download_traffic)']; 
							$jj++;
							}
											
								
							//$sql_sum="SELECT * FROM `sum_day_hr_itr` WHERE    Period ='$Period'  and `time_zone_h` like '%$day%'  ORDER BY tribe asc,time_zone_h asc      ";
							$sql_sum="SELECT *,sum(Upload_traffic),sum(Download_traffic) 
									  FROM sum_day_hr_itr 
									  where  `time_zone_h` like '%$day%'
									  GROUP BY tribe 
									  ORDER BY tribe asc,time_zone_h asc";
							$result_sum = execute_sql($database_name, $sql_sum, $link);
							$jjj=0;
							while ($row_sum= mysql_fetch_assoc($result_sum) )
							{						
							$Period =$row_sum['Period'];
							$County =$row_sum['County'];
							$area =$row_sum['area'];
							$tribe =$row_sum['tribe'];
							$time_zone_h =  $row_sum['time_zone_h'];
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
							$array2[$jjj][10] = $time_zone_h ;
							$array2[$jjj][11] = $row_sum['sum(Upload_traffic)']; 
							$array2[$jjj][12] = $row_sum['sum(Download_traffic)']; 
							$jjj++;
							}
$rowCount = 2;

$count_array = count($array2);
	// $ii = 0 ;
	for ($i =0;$i < $count_array; $i++) 
	{
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $day);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $array2[$i][0]);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $array2[$i][1]);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $array2[$i][2]);
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $array2[$i][3]);
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,  ceil(($array1[$i][11]+$array2[$i][11]+$array1[$i][12]+$array2[$i][12])/(1024*1000)));
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount,  ceil(($array1[$i][11]+$array2[$i][11])/(1024*1000)));
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount,  ceil(($array1[$i][12]+$array2[$i][12])/(1024*1000)));
			
			$rowCount++;
			//$ii++;
	}

$attach_name = '服務效益日報表['.$day.'].xlsx';
$attach = 'Fire_down/A/'.$attach_name ;
//$attach = 'Fire_down/不分類'.$day.'.xlsx';
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//$objWriter->save('Fire_down/不分類'.$day.'.xlsx');
$objWriter->save($attach);

include_once('../../mail_fulsion/mail/PHPMailer/PHPMailerAutoload.php');
//include_once('../../mail_fulsion/mail/PHPMailer/mail_send.php');  //mail_send_gmail.php
include_once('../../mail_fulsion/mail/PHPMailer/mail_send_gmail.php'); 
$mail_title1 = "原民會網管" ;
$mail_title2 = "服務效益日報表" ;
$mail->From = 'itribe2016@gamil.com';
$mail->FromName = $mail_title1;
$mail->Subject = $mail_title2;
$mail->Body = '附件為'.$day.' 日報表';
$mail->IsHTML(true);
$mail->AddAttachment("", "");
		
		     //tecom
			$mail->AddAddress('yashon@tecom.com.tw','Yashon');
			//tiis
			$mail->AddAddress('seanchen@tiis.com.tw','seanchen');
			$mail->AddAddress('frankchang@tiis.com.tw','Frank');
			$mail->AddAddress('charlesh@tiis.com.tw','charlesh');
			$mail->AddAddress('jason01chang@tiis.com.tw','jason01chang');
			$mail->AddAddress('danielwu@tiis.com.tw','Daniel');	
			//fareastone
			$mail->AddAddress('heaven@fareastone.com.tw','Heaven');
			$mail->AddAddress('chhsfang@fareastone.com.tw','Chhsfang');
			$mail->AddAddress('bryanlin@fareastone.com.tw','bryanlin');
			$mail->AddAddress('ccchiang@fareastone.com.tw','ccchiang');
			$mail->AddAddress('chitalee@fareastone.com.tw','chitalee');
			$mail->AddAddress('shichichen@fareastone.com.tw','shichichen');
			
			
			/////org.tw  
			$mail->AddAddress('fcc@apc.gov.tw','fcc');
			$mail->AddAddress('wiselyli@iii.org.tw','wiselyli');
			$mail->AddAddress('daffany@iii.org.tw','daffany');
			$mail->AddAddress('jerryccchen@iii.org.tw','jerryccchen');
			$mail->AddAddress('mayjen@iii.org.tw','mayjen');
			$mail->AddAddress('humanchen@iii.org.tw','humanchen');
			$mail->AddAddress('iseehappy@iii.org.tw','iseehappy');
			$mail->AddAddress('satinechiang@iii.org.tw','satinechiang');
			$mail->AddAddress('p129894881@gmail.com','p129894881');
			
$mail->AddAttachment($attach, $attach_name); 
$addressCC = "uunmask2000@gmail.com";
$mail->AddBCC($addressCC, '康康');
//echo 	$attach ;
if(!$mail->Send())
{
		//echo "<p align=center>傳送Error1: ".$errorx=$mail->ErrorInfo."</p>";
}else
	{	

	//echo "<p align=center><b>傳送成功。</b></p>";
	}




?>