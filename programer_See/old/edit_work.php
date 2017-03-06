<!doctype html>
<html lang="zh-TW">
<head>
<meta charset="UTF-8">
<title>無線AP網管系統</title>
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
<link href="../include/style.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<!--頁籤-->
<link href="tab.css" rel="stylesheet" type="text/css"/>

<!---->
<link rel="stylesheet" href="../colorbox_acces/colorbox.css" />
<script src="../colorbox_acces/jquery.colorbox.js"></script>
<script>
$(document).ready(function(){
//Examples of how to assign the Colorbox event to elements

$(".inline_mail").colorbox({inline:true, width:"50%"}); // 首回復
$(".inline_A").colorbox({inline:true, width:"50%"}); // 派工
$(".inline_B").colorbox({inline:true, width:"50%"}); // 派工
$(".inline_C").colorbox({inline:true, width:"50%"}); // 派工
$(".inline_D").colorbox({inline:true, width:"50%"}); // 派工

//Example of preserving a JavaScript event for inline calls.
$("#click").click(function(){ 
$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
return false;
});
});
</script>

<?php
include("../SQL/dbtools.inc.php");
include("../function_php/function_class.php");
$link = create_connection();

?>


<style>

td, th {
    border: 1px solid #ddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) { background: #ddd;}

.workstep {
    margin: 0px auto;
	padding-left: 80px;
}
.workstep a {
    float: left;
    margin: 10px;
	font-size: 1.6em;
}
.workstep a:hover { color:#fff;}

.button, .button_off, .button_ok {
	display: block;
    width: 115px; height: 25px;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;
}

.button { background: #4E9CAF;}
.button:hover { background: #27839a;}
.button_off { background: gray;}


.button_A {
    display: block;
    width: 115px;
    height: 40px;
    background: #4E9CAF;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: #fff;
    font-weight: bold;
}
.button2 {background: #008CBA;}
.button3 {background: #f44336;}
.button4 {background: #e7e7e7; color: black;}
.button5 {background: #555555;}

.button_ok { background: #FFDC35; color: #222;}
a.button_ok:hover { color: #222;}

.c {clear:both;}

.tribe_name, .dis_time, .proc_num, .fix_num, .proc_status, .sendmail_time, .fst_re_time, .fst_re_content { 
border: #aaa 1px solid;font-size:1.2em; padding:10px;
}
.dis_time, .proc_num, .fix_num, .proc_status, .workstep, .sendmail_time, .fst_re_time, .fst_re_content { 
border:#aaa 1px solid;border-top:none;
}

.tribe_name { /*部落設備名稱*/
    margin: 10px 0 0;
    text-align: center;
	font-weight:bold;
    border-radius: 10px 10px 0 0;
    background: #e1faf5;
}
.dis_time { /*服務中斷時間*/

}
.proc_num { /*處理編號*/
    float: left;
    width: 453px;
    padding: 10px;
}
.fix_num { /*叫修編號*/
    float: right;
    width: 452px;
	border-left: none;
}
.proc_status { /*目前處理狀態*/
	clear:both;
	font-weight:bold;
    background: #fae6e1;
	margin: 10px 0 0;
    text-align: center;
}

</style>
</head>
<body>
<div id="wrap">
<!-------------------------------------- TOP -->
	<div id="header">
	<?php
	include("../include/top.php");
	?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">
	<?php include("../alert/alert2.php");?>

	<div id="port_data">

<?php
session_start();
date_default_timezone_set('Asia/Taipei');
$name = $_SESSION['user_name']   ;
$key =$_GET['key'];

if(get_numeric($key) =='NOT')
{
		?>
		<script type="text/javascript">
		alert("錯誤參數");history.back();　 
		</script>
		<?php
	
}else{
	$sql  =  "SELECT * FROM alert_ap_date_filter WHERE alert_ap_date_filter_id='$key' ";
		$result  = execute_sql($database_name, $sql, $link);
		while ($row  = mysql_fetch_assoc($result))
		{
			$alert_ap_date_filter_id = $row['alert_ap_date_filter_id']; //PK		    
			$calling_bar_id      = $row['calling_bar_id']; //事件處理編號
			$Processing_status   = $row['Processing_status'];
			$Period_AP = $row['Period_AP'];
			
			$alert_written_time  = $row['alert_written_time']; //告警發信時間
			$Processing_time_A   = $row['Processing_time_A'];
			$note_A              = $row['note_A'];  
			$Processing_time_B   = $row['Processing_time_B'];
			$note_B              = $row['note_B'];
			$accendant           = $row['accendant'];
			$Processing_time_C   = $row['Processing_time_C'];
			$processing_engineer           = $row['processing_engineer'];
			$note_C              = $row['note_C'];
			$Processing_time_D   = $row['Processing_time_D'];
			$note_D              = $row['note_D'];
			$Processing_time_E   = $row['Processing_time_E'];
			$note_E              = $row['note_E'];
			
			$Processor_A   = $row['Processor_A'];
			$Processor_B   = $row['Processor_B'];
			$Processor_C   = $row['Processor_C'];
			$Processor_D   = $row['Processor_D'];
			$Processor_E   = $row['Processor_E'];
			///
			$alert_ap_date_city   =  $row['alert_ap_date_city'];
			$alert_ap_date_township   =  $row['alert_ap_date_township'];
			$alert_ap_date_tribe   =  $row['alert_ap_date_tribe'];
			$alert_ap_date_ap_name  =  $row['alert_ap_date_ap_name'];
			
		}
	
	
}
//$sql_check  =  "SELECT * FROM  Equipment_Repair  where  Equipment_Repair_number='$key' and Equipment_Repair_type = '01' or Equipment_Repair_type='02'  ";
$sql_check  =  "SELECT * FROM  Equipment_Repair  where  Equipment_Repair_number='$key'  ";
$result_check   = execute_sql($database_name, $sql_check, $link);
$num_rows_check = mysql_num_rows($result_check);

///echo get_numeric($key);
//echo '目前登入者 : '.$name ;



//00 = 派工 01=處理中 02==到達 03=已結案
	$sql_1 =  "SELECT * FROM Equipment_Repair WHERE Equipment_Repair_number='$key'  order by Equipment_Repair_id desc limit 1  ";
	$result_1  = execute_sql($database_name, $sql_1, $link);
	while ($row_1  = mysql_fetch_assoc($result_1))
	{
	   $Closing_time_reference = $row_1['Equipment_Repair_time'];
	   $Closing_Equipment_Repair_engineer_reference = $row_1['Equipment_Repair_engineer'];
	}
//echo $Closing_Equipment_Repair_engineer_reference ;
//echo date("Y-m-d h:i:s");
?>

<div class="tribe_name"><?php echo $alert_ap_date_city .$alert_ap_date_township .$alert_ap_date_tribe .$alert_ap_date_ap_name ;?></div>
<div class="dis_time">服務中斷時間：<?php echo $alert_written_time;?></div>
<div class="proc_num">處理編號：<?php echo $calling_bar_id;?></div>
<div class="fix_num">叫修編號：<?php echo $alert_ap_date_filter_id;?></div>
<div class="proc_status">目前處理狀態：<?=$Processing_status ;?></div>

<!---->

<div class="workstep">
<?php
if($Processing_status=='已發信')
{
	?>
	<a class="inline_mail button" href="#inline_content_mail" title="首回覆">首回覆</a>
	<a class="button_off">派工</a>	
	<a class="button_off">到達</a>
	<a class="button_off">處理</a>
	<a class="button_off">結案</a>
	<?php
}

if($Processing_status=='首回覆'){
	?>
		<a class="button_ok">首回覆</a>
		<a class="inline_A button" href="#inline_content_A" title="派工">派工</a>	
		<a class="button_off">到達</a>
		<a class="button_off">處理</a>
		<a class="button_off">結案</a>
	<?php
}
		if($Processing_status=='已派工' or $Processing_status=='已到達' or $Processing_status=='處理中')
		{
			//if($Closing_Equipment_Repair_engineer_reference==$name)
			if($name==$name)
			{
				//echo 'Match';
				?>
					<a class="button_ok">首回覆</a>
					<a class="button_ok" >派工</a>
					<a class="inline_B button" href="#inline_content_B"  title="到達">到達</a>
					<a class="inline_C button" href="#inline_content_C"  title="處理">處理</a>
					<?php
					//echo $num_rows_check ;
					if($num_rows_check > 3)
					{
					?>
					<a class="inline_D button" href="#inline_content_D"  title="結案">結案</a>
					<?php
					}else{
					?>
					<a class="button_off" >結案</a>
				<?php
				}
		}else{
				?>
					<a class="button_ok" >首回覆</a>
					<a class="button_ok" >派工</a>	
					<a class="button_off" >到達</a>
					<a class="button_off" >處理</a>
					<?php
					if($num_rows_check > 3)
					{
					?>
					<a class="button_off" >結案</a>
				<?php
                }
					//echo 'NOT Match';
					}
					
				}
				if($Processing_status=='已結案'){
				?>
					<a class="button_off" >首回覆</a>
					<a class="button_off" >派工</a>	
					<a class="button_off" >到達</a>
					<a class="button_off" >處理</a>
					<a class="button_off" >結案</a>
				<?php
				}
				?>
<div class="c"></div>
</div>


<div style='display:none'>
	<div id='inline_content_mail' style='padding:10px; background:#fff;'>
	<form action="edit_work_proc.php?mode=mail" method="post">
	信件發送時間：<?=$alert_written_time;?>
	<br>
	回覆時間：  <input  type="text"  name="time"  value="<?=$alert_written_time  ;?>"/> PS 格式為 0000-00-00 00:00:00  <br>					  
	備註 :<textarea style="width:98%;" rows="5" name="item_wrong_text" placeholder="備註"><?=$note_A ;?></textarea>
	<input type="hidden" name="key" value="<?=$alert_ap_date_filter_id ;?>">
	<input type="hidden" name="item_wrong" value="首回覆">
	<input type="hidden" name="title" value="<?=$alert_ap_date_city .$alert_ap_date_township .$alert_ap_date_tribe .$alert_ap_date_ap_name .'服務中斷時間: ' .$alert_written_time  ;?>">
	<input type="hidden" name="Period_AP" value="<?=$Period_AP ;?>">
	<input type="hidden" name="alert_written_time" value="<?=$alert_written_time ;?>">
	<input type="submit" value="確定">
	</form>		
	</div>	
</div>	


<div style='display:none'>
	<div id='inline_content_A' style='padding:10px; background:#fff;'>
	<form action="edit_work_proc.php?mode=0" method="post">
	回覆時間：<?=$Processing_time_A ;?>
	<br>
	派工時間：<input  type="text"  name="time"  value="<?=$Processing_time_A ;?>"/> PS 格式為 0000-00-00 00:00:00  <br>
	指派工程師：
		<select name="accendant">
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
	備註：<textarea style="width:98%;" rows="5" name="item_wrong_text" placeholder="備註"></textarea>
	<input type="hidden" name="key" value="<?=$alert_ap_date_filter_id ;?>">
	<input type="hidden" name="item_wrong" value="已派工">
	<input type="submit" value="確定">
	</form>		
	</div>	
</div>	

<div style='display:none'>

	<div id='inline_content_B' style='padding:10px; background:#fff;'>
	已到達
	<form action="edit_work_proc.php?mode=2" method="post">
	處理時間<input  type="text"  name="time" value="<?=$Closing_time_reference;?>" /> PS 格式為 0000-00-00 00:00:00  <br>
	處理工程師
		<select name="accendant">
		<?php
		$sql_Engineer  = "SELECT * FROM `web_user` WHERE `user_engineer_radio` =1 ";
		$result_Engineer  = execute_sql($database_name, $sql_Engineer, $link);
		while ($row_Engineer  = mysql_fetch_assoc($result_Engineer))
		{
		?>
		<option value="<?=$row_Engineer['user_name'];?>" <?php if($row_Engineer['user_name']==$Closing_Equipment_Repair_engineer_reference  ){echo 'selected';} ?>><?=$row_Engineer['user_name'];?></option>
		<?php
		}
		?>
		</select>
		<br>
	處理內容 :<textarea style="width:98%;" rows="5" name="item_wrong_text" placeholder="處理內容"></textarea>
	<input type="hidden" name="key" value="<?=$alert_ap_date_filter_id ;?>">
	<input type="hidden" name="item_wrong" value="已到達">
	<input type="submit" value="確定">
	</form>	
	</div>

	<div id='inline_content_C' style='padding:10px; background:#fff;'>
	處理
	<form action="edit_work_proc.php?mode=1" method="post">
	處理時間<input  type="text"  name="time" value="<?=$Closing_time_reference ;?>" /> PS 格式為 0000-00-00 00:00:00  <br>
	處理工程師
		<select name="accendant">
		<?php
		$sql_Engineer  = "SELECT * FROM `web_user` WHERE `user_engineer_radio` =1 ";
		$result_Engineer  = execute_sql($database_name, $sql_Engineer, $link);
		while ($row_Engineer  = mysql_fetch_assoc($result_Engineer))
		{
		?>
		<option value="<?=$row_Engineer['user_name'];?>"  <?php if($row_Engineer['user_name']==$Closing_Equipment_Repair_engineer_reference  ){echo 'selected';} ?>><?=$row_Engineer['user_name'];?></option>
		<?php
		}
		?>
		</select>
		<br>
	處理內容 :<textarea style="width:98%;" rows="5" name="item_wrong_text" placeholder="處理內容"></textarea>
	<input type="hidden" name="key" value="<?=$alert_ap_date_filter_id ;?>">
	<input type="hidden" name="item_wrong" value="處理中">
	<input type="submit" value="確定">
	</form>		
	</div>	

	<div id='inline_content_D' style='padding:10px; background:#fff;'>
	結案
	<form action="edit_work_proc.php?mode=3" method="post">
	結案時間  <input  type="text"  name="time" value="<?=$Closing_time_reference ;?>" /> PS 格式為 0000-00-00 00:00:00<br>												
	<br>
	結案工程師
		<select name="accendant">
		<?php
		$sql_Engineer  = "SELECT * FROM `web_user` WHERE `user_engineer_radio` =1 ";
		$result_Engineer  = execute_sql($database_name, $sql_Engineer, $link);
		while ($row_Engineer  = mysql_fetch_assoc($result_Engineer))
		{
		?>
		<option value="<?=$row_Engineer['user_name'];?>"  <?php if($row_Engineer['user_name']==$Closing_Equipment_Repair_engineer_reference  ){echo 'selected';} ?> ><?=$row_Engineer['user_name'];?></option>
		<?php
		}
		?>
		</select>
		<br>
	處理資訊 :<textarea style="width:98%;" rows="5" name="item_wrong_text" placeholder="處理資訊"></textarea>
	<input type="hidden" name="key" value="<?=$alert_ap_date_filter_id ;?>">
	<input type="hidden" name="item_wrong" value="已結案">
	
		<input type="hidden" name="Period_AP" value="<?=$Period_AP ;?>">
	　	<input type="submit" value="確定">
	</form>		
	</div>	
</div>	


<!--------------------------------------------------------->

<div>

<div class="sendmail_time">發信時間：<?=$alert_written_time ;?></div>
<div class="fst_re_time">首回覆時間：<?=$Processing_time_A ;?></div>
<div class="fst_re_content">回覆內容：<?=$note_A ;?></div>

<?php
if($calling_bar_id!=0)
{

		//if($Processor_A==$name)
		if($name==$name)
		{
		//echo 'Match';
		echo '<button onclick="edit_maill()"  class="button_A button2">編輯首回覆</button>';
		}else{
		//echo 'NOT Match';
		echo '<button class="button_A button5" >編輯首回覆</button>';
		}

}
?>


<script>
function edit_maill() {
  window.open("./Frame/edit_caseA.php?key=<?=$_GET['key'];?>", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
}
</script>
</div>

<div class="works_tab">
	<ul class="work_tabs">
		<li><a href="#tab1">派工資訊</a></li>
		<li><a href="#tab2">到場資訊</a></li>
		<li><a href="#tab3">處理資訊</a></li>
		<li><a href="#tab4">結案資訊</a></li>
	</ul>

	<div class="tab_container">

		<div id="tab1" class="tab_content" style="display: block;">
		<table id="show_date" width="100%">
			<tr>
				<th width="120">指派工程師</th>
				<th width="200">時間</th>
				<th>備註</th>
				<th width="120">編輯</th>
			</tr>
				<?php
				$sql_0  =  "SELECT * FROM Equipment_Repair WHERE Equipment_Repair_number='$key' AND Equipment_Repair_type='00' ";
				$result_0  = execute_sql($database_name, $sql_0, $link);
				$num_rows = mysql_num_rows($result_0);
				if($num_rows > 0)
				{
				while ($row_0  = mysql_fetch_assoc($result_0))
				{
				echo '<tr>';
				echo '<td>'.$row_0['Equipment_Repair_engineer'].'</td>';
				echo '<td>'.$row_0['Equipment_Repair_time'].'</td>';
				echo '<td>'.$row_0['Equipment_Repair_remark'].'</td>';
				?>
				<td>
				<?php
					//if($row_0['Equipment_Repair_engineer']==$name)
					if($name==$name)
					{
					//echo 'Match';
					?>
					<a href="#" target="popup" class='button_ok' onclick="window.open('./Frame/edit_case_event_A.php?key=<?=$row_0['Equipment_Repair_id'];?>','name','width=500,height=500')">編輯派工</a>				
					<?php
					}else{
					//echo 'NOT Match';
					?>
					<a href="#" class='button_off' >編輯派工</a>						
					<?php
					}

				?>
				</td>
				<?php
				echo '</tr>';

				}	
				}else{
					echo '<tr>';
					echo '<td colspan="4">目前沒有資料</td>';
						echo '</tr>';
				}
				
				?>
		</table>
		</div>
		
		<div id="tab2" class="tab_content" style="display: none;">
		<table id="show_date" width="100%">
			<tr>
				<th width="120">到場工程師</th>
				<th width="200">時間</th>
				<th>備註</th>
				<th width="120">編輯</th>
			</tr>
				<?php
				$sql_0  =  "SELECT * FROM Equipment_Repair WHERE Equipment_Repair_number='$key' AND Equipment_Repair_type='02' ";
				$result_0  = execute_sql($database_name, $sql_0, $link);
				$num_rows = mysql_num_rows($result_0);
				if($num_rows > 0)
				{
				while ($row_0  = mysql_fetch_assoc($result_0))
				{
				echo '<tr>';
				echo '<td>'.$row_0['Equipment_Repair_engineer'].'</td>';
				echo '<td>'.$row_0['Equipment_Repair_time'].'</td>';
				echo '<td>'.$row_0['Equipment_Repair_remark'].'</td>';
				?>
				<td>
				<?php
				//if($row_0['Equipment_Repair_engineer']==$name)
				if($name==$name)
				{
				//echo 'Match';
				?>
				<a href="#" target="popup" class='button_ok' onclick="window.open('./Frame/edit_case_event_B.php?key=<?=$row_0['Equipment_Repair_id'];?>','name','width=500,height=500')">編輯到場</a>				
				<?php
				}else{
				//echo 'NOT Match';
				?>
				<a href="#" class='button_off' >編輯到場</a>						
				<?php
				}
				?>
				</td>
				<?php
				echo '</tr>';

				}	
				}else{
					echo '<tr>';
					echo '<td colspan="4">目前沒有資料</td>';
						echo '</tr>';
				}
				?>
		</table>
		</div>
		
		
		<div id="tab3" class="tab_content" style="display: none;">
		<table id="show_date" width="100%">
		<tr>
			<th width="120">處理工程師</th>
			<th width="200">時間</th>
			<th>處理內容</th>
			<th width="120">編輯</th>
		</tr>

			<?php
			$sql_0  =  "SELECT * FROM Equipment_Repair WHERE Equipment_Repair_number='$key' AND Equipment_Repair_type='01' ";
			$result_0  = execute_sql($database_name, $sql_0, $link);
			$num_rows = mysql_num_rows($result_0);
			if($num_rows > 0)
			{
			while ($row_0  = mysql_fetch_assoc($result_0))
			{
			echo '<tr>';
			echo '<td>'.$row_0['Equipment_Repair_engineer'].'</td>';
			echo '<td>'.$row_0['Equipment_Repair_time'].'</td>';
			echo '<td>'.$row_0['Equipment_Repair_remark'].'</td>';
			?>
			<td>
			<?php
			//if($row_0['Equipment_Repair_engineer']==$name)
			if($name==$name)
			{
			//echo 'Match';
			?>
			
			<a href="#" target="popup" class='button_ok' onclick="window.open('./Frame/edit_case_event_C.php?key=<?=$row_0['Equipment_Repair_id'];?>','name','width=500,height=500')">編輯處理</a>				
			
			<?php
			}else{
			//echo 'NOT Match';
			?>
			
			<a href="#" class='button_off' >編輯處理</a>
			
			<?php
			}
			?>
			</td>
			<?php
			echo '</tr>';
			}	
			}else{
				echo '<tr>';
				echo '<td colspan="4">目前沒有資料</td>';
					echo '</tr>';
			}
				?>
		</table>
		</div>
		
		<div id="tab4" class="tab_content" style="display: none;">
		<table id="show_date" width="100%">
		<tr>
			<th width="120">結案工程師</th>
			<th width="200">時間</th>
			<th>備註</th>
			<th width="120">編輯</th>
		</tr>
			<?php
				$sql_0  =  "SELECT * FROM Equipment_Repair WHERE Equipment_Repair_number='$key' AND Equipment_Repair_type='03' ";
				$result_0  = execute_sql($database_name, $sql_0, $link);
				$num_rows = mysql_num_rows($result_0);
				if($num_rows > 0)
				{
						while ($row_0  = mysql_fetch_assoc($result_0))
						{
						echo '<tr>';
						echo '<td>'.$row_0['Equipment_Repair_engineer'].'</td>';
						echo '<td>'.$row_0['Equipment_Repair_time'].'</td>';
						echo '<td>'.$row_0['Equipment_Repair_remark'].'</td>';
						?>				
						<td>
							<?php
		//if($row_0['Equipment_Repair_engineer']==$name)
		if($name==$name)
		{
		//echo 'Match';
		?>
		<a href="#" target="popup" class='button_ok' onclick="window.open('./Frame/edit_case_event_D.php?key=<?=$row_0['Equipment_Repair_id'];?>','name','width=500,height=500')">編輯結案</a>				
		<?php
		}else{
		//echo 'NOT Match';
		?>
		<a href="#" class='button_off' >編輯結案</a>						
		<?php
		}


		?>
		</td>
		<?php
		echo '</tr>';
		}	
		}else{
		echo '<tr>';
		echo '<td colspan="4">目前沒有資料</td>';
		echo '</tr>';
		}
		?>

		</table>
		</div>

	</div>
</div>

	<button onclick="myFunction()">返回</button>
	</div>

	</div>

<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</div>
</body>
<script>
function myFunction() {
  window.location.assign("show_AP_date_form_2.php?A=<?=$Period_AP;?>");
}
</script>
<script type="text/javascript">
	$(function(){
		var _showTab = 0;
		var $defaultLi = $('ul.tabs li').eq(_showTab).addClass('active');
		$($defaultLi.find('a').attr('href')).siblings().hide();

		$('ul.work_tabs li').click(function() {

			var $this = $(this),
				_clickTab = $this.find('a').attr('href');

			$this.addClass('active').siblings('.active').removeClass('active');

			$(_clickTab).stop(false, true).fadeIn().siblings().hide();

			return false;
		}).find('a').focus(function(){
			this.blur();
		});
	});
</script>
</html>