<?php
/*
JQ UI 在IE體系怪怪的 需要修復



*/



?>
<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<!--
<link href="css/jq_ui_css/jquery-ui.css" rel="stylesheet">
-->
<script src="https://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

<button id="opener">昨日各時段告警數量統計圖</button>
<div id="dialog" title="昨日各時段告警數量統計圖"><iframe src="Daily_alarm/Yesterday_alarm.php" height="900px" width="900px" scrolling="no" ></iframe></div>
 
<script>
$( "#dialog" ).dialog(
	{ 
		autoOpen: false,
		width: 550 ,
	    height: 600 ,
	}
	
	);
$( "#opener" ).click(function() {
  $( "#dialog" ).dialog( "open" );
});
</script>

<button id="opener1">本日各時段告警數量統計圖</button>
<div id="dialog1" title="本日各時段告警數量統計圖"><iframe src="Daily_alarm/Daily_alarm.php" height="900px" width="900px" scrolling="no"></iframe></div>
<script>
$( "#dialog1" ).dialog(
	{ 
		autoOpen: false,
		width: 550 ,
	    height: 600 ,
	}
	
	);
$( "#opener1" ).click(function() {
  $( "#dialog1" ).dialog( "open" );
});
</script>