<?php
require_once("../../SQL/dbtools.inc.php");
$link = create_connection();

if($_GET['mode']='update')
	{
				//指定檔案儲存目錄及檔名
				$upload_dir =  "./EXEFILE/";
				$upload_file = $upload_dir . $to = iconv("UTF-8", "UTF-8", $_FILES["myfile"]["name"]);
           if($_FILES["myfile"]["type"]=='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || $_FILES["myfile"]["type"]=='application/vnd.ms-excel')
		   {
				//將上傳的檔案由暫存目錄移至指定之目錄
				if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $upload_file))
				{
						echo "<strong>檔案上傳成功</strong><hr>";	

						//顯示檔案資訊		
						echo "檔案名稱：" . $_FILES["myfile"]["name"] . "<br>";	
						echo "暫存檔名：" . $_FILES["myfile"]["tmp_name"] . "<br>";
						echo "檔案大小：" . $_FILES["myfile"]["size"] . "<br>";
						echo "檔案種類：" . $_FILES["myfile"]["type"] . "<br>";						
						echo "<p><a href='JavaScript:history.back()'>繼續上傳</a></p>";

					
						/////
						 //引入函式庫
    include '../Classes/PHPExcel.php';
    //設定要被讀取的檔案
   $file = 'EXEFILE/'.$_FILES["myfile"]["name"] ;
    try {
        $objPHPExcel = PHPExcel_IOFactory::load($file);
    } catch(Exception $e) {
        die('Error loading file "'.pathinfo($file,PATHINFO_BASENAME).'": '.$e->getMessage());
    }
    
    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
   echo $Arry_count =  count($sheetData);
   
 //print_r($sheetData[2]);
//exit();			
   
   for($i=2 ; $i <= $Arry_count  ; $i++ )
   {
		//$inser_text = 'TIIS_Call_number, TIIS_Call_time, TIIS_Call_in_time, TIIS_Call_over_time, TIIS_Complete_code, TIIS_process_result, TIIS_current_state, TIIS_client_name, TIIS_Contact_person, TIIS_Day_call, TIIS_customer_address, TIIS_Reaction_problem, TIIS_Maintenance_staff, TIIS_CAG, TIIS_Notes ,Processing_status';
	   $inser_text = 'TIIS_Call_number,alert_written_time ,TIIS_Called_repair_category,alert_ap_date_tribe, TIIS_Maintenance_arrival_time, TIIS_Processing_end_time, TIIS_CAG_recommendations, TIIS_process_result, TIIS_current_state, TIIS_Contact_person, TIIS_Day_call, TIIS_Reaction_problem, TIIS_Maintenance_staff, TIIS_Notes,Processing_status,TIIS_date';
	   $output=implode("','",$sheetData[$i]);
		/*
		$sheetData[$i]['A'];
		$sheetData[$i]['B'];
		$sheetData[$i]['C'];
		$sheetData[$i]['D'];
		$sheetData[$i]['E'];
		$sheetData[$i]['F'];
		$sheetData[$i]['G'];
		$sheetData[$i]['H'];
		$sheetData[$i]['I'];
		$sheetData[$i]['J'];
		$sheetData[$i]['K'];
		$sheetData[$i]['L'];
		$sheetData[$i]['M'];
		$sheetData[$i]['N'];
		$sheetData[$i]['O'];
		*///
		$check_txt = $sheetData[$i]['A'];
$sql_0  =  "SELECT * FROM alert_ap_date_filter WHERE `TIIS_Call_number`='$check_txt' ";
$result_0  = execute_sql($database_name, $sql_0, $link);
$row_count= mysql_num_rows($result_0);
if($row_count!=NULL)
{	

}else{
			$sql = "INSERT INTO alert_ap_date_filter($inser_text) VALUES('$output','已結案',1) ";
			execute_sql($database_name, $sql, $link); 
}	
		
		//echo $sql ;
		//echo '<br>';
		//exit();	
		?>
		<script>
		alert('寫入成功');
		window.location = 'Execl_update.php';
		</script>
		<?php
   }
  
	//print_r($sheetData);
				//exit();
				//列印每一行的資料
				/*
				echo "<h2>列印每一行的資料</h2>";
				foreach($sheetData as $key => $col)
				{
				echo "行{$key}: ";
				foreach ($col as $colkey => $colvalue) {
				echo "{$colvalue}, ";
				} 
				echo "<br/>";
				}
				echo "<hr />";

				//取得欄位與行列的值
				echo "<h2>取得欄位與行列的值</h2>";
				foreach($sheetData as $key => $col)
				{
				foreach ($col as $colkey => $colvalue) {
				echo "{$colkey}{$key} = {$colvalue}, ";
				}
				echo "<br />";
				}
				*/
				///print_r($text);
					$file_path = realpath("$file");
					if (file_exists($file_path)) unlink($file_path);
					//讀取完畢抹殺
				}
				else
				{
					echo "檔案上傳失敗2 (" . $_FILES["myfile"]["error"] . ")<br><br>";
					echo "<a href='javascript:history.back()'>重新上傳</a>";
				}
		   }else
				{
					echo "檔案上傳失敗1 (" . $_FILES["myfile"]["error"] . ")<br><br>";
					echo "<a href='javascript:history.back()'>重新上傳</a>";
				}		
	}else{
		echo "檔案上傳失敗1 (" . $_FILES["myfile"]["error"] . ")<br><br>";
		echo "<a href='javascript:history.back()'>重新上傳</a>";
		
	}	  






?>