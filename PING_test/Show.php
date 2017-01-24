<?php
	require_once("../SQL/dbtools.inc.php");
	$link = create_connection();


?>

<p>
F/W
<?php

	echo'<br>';
	echo '<ol>';
	$sql_F_W = "SELECT * FROM `ass_grouter`  where ass_grouter_type=1  ";
	$result_F_W = execute_sql($database_name, $sql_F_W, $link);
	while ($row_F_W = mysql_fetch_assoc($result_F_W))
	{
		echo '<li>';
	   echo  $row_F_W['ass_ip'];
	   echo  $row_F_W['ass_name'];
	  ////// echo '<iframe src="PING_fram.php?ip='.$row_F_W['ass_ip'].'"  ></iframe>';
	   echo '</li>';
	}
	echo '</ol>';

?>
</p>
<p>
4G Router
<?php

	echo'<br>';echo '<ol>';
	$sql_F_W = "SELECT * FROM `ass_4Ggrouter`  where ass_4G_grouter_type=1  ";
	$result_F_W = execute_sql($database_name, $sql_F_W, $link);
	while ($row_F_W = mysql_fetch_assoc($result_F_W))
	{
		echo '<li>';
	   echo  $row_F_W['ass_4Gip'];
	   echo  $row_F_W['ass_4Gname'];
	  // echo '<iframe src="PING_fram.php?ip='.$row_F_W['ass_4Gip'].'"  ></iframe>';
	    echo '</li>';
	}
echo '</ol>';

?>
</p>
<p>
Poe S/W
<?php

	echo'<br>';echo '<ol>';
	$sql_F_W = "SELECT * FROM `ass_poesw`  where ass_poesw_type=1  ";
	$result_F_W = execute_sql($database_name, $sql_F_W, $link);
	while ($row_F_W = mysql_fetch_assoc($result_F_W))
	{
		echo '<li>';
	   echo  $row_F_W['ass_poesw_ip'];
	   echo  $row_F_W['ass_poesw_name'];
	   //echo '<iframe src="PING_fram.php?ip='.$row_F_W['ass_poesw_ip'].'"  ></iframe>';
	    echo '</li>';
	}

echo '</ol>';
?>
</p>
<p>
PDU
<?php
/*
	echo'<br>';echo '<ol>';
	$sql_F_W = "SELECT * FROM `ass_pdu` where ass_PDU_type=1  ";
	$result_F_W = execute_sql($database_name, $sql_F_W, $link);
	while ($row_F_W = mysql_fetch_assoc($result_F_W))
	{
		echo '<li>';
	   echo  $row_F_W['ass_pdu_ip'];
	   echo  $row_F_W['ass_pdu_name'];
	   //echo '<iframe src="PING_fram.php?ip='.$row_F_W['ass_pdu_ip'].'"  ></iframe>';
	    echo '</li>';
	}
*/

?>
</p>
<p>
AP
<?php

	echo'<br>';echo '<ol>';
	$sql_F_W = "SELECT * FROM `ass_ap` where ass_ap_type=1 ";
	$result_F_W = execute_sql($database_name, $sql_F_W, $link);
	while ($row_F_W = mysql_fetch_assoc($result_F_W))
	{
		echo '<li>';
	   echo  $row_F_W['ass_ap_ip'];
	   echo  $row_F_W['ass_ap_name'];
	   //echo '<iframe src="PING_fram.php?ip='.$row_F_W['ass_ap_ip'].'"  ></iframe>';
	   echo '</li>';
	}
echo '</ol>';

?>
</p>