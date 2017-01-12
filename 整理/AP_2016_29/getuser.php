<?php
$q=$_GET["q"];

$con = mysql_connect('localhost', 'root', '0932969495');
if (!$con)
 {
 die('Could not connect: ' . mysql_error());
 }

mysql_select_db("AP_data", $con);

//$sql="SELECT * FROM CPU_check WHERE CPU_check_id = '".$q."'";
$sql="SELECT * FROM `CPU_check` ORDER by `CPU_check_id` desc LIMIT 8";
$result = mysql_query($sql);

echo "<table border='1'>
<tr>
<th>CPU_no</th>
<th>CPU_user</th>
<th>CPU_nice</th>
<th>CPU_sys</th>
<th>CPU_idle</th>
</tr>";

while($row = mysql_fetch_array($result))
 {
 echo "<tr>";
 echo "<td>" . $row['CPU_no'] . "</td>";
 echo "<td>" . $row['CPU_user'] . "</td>";
 echo "<td>" . $row['CPU_nice'] . "</td>";
 echo "<td>" . $row['CPU_sys'] . "</td>";
 echo "<td>" . $row['CPU_idle'] . "</td>";
 echo "</tr>";
 }
echo "</table>";

mysql_close($con);
?>

