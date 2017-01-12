<?php
require_once("../SQL/dbtools.inc.php");
$link = create_connection();


switch ($_GET['mode'])
	{
		case "inser_user":
		 
			$user_name = $_POST['user_name'];
			$user_acc = $_POST['user_acc'];
			$user_maill = $_POST['user_maill'];
			$user_lv = $_POST['user_lv'];
			$user_pwd = $_POST['user_pwd'];

			$user_acc = trim($user_acc);
			$user_acc = preg_replace('/\s(?=)/', '', $user_acc);
			
			$user_pwd = trim($user_pwd);
			$user_pwd = preg_replace('/\s(?=)/', '', $user_pwd);
			
			$score = 0;
           if(preg_match("/[0-9]+/",$user_pwd))
           {
              $score ++; 
           }
           if(preg_match("/[0-9]{3,}/",$user_pwd))
           {
              $score ++; 
           }
           if(preg_match("/[a-z]+/",$user_pwd))
           {
              $score ++; 
           }
           if(preg_match("/[a-z]{3,}/",$user_pwd))
           {
              $score ++; 
           }
           if(preg_match("/[A-Z]+/",$user_pwd))
           {
              $score ++; 
           }
           if(preg_match("/[A-Z]{3,}/",$user_pwd))
           {
              $score ++; 
           }
           if(preg_match("/[_|\-|+|=|*|!|@|#|$|%|^|&|(|)]+/",$user_pwd))
           {
              $score += 2; 
           }
           if(preg_match("/[_|\-|+|=|*|!|@|#|$|%|^|&|(|)]{3,}/",$user_pwd))
           {
              $score ++ ; 
           }
           if(strlen($user_pwd) >= 10)
           {
              $score ++; 
           }
			if($score < 6)
			{
				//echo $score;
				echo"<script>alert('密碼驗證強度不夠');history.go(-1);</script>";
				exit();
			}
		

	$sql = "INSERT INTO web_user(user_name,user_acc,user_pwd,user_maill,user_lv) VALUES ('$user_name','$user_acc','$user_pwd','$user_maill','$user_lv')" ;
                  // echo $sql;	
	$result = execute_sql($database_name, $sql, $link);
			
echo"<script>alert('新增使用者成功');window.location.href = 'user.php';</script>";

			//echo "你買了 wii ";
		break;


		case "fix_user":



			$user_id = $_POST['user_id'];
			$user_name = $_POST['user_name'];
			$user_acc = $_POST['user_acc'];
			$user_mail = $_POST['user_mail'];
			$user_lv = $_POST['user_lv'];

			$user_pwd = $_POST['user_pwd'];
			$old_pwd = $_POST['old_pwd'];
				if(empty($user_pwd))
                            	 {
                            	$user_pwd = $old_pwd ;
                             }else{

					$user_pwd = $user_pwd;
					}  
 						    $photo_base = $_POST['photo_base'] ;
						    $old_base = $_POST['old_base'] ;
						   if(empty( $photo_base)){
						    $photo_base = $old_base ;
						   
						   }else{
						   
						     $photo_base =  $photo_base;
						   }




			$user_acc = trim($user_acc);
			$user_acc = preg_replace('/\s(?=)/', '', $user_acc);
			
			$user_pwd = trim($user_pwd);
			$user_pwd = preg_replace('/\s(?=)/', '', $user_pwd);
                                              
			
			// 密碼驗證強度
			
			$score = 0;
           if(preg_match("/[0-9]+/",$user_pwd))
           {
              $score ++; 
           }
           if(preg_match("/[0-9]{3,}/",$user_pwd))
           {
              $score ++; 
           }
           if(preg_match("/[a-z]+/",$user_pwd))
           {
              $score ++; 
           }
           if(preg_match("/[a-z]{3,}/",$user_pwd))
           {
              $score ++; 
           }
           if(preg_match("/[A-Z]+/",$user_pwd))
           {
              $score ++; 
           }
           if(preg_match("/[A-Z]{3,}/",$user_pwd))
           {
              $score ++; 
           }
           if(preg_match("/[_|\-|+|=|*|!|@|#|$|%|^|&|(|)]+/",$user_pwd))
           {
              $score += 2; 
           }
           if(preg_match("/[_|\-|+|=|*|!|@|#|$|%|^|&|(|)]{3,}/",$user_pwd))
           {
              $score ++ ; 
           }
           if(strlen($user_pwd) >= 10)
           {
              $score ++; 
           }
			if($score < 6)
			{
				//echo $score;
				echo"<script>alert('密碼驗證強度不夠');history.go(-1);</script>";
				exit();
			}
			
			
			/*
 			if( preg_match('/^(?!.*[^a-zA-Z0-9])(?=.*\d)(?=.*[a-zA-Z]).{8,999}$/',$user_pwd) ) 
			{
			   // echo '這是÷OK' ;
			} else {
			    //echo '這不OK' ;
				echo"<script>alert('密碼驗證強度不夠(至少8個字與一個英文)');history.go(-1);</script>";
				exit();
			}
			*/
		
			$sql = "UPDATE web_user SET
user_name='$user_name', user_pwd='$user_pwd',user_maill='$user_mail',user_lv='$user_lv' ,user_photo='$photo_base' WHERE user_id ='$user_id' ";

execute_sql($database_name, $sql, $link);
//echo"<script>alert('修改使用者成功');window.location.href = 'user.php';</script>";
echo"<script>alert('資料已更新');history.back();document.URL=location.href;</script>";

			
		
		break;

		default:
		  echo "沒有功能";
	}










?>
