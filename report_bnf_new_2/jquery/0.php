
<!DOCTYPE html>
<!--[if lt IE 9]>
<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<html>
<head>
  <meta charset="utf-8">
  <title>jQuery UI 測試</title>
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/hot-sneaks/jquery-ui.css" rel="stylesheet">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="jquery.ui.datepicker-zh-TW.js"></script>
  <style>
    article,aside,figure,figcaption,footer,header,hgroup,menu,nav,section {display:block;}
    body {font: 62.5% "Trebuchet MS", sans-serif; margin: 50px;}
  </style>
</head>
<body>
  <input id="start_date" type="text"  name="start_date" />
   <input id="end_date" type="text"  name="end_date" />
  <script language="JavaScript"> 
			$('#start_date').datepicker({
			dateFormat: 'yy-mm-dd'
			});
			$('#end_date').datepicker({
			dateFormat: 'yy-mm-dd'
			});
  </script>
</body>
</html>