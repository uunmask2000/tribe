<?php
include_once("../../SQL/dbtools.inc2.php");
$link = create_connection();




//
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';

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
$sql_sum="SELECT * FROM `monthly_report_itr_total` WHERE    Period ='2'  and `Time_interval` ='$day'";
$result_sum = execute_sql($database_name, $sql_sum, $link);
while($row_sum = mysql_fetch_assoc($result_sum)){
	
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

			$Use_of_people =$row_sum['Use_of_people'];
			$Number_of_users =$row_sum['Number_of_users'];

			$Total_usage_time =($row_sum['Total_usage_time']/60);

			$Upload_traffic =($row_sum['Upload_traffic']/(1024*1000));
			$Download_traffic =($row_sum['Download_traffic']/(1024*1000));				
			$SUM_2  = ceil(($row_sum['Upload_traffic']/(1024*1000))+($row_sum['Download_traffic']/(1024*1000)) );
			$Total_usage_time=  ceil($Total_usage_time);
			$Upload_traffic=  ceil($Upload_traffic);
			$Download_traffic= ceil($Download_traffic);
	
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $day);
 $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $Period);
 $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $County);
 $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $area);
 $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $tribe);
 $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $Use_of_people);
 $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $Number_of_users);
 $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $Total_usage_time);
 $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $SUM_2);
 $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $Upload_traffic);
 $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $Download_traffic);
    $rowCount++;
	//echo $row['Period'] ;
	//echo '<BR>';
}

//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//$objWriter->save('Fire_down/愛部落'.$day.'.xlsx');

$attach_name = '愛部落'.$day.'.xlsx';
$attach = 'Fire_down/'.$attach_name ;
//$attach = 'Fire_down/不分類'.$day.'.xlsx';
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//$objWriter->save('Fire_down/不分類'.$day.'.xlsx');
$objWriter->save($attach);
/*
include_once('../../mail_fulsion/mail/PHPMailer/PHPMailerAutoload.php');
include_once('../../mail_fulsion/mail/PHPMailer/mail_send.php');
$mail_title1 = "原民會網管" ;
$mail_title2 = "服務效益月總報表" ;
$mail->From = 'itribe2016@gamil.com';
$mail->FromName = $mail_title1;
$mail->Subject = $mail_title1;
$mail->Body = '附件為'.$day.'報表';
$mail->IsHTML(true);
$mail->AddAttachment("", "");
$mail->AddAddress('uunmask2000@gmail.com','康康');
$mail->AddAttachment($attach, $attach_name); 
echo 	$attach ;
if(!$mail->Send())
{
		echo "<p align=center>傳送Error1: ".$errorx=$mail->ErrorInfo."</p>";
}else
	{	

	echo "<p align=center><b>傳送成功。</b></p>";
	}

*/

?>