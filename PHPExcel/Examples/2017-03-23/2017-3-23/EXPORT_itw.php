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
$sql_sum="SELECT * FROM `monthly_report_itw_total` WHERE     `Time_interval` ='$day'";
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
 ////
			$SUMA1[$rowCount] = $Use_of_people ;
			$SUMA2[$rowCount] = $Number_of_users ;		
            $A1 = 	$Total_usage_time ;		
			$SUMA3[$rowCount] =  ceil($A1/60) ;
			//$A2 = 	 ceil(($row_sum['Upload_traffic']/(1024*1000))+($row_sum['Download_traffic']/(1024*1000)) );
			$SUMA4[$rowCount] =  ceil(($row_sum['Upload_traffic']/(1024*1000))+($row_sum['Download_traffic']/(1024*1000)) );
			//$A3 = 	($row_sum['Upload_traffic']/(1024*1000));
			$SUMA5[$rowCount] = ($row_sum['Upload_traffic']/(1024*1000));
		//	$A4 = 	($row_sum['Download_traffic']/(1024*1000));		
			$SUMA6[$rowCount] =  ($row_sum['Download_traffic']/(1024*1000));	
			$rowCount++;
			//$ii++;
	//echo $row['Period'] ;
	//echo '<BR>';
}
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,'合計');
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,'');
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,'');
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,'');
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,'');
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,array_sum($SUMA1));
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount,array_sum($SUMA2));
		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount,array_sum($SUMA3));
		$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount,array_sum($SUMA4));
		$objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount,array_sum($SUMA5));
		$objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount,array_sum($SUMA6));


//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//$objWriter->save('Fire_down/愛部落'.$day.'.xlsx');

$attach_name = '愛台灣'.$day.'.xlsx';
$attach = 'Fire_down/C/'.$attach_name ;
//$attach = 'Fire_down/不分類'.$day.'.xlsx';
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//$objWriter->save('Fire_down/不分類'.$day.'.xlsx');
$objWriter->save($attach);

include_once('../../mail_fulsion/mail/PHPMailer/PHPMailerAutoload.php');
//include_once('../../mail_fulsion/mail/PHPMailer/mail_send.php');  //mail_send_gmail.php
include_once('../../mail_fulsion/mail/PHPMailer/mail_send_gmail.php'); 
$mail_title1 = "原民會網管" ;
$mail_title2 = "服務效益月總報表" ;
$mail->From = 'itribe2016@gamil.com';
$mail->FromName = $mail_title1;
$mail->Subject = $mail_title1;
$mail->Body = '附件為'.$day.'報表';
$mail->IsHTML(true);
$mail->AddAttachment("", "");
//$mail->AddAddress('uunmask2000@gmail.com','康康1');
//$mail->AddAddress('service@zhan-yang.com.tw','展暘數位');
/*
$mail->AddAddress('frankchang@tiis.com.tw','Frank');
$mail->AddAddress('danielwu@tiis.com.tw','Daniel');
$mail->AddAddress('yashon@tecom.com.tw','Yashon');
*/
$mail->AddAddress('seanchen@tiis.com.tw','seanchen');
$mail->AddAddress('frankchang@tiis.com.tw','Frank');
$mail->AddAddress('danielwu@tiis.com.tw','Daniel');
$mail->AddAddress('yashon@tecom.com.tw','Yashon');
$mail->AddAddress('heaven@fareastone.com.tw','Heaven');
$mail->AddAddress('chhsfang@fareastone.com.tw','Chhsfang');
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
			//$mail->AddAddress('jerryccchen@iii.org.tw','jerryccchen');	
			$mail->AddAddress('na1337@apc.gov.tw','na1337');	
			$mail->AddAddress('cip1026@apc.gov.tw','cip1026');	
			$mail->AddAddress('charlie@apc.gov.tw','charlie');	
			$mail->AddAddress('biungsu1@apc.gov.tw','biungsu1');
			
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