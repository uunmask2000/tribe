<?php
include_once("../../SQL/dbtools.inc.php");
$link = create_connection(); 
		
$uid = $_GET['uid'];




?>


<?php
if (is_numeric ($uid)) {
   // echo "這是一個整數";
	$sql = "SELECT * FROM ass_change_other where ass_change_id_other='$uid' ";
	$result = execute_sql($database_name, $sql, $link);
	while ($row = mysql_fetch_assoc($result))
	{
   
   ?>
		<form action="edit_history_proc.php?case=other" method="POST">
		資產名稱: <input type="text" name="ass_change_name_other"   value="<?=$row['ass_change_name_other'];?>"><br>
		S/N: <input type="text" name="ass_change_sn_other"   value="<?=$row['ass_change_sn_other'];?>"><br>
		MAC: <input type="text" name="ass_change_mac_other"   value="<?=$row['ass_change_mac_other'];?>"><br>
		P/N: <input type="text" name="ass_change_pn_other"   value="<?=$row['ass_change_pn_other'];?>"><br>
		期別: <select name="ass_change_label_other">
			　<option value="2"  <?php if($row['ass_change_label_other'] == '2'){ echo 'selected';}?> >二期</option>
			　<option value="3"  <?php if($row['ass_change_label_other'] == '3'){ echo 'selected';}?> >三期</option>
			</select><br>
		<input type="hidden" name="ass_change_id_other"  value="<?=$row['ass_change_id_other'];?>">	
		<input type="submit" value="修改">
		</form>
   
   
   
   <?php
	}
   
   
} else {
   // echo "這不是整數";
   echo '<script>';
   echo 'alert("參數錯誤");window.opener=null;window.close();';
   echo '</script>';
}



?>