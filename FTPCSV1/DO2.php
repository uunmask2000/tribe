<html>

<head>

<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">

</head>



<body>

<h2 align=center>時程表</h2>

<hr>

<script>

function showTime()

	{

		date=new Date();

		var aaa = date ;

		document.theForm.theText.value=date.toLocaleString();

		var Str = date.toLocaleString();

		

		var entry = Str.split(' ');

		//document.theForm.time.value=entry[2];

		var  do_alert =  entry[2] ;

		//var  hm =  date.getHours()+':'+date.getMinutes()+':'+date.getSeconds();
		var  hm =  date.getMinutes()+':'+date.getSeconds();
		
		
		

		if(hm == '1:1' )

		{

		   document.theForm.time.value= hm;

 				var javascriptVariable = "update1";
  				window.location.href = "?update=" + javascriptVariable; 

			



		}else
		{

		    document.theForm.time.value= 'Notworking';

		}

		

		//date.getHours().getMinutes();

		document.theForm.time1.value= hm;



		

	}

clock=setInterval("showTime()", 500);		//每秒更新

</script>



<center>

<form name="theForm">

時間<input type="text" name="theText" size="30" disabled>

<input type="text" name="time" size="30"  disabled>

<input type="text" name="time1" size="30"  disabled>

</form>

</center>

<?php

     $update = $_GET['update'];
	 if($update == 'update1' )
	 {
	 
		 //require_once("scv_table.php");
	 	 //require_once("view_case.php");
	     ?>
		<iframe src="scv_table_time.php" width="100%" height="100%" frameborder="0" scrolling="yes"></iframe>
		<?php
		//header("Refresh: 600; url=DO2.php");
	 }





?>

</body>

</html>
