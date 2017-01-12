<?php

//echo getcwd().'n'.'<br>';

chdir('../../../../home/sk/FTP_upload/');
//chdir('./718_8');

//echo getcwd().'n'.'<br>';
//print_r(glob("*.csv"));
$A= glob("*.zip");
$arr_num= count($A);
for($a=0;$a<=$arr_num;$a++)
	{
	  echo $A[$a].'<br>';
	  $csv_file = $A[$a];
	  chdir('../../../../home/sk/');
	  rename("FTP_upload/".$csv_file,"FTP_upload/rar/".$csv_file);
	}


?>