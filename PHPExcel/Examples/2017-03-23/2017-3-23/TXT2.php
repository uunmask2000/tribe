<html>
  <head>
    <title>檔案上傳</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">		
  </head>
  <body>
    <p align="center"><img src="title.jpg"></p>
    <?php
      //指定檔案儲存目錄及檔名
      $upload_dir =  "./EXEFILE/";
      $upload_file = $upload_dir . $to = iconv("UTF-8", "UTF-8", $_FILES["myfile"]["name"]);
		
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
		
		//引入函式庫
	include '../Classes/PHPExcel.php';
	//require_once(__DIR__.'/../Classes/PHPExcel.php');
	header("Content-Type:text/html; charset=utf-8");
	//設定要被讀取的檔案，經過測試檔名不可使用中文
	$file = 'EXEFILE/'.$_FILES["myfile"]["name"] ;
	try {
	    $objPHPExcel = PHPExcel_IOFactory::load($file);
	} catch(Exception $e) {
	    die('Error loading file "'.pathinfo($file,PATHINFO_BASENAME).'": '.$e->getMessage());
	}
	
	$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
	
	echo "<h2>列印每一行的資料</h2>";
	//欄與列的index
	$colindex=0;
	$rowindex=0;
	//某行完全沒有值的判斷變數
	$rownull=true;
	//資料對應的欄位標題，有時標題也有利用的空間，完整版我是有用到。
	$title = array();
	foreach($sheetData as $key => $col){
		//讀取標題
		if($rowindex == 0){
			foreach ($col as $colkey => $colvalue){
				array_push($title,$colvalue);
			}
		}
		//前面1行不讀入,可更改值設定前幾行不讀取
		if($rowindex>=1){
			echo "行{$key}: "."<br>";
			$temp="";
			foreach ($col as $colkey => $colvalue){
			
				//#--為後面使用字串切割的key
				//為第二列資料並且不為最後一列資料，增加切割時用的字串(可更改為不常使用的符號或文字)。輸出格式會變成: 資料1#--資料2#--資料3#--資料4....資料n，每筆資料中間會有#--
				if($colindex > 0 && $colindex != sizeof($col)-1)
					$temp.="#--";
				//前面0列不讀入,可更改值，設定前幾列不讀取，或是為n+1列開始讀取。
				if($colindex >= 0){
					//某列值不為空，判斷該行就算有資料。
					if($colvalue!="")
						$rownull=false;
					//將資料暫存下來，繼續讀取下一列。
					$temp.=$colvalue;
				}
				//列的index遞增
				$colindex++;
			}
			//如果設定保護工作表會讀取整份文件Excel,所以$rownull來判斷讀取到的某一行是否完全沒有輸入值
			if($rownull)
				echo "行".$key."沒有值<br>";
			if($rownull && $rowindex > 0)//如果某行完全沒有值，並且讀取到的是內容(標題為第一行,$rowindex=0)，就不在繼續讀取，節省資源。
				break;
			//某行完全沒有值的"判斷變數"，改回預設值
			$rownull=true;
		
			$text=explode("#--",$temp);
			//某一行的所有資料
			for($i=0;$i<sizeof($text);$i++){
				//某列資料值為空
				if($text[$i]=="")
					echo "此儲存格資料為空!";
				else {
					echo $title[$i].":";
					echo $text[$i]."<br>";
				}
			}
			//列的index歸零
			$colindex=0;
			//輸出換行
			echo "<br/>";
		}
		if($rowindex>=1)
			echo "<hr>";
		//行的index遞增
		$rowindex++;
	}
	
	 $file_path = realpath("$file");
	  if (file_exists($file_path)) unlink($file_path);
		//讀取完畢抹殺
      }
      else
      {
        echo "檔案上傳失敗 (" . $_FILES["myfile"]["error"] . ")<br><br>";
        echo "<a href='javascript:history.back()'>重新上傳</a>";
      }
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
    ?>
  </body>
</html>