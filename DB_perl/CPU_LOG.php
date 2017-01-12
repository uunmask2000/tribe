

<?php

 function create_connection()
  {
   // $link = mysql_connect("localhost", "root", "")
   //   or die("無法建立資料連接<br><br>" . mysql_error());
	$link = @mysql_connect("localhost","root","0932969495","AP_data") or die("無法建立連接");
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
  $database_name = "AP_data";   /// 之後 SQL 語法帶入參數 




	$link = create_connection();

?>

<?php
/* Gets individual core information */
function GetCoreInformation() {
	$data = file('/proc/stat');
	$cores = array();
	foreach( $data as $line ) {
		if( preg_match('/^cpu[0-9]/', $line) )
		{
			$info = explode(' ', $line );
			$cores[] = array(
				'user' => $info[1],
				'nice' => $info[2],
				'sys' => $info[3],
				'idle' => $info[4]
			);
		}
	}
	return $cores;
}
/* compares two information snapshots and returns the cpu percentage */
function GetCpuPercentages($stat1, $stat2) {
	if( count($stat1) !== count($stat2) ) {
		return;
	}
	$cpus = array();
	for( $i = 0, $l = count($stat1); $i < $l; $i++) {
		$dif = array();
		$dif['user'] = $stat2[$i]['user'] - $stat1[$i]['user'];
		$dif['nice'] = $stat2[$i]['nice'] - $stat1[$i]['nice'];
		$dif['sys'] = $stat2[$i]['sys'] - $stat1[$i]['sys'];
		$dif['idle'] = $stat2[$i]['idle'] - $stat1[$i]['idle'];
		$total = array_sum($dif);
		$cpu = array();
		foreach($dif as $x=>$y) $cpu[$x] = round($y / $total * 100, 1);
		$cpus['cpu' . $i] = $cpu;
	}
	return $cpus;
}
/* get core information (snapshot) */
$stat1 = GetCoreInformation();
/* sleep on server for one second */
sleep(1);
/* take second snapshot */
$stat2 = GetCoreInformation();
/* get the cpu percentage based off two snapshots */
$data = GetCpuPercentages($stat1, $stat2);
/* makes a google image chart url */
function makeImageUrl($title, $data) {
	$url = 'http://chart.apis.google.com/chart?chs=440x240&cht=pc&chco=0062FF|498049|F2CAEC|D7D784&chd=t:';
	$url .= $data['user'] . ',';
	$url .= $data['nice'] . ',';
	$url .= $data['sys'] . ',';
	$url .= $data['idle'];
	$url .= '&chdl=User|Nice|Sys|Idle&chdlp=b&chl=';
	$url .= $data['user'] . '%25|';
	$url .= $data['nice'] . '%25|';
	$url .= $data['sys'] . '%25|';
	$url .= $data['idle'] . '%25';
	$url .= '&chtt=Core+' . $title;
	return $url;
}
/* ouput pretty images */
//include_once("../SQL/dbtools.inc.php");
//$link = create_connection();


foreach( $data as $k => $v ) {
	echo '<img src="' . makeImageUrl( $k, $v ) . '" />';
	echo $A1= $data[$k]['user'];
	echo $A2= $data[$k]['nice'];
	echo  $A3=$data[$k]['sys'];
	echo  $A4= $data[$k]['idle'];
	 $data[$k]['CPU'] = ''.$k ; 
	echo  $A5=$data[$k]['CPU'];
	//echo print_r($data[$k]);
$sql = "INSERT INTO CPU_check( CPU_no, CPU_user, CPU_nice, CPU_sys, CPU_idle) VALUES ('$A5','$A1','$A2','$A3','$A4') ";
execute_sql($database_name, $sql, $link);	
///echo	$sql;
	
}
?>