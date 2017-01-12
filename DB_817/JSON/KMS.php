<?php
header('Content-Type: text/html;charset=UTF-8');
/*
$host="172.20.0.12"; //MySQL 主機位址
$username="reporter"; //MySQL 使用者名稱
$password="8825252qE"; //MySQL 使用者密碼
$database="radius"; //資料庫名稱
$conn=mysql_connect($host, $username, $password); //建立連線
mysql_query("SET NAMES 'utf8'"); //設定查詢所用之字元集為 utf-8
mysql_select_db($database, $conn); //開啟資料庫
$SQL = "SELECT *  FROM radacct limit 9999";
$result=mysql_query($SQL, $conn); //執行 SQL 指令
*/


$stock=array(); 
//$stock_name=array();
//取得欄位數
$total_fields = mysql_num_fields($result);
for ($j = 0; $j < $total_fields; $j++)
{
	$stock[0][$j]= mysql_field_name($result, $j);

}


for ($i=1; $i<mysql_numrows($result); $i++) { //走訪紀錄集 (列)
     $row=mysql_fetch_array($result); //取得列陣列
     //$stock_name=$row["username"];
     //$stock_id=$row["radacctid"];
	
	$radacctid	 = $row["radacctid"];
	$acctsessionid	  = $row["acctsessionid"];
	$acctuniqueid	  = $row["acctuniqueid"];
	$username	  = $row["username"];
	$groupname	  = $row["groupname"];
	$realm	  = $row["realm"];
	$nasipaddress	  = $row["nasipaddress"];
	$nasportid	  = $row["nasportid"];
	$nasporttype	  = $row["nasporttype"];
	$acctstarttime	 = $row["acctstarttime"];
	$acctstoptime	  = $row["acctstoptime"];
	$acctsessiontime	  = $row["acctsessiontime"];
	$acctauthentic	 = $row["acctauthentic"];
	$connectinfo_start	 = $row["connectinfo_start"];
	$connectinfo_stop	 = $row["connectinfo_stop"];
	$acctinputoctets	 = $row["acctinputoctets"];
	$acctoutputoctets	 = $row["acctoutputoctets"];
	$calledstationid	 = $row["calledstationid"];
	$callingstationid	 = $row["callingstationid"];
	$acctterminatecause	 = $row["acctterminatecause"];
	$servicetype	 = $row["servicetype"];
	$framedprotocol	 = $row["framedprotocol"];
	$framedipaddress	 = $row["framedipaddress"];
	$acctstartdelay	 = $row["acctstartdelay"];
	$acctstopdelay	 = $row["acctstopdelay"];
	$xascendsessionsvrkey = $row["xascendsessionsvrkey"];
	//$radacctid $acctsessionid $acctuniqueid $username $groupname $realm $nasipaddress $nasportid $nasporttype $acctstarttime $acctstoptime $acctsessiontime $acctauthentic $connectinfo_start $connectinfo_stop $acctinputoctets $acctoutputoctets $calledstationid $callingstationid $acctterminatecause $servicetype $framedprotocol $framedipaddress $acctstartdelay $acctstopdelay $xascendsessionsvrkey 
	 
	 //$stock[$i]=array($stock_name, $stock_id); //存入二維陣列
	 
     $stock[$i]=array($radacctid ,$acctsessionid ,$acctuniqueid ,$username ,$groupname ,$realm ,$nasipaddress ,$nasportid ,$nasporttype ,$acctstarttime ,$acctstoptime ,$acctsessiontime ,$acctauthentic ,$connectinfo_start ,$connectinfo_stop ,$acctinputoctets ,$acctoutputoctets ,$calledstationid ,$callingstationid ,$acctterminatecause ,$servicetype ,$framedprotocol ,$framedipaddress ,$acctstartdelay ,$acctstopdelay ,$xascendsessionsvrkey); //存入二維陣列
     } //end of for
echo json_encode($stock);  //將陣列轉成 JSON 資料格式傳回
//echo json_encode($stock_name);  //將陣列轉成 JSON 資料格式傳回


$savedata = json_encode($stock); 
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
//echo $msg;


?>







