<?php
include("../SQL/dbtools.inc.php");
include("../function_php/function_class.php");
$link = create_connection();

session_start();
date_default_timezone_set('Asia/Taipei');
$name = $_SESSION['user_name']   ;
//00 = 派工 01=處理中 02==到達 03=已結案

$mode = $_GET['mode'];
//$i = $mode ;
//exit();
switch ($mode):
		case 'mail':
					//echo "首回復";
					require_once('../mail_fulsion/mail/PHPMailer/PHPMailerAutoload.php');
					require_once('../mail_fulsion/mail/PHPMailer/mail_send_gmail.php');	
					$key   =$_POST['key'];
					$item_wrong_text  =$_POST['item_wrong_text'];
					$item_wrong  =$_POST['item_wrong'];
					$title  =$_POST['title'];

					$re_time  = $_POST['time'];　;
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
						if($item_wrong_text==NULL)
						{
						$item_wrong_text='無';
						}else
						{ 
						$item_wrong_text=$item_wrong_text ;
						} 

					$mail_title1 = "愛部落" ;
					$mail_title2 = "愛部落網管<回報>" ;
					$mail->From = 'itribe2016@gamil.com';
					$mail->FromName = $mail_title1;
					$mail->Subject = $mail_title2;
					$mail->Body = 	'處理編號 : '.$re_time.'<br>問題設備 : '.$title.'<br>選擇項目   :  '.$item_wrong.'<br>內容   :   '.$item_wrong_text;
					$mail->IsHTML(true);
					$mail->AddAttachment("", "");
					//$mail->AddAddress('seanchen@tiis.com.tw','seanchen');
					//$mail->AddAddress('frankchang@tiis.com.tw','Frank');
					//$mail->AddAddress('danielwu@tiis.com.tw','Daniel');
					$mail->AddAddress('yashon@tecom.com.tw','Yashon');
					//$mail->AddAddress('heaven@fareastone.com.tw','Heaven');
					//$mail->AddAddress('chhsfang@fareastone.com.tw','Chhsfang');
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

					//echo "<p align=center><b>傳送成功。</b></p>";
					}
					//$Processing_time_A = date("Y-m-d H:i:s"); 
					$Processing_time_A = $_POST['time'];  // 手動填寫
					//$calling_bar_id = date("YmdHis"); 
					$calling_bar_id = $re_time;   // 手動填寫
					$sql = "UPDATE  alert_ap_date_filter SET Processing_status='首回覆' ,Processing_time_A='$Processing_time_A',note_A='$item_wrong_text',calling_bar_id='$calling_bar_id',calling_bar_id_check='$calling_bar_id',Processor_A='$name' WHERE alert_ap_date_filter_id='$key' ";
					execute_sql($database_name, $sql, $link);
					//echo $sql ;
					//exit();
					$Period_AP  =$_POST['Period_AP'];
					?>
					<script>
					window.location = 'show_AP_date_form_2.php?A=<?=$Period_AP ;?>';
					</script>
					<?php
		break;
    case 0:
      // echo "派工";
		//exit();
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

					}else if($item_wrong_text==NULL)
					{
					$item_wrong_text ='無';


					}
			$sql = "UPDATE  alert_ap_date_filter SET Processing_status='$item_wrong' WHERE alert_ap_date_filter_id='$key' ";
			execute_sql($database_name, $sql, $link);
			$sql = "INSERT INTO Equipment_Repair(Equipment_Repair_number, Equipment_Repair_time, Equipment_Repair_type, Equipment_Repair_engineer, Equipment_Repair_operator, Equipment_Repair_remark) VALUES ('$key','$time','00','$accendant','$name', '$item_wrong_text' )";
			execute_sql($database_name, $sql, $link);								
		
		
			//exit;
			?>
			<script>
			window.location = 'edit_work.php?key=<?=$key;?>';
			</script>
			<?php
			//exit;
		
        break;
    case 1:
       // echo "i equals 1";
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

					}else if($item_wrong_text==NULL)
					{
					$item_wrong_text ='無';


					}
				$sql = "UPDATE  alert_ap_date_filter SET Processing_status='$item_wrong' WHERE alert_ap_date_filter_id='$key' ";
				execute_sql($database_name, $sql, $link);
				$sql = "INSERT INTO Equipment_Repair(Equipment_Repair_number, Equipment_Repair_time, Equipment_Repair_type, Equipment_Repair_engineer, Equipment_Repair_operator, Equipment_Repair_remark) VALUES ('$key','$time','01','$accendant','$name', '$item_wrong_text' )";
				execute_sql($database_name, $sql, $link);	
				?>
				<script>
				window.location = 'edit_work.php?key=<?=$key;?>';
				</script>
				<?php			
        break;
    case 2:
       // echo "i equals 2";
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

					}else if($item_wrong_text==NULL)
					{
					$item_wrong_text ='無';


					}
				$sql = "UPDATE  alert_ap_date_filter SET Processing_status='$item_wrong' WHERE alert_ap_date_filter_id='$key' ";
				execute_sql($database_name, $sql, $link);
				$sql = "INSERT INTO Equipment_Repair(Equipment_Repair_number, Equipment_Repair_time, Equipment_Repair_type, Equipment_Repair_engineer, Equipment_Repair_operator, Equipment_Repair_remark) VALUES ('$key','$time','02','$accendant','$name', '$item_wrong_text' )";
				execute_sql($database_name, $sql, $link);	
				?>
				<script>
				window.location = 'edit_work.php?key=<?=$key;?>';
				</script>
				<?php		
        break;
	case 3:
       //echo "i equals 3";
	  // exit();
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

					}else if($item_wrong_text==NULL)
					{
					$item_wrong_text ='無';


					}
				$sql = "UPDATE  alert_ap_date_filter SET Processing_status='$item_wrong' WHERE alert_ap_date_filter_id='$key' ";
				execute_sql($database_name, $sql, $link);
				$sql = "INSERT INTO Equipment_Repair(Equipment_Repair_number, Equipment_Repair_time, Equipment_Repair_type, Equipment_Repair_engineer, Equipment_Repair_operator, Equipment_Repair_remark) VALUES ('$key','$time','03','$accendant','$name', '$item_wrong_text' )";
				execute_sql($database_name, $sql, $link);
		
				?>
				<script>
				window.location = 'edit_work.php?key=<?=$key;?>';
				</script>
				<?php		
        break;
    default:
        echo "i is not equal to 0, 1 or 2";
endswitch;
?>