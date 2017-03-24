<?php
include("../SQL/dbtools.inc.php");
$link = create_connection();
?>

<?php

$key  = $_GET['id'];
if(is_numeric($key))
{
	//echo '是數字';
		$sql2="SELECT * FROM Project  where Project_id='$key' ";
		$result2 = execute_sql($database_name, $sql2, $link);
		while ($row = mysql_fetch_assoc($result2) )
		{
		/*
		Project_id
		Project_name
		Project_number
		Project_time
		*/
		$Project_id = $row['Project_id'] ;
		$Project_name = $row['Project_name'] ;
		$Project_number = $row['Project_number'] ;
		//$Project_time = $row['Project_time'] ;
		}
	?>
		<form action="Project_proc.php?mode=fix" method="post">
			專案名稱: <input type="text" name="Project_name" value="<?=$Project_name ;?>">
			<br>
			專案對應數字: <input type="number" name="Project_number" value="<?=$Project_number ;?>">
			<input type="hidden" name="key" value="<?=$Project_id ;?>">
			<input type="hidden" name="Project_name_check" value="<?=$Project_number ;?>">
		　<input type="submit" value="送出表單">
		</form>
	
	
	
	<?php
}else{
	echo '<script>history.back();</script>';
}


?>