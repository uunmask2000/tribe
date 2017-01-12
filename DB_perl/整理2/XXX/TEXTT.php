<?php
$s_date="2016-10-01";
$e_date="2016-10-31";
/*
1天=24小時=1440分鐘=86400秒
1小時=60分鐘=3600秒
1分鐘=60秒
*/
echo $s_date;
echo '兩個日期時間 相差 幾天<br/>';
$second1=floor((strtotime($e_date)-strtotime($s_date)));//兩個日期時間 相差 幾秒
echo floor($second1/86400).'天<br/>';
?>