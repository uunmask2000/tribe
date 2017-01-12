<?php

//echo $_GET['ip'];
include_once("../SQL/dbtools.inc.php");
$link = create_connection();

$IP = $_GET['ip'];
///---- AP
$sql_AP = "SELECT * FROM ass_ap WHERE ass_ap_ip='$IP' ";
$result_AP = execute_sql($database_name, $sql_AP, $link);
$total_record_AP = mysql_num_rows($result_AP);  //取得記錄數
echo $total_record_AP;
///---- AP v

///---- pdu
$sql_pdu = "SELECT * FROM  ass_pdu WHERE ass_pdu_ip='$IP' ";
$result_pdu = execute_sql($database_name, $sql_pdu, $link);
$total_record_pdu = mysql_num_rows($result_pdu);  //取得記錄數
echo $total_record_pdu;
///---- pdu v

///---- POE
$sql_POE= "SELECT * FROM  ass_poesw WHERE ass_poesw_ip='$IP' ";
$result_POE = execute_sql($database_name, $sql_POE, $link);
$total_record_POE = mysql_num_rows($result_POE);  //取得記錄數
echo $total_record_POE;
///---- POE


///---- 4G_rouet
$sql_4G_rouet= "SELECT * FROM  ass_4Ggrouter WHERE ass_4Gip='$IP' ";
$result_4G_rouet= execute_sql($database_name, $sql_4G_rouet, $link);
$total_record_4G_rouet = mysql_num_rows($result_4G_rouet);  //取得記錄數
echo $total_record_4G_rouet;
///---- 4G_rouet


///---- rouet
$sql_rouet= "SELECT * FROM  ass_grouter WHERE ass_ip='$IP' ";
$result_rouet = execute_sql($database_name, $sql_rouet, $link);
$total_record_rouet = mysql_num_rows($result_rouet);  //取得記錄數
echo $total_record_rouet;
///---- rouet
///http://172.20.0.14/device_defend/show_router.php?ip=172.21.19.1

if($total_record_AP>0)
{
	echo 'AP';
	header("Location:../device_defend/show_ap.php?ip=$IP" );
	exit();
}else if($total_record_pdu>0)
{
	echo 'PDU';
	header("Location:../device_defend/show_pdu.php?ip=$IP" );
	exit();
}else if($total_record_POE>0)
{
	echo 'POE';
	header("Location:../device_defend/show_poe_sw.php?ip=$IP" );
	exit();
}else if($total_record_4G_rouet>0)
{
	echo '4G_rouet';
	header("Location:../device_defend/show_4grouter.php?ip=$IP" );
	exit();
}else if($total_record_rouet>0)
{
	echo 'rouet';
	header("Location:../device_defend/show_router.php?ip=$IP" );
	exit();
}else{
	
	echo header("Location:../../" );
	exit();
	
}








?>