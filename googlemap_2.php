<html>
<head>
<!----<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>-->
<?php  //康軍gmail-uunmask2000ㄧ googlemap api key = AIzaSyD4yLbmkhvVtPXMWXK8eij1K14dd6jml58
	//愛部落 AIzaSyAin5wQ_GES6g6JHQBcvR2HEORxaJ5ZfFY ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAin5wQ_GES6g6JHQBcvR2HEORxaJ5ZfFY&sensor=true&language=zh-TW"   type="text/javascript"></script>
<link href="include/style.css" rel="stylesheet" type="text/css" />
<link href="include/reset.css" rel="stylesheet" type="text/css" />

</head>
<body>
  <div id="map" style="height: 500px; width: 738px;">
</div>

<script type="text/javascript" charset="utf-8">
	
<?php
//$conn = pg_connect("host=127.0.0.1 port=5432 dbname=opennms user=opennms password=0932969495");
include("SQL/dbtools_ps.php");
 
 session_start();
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
	//$sql_ipinterface =" SELECT ipaddr	FROM ipinterface where 	nodeid='$node_id'  and  ipaddr NOT IN('172.21.42.101' ,'172.21.42.102' ,'172.21.42.111','172.21.42.121','172.21.42.122','172.21.42.123') ";  /// 2016.12.12 暫時遮蔽 椰油AP3
	//$sql_ipinterface =" SELECT ipaddr	FROM ipinterface where 	nodeid='$node_id' and  ipaddr<>'172.21.11.121'   ";   /// 2016.11.21 暫時遮蔽 大社AP4
	$sql_ipinterface =" SELECT ipaddr	FROM ipinterface where 	nodeid='$node_id'";
	$result_ipinterface = pg_query($conn,$sql_ipinterface );
	
	while ($row_ipinterface = pg_fetch_row($result_ipinterface)  )
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

//pg_close($conn);

?>	
	

<?php
	  require_once("SQL/dbtools.inc.php");
	  // $ABC ='<h1>My Web Page</h1><p id="demo">A Paragraph.</p><button type="button" onclick="myFunction()">点击这里</button>';
	  $link = create_connection();
?>
<?php


	$sql0 = "SELECT ass_address_id  FROM  assets_address   ";
	$result0 = execute_sql($database_name, $sql0, $link);
	while ($row0 = mysql_fetch_assoc($result0))
	{
	   ?>
		var txt = <?=$row0['ass_address_id'];?>;
	   <?php
	}
	
	
	
?>
	  var locations = [
<?php
///$sql = "SELECT *  FROM  assets_address  ";
	
		if(($_SESSION['user_lv'])<=2)
		{
		$sql = "SELECT *  FROM  assets_address  ";
		}else{
		$sql = "SELECT *  FROM  assets_address where type =1  "; //目前排除三期資料
		}

	
	
	$result = execute_sql($database_name, $sql, $link);
	while ($row = mysql_fetch_assoc($result))
	{    
			$type_photo = $row['type'] ; 
			$tribe_assets_name =  $row['tribe_ass_name'] ;
			$tribe_ass_x = $row['tribe_ass_x'];
			$tribe_ass_y = $row['tribe_ass_y']; 
			$addid= $row['ass_address_id'];
			$type_photo = $row['type'] ;
			$tribe_ass_own = $row['tribe_ass_own'] ; // 部落ID
			
?>
	['<?php include('inc.php') ;?>',<?=$tribe_ass_x ;?>,<?=$tribe_ass_y ;?>,<?=$addid;?>,<?=$type_photo;?>,'<?php include('check_type.php') ;?>'],
			<?php
	}
	$nus = mysql_num_rows($result);
?>
	];
   /*
    var locations = [
      ['Bondi Beach', -33.890542, 151.274856, 4],
      ['Coogee Beach', -33.923036, 151.259052, 5],
      ['Cronulla Beach', -34.028249, 151.157507, 3],
      ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
      ['Maroubra Beach<div><?=$ABC?></div>', -33.950198, 151.259302, 1],
    ];
  */
  
 

	
	  <?php
	  if($_GET['do']=='do')
	  {
		 $value =  $_GET['address'].$_GET['address2']; 
		  
		 // $value ='屏東縣霧台鄉';
		 ?>
		 var addr = '<?=$value;?>';
			 var geocoder = new google.maps.Geocoder();
			 geocoder.geocode
			 (
			 
					 {
							"address": addr
						}, function (results, status) 
						{
															
							var text =    results[0].geometry.location.lat() + "," + results[0].geometry.location.lng() ;
							//var arry = [text];
							//alert(addr);	
							//alert(text);		 
							location.href="?reback=MAP&city=<?=$_GET['city'];?>&township=<?=$_GET['township'];?>&map="+text;
							
						}
              
                
                
                );	
             
		 var map = new google.maps.Map(document.getElementById('map'), 
		 {
			 
		    zoom: 7,
			center: new google.maps.LatLng(               ),
     
		
		<?php   
		  
		  
		  
	  }else  if($_GET['reback']=='MAP')
	  {
			  ?>
			var map = new google.maps.Map(document.getElementById('map'), {
			 zoom: <?php if($_GET['size']==NULL){ echo '10';}else{echo $_GET['size'];}?>	,
			center: new google.maps.LatLng(<?php if($_GET['map']==NULL){ echo '23.5456438,120.6458377';}else{echo $_GET['map'];}?>						),
			<?php  
		  
	  }else
	  {
		?>
		var map = new google.maps.Map(document.getElementById('map'), {
		 zoom: <?php if($_GET['size']==NULL){ echo '7';}else{echo $_GET['size'];}?>	,
		center: new google.maps.LatLng(<?php if($_GET['map']==NULL){ echo '23.5456438,120.6458377';}else{echo $_GET['map'];}?>						),
     
		
		<?php  
		  
	  }
	  
	  ?>
      //mapTypeId: google.maps.MapTypeId.ROADMAP

	  mapTypeControl: true,
	    mapTypeControlOptions: {
		style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
		position: google.maps.ControlPosition.TOP_CENTER
	    },
	    zoomControl: true,
	    zoomControlOptions: {
		position: google.maps.ControlPosition.RUGHT_CENTER
	    },
	    scaleControl: false,
	    streetViewControl: false,
	    streetViewControlOptions: {
		position: google.maps.ControlPosition.LEFT_TOP
	    }




    });

    var infowindow = new google.maps.InfoWindow();
    
    
      ////
		var icon1 = 
		{
			url: "../images/ap_green.png", // url
			scaledSize: new google.maps.Size(20, 20), // scaled size
			origin: new google.maps.Point(0,0), // origin
			anchor: new google.maps.Point(17,34), // anchor
			//size: new google.maps.Size(20,20), // size
		};
		
		 var icon2 = 
		{
			url: "../images/package_green.png", // url
			scaledSize: new google.maps.Size(20, 20), // scaled size
			origin: new google.maps.Point(0,0), // origin
			anchor: new google.maps.Point(0, 0), // anchor
			//size: new google.maps.Size(20,20), // size
                         
		};
		
		 var icon3 = 
		{
			url: "../images/box_green.png", // url
			scaledSize: new google.maps.Size(20, 20), // scaled size
			origin: new google.maps.Point(0,0), // origin
			anchor: new google.maps.Point(0, 0), // anchor
			//size: new google.maps.Size(20,20), // size
		};
		
		 var icon4 = 
		{
			url: "../images/fire_msg.png", // url
			scaledSize: new google.maps.Size(20, 20), // scaled size
			origin: new google.maps.Point(0,0), // origin
			anchor: new google.maps.Point(0, 0), // anchor
			//size: new google.maps.Size(20,20), // size
		};
		
		 var icon5 = 
		{
			url: "../images/ap_red.png", // url
			scaledSize: new google.maps.Size(20, 20), // scaled size
			origin: new google.maps.Point(0,0), // origin
			anchor: new google.maps.Point(0, 0), // anchor
			//size: new google.maps.Size(20,20), // size
		};
		
    /////    

    var marker, i;
	//alert(locations);
    
    for (i = 0; i < locations.length; i++) 
	{ 
		//alert(locations[i][5]) ;
        if(locations[i][5]>0)
				{
					
					if(locations[i][4]==1)
					{
						
												marker = new google.maps.Marker
							(
							{
							position: new google.maps.LatLng(locations[i][1], locations[i][2]),
							map: map,
							//icon: '../images/package.png'
							icon: icon5,
							optimize: true,

							}
							);
	
						
					}else{
						
							marker = new google.maps.Marker
							(
							{
							position: new google.maps.LatLng(locations[i][1], locations[i][2]),
							map: map,
							//icon: '../images/package.png'
							icon: icon4,
							optimize: true,

							}
							);
					}
                        					
					
					
					
				}else{
					if(locations[i][4]==3)
				{
					marker = new google.maps.Marker
					(
					{
					position: new google.maps.LatLng(locations[i][1], locations[i][2]),
					map: map,
					//icon: '../images/package.png'
					icon: icon3,
					optimize: true,

					}
					);

				}else if(locations[i][4]==2)
				{
				marker = new google.maps.Marker
				(
					{
					position: new google.maps.LatLng(locations[i][1], locations[i][2]),
					map: map,
					//icon: '../images/box.png'
					icon: icon2,
					optimize: true,
					}
					);

				}else
				{
					marker = new google.maps.Marker
					(
					{
					position: new google.maps.LatLng(locations[i][1], locations[i][2]),
					map: map,
					//icon: '../images/location.png',
					icon: icon1,
					optimize: true,
					}
					);
				}
				}
        
				
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
	
        }
      })(marker, i));
    }
  </script>

  
  <?php
	//echo 'AAAAAAAAAAAAAAAAAAAAAa';
	//echo $_GET['map'];
	
	//echo $check_ip_death ;
	
	
	?>
</body>
</html>
