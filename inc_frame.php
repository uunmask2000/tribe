<!----lazyload----->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="jq_lazy_load_js/jquery.lazyload.js?v=1.9.7"></script>
<script src="http://www.appelsiini.net/js/all.js"></script>

<!--輪播-->
<link href="include/slider.css" rel="stylesheet" type="text/css">


<div class="slider_box" id="slider_name">
	<ul class="silder_con">	
<?php 
	//echo 'A';
	
	//echo $_GET['key'];
	$key_id = $_GET['key'];
	require_once("SQL/dbtools.inc.php");
	$link = create_connection();
	$sql = "SELECT base_ico,base_ico2,base_ico3,ass_address_id  FROM  assets_address where ass_address_id='$key_id'   ";
	$result = execute_sql($database_name, $sql, $link);
	while ($row = mysql_fetch_assoc($result))
	{   
		
	$base_ico =$row['base_ico'];
	$base_ico2 =$row['base_ico2'];
	$base_ico3 =$row['base_ico3'];
	/*
	echo '<img  class="lazy img-responsive" data-original="'.$base_ico.'" src="'.$base_ico.'" width="150px" height="150px" />';
	if($base_ico2!=NULL)
		{ echo '<img  class="lazy img-responsive" data-original="'.$base_ico2.'" src="'.$base_ico.'" width="150px" height="150px" />';}
	if($base_ico3!=NULL)
			 { echo '<img  class="lazy img-responsive" data-original="'.$base_ico3.'" src="'.$base_ico.'" width="150px" height="150px" />';}						
			
		
	}
	*/
	
	echo '<li class="silder_panel"><a href="#" class="f_l"><img  class="lazy img-responsive" data-original="'.$base_ico.'" src="'.$base_ico.'" width="150px" height="150px" /></a></li>';
	if($base_ico2!=NULL)
		{ echo '<li class="silder_panel"><a href="#" class="f_l"><img  class="lazy img-responsive" data-original="'.$base_ico2.'" src="'.$base_ico2.'" width="150px" height="150px" /></a></li>';}
	if($base_ico3!=NULL)
			 { echo '<li class="silder_panel"><a href="#" class="f_l"><img  class="lazy img-responsive" data-original="'.$base_ico3.'" src="'.$base_ico3.'" width="150px" height="150px" /></a></li>';}						
	}
?>
	</ul>
</div>

<!--輪播-->
<script src="js/jquery.slides.js" type="text/javascript"></script>
<!----lazyload----->
<script type="text/javascript" charset="utf-8">
	  $(function() {
		 $("img.lazy").lazyload();
	  });
</script>
