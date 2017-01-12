<?php

echo "remove file<br>";
$files = scandir(dirname(__FILE__));
$num_files = count($files);
echo "$num_files files<br>";
for($i=2; $i<$num_files; $i++){
	$file = $files[$i];
	echo "$i: $file<br>";
	if($file =='Del_file.php')
	{
		//echo 'NODel';
		//echo '<br>';
	}else{
		//echo 'Del';
		//echo '<br>';
		unlink($file);
	}
	//unlink($file);
}




?>