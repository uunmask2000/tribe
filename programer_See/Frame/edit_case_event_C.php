<!DOCTYPE html>  
<html>  
<head>  
<title>編輯處理資訊:</title> 
</head>  
<body>  
<!---------------------->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/hot-sneaks/jquery-ui.css" rel="stylesheet">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="../../report_bnf_new_2/jquery/jquery.ui.datepicker-zh-TW.js"></script>
<!--datepicker 小工具, 再加上時間選擇器--->
<link href="../timepicker_include/jquery-ui-timepicker-addon.css" rel="stylesheet"></link>
<script src="../timepicker_include/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
<script src="../timepicker_include/jquery-ui-sliderAccess.js" type="text/javascript"></script>
<script>
$(function() 
{
//Draggable + JQ  : 時間選器拖曳
$( "#ui-datepicker-div" ).draggable();
});
</script>
<?php
include("../../SQL/dbtools.inc.php");
include("../../function_php/function_class.php");
$link = create_connection();

?>
<script language="javascript">setTimeout("self.opener = null; self.close();",60000)</script>
		<?php
		session_start();
		date_default_timezone_set('Asia/Taipei');
		$name = $_SESSION['user_name']   ;
		?>
		<?php
		//echo '目前登入者 : '.$name ;
		?>
		
		<?php
		if($_GET['mode']=='do')
		{
			
				$key   =$_POST['key'];
				$time  =$_POST['time'];
				$accendant = $_POST['accendant'];
				$Equipment_Repair_remark  =$_POST['Equipment_Repair_remark'];
			
			
			$sql = "UPDATE  Equipment_Repair SET Equipment_Repair_time='$time',Equipment_Repair_remark='$Equipment_Repair_remark', Equipment_Repair_engineer='$accendant' WHERE Equipment_Repair_id='$key' ";
			execute_sql($database_name, $sql, $link);
			//echo $sql;
			//exit();
			?>
			<script>opener.location.reload();window.close();</script>
			<?php
		
			exit();		
		}
		
		?>
		<?php
		
		$key =$_GET['key'];

				if(get_numeric($key) =='NOT')
				{
				?>
				<script type="text/javascript">
				alert("錯誤參數");history.back();　 
				</script>
				<?php

				}else{

					$sql  =  "SELECT * FROM Equipment_Repair WHERE Equipment_Repair_id='$key' ";
					$result  = execute_sql($database_name, $sql, $link);
					while ($row  = mysql_fetch_assoc($result))
					{
					$Equipment_Repair_id = $row['Equipment_Repair_id']; //PK		
					$Equipment_Repair_time  = $row['Equipment_Repair_time']; //告警發信時間
					$Equipment_Repair_engineer  = $row['Equipment_Repair_engineer'];  
					$Equipment_Repair_remark   = $row['Equipment_Repair_remark'];
					
					}	
				
				
				
							?>
<form action="?mode=do" method="POST">
處理時間  <input  type="text"  name="time" id="start_date"  value="<?=$Equipment_Repair_time ;?>"/> PS 格式為 0000-00-00 00:00:00  <br>
	處理工程師
	<select name="accendant">
	<?php
	$sql_Engineer  = "SELECT * FROM `web_user` WHERE `user_engineer_radio` =1";
	$result_Engineer  = execute_sql($database_name, $sql_Engineer, $link);
	while ($row_Engineer  = mysql_fetch_assoc($result_Engineer))
	{
	?>
	<option value="<?=$row_Engineer['user_name'];?>"  <?php if($row_Engineer['user_name']==$Equipment_Repair_engineer  ){echo 'selected';} ?>><?=$row_Engineer['user_name'];?></option>
	<?php
	}
	?>
	</select>
	<br>
	處理內容 :<textarea style="width:98%;" rows="5" name="Equipment_Repair_remark" placeholder="處理內容"><?=$Equipment_Repair_remark;?></textarea>
	<input type="hidden" name="key" value="<?=$Equipment_Repair_id ;?>">
	<input type="submit" value="確定">
</form>
							<?php

				}
		
		
		?>
		
		
		
		
		
		
	<script language="JavaScript">
	/*							
	$('#start_date').datepicker({
	dateFormat: 'yy-mm-dd'
	});
	*/
	var opt={
	//以下為日期選擇器部分
	dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
	dayNamesMin:["日","一","二","三","四","五","六"],
	monthNames:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
	monthNamesShort:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
	prevText:"上月",
	nextText:"次月",
	weekHeader:"週",
	showMonthAfterYear:true,
	dateFormat:"yy-mm-dd",
	//以下為時間選擇器部分
	timeOnlyTitle:"選擇時分秒",
	timeText:"時間",
	hourText:"時",
	minuteText:"分",
	secondText:"秒",
	millisecText:"毫秒",
	timezoneText:"時區",
	currentText:"現在時間",
	closeText:"確定",
	amNames:["上午","AM","A"],
	pmNames:["下午","PM","P"],
	timeFormat:"HH:mm:ss"
	//timeFormat:"HH:mm"
	};
	$("#start_date").datetimepicker(opt);
</script>	

	
		
		
		
</body>  
</html>  