<?php
include("../SQL/dbtools.inc.php");
$link = create_connection();

?>

<?php
   $mode = $_GET['mode'];
   $key = $_GET['key'];
   
			switch ($mode) 
			{
			case 'insert':
					$alert_contacts_name = trim($_POST['alert_contacts_name']);
					$alert_contacts_email =  trim($_POST['alert_contacts_email']);
				if($alert_contacts_name==NULL)
				{
				//echo $score;
				echo"<script>alert('通訊人名稱空白');history.go(-1);</script>";
				exit();
				}else if($alert_contacts_email==NULL){
					echo"<script>alert('通訊人mail空白');history.go(-1);</script>";
					exit();
				}
		$sql = "INSERT INTO alert_contacts(alert_contacts_name,alert_contacts_email) VALUES ('$alert_contacts_name','$alert_contacts_email')" ;
		$sql = preg_replace("/[\'\"]+/" , "'" ,$sql);
		$result = execute_sql($database_name, $sql, $link);
		//echo $sql;
		echo"<script>alert('新增成功');window.location.href = 'veiw_alert_contacts_setting.php';</script>";
			// echo "新增";
			//$url = 'insert_alert_contacts_setting.php';
			// header("Location:$url" );
			break;
			
			case 'fix':
					$alert_contacts_name = trim($_POST['alert_contacts_name']);
					$alert_contacts_email =  trim($_POST['alert_contacts_email']);
					$alert_contacts_id =  trim($_POST['alert_contacts_id']);
								if($alert_contacts_name==NULL)
								{
								//echo $score;
								echo"<script>alert('通訊人名稱空白');history.go(-1);</script>";
								exit();
								}else if($alert_contacts_email==NULL){
								echo"<script>alert('通訊人mail空白');history.go(-1);</script>";
								exit();
								}				
		$sql = "UPDATE alert_contacts SET alert_contacts_name='$alert_contacts_name',alert_contacts_email='$alert_contacts_email' where alert_contacts_id='$alert_contacts_id'" ;
		$sql = preg_replace("/[\'\"]+/" , "'" ,$sql);
		execute_sql($database_name, $sql, $link);
		echo"<script>alert('修改成功');window.location.href = 'veiw_alert_contacts_setting.php';</script>";
		//echo	$sql  ;
			break;
			
			case 'del':
				$key = $_GET['key'];
				$sql = "DELETE FROM alert_contacts WHERE alert_contacts_id ='$key' " ;
				$result = execute_sql($database_name, $sql, $link);
				echo"<script>alert('刪除成功');window.location.href = 'veiw_alert_contacts_setting.php';</script>";	
			break;
			default:
			echo "沒有功能";
			break;
			}
?>