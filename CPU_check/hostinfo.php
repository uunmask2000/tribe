<?php

// Server Hardware Information v1.0.0

?>

<html>
<head>
<title><?php echo $SERVER_NAME; ?> - Server Information</title>
<STYLE type=text/css>
BODY { FONT-SIZE: 8pt; COLOR: black; FONT-FAMILY: Verdana,arial, helvetica, serif; margin : 0 0 0 0;}
.style1 {
    color: #999999;
    font-weight: bold;
}

div.img {
    margin: 5px;
    border: 1px solid #ccc;
    float: left;
    width: 500px;
}

div.img:hover {
    border: 1px solid #777;
}

div.img img {
    width: 100%;
    height: auto;
}

div.desc {
    padding: 15px;
    text-align: center;
}
</STYLE>
<meta http-equiv="refresh" content="300">
</head>
<body>
<blockquote>
  <pre><p></p>
<span class="style1">Uptime:</span> 
<?php system("uptime"); ?>  // 利用 system () 函式執行 bash 指令抓取時間

<span class="style1">System Information:</span>
<?php system("uname -a"); ?> // 利用 system () 函式執行 bash 指令抓取系統版本 


<span class="style1">Memory Usage (MB):</span> 
<?php system("free -m"); ?> //利用 system () 函式執行 bash 指令抓取記憶體


<span class="style1">Disk Usage:</span> 
<?php system("df -h"); ?> //利用 system () 函式執行 bash 指令抓取硬碟使用情況


<span class="style1">CPU Information:</span> 
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
echo '<div  style="width:200px;background-color:#E7CDFF;">';
foreach( $data as $k => $v ) {
	echo '<img src="' . makeImageUrl( $k, $v ) . '" />';
}
echo '</div>';
?>

</body>
</html>
