<?php
include("../SQL/dbtools.inc.php");
$link = create_connection();
?>

<?php
$sql_KID  = "SELECT * FROM `Equipment_Repair` WHERE `Equipment_Repair_time` = '0000-00-00 00:00:00' ORDER BY `Equipment_Repair_time` ASC ";
$result_KID  = execute_sql($database_name, $sql_KID, $link);	
while ($row_KID   = mysql_fetch_assoc($result_KID))
{

}


?>