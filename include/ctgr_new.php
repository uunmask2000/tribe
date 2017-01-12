
<link href="css/jquery-accordion-menu.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-accordion-menu.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){	
	//顶部导航切换
	$("#demo-list li").click(function(){
		$("#demo-list li.active").removeClass("active")
		$(this).addClass("active");
	})	
})	
</script>

<?php
//$conn = pg_connect("host=127.0.0.1 port=5432 dbname=opennms user=opennms password=0932969495");
include("SQL/dbtools_ps.php");
$sql_text ="SELECT  iflostservice,ifserviceid,ifregainedservice,outageid,serviceid,svclosteventid  FROM (SELECT * FROM outages ) AS  outages 
INNER JOIN (SELECT * FROM ifservices) AS ifservices ON   outages.ifserviceid=ifservices.id
where serviceid=2 and  ifregainedservice is NULL ";
$result_outages = pg_query($conn,$sql_text );
$total_records2 = pg_num_rows($result_outages);

$j = 0;
//$array = array(};

while ($row_outages = pg_fetch_row($result_outages) )
{
$events_id=$row_outages[5];
//eventid	
$sql_events =" SELECT nodeid	FROM events where eventid='$events_id'   ";
$result_events = pg_query($conn,$sql_events );
//echo  $sql_events ;

while ($row_events = pg_fetch_row($result_events) )
{
	$node_id = $row_events[0];
	//$sql_ipinterface =" SELECT ipaddr	FROM ipinterface where 	nodeid='$node_id' and  ipaddr NOT IN('172.21.42.101' ,'172.21.42.102' ,'172.21.42.111','172.21.42.121','172.21.42.122','172.21.42.123')   "; /// 2016.12.12 暫時遮蔽 椰油AP
	//$sql_ipinterface =" SELECT ipaddr	FROM ipinterface where 	nodeid='$node_id' and  ipaddr<>'172.21.11.121'   ";   /// 2016.11.21 暫時遮蔽 大社AP4
	$sql_ipinterface =" SELECT ipaddr	FROM ipinterface where 	nodeid='$node_id'";
	$result_ipinterface = pg_query($conn,$sql_ipinterface );
	
	while ($row_ipinterface = pg_fetch_row($result_ipinterface) )
	{
		//echo $row_ipinterface[0];
		//echo '<br>';
		//`ass_grouter_address`='$addid'  
	$query_ip = $row_ipinterface[0];
	//echo  $query_ip ;
	//echo '<br>';
	//echo $j;
	$array[$j] = $query_ip;
	$j++;
	
	
	}
}

}
$check_ip_death = implode(",",$array);
pg_close($conn);
?>

<?php
        



?>

<div class="content"><div class="clr"></div>
	<div id="jquery-accordion-menu" class="jquery-accordion-menu red">

		<ul id="demo-list" id="list_first">
		 <?php
		 //require_once("../SQL/dbtools.inc.php");
		$link = create_connection();
		$sql = "SELECT * FROM city_array ORDER BY city_sort ASC";
		$result = execute_sql($database_name, $sql, $link);
		while ($row = mysql_fetch_assoc($result))
		{
			$id = $row['id'] ;
		
			$sql33 = "SELECT *  FROM  city_township where township_city='$id'  ";
			$result33 = execute_sql($database_name, $sql33, $link);
			if (mysql_num_rows($result33)!=NULL)
			{
				?>
				<li class="">
				<?php echo  '<a href="googlemap_2.php?city='.$id.'&address='.$row["city_name"].'&do=do" target="googlemap">'.$row["city_name"] .'</a>';?>
				<?php
					if(($_SESSION['user_lv'])<=2)
						{
						
							$sql_check_city = "
							SELECT ass_ap_ip FROM ass_ap WHERE 	ass_ap_city='$id'  
							UNION
							SELECT ass_pdu_ip FROM ass_pdu WHERE ass_pdu_city='$id' 
							UNION
							SELECT ass_4Gip FROM ass_4Ggrouter WHERE ass_4Ggrouter_city='$id' 
							UNION
							SELECT ass_ip FROM ass_grouter WHERE ass_grouter_city='$id'  
							UNION
							SELECT ass_poesw_ip FROM ass_poesw WHERE ass_poesw_city='$id'  ";
						
						}else{
							$sql_check_city = "SELECT ass_ap_ip FROM ass_ap WHERE 	ass_ap_city='$id' and ass_ap_tribe NOT IN (43,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110) ";
							//echo $sql_check_city ;
							//$sql_check_city = "SELECT ass_ap_ip FROM ass_ap WHERE 	ass_ap_city='$id'  and 	  ";
						
						
						}
				
							
							
							
							
							$result_check_city = execute_sql($database_name, $sql_check_city, $link);
							while ($row_check_city  = mysql_fetch_assoc($result_check_city))
							{
							$subject_check_city = $row_check_city['ass_ap_ip'];
							//echo $subject_check_city;
							//echo '<br>';
							if(preg_match("/$subject_check_city/","$check_ip_death")) {
							//echo "OK";
							//echo '<br>';
							$city_Equipment =1;

							} else {
							//echo "error";
							//echo '<br>';
							$city_Equipment =0;
							}


							if($city_Equipment>0){ echo '<span class="jquery-accordion-menu-label">!</span>' ;}	
							}
				
				?>
				
				
				<?php
				$sql1 = "SELECT *  FROM  city_township where township_city='$id' and township_id <> 36 ";  //排除測試區
					$result1 = execute_sql($database_name, $sql1, $link);
					while ($row1 = mysql_fetch_assoc($result1))
					{   
					$township_id = $row1["township_id"] ;
					?>
					<ul class="submenu" id="list_sec">

                        
						<li>
<?php echo  '<a href="googlemap_2.php?city='.$id.'&township='.$township_id.'&address='.$row["city_name"].'&address2='.$row1["township_name"].'&do=do" target="googlemap">'.$row1["township_name"] .'</a>';
					  ?>
					  <?php 
						if(($_SESSION['user_lv'])<=2)
						{
								$SQL2 = "
								SELECT ass_ap_ip FROM ass_ap WHERE 	ass_ap_twon='$township_id'  
								UNION
								SELECT ass_pdu_ip FROM ass_pdu WHERE ass_pdu_twon='$township_id' 
								UNION
								SELECT ass_4Gip FROM ass_4Ggrouter WHERE ass_4Ggrouter_twon='$township_id' 
								UNION
								SELECT ass_ip FROM ass_grouter WHERE ass_grouter_twon='$township_id'  
								UNION
								SELECT ass_poesw_ip FROM ass_poesw WHERE ass_poesw_twon='$township_id'  ";
						}else{
							$SQL2 = "SELECT ass_ap_ip FROM ass_ap WHERE 	ass_ap_twon='$township_id' and ass_ap_tribe NOT IN (43,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110) 	";  //目前排除三期資料
							//$SQL2 = "SELECT ass_ap_ip FROM ass_ap WHERE 	ass_ap_twon='$township_id'  ";
						
						}
					  
					  
					  
					  
								
								$result_SQL2 = execute_sql($database_name, $SQL2, $link);
								//echo $SQL2;
								while ($row_SQL2  = mysql_fetch_assoc($result_SQL2))
								{
								$subject_check_twon = $row_SQL2['ass_ap_ip'];
								//echo $subject_check_city;
								//echo '<br>';
								if(preg_match("/$subject_check_twon/","$check_ip_death")) {
								//echo "OK";
								//echo '<br>';
								$twon_Equipment =1;

								} else {
								//echo "error";
								//echo '<br>';
								$twon_Equipment =0;
								}
								//echo $twon_Equipment;
								//echo '<br>';
								if($twon_Equipment>0){ echo '<span class="jquery-accordion-menu-label">!</span>' ;}	
								}

						
						?>
					
						
							<ul class="submenu" id="list_thr">
							<?php
							$sql2 = "SELECT *  FROM  tribe where township_id='$township_id' and  tribe_label >0  "; //目前排除測試區
						$result2 = execute_sql($database_name, $sql2, $link);
						while ($row2 = mysql_fetch_assoc($result2))
						{
							$tribe_id = $row2["tribe_id"] ;
						?>
							<li>
							<a href="googlemap_2.php?city=<?=$id;?>&township=<?=$township_id?>&tribe_id=<?php echo $row2["tribe_id"] ; ?>&address=<?=$_GET["address"];?>&address2=<?=$_GET["address2"];?>&map=<?php echo $row2["tribe_x"] ; ?>,<?php echo $row2["tribe_y"] ; ?>&do=not&size=<?php echo $row2["tribe_o"] ; ?>" target="googlemap" ><?php  echo $row2["tribe_name"] ;   ?></a>
							<?php
		if(($_SESSION['user_lv'])<=2)
		{
				$SQL = "
				SELECT ass_ap_ip FROM ass_ap WHERE 	ass_ap_tribe='$tribe_id'  
				UNION
				SELECT ass_pdu_ip FROM ass_pdu WHERE ass_pdu_tribe='$tribe_id' 
				UNION
				SELECT ass_4Gip FROM ass_4Ggrouter WHERE ass_4Ggrouter_tribe='$tribe_id' 
				UNION
				SELECT ass_ip FROM ass_grouter WHERE ass_grouter_tribe='$tribe_id'  
				UNION
				SELECT ass_poesw_ip FROM ass_poesw WHERE ass_poesw_tribe='$tribe_id'  ";

		}else{
	$SQL = "SELECT ass_ap_ip FROM ass_ap WHERE 	ass_ap_tribe='$tribe_id' and ass_ap_tribe NOT IN (43,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110) ";  //目前排除三期資料

		//$SQL = "SELECT ass_ap_ip FROM ass_ap WHERE 	ass_ap_tribe='$tribe_id'   ";
		}
							
							
							
								$result_SQL = execute_sql($database_name, $SQL, $link);
								//echo $SQL;
								while ($row_SQL  = mysql_fetch_assoc($result_SQL))
								{
								$subject_check_tribe = $row_SQL['ass_ap_ip'];
								//echo $subject_check_city;
								//echo '<br>';
								if(preg_match("/$subject_check_tribe/","$check_ip_death")) {
								//echo "OK";
								//echo '<br>';
								$tribe_Equipment =1;

								} else {
								//echo "error";
								//echo '<br>';
								$tribe_Equipment =0;
								}
								//echo $tribe_Equipment;
								//echo '<br>';
								if($tribe_Equipment>0){ echo '<span class="jquery-accordion-menu-label">!</span>' ;}	
								}						?>
							
							
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
				
			</li>
				
				
				<?php
				
			}
		
		
		}
		 
		 
		 
		 
		 
		 
		 ?>
		 
		 
		 <!---
			<li><a href="googlemap_2.php?city=2&address=新北市&do=do" target="googlemap">新北市 </a></li>
			<li><a href="googlemap_2.php?city=3&address=桃園市&do=do" target="googlemap">桃園市 </a></li>
			<li><a href="googlemap_2.php?city=7&address=新竹縣&do=do" target="googlemap">新竹市 (警示)</a><span class="jquery-accordion-menu-label">!</span></li>
			<li class=""><a href="googlemap_2.php?city=15&address=花蓮縣&do=do" target="googlemap">花蓮縣 </a>
				<ul class="submenu">
					<li><a href="googlemap_2.php?city=15&township=16&address=花蓮縣&address2=豐濱鄉&do=do" target="googlemap">豐濱鄉 </a></li>
					<li><a href="googlemap_2.php?city=15&township=17&address=花蓮縣&address2=秀林鄉&do=do" target="googlemap">秀林鄉 </a>
						<ul class="submenu">
							<li><a href="googlemap_2.php?city=15&township=17&tribe_id=25&address=花蓮縣&address2=秀林鄉&map=24.1557306,121.6489047&do=not&size=16" target="googlemap">得吉利部落【上村】 </a></li>
							<li><a href="googlemap_2.php?city=15&township=17&tribe_id=29&address=花蓮縣&address2=秀林鄉&map=24.1028819,121.6048653&do=not&size=16" target="googlemap">布拉旦部落【1】 </a></li>
							<li><a href="googlemap_2.php?city=15&township=17&tribe_id=35&address=花蓮縣&address2=秀林鄉&map=24.1188282,121.6242252&do=not&size=17" target="googlemap">秀林部落 </a></li>
							<li><a href="googlemap_2.php?city=15&township=17&tribe_id=56&address=花蓮縣&address2=秀林鄉&map=24.1476586,121.6290527&do=not&size=17" target="googlemap">固祿部落 </a></li>
						</ul>
					</li>
					<li><a href="googlemap_2.php?city=15&township=31&address=花蓮縣&address2=光復鄉&do=do">光復鄉 </a></li>
				</ul>
			</li>
			--->
			
			

		</ul>
		

	</div>
</div>


<script type="text/javascript">
(function($) {
$.expr[":"].Contains = function(a, i, m) {
	return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
};
function filterList(header, list) {
	//@header 头部元素
	//@list 无需列表
	//创建一个搜素表单
	var form = $("<form>").attr({
		"class":"filterform",
		action:"#"
	}), input = $("<input>").attr({
		"class":"filterinput",
		type:"text"
	});
	$(form).append(input).appendTo(header);
	$(input).change(function() {
		var filter = $(this).val();
		if (filter) {
			$matches = $(list).find("a:Contains(" + filter + ")").parent();
			$("li", list).not($matches).slideUp();
			$matches.slideDown();
		} else {
			$(list).find("li").slideDown();
		}
		return false;
	}).keyup(function() {
		$(this).change();
	});
}
$(function() {
	filterList($("#form"), $("#demo-list"));
});
})(jQuery);	
</script>

<script type="text/javascript">

	jQuery("#jquery-accordion-menu").jqueryAccordionMenu();
	
</script>