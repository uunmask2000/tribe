<html>
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<SCRIPT type="text/javascript">
			   <!-- 此check()函式在最後的「傳送」案鈕會用到 -->
				function check()
				{
						<!-- 若<form>屬性name值為reg裡的文字方塊值為空字串，則顯示「未輸入姓名」 -->
						if(reg.time_A.value == "") 
						{
								alert("未輸入回覆時間");
						}else if(reg.time_B.value == "") 
						{
								alert("未輸入派工時間");
						}
						/*else if(reg.time_C.value == "") 
						{
								alert("未輸入到達時間");
						}
						*/
						else if(reg.time_D.value == "") 
						{
								alert("未輸入處理時間");
						}else if(reg.time_E.value == "") 
						{
								alert("未輸入結案時間");
						}
						<!-- 若以上條件皆不符合，也就是表單資料皆有填寫的話，則將資料送出 -->
						else reg.submit();
				 }
		</SCRIPT>		
  </head>
  <body>
<?php 
///include("../include/top.php"); 
include_once("../SQL/dbtools.inc.php");
$link = create_connection(); 
?>

<?php
$checkbox_ok  = $_POST['checkbox_ok'] ;  // 繼承前面勾選值
print_r($checkbox_ok);

?>
 <form name="reg" method="post" action="action_page_proc.php">
    <input type="hidden" name="checkbox_ok" value="<?=implode(",",$checkbox_ok);?>">
	<!--首回覆--->
回覆時間：<input name="time_A" type="text" size="16" /> PS 格式為 0000-00-00 00:00:00 <br>
備註 :<textarea style="width:80%;" rows="4" name="item_wrong_text_A" placeholder="備註">無</textarea>  <br>
<!--已派工--->
派工時間：<input name="time_B" type="text" size="16" /> PS 格式為 0000-00-00 00:00:00 <br>
指派工程師：
<select name="accendant_B">
<?php
$sql_Engineer  = "SELECT * FROM `web_user` WHERE `user_engineer_radio` =1 ";
$result_Engineer  = execute_sql($database_name, $sql_Engineer, $link);
while ($row_Engineer  = mysql_fetch_assoc($result_Engineer))
{
?>
<option value="<?=$row_Engineer['user_name'];?>"  selected><?=$row_Engineer['user_name'];?></option>
<?php
}
?>
</select>
<br>
備註：<textarea style="width:80%;" rows="4" name="item_wrong_text_B" placeholder="備註">無</textarea>  <br>
<?php
/*
?>
<!--已到達--->
到達時間：<input name="time_C" type="text" size="16" /> PS 格式為 0000-00-00 00:00:00 <br>
到達工程師：
<select name="accendant_C">
<?php
$sql_Engineer  = "SELECT * FROM `web_user` WHERE `user_engineer_radio` =1 ";
$result_Engineer  = execute_sql($database_name, $sql_Engineer, $link);
while ($row_Engineer  = mysql_fetch_assoc($result_Engineer))
{
?>
<option value="<?=$row_Engineer['user_name'];?>"  selected><?=$row_Engineer['user_name'];?></option>
<?php
}
?>
</select>
<br>
備註：<textarea style="width:98%;" rows="5" name="item_wrong_text_C" placeholder="備註">無</textarea> <br>
<?php
*/
?>	
 <!---處理中--->
處理時間：<input name="time_D" type="text" size="16" /> PS 格式為 0000-00-00 00:00:00 <br>
處理工程師：
<select name="accendant_D">
<?php
$sql_Engineer  = "SELECT * FROM `web_user` WHERE `user_engineer_radio` =1 ";
$result_Engineer  = execute_sql($database_name, $sql_Engineer, $link);
while ($row_Engineer  = mysql_fetch_assoc($result_Engineer))
{
?>
<option value="<?=$row_Engineer['user_name'];?>"  selected><?=$row_Engineer['user_name'];?></option>
<?php
}
?>
</select>
<br>
備註：<textarea style="width:98%;" rows="5" name="item_wrong_text_D" placeholder="備註">無</textarea> <br>
 <!--已結案--->
		結案時間：<input name="time_E" type="text" size="16" /> PS 格式為 0000-00-00 00:00:00 <br>
		結案工程師：
		<select name="accendant_E">
		<?php
		$sql_Engineer  = "SELECT * FROM `web_user` WHERE `user_engineer_radio` =1 ";
		$result_Engineer  = execute_sql($database_name, $sql_Engineer, $link);
		while ($row_Engineer  = mysql_fetch_assoc($result_Engineer))
		{
		?>
		<option value="<?=$row_Engineer['user_name'];?>"  selected><?=$row_Engineer['user_name'];?></option>
		<?php
		}
		?>
		</select>
		<br>
	    備註：<textarea style="width:98%;" rows="5" name="item_wrong_text_E" placeholder="備註">無</textarea><br>


<!-- type值為button而非submit，另外要加上onClick="check()"來判斷以上的表單資料是否有填寫 -->
<input type="button" value="傳送" onClick="check()" /> 
<input type="reset" value="清除" />
</form>
</body>
</html>