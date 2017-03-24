<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Taipei');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', '叫修編號')
				->setCellValue('B1', '期別')
				->setCellValue('C1', '部落')
				->setCellValue('D1', '設備名稱')
				->setCellValue('E1', 'IP')
				->setCellValue('F1', '中斷時間')
				->setCellValue('G1', '恢復時間')
				->setCellValue('H1', '處理編號')
				->setCellValue('I1', '狀態')
				->setCellValue('J1', '叫修類別')
				
				->setCellValue('K1', '發信時間')
				->setCellValue('L1', '首回覆時間')
				->setCellValue('M1', '派工時間')
				->setCellValue('N1', '維修到場時間')
				->setCellValue('O1', '處理時間')
				->setCellValue('P1', '處理結束時間')
				
				->setCellValue('Q1', 'CAG建議')
				->setCellValue('R1', '處理結果')
				->setCellValue('S1', '目前狀態')
				->setCellValue('T1', '連絡人')
				->setCellValue('U1', '日間電話')
				->setCellValue('V1', '反應問題')
				->setCellValue('W1', '維修人員')
				->setCellValue('X1', '附註')
				->setCellValue('Y1', '處置人員')
				->setCellValue('Z1', '回覆時間')
				->setCellValue('AA1', '到場時間')
				->setCellValue('AB1', '完修時間')
				;
		
// Miscellaneous glyphs, UTF-8

session_start();
if(count($_SESSION["Array_total"])<2)
{
	$count_row = 3 ;
}else{
	$count_row = count($_SESSION["Array_total"])+1 ;
}
//echo  print_r($_SESSION["Array_total"][17]);
//exit();
for($rowCount=2 ; $rowCount <= $count_row  ; $rowCount++)
{
	$dt1 = $_SESSION["Array_total"][$rowCount][1];
	$dt2 = $_SESSION["Array_total"][$rowCount][2];
	$dt3 = $_SESSION["Array_total"][$rowCount][3];
	$dt4 = $_SESSION["Array_total"][$rowCount][4];
	$dt5 = $_SESSION["Array_total"][$rowCount][5];
	$dt6 = $_SESSION["Array_total"][$rowCount][6];
	$dt7 = $_SESSION["Array_total"][$rowCount][7];
	$dt8 = "'".$_SESSION["Array_total"][$rowCount][8];
	$dt9 = $_SESSION["Array_total"][$rowCount][9];
	$dt10 = $_SESSION["Array_total"][$rowCount][10];
	
	$dt1101 = $_SESSION["Array_total"][$rowCount][1101]; //維修到場時間(已到達)
	$dt1111 = $_SESSION["Array_total"][$rowCount][1111];  //1111 //已發信
	$dt1112 = $_SESSION["Array_total"][$rowCount][1112];  //1112 //首回覆
	$dt1100 = $_SESSION["Array_total"][$rowCount][1100];  //1100 //已派工	
	$dt1102 = $_SESSION["Array_total"][$rowCount][1102];  //1102 //處理中
	$dt1103 = $_SESSION["Array_total"][$rowCount][1103];  //1103 //已結案
	
	//$dt12 = $_SESSION["Array_total"][$rowCount][12];
	$dt13 = $_SESSION["Array_total"][$rowCount][13];
	$dt14 = $_SESSION["Array_total"][$rowCount][14];
	$dt15 = $_SESSION["Array_total"][$rowCount][15];
	$dt16 = $_SESSION["Array_total"][$rowCount][16];
	$dt17 = $_SESSION["Array_total"][$rowCount][17];
	$dt18 = $_SESSION["Array_total"][$rowCount][18];
	$dt19 = $_SESSION["Array_total"][$rowCount][19];	
	$dt20 = $_SESSION["Array_total"][$rowCount][20];
	//	
	$dt21 = $_SESSION["Array_total"][$rowCount][21];
	//
	$dt22 = $_SESSION["Array_total"][$rowCount][22];
	$dt23 = $_SESSION["Array_total"][$rowCount][23];
	$dt24 = $_SESSION["Array_total"][$rowCount][24];
	
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount,$dt1);
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount,$dt2);
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount,$dt3);
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount,$dt4);
	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount,$dt5);
	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount,$dt6);
	$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount,$dt7);
	$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount,$dt8);
	$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount,$dt9);
	$objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount,$dt10);
	
	
	$objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount,$dt1111);
	$objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount,$dt1112);
	$objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount,$dt1100);
	$objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount,$dt1101);
	$objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount,$dt1102);
	$objPHPExcel->getActiveSheet()->SetCellValue('P'.$rowCount,$dt1103);
	
	$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$rowCount,$dt13);
	$objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowCount,$dt14);
	$objPHPExcel->getActiveSheet()->SetCellValue('S'.$rowCount,$dt15);
	$objPHPExcel->getActiveSheet()->SetCellValue('T'.$rowCount,$dt16);	
	$objPHPExcel->getActiveSheet()->SetCellValue('U'.$rowCount,$dt17);
	$objPHPExcel->getActiveSheet()->SetCellValue('V'.$rowCount,$dt18);
	$objPHPExcel->getActiveSheet()->SetCellValue('W'.$rowCount,$dt19);
	$objPHPExcel->getActiveSheet()->SetCellValue('X'.$rowCount,$dt20);
	$objPHPExcel->getActiveSheet()->SetCellValue('Y'.$rowCount,$dt21);
	$objPHPExcel->getActiveSheet()->SetCellValue('Z'.$rowCount,$dt22);
	$objPHPExcel->getActiveSheet()->SetCellValue('AA'.$rowCount,$dt23);
	$objPHPExcel->getActiveSheet()->SetCellValue('AB'.$rowCount,$dt24);
	/*
	$objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount,$dt12);
	$objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount,$dt13);
	$objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount,$dt14);
	$objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount,$dt15);
	$objPHPExcel->getActiveSheet()->SetCellValue('P'.$rowCount,$dt16);
	$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$rowCount,$dt17);
	$objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowCount,$dt18);
	$objPHPExcel->getActiveSheet()->SetCellValue('S'.$rowCount,$dt19);
	$objPHPExcel->getActiveSheet()->SetCellValue('T'.$rowCount,$dt20);	
	$objPHPExcel->getActiveSheet()->SetCellValue('U'.$rowCount,$dt21);
	//
	$objPHPExcel->getActiveSheet()->SetCellValue('V'.$rowCount,$dt22);
	$objPHPExcel->getActiveSheet()->SetCellValue('W'.$rowCount,$dt23);
	$objPHPExcel->getActiveSheet()->SetCellValue('X'.$rowCount,$dt24);
	*/
}


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel2007)
 $bdaymonth =$_SESSION["date"] ;
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="時間區間:['.$bdaymonth.']結案紀錄表.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
 unset($_SESSION["Array_total"]);
 unset($_SESSION["date"]);
//exit;
