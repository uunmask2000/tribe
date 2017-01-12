<?php
$savedata = 'TEST存入資料測試1';
$getfilename = 'output.txt'; //設定你的檔案寫路路徑。請依照主機路徑為主
if(@$fp = fopen($getfilename, 'w+'))
{
	//更新原資料記錄表
	fwrite($fp, $savedata);
	fclose($fp);
	$msg = '檔案建立完成1';
}
else
{
	$msg = '檔案建立失敗，請確定該目錄是否有可寫權限';
}
echo $msg;


?>