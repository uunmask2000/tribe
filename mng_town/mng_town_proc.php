<?php
header("Cache-control: private");
require_once("../SQL/dbtools.inc.php");
$link = create_connection();


switch ($_GET['mode'])
	{
		case "fix_mng_town":
			$ckeck_key =$_POST['ckeck_key'];
                       if($ckeck_key=='check')
			{
			$township_name = trim($_POST['township_name']);
			$Mayor = trim($_POST['Mayor']);
			$Mayor_phone = trim($_POST['Mayor_phone']);
			$Contact_person = trim($_POST['Contact_person']);
			$Contact_person_phone = trim($_POST['Contact_person_phone']);
			$address = trim($_POST['address']);
			$area_note = trim($_POST['area_note']);
			
			$uid =$_POST['uid'];


			$sql = " UPDATE  city_township SET township_name='$township_name',Mayor='$Mayor',Mayor_phone='$Mayor_phone',Contact_person='$Contact_person',Contact_person_phone='$Contact_person_phone',address='$address',area_note='$area_note'  WHERE  township_id ='$uid' ";
			execute_sql($database_name, $sql, $link);
			//echo $sql ;
			echo"<script>alert('資料已更新');history.back();document.URL=location.href;</script>";
			}else{  ?><script>alert('104!?');document.location.href="mng_town.php";</script><?php       }
		break;
		
		
		
			case "inser_mng_town":
			$ckeck_key =$_POST['ckeck_key'];
                       if($ckeck_key=='check')
			{
						   
						
						$city =$_POST['city'];
					    //$township_name =$_POST['township_name'];
					$township_name = trim($_POST['township_name']);
					$Mayor = trim($_POST['Mayor']);
					$Mayor_phone = trim($_POST['Mayor_phone']);
					$Contact_person = trim($_POST['Contact_person']);
					$Contact_person_phone = trim($_POST['Contact_person_phone']);
					$address = trim($_POST['address']);
					$area_note = trim($_POST['area_note']);
						
						
						
						
						    if(empty($city))
						 {
						  ?><script>alert('$city!?'); document.location.href="mng_town.php";</script><?php
						 
						 }else{
								
								
								    if(empty($township_name))
						 {
						  ?><script>alert('$township_name!?'); document.location.href="mng_town.php";</script><?php
						 
						 }else{
									$sql = "INSERT INTO `city_township`(`township_city`, `township_name`,Mayor,Mayor_phone,Contact_person,Contact_person_phone,address,area_note) VALUES ('$city',' $township_name','$Mayor','$Mayor_phone','$Contact_person','$Contact_person_phone','$address','$area_note')";
									execute_sql($database_name, $sql, $link);
										
									?>
										<script>alert('新增地區成功');document.location.href="mng_town.php";</script>
								 <?php
									}
						
							}
						   
						
						   
						   
						   
			//$uid =$_POST['uid'];


			//$sql = " UPDATE  city_township SET township_name='$township_name'  WHERE  township_id ='$uid' ";
			//execute_sql($database_name, $sql, $link);
		
			}else{  ?><script>alert('104!?');document.location.href="mng_town.php";</script><?php       }
		break;
		
		
		case "del_town":
		$id = $_GET['id'];
		
		$sql= "SELECT * FROM `tribe` WHERE `township_id`='$id' ";
			$result= execute_sql($database_name, $sql, $link);
			//取得記錄數
		    $num= mysql_num_rows($result);
		   if( $num>0  )
		   {
		    		?><script>alert('have anyone date on tribe ,will come back !?'); document.location.href="mng_town.php";</script><?php 
		   
		   }else{
			   $sql = "DELETE FROM `city_township` WHERE `township_id`='$id' " ;
				$result = execute_sql($database_name, $sql, $link);
			 
								?>
							<script>alert('刪除地區成功！');document.location.href="mng_town.php";document.execCommand('Refresh') ;</script>
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
