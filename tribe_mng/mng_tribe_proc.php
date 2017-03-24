<?php
require_once("../SQL/dbtools.inc.php");
$link = create_connection();


switch ($_GET['mode'])
	{
		case "fix_tribe":
			$ckeck_key =$_POST['ckeck_key'];
             if($ckeck_key=='check')
			{
			    //$township_name =$_POST['township_name'];
					$tribe_name = $_POST['tribe_name'];
					$tribe_x= $_POST['tribe_x'];
					$tribe_y = $_POST['tribe_y'];
					$tribe_o = $_POST['tribe_o'];
					$uid =$_POST['uid'];
					$tribe_label = $_POST['tribe_label'];
					
					//
					$tribe_member   = trim($_POST['tribe_member']);
					$tribe_phone   = trim($_POST['tribe_phone']);
					$tribe_note   = trim($_POST['tribe_note']);
					$tribe_flow   = trim($_POST['tribe_flow']);
					$tribe_network_segment   = trim($_POST['tribe_network_segment']);
	$sql = " UPDATE tribe  SET tribe_name='$tribe_name',tribe_x='$tribe_x',tribe_y='$tribe_y',tribe_o='$tribe_o' ,tribe_label='$tribe_label' ,tribe_member='$tribe_member' ,tribe_phone='$tribe_phone' ,tribe_note='$tribe_note' ,tribe_network_segment='$tribe_network_segment' ,tribe_flow='$tribe_flow'  WHERE  tribe_id='$uid' ";
	///echo $sql;
      //exit();
       execute_sql($database_name, $sql, $link);
		echo"<script>alert('資料已更新');history.back();document.URL=location.href;</script>";
			}else{  ?><script>alert('104!?');document.location.href="view_tribe.php";</script><?php       }
		
		
			break;
		case "insert_tribe":
			$ckeck_key =$_POST['ckeck_key'];
                       if($ckeck_key=='check')
			{
			
						    	$city = $_POST['city'];
						    	$town = $_POST['town'];
						 		 $tribe_name = $_POST['tribe_name'];
						 		    $tribe_x= $_POST['tribe_x'];
									$tribe_y = $_POST['tribe_y'];
								    $tribe_o = $_POST['tribe_o'];
									$tribe_label = $_POST['tribe_label'];
									//
								$tribe_member   = trim($_POST['tribe_member']);
								$tribe_phone   = trim($_POST['tribe_phone']);
								$tribe_note   = trim($_POST['tribe_note']);
								$tribe_network_segment   = trim($_POST['tribe_network_segment']);
						    if(empty($city))
						 {
						  ?><script>alert('未選擇縣市!?'); window.history.back();</script><?php
						 
						 }else{
							
							    if(empty($town))
						 {
						  ?><script>alert('未選擇地區!?'); window.history.back();</script><?php
						 
						 }else{
									
									    if(empty($tribe_name))
										 {
										  ?><script>alert('部落名稱空白!?'); window.history.back();document.execCommand('Refresh') ;</script><?php

										 }else{
											
									//$sql = "INSERT INTO tribe( `city_id`, `township_id`, `tribe_name`, `tribe_x`, `tribe_y`, `tribe_o`) VALUES (  '$city','$town','$tribe_name','$tribe_x','$tribe_y','$tribe_o'  }  ";
									
										$sql = "	INSERT INTO tribe(city_id, township_id,tribe_name,tribe_x,tribe_y,tribe_o,tribe_label,tribe_member,tribe_phone,tribe_note,) 
										VALUES ( '$city','$town','$tribe_name','$tribe_x','$tribe_y','$tribe_o','$tribe_label','$tribe_member','$tribe_phone','$tribe_note','$tribe_network_segment')";
											
								//	echo $sql;
    // exit();	
											
											execute_sql($database_name, $sql, $link);
											
													   
											?>
												<script>alert('新增部落成功');document.location.href="view_tribe.php";</script>
											 <?php
											
											
										
										}
									
								
								
								}
							
							
							
							
							}
								
								

						   
				
						   
						   
						   
			}else{  ?><script>alert('104!?');document.location.href="view_tribe.php";</script><?php       }
		
		
		break;
		
		case "del_tribe":
		$id = $_GET['id'];
		
		$sql= "SELECT * FROM `assets_address` WHERE `tribe_ass_own`='$id' ";
			$result= execute_sql($database_name, $sql, $link);
			//取得記錄數
		    $num= mysql_num_rows($result);
		   if( $num>0  )
		   {
		    		?><script>alert('have anyone date on assets_address ,will come back !?'); document.location.href="view_tribe.php";</script><?php 
		   
		   }else{
			   $sql = "DELETE FROM `tribe` WHERE `tribe_id`='$id' " ;
				$result = execute_sql($database_name, $sql, $link);
			 
								?>
							<script>alert('部落刪除成功！');document.location.href="view_tribe.php";</script>
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
