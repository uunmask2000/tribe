
		<div class="tabs">
			資產分類︰
			<a href="../device_defend/view_fw.php"
			<?php if (preg_match("/fw/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>F/W</a>
			<a href="../device_defend/view_4grouter.php"
			<?php if (preg_match("/4grouter/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>4G Router</a>
            		<a href="../device_defend/view_pdu.php"
			<?php if (preg_match("/pdu/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>PDU</a>
            		<a href="../device_defend/view_poesw.php"
			<?php if (preg_match("/poe/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>POE SW</a>
			<a href="../device_defend/view_ap.php"
			<?php if (preg_match("/ap/i", $_SERVER['PHP_SELF'])) {echo "class='nav_linked'"; } 
			?>>AP</a>
		</div>

