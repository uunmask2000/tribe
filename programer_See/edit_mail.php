<!DOCTYPE html>
<html>
<head>
	<title>無線AP網管系統</title>
	<link href="../include/style.css" rel="stylesheet" type="text/css" />
	<link href="../include/reset.css" rel="stylesheet" type="text/css" />

<!---------------------->
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/hot-sneaks/jquery-ui.css" rel="stylesheet">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="../report_bnf_new_2/jquery/jquery.ui.datepicker-zh-TW.js"></script>
<!--datepicker 小工具, 再加上時間選擇器--->
<link href="timepicker_include/jquery-ui-timepicker-addon.css" rel="stylesheet"></link>
<script src="timepicker_include/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
<script src="timepicker_include/jquery-ui-sliderAccess.js" type="text/javascript"></script>
		<script>
		$(function() 
		{
		//Draggable + JQ  : 時間選器拖曳
		$( "#ui-datepicker-div" ).draggable();
		});
		</script>
<?php
include("../SQL/dbtools.inc.php");
$link = create_connection();
//include("../SQL/dbtools_ps_2.php");
//$conn= create_ps_connection();
//Mail
require_once('../mail_fulsion/mail/PHPMailer/PHPMailerAutoload.php');
require_once('../mail_fulsion/mail/PHPMailer/mail_send_gmail.php');




?>

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
date_default_timezone_set('Asia/Taipei');
$name = $_SESSION['user_name']   ;
if($_GET['mode']=='sennd_mail_A' )
{
		

		$key   =$_POST['key'];
		$item_wrong_text  =$_POST['item_wrong_text'];
		$item_wrong  =$_POST['item_wrong'];
		$title  =$_POST['title'];
		
			$re_time  = $_POST['re_time'];　;
			//$re_time  = str_replace ("-","",$re_time);
			//$re_time  = str_replace (":","",$re_time);
			//$re_time  = preg_replace('/\s(?=)/', '', $re_time);  // 刪除 -  : 等
		$re_time = substr($re_time, 0, strpos($re_time, ' '));
		$re_time  = str_replace ("-","",$re_time);
		$re_time  = preg_replace('/\s(?=)/', '', $re_time);  // 刪除 -  : 等
			$sql_query  = "SELECT * FROM alert_ap_date_filter WHERE calling_bar_id LIKE '%$re_time%'";
			$result_query  = execute_sql($database_name, $sql_query, $link);
		    $total_row = mysql_num_rows($result_query);  // 取得結果筆數 
			$total_row = ( $total_row +1 ) ;
		//echo $sql_query;
		
		
		
		$re_time  =   $re_time.str_pad($total_row,3,'0',STR_PAD_LEFT) ;
		
		//echo $re_time;
		//exit();
		if(empty($item_wrong))
		{
			?>
			<script type="text/javascript">
			alert("未選擇類型");history.back();　 
			</script>
			<?php
			exit();
			
		}else if($item_wrong_text==NULL)
		{
			?>
			<script type="text/javascript">
			alert("未填寫處理方式");history.back();　 
			</script>
			<?php
			exit();
			
		} 
				
			$mail_title1 = "愛部落" ;
			$mail_title2 = "愛部落網管<回報>" ;
			$mail->From = 'itribe2016@gamil.com';
			$mail->FromName = $mail_title1;
			$mail->Subject = $mail_title2;
			$mail->Body = 	'處理編號 : '.$re_time.'<br>問題設備 : '.$title.'<br>選擇項目   :  '.$item_wrong.'<br>內容   :   '.$item_wrong_text;
			$mail->IsHTML(true);
			$mail->AddAttachment("", "");
					$mail->AddAddress('seanchen@tiis.com.tw','seanchen');
					$mail->AddAddress('frankchang@tiis.com.tw','Frank');
					$mail->AddAddress('danielwu@tiis.com.tw','Daniel');
					$mail->AddAddress('yashon@tecom.com.tw','Yashon');
				//$mail->AddAddress('uunmask2000@gmail.com','康康');				//收件者信箱
				//$mail->AddAddress('danielwu@tiis.com.tw','danielwu');				//總PM收件者信箱
				$addressCC = "uunmask2000@gmail.com";
				$mail->AddBCC($addressCC, '康康');


		
	
		//exit;
		if(!$mail->Send())
		{
		echo "<p align=center>傳送Error1: ".$errorx=$mail->ErrorInfo."</p>";
		}else
		{	

		echo "<p align=center><b>傳送成功。</b></p>";
		}
		
		
		//$Processing_time_A = date("Y-m-d H:i:s"); 
		$Processing_time_A = $_POST['re_time'];  // 手動填寫
		//$calling_bar_id = date("YmdHis"); 
		$calling_bar_id = $re_time;   // 手動填寫
	
		//Processing_time_A
				//$sql = "UPDATE  alert_ap_date_filter SET mail_type_re='1' WHERE alert_ap_date_filter_id='$key' ";
				$sql = "UPDATE  alert_ap_date_filter SET Processing_status='首回覆' ,Processing_time_A='$Processing_time_A',note_A='$item_wrong_text',calling_bar_id='$calling_bar_id',calling_bar_id_check='$calling_bar_id',Processor_A='$name' WHERE alert_ap_date_filter_id='$key' ";
				execute_sql($database_name, $sql, $link);
				//echo $sql ;
				$Period_AP  =$_POST['Period_AP'];
				//header('Location: show_AP_date_form.php?A='.$Period_AP);
				?>
				<script>
				window.location = 'show_AP_date_form.php?A=<?=$Period_AP ;?>';
				</script>
				<?php
				//exit;
	
}else if($_GET['mode']=='sennd_mail_B' )
{
			$key   = trim($_POST['key']);
		    $item_wrong  = trim($_POST['item_wrong']);
			$item_wrong_text  = trim($_POST['item_wrong_text']);
		    $time = trim($_POST['time']);
		    $accendant = trim($_POST['accendant']);
		
			if(empty($time))
			{
			?>
			<script type="text/javascript">
			alert("未填寫時間");history.back();　 
			</script>
			<?php
			exit();

			}else if($accendant==NULL)
			{
			?>
			<script type="text/javascript">
			alert("未填寫維護人員");history.back();　 
			</script>
			<?php	
			}	
			else if($item_wrong_text==NULL)
			{
			?>
			<script type="text/javascript">
			alert("未填寫處理方式");history.back();　 
			</script>
			<?php
			exit();

			}
			
			$sql = "UPDATE  alert_ap_date_filter SET Processing_status='$item_wrong' ,Processing_time_B='$time',note_B='$item_wrong_text',accendant='$accendant',Processor_B='$name' WHERE alert_ap_date_filter_id='$key' ";
			execute_sql($database_name, $sql, $link);
			//echo $sql ;
			$Period_AP  =$_POST['Period_AP'];
				//header('Location: show_AP_date_form.php?A='.$Period_AP);
				?>
				<script>
				window.location = 'show_AP_date_form.php?A=<?=$Period_AP ;?>';
				</script>
				<?php
			//exit;
	
	exit;
}else if($_GET['mode']=='sennd_mail_C' )
{
			$key   = trim($_POST['key']);
		    $item_wrong  = trim($_POST['item_wrong']);
			$item_wrong_text  = trim($_POST['item_wrong_text']);
		    $time = trim($_POST['time']);
			$processing_engineer = trim($_POST['processing_engineer']);
			if(empty($time))
			{
			?>
			<script type="text/javascript">
			alert("未填寫時間");history.back();　 
			</script>
			<?php
			exit();

			}else if($item_wrong_text==NULL)
			{
			?>
			<script type="text/javascript">
			alert("未填寫處理方式");history.back();　 
			</script>
			<?php
			exit();

			}
			
			$sql = "UPDATE  alert_ap_date_filter SET Processing_status='$item_wrong' ,Processing_time_C='$time',processing_engineer='$processing_engineer',note_C='$item_wrong_text',Processor_C='$name' WHERE alert_ap_date_filter_id='$key' ";
			execute_sql($database_name, $sql, $link);
			//echo $sql ;
			$Period_AP  =$_POST['Period_AP'];
				//header('Location: show_AP_date_form.php?A='.$Period_AP);
				?>
				<script>
				window.location = 'show_AP_date_form.php?A=<?=$Period_AP ;?>';
				</script>
				<?php
			//exit;
	
	exit;
}else if($_GET['mode']=='sennd_mail_D' )
{
			$key   = trim($_POST['key']);
		    $item_wrong  = trim($_POST['item_wrong']);
			$item_wrong_text  = trim($_POST['item_wrong_text']);
		    $time = trim($_POST['time']);
			if(empty($time))
			{
			?>
			<script type="text/javascript">
			alert("未填寫時間");history.back();　 
			</script>
			<?php
			exit();

			}else if($item_wrong_text==NULL)
			{
			?>
			<script type="text/javascript">
			alert("未填寫處理方式");history.back();　 
			</script>
			<?php
			exit();

			}
			
			$item_wrong_text = '處理時間 : '.$time.'處理內容: '.$item_wrong_text.'<br>';
			$note_D = trim($_POST['note_D']);
			$Processing_time_D = $_POST['Processing_time_D'];
			$item_wrong_text = $note_D.'處理時間 : '.$time.'處理內容: '.$item_wrong_text;
			
			if($Processing_time_D !='0000-00-00 00:00:00')
			{
				//echo '不等於0';
				//exit();
					$sql = "UPDATE  alert_ap_date_filter SET Processing_status='$item_wrong' ,note_D='$item_wrong_text',Processor_D='$name' WHERE alert_ap_date_filter_id='$key' ";
					execute_sql($database_name, $sql, $link);
					//echo $sql ;
					$Period_AP  =$_POST['Period_AP'];	
			}else{
				//echo '等於0';
				//exit();
			$sql = "UPDATE  alert_ap_date_filter SET Processing_status='$item_wrong' ,Processing_time_D='$time',note_D='$item_wrong_text',Processor_D='$name' WHERE alert_ap_date_filter_id='$key' ";
			execute_sql($database_name, $sql, $link);
			//echo $sql ;
			$Period_AP  =$_POST['Period_AP'];	
				
			}
		
				//header('Location: show_AP_date_form.php?A='.$Period_AP);
				?>
				<script>
				window.location = 'show_AP_date_form.php?A=<?=$Period_AP ;?>';
				</script>
				<?php
			//exit;
	
	exit;
}else if($_GET['mode']=='sennd_mail_E' )
{
			$key   = trim($_POST['key']);
		    $item_wrong  = trim($_POST['item_wrong']);
			$item_wrong_text  = trim($_POST['item_wrong_text']);
		    $time = trim($_POST['time']);
			if(empty($time))
			{
			?>
			<script type="text/javascript">
			alert("未填寫時間");history.back();　 
			</script>
			<?php
			exit();

			}else if($item_wrong_text==NULL)
			{
			?>
			<script type="text/javascript">
			alert("未填寫處理方式");history.back();　 
			</script>
			<?php
			exit();

			}
			
			$sql = "UPDATE  alert_ap_date_filter SET Processing_status='$item_wrong' ,Processing_time_E='$time',note_E='$item_wrong_text',Processor_E='$name' WHERE alert_ap_date_filter_id='$key' ";
			execute_sql($database_name, $sql, $link);
			//echo $sql ;
			$Period_AP  =$_POST['Period_AP'];
				//header('Location: show_AP_date_form.php?A='.$Period_AP);
				?>
				<script>
				window.location = 'show_AP_date_form.php?A=<?=$Period_AP ;?>';
				</script>
				<?php
			//exit;
	
	exit;
}

?>

<?php
$KEY = $_GET['key'];

if( intval( $KEY ) )
{

			$sql_alert_ap_date  = "SELECT * FROM `alert_ap_date_filter` WHERE `alert_ap_date_filter_id` = '$KEY' ";
			$result_alert_ap_date  = execute_sql($database_name, $sql_alert_ap_date, $link);
			while ($row_alert_ap_date  = mysql_fetch_assoc($result_alert_ap_date))
			{
				$alert_ap_date_filter_id   =  $row_alert_ap_date['alert_ap_date_filter_id'];
				$alert_ap_date_city   =  $row_alert_ap_date['alert_ap_date_city'];
				$alert_ap_date_township   =  $row_alert_ap_date['alert_ap_date_township'];
				$alert_ap_date_tribe   =  $row_alert_ap_date['alert_ap_date_tribe'];
				$alert_ap_date_ap_name  =  $row_alert_ap_date['alert_ap_date_ap_name'];
				$title  =  $alert_ap_date_city .$alert_ap_date_township .$alert_ap_date_tribe .$alert_ap_date_ap_name ;
				$Processing_status =  $row_alert_ap_date['Processing_status'];
				$Period_AP =  $row_alert_ap_date['Period_AP'];
				$alert_written_time  = $row_alert_ap_date['alert_written_time']; //告警發信時間
				
				$note_D =  $row_alert_ap_date['note_D'];
				$Processing_time_D  =  $row_alert_ap_date['Processing_time_D'];
				//$note_D =  str_replace ("<br>","",$row_alert_ap_date['note_D']); ;
			}
    
	  // echo $alert_ap_date_city .$alert_ap_date_township .$alert_ap_date_tribe .$alert_ap_date_ap_name  ;
	   
	  switch ($Processing_status) 
					{							
					case '已發信':
					//echo "已發信";
					?>
					
					<div class="place_time"><?=$alert_ap_date_city .$alert_ap_date_township .$alert_ap_date_tribe .$alert_ap_date_ap_name .'服務中斷時間: ' .$alert_written_time  ;?></div>
					<div class="common_img"></div>
					
					<form action="?mode=sennd_mail_A" method="POST">
					
					<table cellpadding="5" cellspacing="0" class="edit" width="500">
					<tr>
						<th>
							<select name="item_wrong">
								<option value="首回覆" selected >首回覆</option>
							</select>
						</th>
						<th>回覆時間 
						<input id="start_date" type="text"  name="re_time" value="<?php echo date("Y-m-d H:i:s ")?>" />
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
								//timeFormat:"HH:mm:ss"
								timeFormat:"HH:mm"
								};
								$("#start_date").datetimepicker(opt);
								
							</script>
						
						</th>
					</tr>
					
					<tr><td colspan="2">
					<textarea style="width:98%;" rows="5" name="item_wrong_text" placeholder="處理內容"></textarea>
					</td></tr>
					
					<tr>
						<td colspan="2" align="center">
						<input class="edit_btn" type="submit" value="送出">
						<input class="edit_btn" type="button" onclick="history.back()" value="回上頁">
						</td>
					</tr>
					</table>
					<input type="hidden" name="key" value="<?=$alert_ap_date_filter_id ;?>">
					<input type="hidden" name="title" value="<?=$title ;?>">
					<input type="hidden" name="Period_AP" value="<?=$Period_AP ;?>">
					</form>
					
					<?php
					break;
					
					case '首回覆':
					?>
					
					<div class="place_time"><?=$alert_ap_date_city .$alert_ap_date_township .$alert_ap_date_tribe .$alert_ap_date_ap_name .'服務中斷時間: ' .$alert_written_time  ;?></div>
					<div class="common_img"></div>
					
					<form action="?mode=sennd_mail_B" method="POST">
					<table cellpadding="5" cellspacing="0" class="edit" style="width:700px;">
					
					<tr>
						<th>
							<select name="item_wrong">
									<option value="已派工" selected >已派工</option>
							</select>
						</th>
						
						<th>回覆時間 
						<input id="start_date" type="text"  name="time" />

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
								//timeFormat:"HH:mm:ss"
								timeFormat:"HH:mm"
								};
								$("#start_date").datetimepicker(opt);
							</script>
						</th>
					</tr>
					
					<tr>
						<td>派工工程師</td>
						<td>
						<select name="accendant">
						<?php
							$sql_Engineer  = "SELECT * FROM Maintenance_Engineer_menu ";
							$result_Engineer  = execute_sql($database_name, $sql_Engineer, $link);
							while ($row_Engineer  = mysql_fetch_assoc($result_Engineer))
							{
								?>
									<option value="<?=$row_Engineer['Maintenance_Engineer_menu_name'];?>"  selected><?=$row_Engineer['Maintenance_Engineer_menu_name'];?></option>
								<?php

							}
						
						
						?>
						</select>
						</td>
					</tr>

					<tr><td colspan="2">
					<textarea style="width:98%;" rows="5" name="item_wrong_text" placeholder="處理內容"></textarea>
					</td></tr>
					
					<tr>
						<td colspan="2" align="center">
						<input class="edit_btn" type="submit" value="送出">
						<input class="edit_btn" type="button" onclick="history.back()" value="回上頁">
						</td>
					</tr>
					</table>
					<input type="hidden" name="key" value="<?=$alert_ap_date_filter_id ;?>">
					<input type="hidden" name="Period_AP" value="<?=$Period_AP ;?>">						
					
					</form>
					
					<?php
					break;
				
					case '已派工':
					?>
					
					<div class="place_time"><?=$alert_ap_date_city .$alert_ap_date_township .$alert_ap_date_tribe .$alert_ap_date_ap_name .'服務中斷時間: ' .$alert_written_time  ;?></div>
					<div class="common_img"></div>
					
					<form action="?mode=sennd_mail_C" method="POST">
					<table cellpadding="5" cellspacing="0" class="edit">
					<tr>
						<th colspan="2">
							<select name="item_wrong">
							<option value="已到達" selected >已到達</option>
							</select>
						</th>
					</tr>
					
					<tr>
						<td>到達時間</td>
						<td>
						<input id="start_date" type="text"  name="time" />

							<script language="JavaScript">
								//						
								//$('#start_date').datepicker({
								//dateFormat: 'yy-mm-dd'
								//});
								//
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
								//timeFormat:"HH:mm:ss"
								timeFormat:"HH:mm"
								};
								$("#start_date").datetimepicker(opt);
							</script>
						</td>
					</tr>
					<tr>
						<td>到場工程師</td>
						<td>
						<select name="processing_engineer">
						<?php
							$sql_Engineer  = "SELECT * FROM Maintenance_Engineer_menu ";
							$result_Engineer  = execute_sql($database_name, $sql_Engineer, $link);
							while ($row_Engineer  = mysql_fetch_assoc($result_Engineer))
							{
								?>
									<option value="<?=$row_Engineer['Maintenance_Engineer_menu_name'];?>"  selected><?=$row_Engineer['Maintenance_Engineer_menu_name'];?></option>
								<?php

							}
						
						
						?>
						</select>
						</td>
					</tr>
					
					<tr><td colspan="2">
					<textarea style="width:98%;" rows="5" name="item_wrong_text" placeholder="到場內容"></textarea>
					</td></tr>

					<tr>
						<td colspan="2" align="center">
						<input class="edit_btn" type="submit" value="送出">
						<input class="edit_btn" type="button" onclick="history.back()" value="回上頁">
						</td>
					</tr>
					</table>
					<input type="hidden" name="key" value="<?=$alert_ap_date_filter_id ;?>">	
					<input type="hidden" name="Period_AP" value="<?=$Period_AP ;?>">						
					</form>
					
					<?php
					break;
			
					case '已到達':
				//case '已派工':	
					?>
					
					<div class="place_time"><?=$alert_ap_date_city .$alert_ap_date_township .$alert_ap_date_tribe .$alert_ap_date_ap_name .'服務中斷時間: ' .$alert_written_time  ;?></div>
					<div class="common_img"></div>
					
					<form action="?mode=sennd_mail_D" method="POST">
					<table cellpadding="5" cellspacing="0" class="edit">
					
					<tr>
						<th colspan="2">
							<select name="item_wrong">
								<option value="已到達" selected >持續處理中</option>
								<option value="處理中"  >結案流程</option>
							</select>
						</th>
					</tr>

					<tr>
						<td>處理時間</td>
						<td>
						<input id="start_date" type="text"  name="time" />

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
								//timeFormat:"HH:mm:ss"
								timeFormat:"HH:mm"
								};
								$("#start_date").datetimepicker(opt);
							</script>
						</td>
					</tr>

					<tr>
					<td colspan="2">
					<textarea style="width:98%;" rows="5" name="item_wrong_text" placeholder="處理內容"></textarea>
					</td>
					</tr>
							<tr>
							<td colspan="2">
							<p>
							<?=$note_D;?>
							
							<input type="hidden" name="note_D" value="<?=$note_D;?>">
							</p>
							</td>
							</tr>
					<tr>
						<td colspan="2" align="center">
						<input class="edit_btn" type="submit" value="送出">
						<input class="edit_btn" type="button" onclick="history.back()" value="回上頁">
						</td>
					</tr>
					</table>
					<input type="hidden" name="Processing_time_D" value="<?=$Processing_time_D;?>">
					<input type="hidden" name="key" value="<?=$alert_ap_date_filter_id ;?>">
					<input type="hidden" name="Period_AP" value="<?=$Period_AP ;?>">						
					</form>
					
					<?php
					
					break;
					
					case '處理中':
					
					?>
					
					<div class="place_time"><?=$alert_ap_date_city .$alert_ap_date_township .$alert_ap_date_tribe .$alert_ap_date_ap_name .'服務中斷時間: ' .$alert_written_time  ;?></div>
					<div class="common_img"></div>
					
					<form action="?mode=sennd_mail_E" method="POST">
					<table cellpadding="5" cellspacing="0" class="edit">
					
					<tr>
						<th colspan="2">
							<select name="item_wrong">
							<option value="已結案" selected >已結案</option>
							</select>
						</th>
					</tr>

					<tr>
						<td>結案時間</td>
						<td>
						<input id="start_date" type="text"  name="time" />

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
								//timeFormat:"HH:mm:ss"
								timeFormat:"HH:mm"
								};
								$("#start_date").datetimepicker(opt);
							</script>
						</td>
					</tr>
					
					<tr><td colspan="2">
					<textarea style="width:98%;" rows="5" name="item_wrong_text" placeholder="處理內容"></textarea>
					</td></tr>

					<tr>
						<td colspan="2" align="center">
						<input class="edit_btn" type="submit" value="送出">
						<input class="edit_btn" type="button" onclick="history.back()" value="回上頁">
						</td>
					</tr>
					</table>	
					<input type="hidden" name="key" value="<?=$alert_ap_date_filter_id ;?>">
					<input type="hidden" name="Period_AP" value="<?=$Period_AP ;?>">						
					</form>
					
					<?php
					
					break;
					/*
					case 1:
					echo "已回覆";
					break;
					*/
					default; 
						?>
						<script type="text/javascript">
						alert("參數錯誤");history.back();　 
						</script>
						<?php
					break; 
					} 
	   
	   

}
else
{
 //echo $KEY.'不是数字';
 ?>
 <script type="text/javascript">
 alert("參數錯誤");history.back();　 
 </script>
 <?php
}

?>
	</div>
	</div>

<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</div>
</body>
</html>