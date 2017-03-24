<?php
include("../SQL/dbtools.inc.php");
$link = create_connection();
?>

<?php
$i= $_GET['mode'];

switch ($i) {
	case "insert":
		 $Project_name = trim($_POST['Project_name']);
	     $Project_number = trim($_POST['Project_number']);
		
			$sql= "SELECT * FROM Project  where Project_number='$Project_number'";
			$result= execute_sql($database_name, $sql, $link);
			//取得記錄數
			$num= mysql_num_rows($result);
			if( $num>0  )
			{
				//exit();
					?>
					<script>alert('專案對應數字已重複');history.back();</script>
					<?php
			}else{
				
				$sql = "INSERT INTO  Project(Project_name,Project_number) VALUES ('$Project_name','$Project_number')";
				//echo $sql ;
				//exit();
				execute_sql($database_name, $sql, $link);
				?>
				<script>alert('新增成功');document.location.href="Project_view.php";</script>
				<?php
			}
	
	break;
		case "fix":
			//echo "fix";
		$key = trim($_POST['key']);
		$Project_name = trim($_POST['Project_name']);
	    $Project_number = trim($_POST['Project_number']);
		$Project_name_check =  trim($_POST['Project_name_check']);
		if($Project_name_check!=$Project_number)
		{
				$sql= "SELECT * FROM Project  where Project_number='$Project_number'";
				$result= execute_sql($database_name, $sql, $link);
				//取得記錄數
				$num= mysql_num_rows($result);
				if( $num>0  )
				{
				//exit();
				?>
				<script>alert('專案對應數字已重複');history.back();</script>
				<?php
				}else
				{

					$sql = " UPDATE Project  SET Project_name='$Project_name',Project_number='$Project_number' WHERE  Project_id='$key' ";
					execute_sql($database_name, $sql, $link);
					?>
					<script>alert('更新成功');document.location.href="Project_view.php";</script>
					<?php
				}		
		}else{
				$sql = " UPDATE Project  SET Project_name='$Project_name',Project_number='$Project_number' WHERE  Project_id='$key' ";
				execute_sql($database_name, $sql, $link);
				?>
				<script>alert('更新成功');document.location.href="Project_view.php";</script>
				<?php
		}
		break;
		case "Del":
		$key  = $_GET['id'];
		if(is_numeric($key))
		{
				$sql = "DELETE FROM `Project` WHERE `Project_id`='$key'  " ;
				$result = execute_sql($database_name, $sql, $link);
				?>
				<script>alert('刪除成功！');document.location.href="Project_view.php";</script>
				<?php
		}else{
			echo '<script>history.back();</script>';
		}
				
		break;
		 default:
        echo "無功能";
}
?>