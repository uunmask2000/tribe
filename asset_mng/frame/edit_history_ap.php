<?php
include_once("../../SQL/dbtools.inc.php");
$link = create_connection(); 
		
$uid = $_GET['uid'];




?>


<?php
if (is_numeric ($uid)) {
   // echo "這是一個整數";
	$sql = "SELECT * FROM ass_change_ap where ass_change_id_ap='$uid' ";
	$result = execute_sql($database_name, $sql, $link);
	while ($row = mysql_fetch_assoc($result))
	{
   
   ?>
		<form action="edit_history_proc.php?case=AP" method="POST">
		資產名稱: <input type="text" name="ass_change_name_ap"   value="<?=$row['ass_change_name_ap'];?>"><br>
		S/N: <input type="text" name="ass_change_sn_ap"   value="<?=$row['ass_change_sn_ap'];?>"><br>
		MAC: <input type="text" name="ass_change_mac_ap"   value="<?=$row['ass_change_mac_ap'];?>"><br>
		P/N: <input type="text" name="ass_change_pn_ap"   value="<?=$row['ass_change_pn_ap'];?>"><br>
		期別: <select name="ass_change_label_ap">
			　<option value="2"  <?php if($row['ass_change_label_ap'] == '2'){ echo 'selected';}?> >二期</option>
			　<option value="3"  <?php if($row['ass_change_label_ap'] == '3'){ echo 'selected';}?> >三期</option>
			</select><br>
		<input type="hidden" name="ass_change_id_ap"  value="<?=$row['ass_change_id_ap'];?>">	
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