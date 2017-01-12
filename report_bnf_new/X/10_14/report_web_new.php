<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link href="../include/style.css" rel="stylesheet" type="text/css" />
<link href="../include/reset.css" rel="stylesheet" type="text/css" />

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/hot-sneaks/jquery-ui.css" rel="stylesheet">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<link href="timepicker_include/css/jquery-ui-timepicker-addon.css" rel="stylesheet">
<script type="text/javascript" src="timepicker_include/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="timepicker_include/js/jquery-ui-sliderAccess.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<?php
	require_once("dbtools.inc.php");
	$link = create_connection();
	$link2 = create_connection2();
	?>


		



  </head>
<script language="javascript">
			function printdiv(printpage)
			{
			var headstr = "<html><head><title></title></head><body>";
			var footstr = "</body>";
			var newstr = document.all.item(printpage).innerHTML;
			var oldstr = document.body.innerHTML;
			document.body.innerHTML = headstr+newstr+footstr;
			window.print();
			document.body.innerHTML = oldstr;
			return false;
			}
</script>
</head>

<body>
<div id="wrap">

<!-------------------------------------- TOP -->
	<div id="header">
	<?php
		include("../include/top.php");
	?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">
	<?php
		$realm =$_GET['realm'];
		$ass_ap_ip =$_GET['ass_ap_ip'];
		$datepicker1 =$_GET['datepicker1'];
		$datepicker2 =$_GET['datepicker2'];
		  
		if($realm=='itw')
		{
		$key_string = "realm='itw'";

		}else
		{
		$key_string = "realm<>'itw'";
		}

		if($ass_ap_ip!=NULL)
		{
			$ass_ap_ip_string = "nasipaddress IN ('$ass_ap_ip')  and ";
			
		}	
		
		$datepicker11=strtotime($datepicker1);
		$datepicker22=strtotime($datepicker2);
		//$days=round(($datepicker22-$datepicker11)/3600/24) ;	
		//echo  $datepicker11 ;
		//echo  $datepicker22 ;
		
		$day_count =  $datepicker22  -  $datepicker11 ;
		$days =  round((($day_count)/3600)/24) ;
		//echo $days ;
		//echo 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAa';
		
		//exit();
			$sql_datae="SELECT * FROM  ass_ap  where 	ass_ap_ip='$ass_ap_ip'     ";
			$result_datae = execute_sql($database_name2, $sql_datae, $link2);
			while ($row_datae= mysql_fetch_assoc($result_datae) )
			{
				$ass_ap_tribe = $row_datae['ass_ap_tribe'];
				$ass_ap_name = $row_datae['ass_ap_name'];


				$sql_tribe="SELECT * FROM  tribe where tribe_id='$ass_ap_tribe'     ";
				$result_tribe = execute_sql($database_name2, $sql_tribe, $link2);
				while ($row_tribe= mysql_fetch_assoc($result_tribe) )
				{
				$tribe_name = $row_tribe['tribe_name'];
				}
			}
			
			
			
				if($days>0)
				{
                     //00:
					//echo $days;     //days为得到的天数;
					$zzz = 0 ;
					for($doo=0 ; $doo <= $days ; $doo++ )
					{
						
					$zzz ++;
						//$acctstarttime_key =  date( "Y-m-d", strtotime( "$datepicker1" ) ); // PHP:  2009-03-03	
					    //echo $acctstarttime_key ;
						
						
						for($don=0 ; $don < 24 ; $don++)
						{
								if($don<10)
								{
								$don_hr = '0'.$don;
								}else{

								$don_hr = $don;
								}
						
						$acctstarttime_key = date( "Y-m-d", strtotime( "$datepicker1 +$doo days" ) ); // PHP:  2009-03-03	
						$sum_MAX = $doo*$don ;
						$acctstarttime_key_hr = $acctstarttime_key.' '.$don_hr; 
						//echo '<br>';
						//echo $acctstarttime_key_hr  ;
						//echo '<br>';
						$sql="SELECT SUM(acctinputoctets),SUM(acctoutputoctets) FROM radacct  where $ass_ap_ip_string $key_string  and acctstarttime like '%$acctstarttime_key%'  ";
						$result = execute_sql($database_name, $sql, $link);
						$number1 = mysql_num_rows($result);
						$day= $days;
						while ($row= mysql_fetch_assoc($result) )
						{

						$acctinputoctets=$row['SUM(acctinputoctets)']/(1000*1024);
						$acctoutputoctets=$row['SUM(acctoutputoctets)']/(1000*1024);
						$acctinputoctets=  number_format($acctinputoctets,2);
						$acctoutputoctets= number_format($acctoutputoctets,2);
						$array[0][$don][0]= $acctstarttime_key_hr;
						$array[0][$don][1]= $acctinputoctets;
						$array[0][$don][2]= $acctoutputoctets;
						//echo '<br>';
						//echo $j;
						//echo 	$acctstarttime_key;
						//echo '<br>';
						//echo $days; 
						}
						
						}
							


					}
				}				

//echo $sum_MAX;

/*
for($sum_MAX_do=0 ; $sum_MAX_do < $sum_MAX ; $sum_MAX_do++)
{
		//echo $array[$sum_MAX_do][0];
		//echo $array[$sum_MAX_do][1];
		//echo $array[$sum_MAX_do][2];
		//echo '<br>';
	//echo $sum_MAX_do;
}
*/	
	
	
	
	
	
	
	
	
	
	?>

		
		<?php include("../alert/alert2.php");?>
        
		<div class="report_nav">
			<h1>網路流量統計</h1>
		</div>
	  <?php
		
		?>
		
		
		<div class="report_bar">
			<div class="search">
			<form action="" method="GET">
					<select name="realm" size="1" > 
							<option  disabled selected>請選擇單位</option>
					<option value="itr" <?php if($_GET['realm']=='itr'){echo 'selected'; }?> ><?php  echo  '愛部落'; echo '</option>';	?>
					<option value="itw" <?php if($_GET['realm']=='itw'){echo 'selected'; }?> ><?php  echo  '愛台灣'; echo '</option>';	?>
					</select>					
				
				
				<select  name="ass_ap_ip" size="1" >
					<option  disabled selected>請選擇設備</option>
									
					<?php
					    $sql332=" SELECT id,city_name FROM `city_array`  ";
						$result332= execute_sql($database_name2, $sql332, $link2);
						while ($row332= mysql_fetch_assoc($result332)  )
									{
										$ass_ap_city = $row332['id'];
										//$row332['city_name'];
										
										echo '<optgroup label="'.$row332['city_name'].'">';
											  $sql333="SELECT * FROM `ass_ap` WHERE ass_ap_city='$ass_ap_city' ";
											  $result333= execute_sql($database_name2, $sql333, $link2);
											  while ($row333= mysql_fetch_assoc($result333)  )
													{
															  
														?>
													 <option value="<?=$row333['ass_ap_ip'];?>"  <?php if($_GET['ass_ap_ip']==$row333['ass_ap_ip']){  echo 'selected';  }?> ><?=$row333['ass_ap_name'];?></option>
													 <?php
												 }
							}				
					?>
				</select>
				<input id="datepicker1" name ="datepicker1"  type="text" placeholder="請選擇起始日期" value="<?=$_GET['datepicker1'];?>"  />
				<input id="datepicker2" name ="datepicker2" type="text" placeholder="~" value="<?=$_GET['datepicker2'];?>"  />
					  <script language="JavaScript">
						$(document).ready(function(){ 
						  $.datepicker.regional['zh-TW']={
							dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
							dayNamesMin:["日","一","二","三","四","五","六"],
							monthNames:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
							monthNamesShort:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
							prevText:"上月",
							nextText:"次月",
							weekHeader:"週"
							};
						  $.timepicker.regional['zh-TW']={
							timeOnlyTitle:"選擇時分秒",
							timeText:"時間",
							hourText:"時",
							minuteText:"分",
							secondText:"秒",
							millisecText:"毫秒",
							timezoneText:"時區",
							currentText:"現在時間",
							closeText:"確定",
							amNames:["上午","AM","A"],
							pmNames:["下午","PM","P"]
							};
						  $.datepicker.setDefaults($.datepicker.regional["zh-TW"]);
						  $.timepicker.setDefaults($.timepicker.regional["zh-TW"]);
						  
						  $("#datepicker1").datetimepicker({dateFormat:"yy-mm-dd",timeFormat:"HH:mm:ss", showSecond:true	});
						  $("#datepicker2").datetimepicker({dateFormat:"yy-mm-dd",timeFormat:"HH:mm:ss", showSecond:true	});
						  });
						  
					  </script>

				<input type="button" onclick="this.form.submit();" value="檢視報表">
			
			</form>
			</div>
			<div class="tool">
				<a name="b_print" class="ipt" href="" onClick="printdiv('div_print');">
				<img src="../images/print.png" width="24">
				</a>
			</div>
			<div class="c"></div>
		</div>
		
		
		<div class="report">
		<div id="div_print"><style>table td { padding:5px;} table th { padding:5px; border:#000 1px solid;}</style>

	 <?php
	 //echo  $ass_ap_ip;   <script> alert("Hello! I am an alert box!!");window.history.back();</script>
	      
		   
		   if($realm !=NULL and $ass_ap_ip !=NULL and $datepicker1 !=NULL and $datepicker2 !=NULL )
	      {
			  //echo 'AAAAAAAAAAAAAAAAAAAAAA';
			 // 
			 if(empty($number1))
			 {
				 
				 //echo '沒有資料';
				 ?>
				 <script>
				 alert("沒有資料!");window.history.back();
				 </script>
				 <?php
				 }else{
					 //echo  '<div>123456789</div>';
					 echo '<div id="chart_div" style="width: 900px; height: 500px;"></div>';
					 
					 }
			 
			 
		  }
			else
		  {
				 if($realm ==NULL )
				 {
					echo   '請設定單位';
					echo '<br>';
				 }
				 
				 if($ass_ap_ip ==NULL )
				 {
					echo   '請設定設備';
					echo '<br>';
				 }
				 
				 if($datepicker1 ==NULL )
				 {
					echo   '請設定起始日期';
					echo '<br>';
				 }
				 
				 if($datepicker2 ==NULL )
				 {
					echo   '請設定結束日期';
					echo '<br>';
				 
				   
				 
				 } 
				 
				 
				
				
				
				
		 }
	 	print_r($array);
	 ?>
	  
  
    
    
		</div>
		</div>
		
		<?php
		//echo $sum_MAX;
		
		?>
		
    <script type="text/javascript">
	
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
           ['日期', '上傳流量(MB)', '下載流量(MB)'],
			<?php
			for($doo=0 ;$doo < 24 ; $doo++)
			{
				?>
				['<?=$array[0][$doo][0];?>',  <?=$array[0][$doo][1];?>,<?=$array[0][$doo][2];?>],
				<?php
				
			}
			
			?>  
				
		  
		  
        ]);

          var options = {
          title: '<?php echo   $tribe_name.':'.$ass_ap_name.' '    ;?>網路流量統計',
          hAxis: {title: '時間區間<?php echo $datepicker1.'~~'.$datepicker2;    ?>',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

 <!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php   include("../include/bottom.php"); ?>
	</div>

	
	
</body>
</html>
