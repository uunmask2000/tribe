
		<div class="tabs">
			<a style="background:#ead5a5;" href="../mng_anchor/mng_anchor.php" 
			<?php if (preg_match("/anchor/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>
			錨點管理</a>
			資產分類︰
			<a href="../asset_mng/view_fw.php"
			<?php if (preg_match("/fw/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>F/W</a>
			<a href="../asset_mng/view_4grouter.php"
			<?php if (preg_match("/4grouter/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>4G Router</a>
            		<a href="../asset_mng/view_pdu.php"
			<?php if (preg_match("/pdu/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>PDU</a>
            		<a href="../asset_mng/view_poesw.php"
			<?php if (preg_match("/poesw/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>POE SW</a>
			<a href="../asset_mng/view_ap.php"
			<?php if (preg_match("/ap/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>AP</a>
			<a href="../asset_mng/view_other.php"
			<?php if (preg_match("/other/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>其他</a>
			<!--
			<a href="../asset_mng/view_asset.php">全部</a>
			-->
			
			<a href="../report_bnf_new_2/Export_Assets.php" 
			<?php if (preg_match("/Export_Assets/i", $_SERVER['PHP_SELF'])) {	echo "class='linked'"; } ?>
			>部落資產總表</a>
			
			
		</div>

