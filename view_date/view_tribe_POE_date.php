<html><head>	<meta charset="utf-8">	<title>無線AP網管系統</title>	<link href="../include/reset.css" rel="stylesheet" type="text/css" />	<link href="../include/style.css" rel="stylesheet" type="text/css" />	<link rel="stylesheet" href="../include/bootstrap.min.css">	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><?phpinclude("../SQL/dbtools.inc.php");$link = create_connection();$ip = $_GET['ip'];$sql_show = "SELECT * FROM ass_poesw WHERE ass_poesw_ip='$ip' ";$result_show = execute_sql($database_name, $sql_show, $link);while ($row_show = mysql_fetch_assoc($result_show)  ){	$CITY =  $row_show['ass_poesw_city']; // 縣市	$TOWN =  $row_show['ass_poesw_twon']; // 地區	$TRIBE =  $row_show['ass_poesw_tribe']; // 部落	$ADDRESS =  $row_show['ass_poesw_address']; // 控制箱		$ass_4Ggrouter_label =  $row_show['ass_poesw_label'];  // 設備期別	$device_name =  $row_show['ass_poesw_name'];  // 設備名稱	$IP =  $row_show['ass_poesw_ip'];  // IP	$MAC =  $row_show['ass_poesw_mac'];  // MAC	$PN =  $row_show['ass_poesw_pn'];  // PN	$SN =  $row_show['ass_poesw_sn'];  // SN	$NOTE =  $row_show['ass_poesw_note'];  // 備註					$sql_show_0 = "SELECT * FROM  tribe  WHERE tribe_id='$TRIBE' ";			$result_show_0 = execute_sql($database_name, $sql_show_0, $link);			while ($row_show_0 = mysql_fetch_assoc($result_show_0)  )			{			   $tribe_name =  $row_show_0['tribe_name']; // 部落名稱			   $tribe_label =  $row_show_0['tribe_label']; // 部落期別			}			$sql_show_0 = "SELECT * FROM  city_township  WHERE township_id='$TOWN' ";			$result_show_0 = execute_sql($database_name, $sql_show_0, $link);			while ($row_show_0 = mysql_fetch_assoc($result_show_0)  )			{               $township_name =  $row_show_0['township_name']; // 地區名稱			 			}			$sql_show_0 = "SELECT * FROM  city_array  WHERE id='$CITY' ";			$result_show_0 = execute_sql($database_name, $sql_show_0, $link);			while ($row_show_0 = mysql_fetch_assoc($result_show_0)  )			{               $city_name =  $row_show_0['city_name']; //縣市名稱			}	}?></head><body><div id="wrap"><!-------------------------------------- TOP -->	<div id="header">	<?php	include("../include/top.php");	?>	</div><!-------------------------------------- MAIN -->	<div id="main">		<div class="container">	<h2><?=$city_name ;?><?=$tribe_name ;?><?=$device_name ;?></h2> 	<ul class="list-group">		<li class="list-group-item">IP : <?=$IP;?>		<?php echo '<a title="F/W" href="Http://'.$IP .'" target="_blank">管理設備</a>';?>		<?php echo '<a title="F/W" href="../device_defend/show_poe_sw.php?ip='.$IP.'" target="_self">查看</a>'; ?>					</li> 		<li class="list-group-item">MAC : <?=$MAC;?></li>		<li class="list-group-item">P/N : <?=$PN;?></li>		<li class="list-group-item">S/N : <?=$SN;?></li>		<li class="list-group-item">備註 : <?=$NOTE;?></li>	</ul>	</div>	</div><!-------------------------------------- FOOTER -->  	<div id="footer">	<?php include("../include/bottom.php"); ?>	</div></div></body></html>