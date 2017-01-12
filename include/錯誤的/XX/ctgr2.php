<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<style>
.ctgr a { display:block;}
.ctgr_town, .ctgr_tribe  { display:none!important;}
.ctgr_town, .ctgr_tribe { padding:0 0 0 20px;}

</style>

</head>
<body>
<div class="ctgr">
<div class="ctgr_city">
	<a href="?a=1">縣市A1</a>
	
		<div class="ctgr_town" <?php if($_GET['a']==1){ ?>style="display:block!important;"<?php };?>> 
			<a href="?a=1&b=1">地區B1</a>
			
				<div class="ctgr_tribe" <?php if($_GET['a']==1 and $_GET['b']==1){ ?>style="display:block!important;"<?php };?>> 
				<a href="">部落A</a>
				<a href="">部落B</a>
				</div>
				
			<a href="?a=1&b=2">地區B2</a>
			
				<div class="ctgr_tribe" <?php if($_GET['a']==1 and $_GET['b']==2){ ?>style="display:block!important;"<?php };?>> 
				<a href="">部落C</a>
				<a href="">部落D</a>
				</div>
			
		</div>
	
	<a href="?a=2">縣市A2</a>

		<div class="ctgr_town" <?php if($_GET['a']==2 and $_GET['b']==3){ ?>style="display:block;"<?php };?>> 
			<a href="?a=2&b=3">地區B3</a>
			
				<div class="ctgr_tribe" >
				<a href="">部落E</a>
				<a href="">部落F</a>
				</div>
			
		</div>
</div>

	


	
</div>
	

</body>
</html>