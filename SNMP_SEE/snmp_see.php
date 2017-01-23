<?php
//$a = snmpwalk("127.0.0.1", "public", ""); 

$a = snmpwalk("172.21.48.2", "public", ""); 
foreach ($a as $val) {
    echo "$val\n";
	echo '<br>';
}
?>