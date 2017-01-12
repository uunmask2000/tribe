<?php
require_once("../SQL/dbtools.inc.php");
$link = create_connection();


switch ($_GET['mode'])
	{
		case "fix_mng_city":
			$ckeck_key =$_POST['ckeck_key'];
                       if($ckeck_key=='check')
			{
			$city_name =$_POST['city_name'];
			$uid =$_POST['uid'];


			$sql = " UPDATE  city_array SET city_name='$city_name'  WHERE  id ='$uid' ";
			execute_sql($database_name, $sql, $link);
		echo"<script>alert('資料已更新');history.back();document.URL=location.href;</script>";
			}else{  ?><script>alert('104!?');document.location.href="mng_city.php";</script><?php       }
		break;
		
		
		
		case "inser_mng_city":
			$ckeck_key =$_POST['ckeck_key'];
                       if($ckeck_key=='check')
			{
				$city_name =$_POST['city_name'];
						  
						 if(empty($city_name))
						 {
						  ?><script>alert('city_name!?'); window.history.back();</script><?php
						 
						 }else{
						 
						  $sql = "INSERT INTO `city_array`(`city_name`) VALUES ('$city_name')";
						execute_sql($database_name, $sql, $link);
							  	?>
								<script>alert('新增縣市成功');document.location.href="mng_city.php";</script>
								 <?php 
						
						 
						 }
						     
						
			
	 
			}else{  ?><script>alert('104!?');document.location.href="mng_city.php";</script><?php       }
		break;
		case "del_city":
		
		break;
	
		case "dell_city":
		$id =$_GET['id'];
		 $sql= "SELECT * FROM `city_township` WHERE `township_city`='$id' ";
		
			$result= execute_sql($database_name, $sql, $link);
			//取得記錄數
		    $num= mysql_num_rows($result);
		   if( $num>0  )
		   {
		    		?><script>alert('have anyone date on town ,will come back !?');document.execCommand('Refresh'); window.history.back();</script><?php 
		   
		   }else{
			   $sql = "DELETE FROM `city_array` WHERE `id`='$id' " ;
			   $result = execute_sql($database_name, $sql, $link);
			
								?>
							<script>alert('刪除縣市成功');document.location.href="mng_city.php";document.execCommand('Refresh');</script>
								<?php
		   
		   
		   }
		break;
		
/*
		case "ps3":
		 echo "你買了 ps3";
		break;

		case "xbox 360":
		 echo "你買了 xbox 360";
		break;
*/
		default:
		  echo "沒有功能";
	}










?>
