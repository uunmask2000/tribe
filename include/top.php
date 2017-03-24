<script language="javascript">
$(function(){
	// 幫 #menu li 加上 hover 事件
	$('#down li').hover(function(){
		// 先找到 li 中的子選單
		var _this = $(this),
			_subnav = _this.children('ul');
 
		// 變更目前母選項的背景顏色
		// 同時顯示子選單(如果有的話)
		_this.css('backgroundColor', '#448271');
		_this.css('Color', '#ffef60');
		_subnav.css('display', 'block');
	} , function(){
		// 變更目前母選項的背景顏色
		// 同時隱藏子選單(如果有的話)
		// 也可以把整句拆成上面的寫法
		$(this).css('backgroundColor', '').children('ul').css('display', 'none');
	});
 
	// 取消超連結的虛線框
	$('a').focus(function(){
		this.blur();
	});
});
</script>


<div id="top">
<?php
session_start();
 //$_SESSION['login'] =  'login'   ;
if(preg_match("/login/i", $_SERVER['PHP_SELF'])) 
{
	 //echo 'OK';   //判斷目前是否再登入畫面
	
}else{
		if(empty($_SESSION['login']))
		{
		//echo '味登入ˋ';
		header("Refresh: 0; url=../login/login.php");
		}else{
		//echo '登入ˋ';
		}
}

?>

	<div id="logo">
		<div id="nowat"></div>
	</div>

	<div id="account">
<?php
		if(empty($_SESSION['user_lv']))
			{
?>
		<div id="data">
			<div class="user_data">您好</div>
			所在群組：guest
		</div>
<?php
			}
			else{
			
			switch ($_SESSION['user_lv']) {
			case 1:
				$Grouple ="最高使用者";
			break;
			case 2:
				$Grouple ="網管人員";
			break;
			case 3:
				$Grouple ="專管人員";
			break;
			case 4:
				$Grouple ="原民會";
			break;
			}


				
?>

		<div id="data">
			<div class="user_data"><?=$_SESSION['user_name'];?>，您好</div>
			所在群組：<?=$Grouple;?>
		</div>
<?php
				}
?>
		<div id="head_pic">
		<img src="<?=$_SESSION['user_photo'];?>" class="head_pic_user">
		</div>
	</div>

	<div class="clr"></div>

</div>
<?php
	if($_GET['logout']=='logout')
		{
 		session_unset();
		echo '<script>alert("登出成功");document.location.href="../index.php";</script>';

		}
?>
		<div id="menu">
		
			<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/index.php" 	<?php if (preg_match("/index.php/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } ?>   >
			AP狀態</a> | 
			
		<?php
			if( ($_SESSION['user_lv'])==1 or ($_SESSION['user_lv'])==2  or  ($_SESSION['user_lv'])==3  or ($_SESSION['user_id'])=='37' )
			{
				?>		
				<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/programer_See/See_programer.php"
				<?php if (preg_match("/See_programer/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } ?>>
				目前斷線AP清單
				</a> | 
				<?php
			}
		?>
		<?php
			if( ($_SESSION['user_lv'])==1 or ($_SESSION['user_lv'])==2 or ($_SESSION['user_id'])=='37'  )
			{
				?>		
				<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/programer_See/show_AP_date_form.php"
				<?php if (preg_match("/show_AP_date_form/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } 
				else if (preg_match("/Execl_update/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } 
				else if (preg_match("/Veiw_end_date_2/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } 
				?>>
				AP中斷維修紀錄表
				</a> | 
				<?php
			}
		?>
		
		<?php
		if( ($_SESSION['user_lv'])==1 or ($_SESSION['user_lv'])==2  )
		{
		?>	
			<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/alert/show_down_month.php" 
			<?php if (preg_match("/alert/i", $_SERVER['PHP_SELF'])) {
			echo "class='linked'"; } ?>>
			訊息通報</a> |
			
			<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/device_defend/view_all_device.php" 
			<?php if (preg_match("/device_defend/i", $_SERVER['PHP_SELF'])) {
			echo "class='linked'"; } ?>>
			設備維護</a> | 
		<?php
		}
		?>
			
   <?php
   if( ($_SESSION['user_lv'])==1 or ($_SESSION['user_lv'])==2  or  ($_SESSION['user_lv'])==3  or  ($_SESSION['user_lv'])==4  )
	{   
   ?>
	<ul id="down">
		<li>
			<a href="#"
			<?php if (preg_match("/show_report/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } 
			else if (preg_match("/report_web/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } 
			else if (preg_match("/report_user/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } 
			?>>統計報表</a> |
			<ul>
					<?php
					if( ($_SESSION['user_lv'])==1 or ($_SESSION['user_lv'])==2  or  ($_SESSION['user_lv'])==3  or  ($_SESSION['user_lv'])==4  )
					{	
					?>

					<li>
					<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/report_bnf_new_2/show_report_all.php" 
					<?php if (preg_match("/show_report_all/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } 
					else if (preg_match("/show_report_tribe.php/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } 
					?>>服務效益分析總表</a>
					</li>

					<?php

					}		

					?>
			
			
				<?php
				if( ($_SESSION['user_lv'])==1 or ($_SESSION['user_lv'])==2  or  ($_SESSION['user_lv'])==3   )
				{	
				?>

				<li>
				<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/report_bnf_new_2/show_report_tribe_city.php" 
				<?php if (preg_match("/show_report_tribe_city/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } 
				?>>熱點服務效益分析明細表</a>
				</li>
				<?php

				}

				?>

				<?php
				 if(($_SESSION['user_lv'])==3  or  ($_SESSION['user_lv'])==4  )
				{	
				?>

				<li>
				<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/report_bnf_new_2/report_web_month.php" 
				<?php if (preg_match("/report_web/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } 
				?>>網路流量統計</a>
				</li>
				<?php

				}else if( ($_SESSION['user_lv'])==1 or ($_SESSION['user_lv'])==2    )
				{
						?>

				<li>
				<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/report_bnf_new_2/report_web.php" 
				<?php if (preg_match("/report_web/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } 
				?>>網路流量統計</a>
				</li>
				<?php
				}

				?>	

					<?php
					if( ($_SESSION['user_lv'])==1 or ($_SESSION['user_lv'])==2  or  ($_SESSION['user_lv'])==3   )
					{	
					?>				
					<li>
					<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/report_bnf_new_2/show_report_people.php" 
					<?php if (preg_match("/show_report_people/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } 
					?>>使用人次統計分析明細表</a>
					</li>



					<li>
					<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/report_bnf_new_2/report_user.php" 
					<?php if (preg_match("/report_user/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } 
					?>>使用者資訊查詢報表</a>
					</li>
					<?php

					}

					?>	
				
			</ul>
		</li>
	</ul>
	
	<?php
	}	
	?>
	 <?php
   if( ($_SESSION['user_lv'])==1 or ($_SESSION['user_lv'])==2  or  ($_SESSION['user_lv'])==3 or  ($_SESSION['user_lv'])==4 )
	{   
   ?>
	
	<ul id="down">
		<li><a href="#" 
		<?php 
		if (preg_match("/show_monthly_report/i", $_SERVER['PHP_SELF'])) { echo "class='linked'"; }
		else if (preg_match("/Export_day_all/i", $_SERVER['PHP_SELF'])) { echo "class='linked'"; } 		
		?>
		>匯出報表</a> |
			<ul>
			
				<li>
				<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/report_bnf_new_2/Export_day_all.php"
				<?php if (preg_match("/Export_day_all/i", $_SERVER['PHP_SELF'])) { echo "class='linked'"; } ?>
				>服務效益日總表</a>
				</li>
				
				<li>
				<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/report_bnf_new_2/show_monthly_report_all_total.php" 
				<?php if (preg_match("/show_monthly_report_all_total/i", $_SERVER['PHP_SELF'])) { echo "class='linked'"; } ?>
				>服務效益月總報表</a>
				</li>

				<li>
				<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/report_bnf_new_2/show_monthly_report_itr_total.php" 
				<?php if (preg_match("/show_monthly_report_itr_total/i", $_SERVER['PHP_SELF'])) { echo "class='linked'"; } ?>
				>愛部落服務效益月報表</a>
				</li>
			
				<li>
				<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/report_bnf_new_2/show_monthly_report_itw_total.php" 
				<?php if (preg_match("/show_monthly_report_itw_total/i", $_SERVER['PHP_SELF'])) { echo "class='linked'"; } ?>
				>愛台灣服務效益月報表</a>
				</li>
                
				
				

			</ul>
		</li>
	</ul>
	<?php
	}	
	?>
	

	
	
	
	
	



	<?php		
			if( ($_SESSION['user_lv'])==1 or ($_SESSION['user_lv'])==2  )
			{
	?>
	<?php
		/*
		<!----<a href="../report_mng/show_record0.php">統計報表</a> |--->
		<!----<a href="../report_mng/report_bnf.php">統計總表</a> |--->
		<!-- <a href="../DB_817/show_record.php" >radacct</a> | -->
		<!--<a href="../csv/demo/demo3_1.php" target="_blank">統計總表</a> | -->
		*/
	
	
	?>
		

			<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/asset_mng/view_fw.php" 
			<?php if (preg_match("/asset_mng/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } 
			else if (preg_match("/mng_anchor/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } 
			else if (preg_match("/Export_Assets/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } 
			?>>
			資產管理</a> | 

			<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/tribe_mng/view_tribe.php" 
			<?php if (preg_match("/tribe_mng/i", $_SERVER['PHP_SELF'])) {
			echo "class='linked'"; } 
			?>>
			部落管理</a> | 
			
			<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/mng_user/user.php"
			<?php if (preg_match("/mng_user/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; }
			else if (preg_match("/mng_city/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } 
			else if (preg_match("/mng_town/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } 
			else if (preg_match("/asset_state/i", $_SERVER['PHP_SELF'])) {echo "class='linked'"; } 
			?>>
			系統管理</a> | 
	<?php
			}
	?>
	<?php		
			if( ($_SESSION['user_id'])==1 or ($_SESSION['user_id'])==11 )
			{
			?>
			<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/PDU_check/pdu_date.php">PDU PING 檢查</a> | 
			<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/Topology/veiw_Topology.php" target='_blank'>網站拓譜圖</a> | 
			<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/pdu_control/pdu_control.php" target='_blank'>PDU-更換紀錄(<?=date("Y-m-d")?>)</a> | 
			<?php
			}
	?>
	
	<?php		
			if( ($_SESSION['user_id'])==11   )
			{
			?>
			<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/programer_See/show_AP_date_form_2.php">
				AP中斷維修紀錄表<過去紀錄>
				</a> |
			<?php
			}
	?>
<?php
			if( ($_SESSION['user_lv'])==1 or ($_SESSION['user_lv'])==2  or  ($_SESSION['user_lv'])==3  or ($_SESSION['user_lv'])==4  )
			{
?>
			<div id="login">
				<a href="?logout=logout">登出</a></div>
			    <div class="clr"></div>
			</div>	
<?php     
            }
			else
			{
?>
			<div id="login"><a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/login/login.php">登入</a></div>

			<div class="clr"></div>
		</div>
				<?php
            }


  
?>




			
