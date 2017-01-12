<?php
$dir2 = getcwd() ;
// 全部
$dir = "./PHPExcel/Examples/Fire_down/A";
chdir($dir);

//chdir('./718_8');

///echo getcwd().'n'.'<br>';
$A= glob("*.xlsx");
//print_r($A);
foreach ($A as $key => $value1 ) 
{
    //echo "Current value of \$a: $v.\n";
	echo  '排序:'.($key+1);
	echo '<a href="download.php?mode=A&file='.$value1.'">'.$value1.'</a>';
	//echo $value ;

	echo '<br>';
}
unset($value1); // break the reference with the last element
chdir($dir2);
?>
<?php
// 部落
$dir = "./PHPExcel/Examples/Fire_down/B";
chdir($dir);

//chdir('./718_8');

///echo getcwd().'n'.'<br>';
$B= glob("*.xlsx");
//print_r($A);
foreach ($B as $key => $value2 ) 
{
    //echo "Current value of \$a: $v.\n";
	echo  '排序:'.($key+1);
	echo '<a href="download.php?mode=B&file='.$value2.'">'.$value2.'</a>';
	//echo $value ;

	echo '<br>';
}
unset($value2); // break the reference with the last element
chdir($dir2);
?>
<?php
// 台灣
$dir = "./PHPExcel/Examples/Fire_down/C";
chdir($dir);

//chdir('./718_8');

///echo getcwd().'n'.'<br>';
$C= glob("*.xlsx");
//print_r($A);
foreach ($C as $key => $value3 ) 
{
    //echo "Current value of \$a: $v.\n";
	echo  '排序:'.($key+1);
	echo '<a href="download.php?mode=C&file='.$value3.'">'.$value3.'</a>';
	//echo $value ;

	echo '<br>';
}
unset($value3); // break the reference with the last element
chdir($dir2);
?>