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
			$Maintenance_Engineer_menu_name = trim($_POST['Maintenance_Engineer_menu_name']);
			if($Maintenance_Engineer_menu_name==NULL)
			{
			//echo $score;
			echo"<script>alert('工程師名稱空白');history.go(-1);</script>";
			exit();
			}
				$sql = "INSERT INTO Maintenance_Engineer_menu(Maintenance_Engineer_menu_name) VALUES ('$Maintenance_Engineer_menu_name')" ;
				$sql = preg_replace("/[\'\"]+/" , "'" ,$sql);
				$result = execute_sql($database_name, $sql, $link);
				//echo $sql;
				echo"<script>alert('新增成功');window.location.href = 'veiw_Maintenance_Engineer_menu.php';</script>";
			
			
						/*
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
						*/
			break;
			
			case 'fix':
					$Maintenance_Engineer_menu_name =  trim($_POST['Maintenance_Engineer_menu_name']);
					$Maintenance_Engineer_menu_id =  trim($_POST['Maintenance_Engineer_menu_id']);
						if($Maintenance_Engineer_menu_name==NULL)
						{
						//echo $score;
						echo"<script>alert('工程師名稱空白');history.go(-1);</script>";
						exit();
						}
					$sql = "UPDATE Maintenance_Engineer_menu SET Maintenance_Engineer_menu_name='$Maintenance_Engineer_menu_name' where Maintenance_Engineer_menu_id='$Maintenance_Engineer_menu_id'" ;
					$sql = preg_replace("/[\'\"]+/" , "'" ,$sql);
					execute_sql($database_name, $sql, $link);
					echo"<script>alert('修改成功');window.location.href = 'veiw_Maintenance_Engineer_menu.php';</script>";
					
			break;
			
			case 'del':
			
				$key = $_GET['key'];
				$sql = "DELETE FROM Maintenance_Engineer_menu WHERE Maintenance_Engineer_menu_id ='$key' " ;
				$result = execute_sql($database_name, $sql, $link);
				echo"<script>alert('刪除成功');window.location.href = 'veiw_Maintenance_Engineer_menu.php';</script>";	
			
					/*
					$key = $_GET['key'];
					$sql = "DELETE FROM alert_contacts WHERE alert_contacts_id ='$key' " ;
					$result = execute_sql($database_name, $sql, $link);
					echo"<script>alert('刪除成功');window.location.href = 'veiw_alert_contacts_setting.php';</script>";	
					*/
			break;
			default:
			echo "沒有功能";
			break;
			}
?>