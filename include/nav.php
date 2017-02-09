
		<div class="tabs">
			<a href="../mng_user/user.php"
			<?php if (preg_match("/user/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>使用者</a>
			
			<a href="../mng_city/mng_city.php"
			<?php if (preg_match("/city/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>縣市管理</a>
			<a href="../mng_town/mng_town.php"
			<?php if (preg_match("/town/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>地區管理</a>
			<a href="../mng_ass_state/asset_state.php"
			<?php if (preg_match("/state/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>資產狀態</a>
			<!------
			<a href="../Maintenance_Engineer_menu/veiw_Maintenance_Engineer_menu.php"
			<?php // if (preg_match("/Maintenance_Engineer_menu/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>工程師管理
			</a>
			---->
			<?php		
			if( ($_SESSION['user_lv'])==1   )
			{
			?>
			<a href="../alert_contacts_setting/veiw_alert_contacts_setting.php"
			<?php if (preg_match("/alert_contacts_setting/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>信件通訊錄設定</a>
				<?php
			}
	?>
			
			<?php
			
			
			
			?>
			
			
		</div>

