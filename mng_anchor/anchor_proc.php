<?php
require_once("../SQL/dbtools.inc.php");
$link = create_connection();


switch ($_GET['mode'])
	{
		case "insert_anchor":


 $string = $_POST['string'];
						$string = explode("-", $string);

						$city =  $string[0]; // piece1
						$town =  $string[1]; // piece2
						$tribe =  $string[2]; // piece2
						$address =  $string[3]; // piece2
						$tribe_ass_name = $_POST['tribe_ass_name'];
			
			  if(empty($city))
			  {
							  echo"<script>alert(' 未選擇城市   ');history.go(-1);</script>";
                                   exit();
				  
			  }else  if(empty($town))
			  {
							  echo"<script>alert(' 未選擇town    ');history.go(-1);</script>";
 exit();
				  
			  }else  if(empty($tribe))
			  {
							  echo"<script>alert(' 未選擇tribe   ');history.go(-1);</script>";
						 exit();
				  
			  }else  if(empty($tribe_ass_name))
			  {
							  echo"<script>alert(' 未key tribe_ass_name   ');history.go(-1);</script>";
						 exit();
				  
			  }          
			
		 	 $string = $_POST['string'];
			$string = explode("-", $string);
		
			$city =  $string[0]; // piece1
			$town =  $string[1]; // piece2
			$tribe =  $string[2]; // piece2
		
		$photo_base = $_POST['photo_base'] ;
		
		 
		 $tribe_ass_x = $_POST['tribe_ass_x'];
		 $tribe_ass_y = $_POST['tribe_ass_y'];
		 $type = $_POST['type'];
		 $assets_address_note = $_POST['assets_address_note'];
		
	
		
	
		$sql = "INSERT INTO `assets_address`(`city_ass_own`, `town_ass_own`, `tribe_ass_own`, `tribe_ass_name`, `tribe_ass_x`, `tribe_ass_y`, `type`, `assets_address_note`, `base_ico`) VALUES ('$city','$town','$tribe','$tribe_ass_name','$tribe_ass_x','$tribe_ass_y','$type','$assets_address_note','$photo_base') ";
		 $result = execute_sql($database_name, $sql, $link);
		
		//echo $sql;
		//exit();
		?>
			<script>alert('錨點新增成功');document.location.href="mng_anchor.php";</script>
		 <?php
		
		break;
		
		
			case "fix_anchor":
			$ckeck_key =$_POST['ckeck_key'];
                       if($ckeck_key=='check')
			{
			
							$uid =$_POST['uid'];
							$tribe_ass_name =$_POST['tribe_ass_name'];
						   $tribe_ass_x =$_POST['tribe_ass_x'];
						  $tribe_ass_y =$_POST['tribe_ass_y'];
						  $type =$_POST['type'];
						  	
						   $photo_base = $_POST['photo_base'] ;
						    $old_base = $_POST['old_base'] ;
						   if(empty( $photo_base)){
						    $photo_base = $old_base ;
						   
						   }else{
						   
						     $photo_base =  $photo_base;
						   }
						 
						//echo '<input type="text" name="tribe_ass_name"  value="'.$photo_base.'" >';
						   //exit();
				$assets_address_note = $_POST['assets_address_note'];
			$sql = "UPDATE `assets_address` SET  `tribe_ass_name`='$tribe_ass_name',`tribe_ass_x`='$tribe_ass_x',`tribe_ass_y`='$tribe_ass_y',`type`='$type',`assets_address_note`='$assets_address_note'  ,	base_ico='$photo_base'    where      ass_address_id= '$uid' ";
			$result = execute_sql($database_name, $sql, $link);
		/*				 
		?>
			<script>alert('錨點修改成功');document.location.href="mng_anchor.php";</script>
		 <?php
		 */
		 echo"<script>alert('資料已更新');history.back();document.URL=location.href;</script>";
			}else{  ?><script>alert('104!?');document.location.href="mng_anchor.php";</script><?php       }
		break;
		
		
			case "del_anchor":
		/*
		ass_4Ggrouter
		ass_ap
		ass_grouter
		ass_other
		ass_pdu
		ass_poesw
		*/
		
						$id = $_GET['id'];
		    //ass_4Ggrouter
			$sql= " SELECT * FROM ass_4Ggrouter  WHERE ass_4Ggrouter_address='$id' ";
			$result= execute_sql($database_name, $sql, $link);
			//取得記錄數
		    $num = mysql_num_rows($result);
		    //ap
			$sql1= " SELECT * FROM `ass_ap` WHERE `ass_ap_address`='$id' ";
			$result1= execute_sql($database_name, $sql1, $link);
			//取得記錄數
		    $num1 = mysql_num_rows($result1);
		 //grouter
			$sql2= "SELECT * FROM `ass_grouter` WHERE `ass_grouter_address`='$id' ";
			$result2= execute_sql($database_name, $sql2, $link);
			//取得記錄數
		    $num2 = mysql_num_rows($result2);
		 //other
			$sql3= "SELECT * FROM `ass_other` WHERE `ass_other_address`='$id' ";
			$result3= execute_sql($database_name, $sql3, $link);
			//取得記錄數
		    $num3 = mysql_num_rows($result3);
			 //pdu
			$sql4= "SELECT * FROM `ass_pdu` WHERE `ass_pdu_address`='$id' ";
			$result4= execute_sql($database_name, $sql4, $link);
			//取得記錄數
		    $num4 = mysql_num_rows($result4);
		 //ass_poesw
			$sql5= "SELECT * FROM `ass_poesw` WHERE `ass_poesw_address`='$id' ";
			$result5= execute_sql($database_name, $sql5, $link);
			//取得記錄數
		    $num5 = mysql_num_rows($result5);
		   if( $num>0 and  $num1 >0 and  $num2 >0 and $num3 >0 and  $num4>0 and  $num5>0 )
		   {
		    		?><script>alert('have anyone date on assect ,will come back !?'); window.history.back();</script><?php 
		   
		   }else{
			   $sql = "DELETE FROM   assets_address    WHERE ass_address_id='$id' " ;
				$result = execute_sql($database_name, $sql, $link);
			   
								?>
							<script>alert('刪除成功！');window.location.href = 'mng_anchor.php';</script>
								<?php
		   
		   
		   }
		

			break;

		case "up_photo":
		     ///echo "你買了 ps3";

			$ckeck_key =$_POST['ckeck_key'];
                       if($ckeck_key=='check')
			{
				$uid =$_POST['uid'];
  				$photo_base = $_POST['photo_base'] ;
				$old_base = $_POST['old_base'] ;
				$photo_type = $_POST['photo_type'] ;
			     if(empty( $photo_base)){
						    $photo_base = $old_base ;
						   
						   }else{
						   
						     $photo_base =  $photo_base;
						   }


                                if($photo_type==2)
					{
					$sql = "UPDATE `assets_address` SET  	base_ico2='$photo_base'    where      ass_address_id= '$uid' ";
				

					}else  if($photo_type==3)
					{
					$sql = "UPDATE `assets_address` SET  	base_ico3='$photo_base'    where      ass_address_id= '$uid' ";
			

					}
				$result = execute_sql($database_name, $sql, $link);
				//echo $photo_type;
				//exit();
				?>
			<script>alert('圖片已更新');document.location.href="mng_anchor.php";</script>
				 <?php







			}else{  ?><script>alert('104!?');document.location.href="mng_anchor.php";</script><?php       }




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
