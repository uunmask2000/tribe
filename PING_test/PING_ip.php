<?php
	require_once("../SQL/dbtools.inc.php");
	$link = create_connection();


?>
<p>
F/W
<?php

	echo'<br>';
	$sql_F_W = "SELECT * FROM `ass_grouter`   ";
	$result_F_W = execute_sql($database_name, $sql_F_W, $link);
	while ($row_F_W = mysql_fetch_assoc($result_F_W))
	{
	   echo  $row_F_W['ass_ip'];
	   echo  $row_F_W['ass_name'];
	   echo '<iframe src="PING_fram.php?ip='.$row_F_W['ass_ip'].'"  ></iframe>';
	   echo'<br>';
	}


?>
</p>
<p>
4G Router
<?php

	echo'<br>';
	$sql_F_W = "SELECT * FROM `ass_4Ggrouter`   ";
	$result_F_W = execute_sql($database_name, $sql_F_W, $link);
	while ($row_F_W = mysql_fetch_assoc($result_F_W))
	{
	   echo  $row_F_W['ass_4Gip'];
	   echo  $row_F_W['ass_4Gname'];
	   echo '<iframe src="PING_fram.php?ip='.$row_F_W['ass_4Gip'].'"  ></iframe>';
	   echo'<br>';
	}


?>
</p>
<p>
Poe S/W
<?php

	echo'<br>';
	$sql_F_W = "SELECT * FROM `ass_poesw`   ";
	$result_F_W = execute_sql($database_name, $sql_F_W, $link);
	while ($row_F_W = mysql_fetch_assoc($result_F_W))
	{
	   echo  $row_F_W['ass_poesw_ip'];
	   echo  $row_F_W['ass_poesw_name'];
	   echo '<iframe src="PING_fram.php?ip='.$row_F_W['ass_poesw_ip'].'"  ></iframe>';
	   echo'<br>';
	}


?>
</p>
<p>
PDU
<?php
/*
	echo'<br>';
	$sql_F_W = "SELECT * FROM `ass_pdu`   ";
	$result_F_W = execute_sql($database_name, $sql_F_W, $link);
	while ($row_F_W = mysql_fetch_assoc($result_F_W))
	{
	   echo  $row_F_W['ass_pdu_ip'];
	   echo  $row_F_W['ass_pdu_name'];
	   echo '<iframe src="PING_fram.php?ip='.$row_F_W['ass_pdu_ip'].'"  ></iframe>';
	   echo'<br>';
	}
*/

?>
</p>
<p>
AP
<?php

	echo'<br>';
	$sql_F_W = "SELECT * FROM `ass_ap`  ";
	$result_F_W = execute_sql($database_name, $sql_F_W, $link);
	while ($row_F_W = mysql_fetch_assoc($result_F_W))
	{
	   echo  $row_F_W['ass_ap_ip'];
	   echo  $row_F_W['ass_ap_name'];
	   echo '<iframe src="PING_fram.php?ip='.$row_F_W['ass_ap_ip'].'"  ></iframe>';
	   echo'<br>';
	}


?>
</p>