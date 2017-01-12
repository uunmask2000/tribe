<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link href="../include/style.css" rel="stylesheet" type="text/css" />
<link href="../include/reset.css" rel="stylesheet" type="text/css" />

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/hot-sneaks/jquery-ui.css" rel="stylesheet">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
	  
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
		  <?php
		  require_once("dbtools.inc.php");
			$link = create_connection();
			$link2 = create_connection2();
			  $realm =$_GET['realm'];
			  $ass_ap_ip =$_GET['ass_ap_ip'];
			  $datepicker1 =$_GET['datepicker1'];
			  $datepicker2 =$_GET['datepicker2'];
		  
		  ?>
		  
        var data = google.visualization.arrayToDataTable([
         
          ['日期', '上傳流量(GB)', '下載流量(GB)'], 
            <?php

			  if($realm=='itw')
						{
							$key_string = "realm='itw'";
							
							}else{
								$key_string = "realm<>'itw'";
								
								}
								
								
								if($ass_ap_ip==NULL)
						{
							//$ass_ap_ip_string = "  ";
							
							}else{
								
								$ass_ap_ip_string = "nasipaddress IN ('$ass_ap_ip')  and ";
								//$ass_ap_ip_string = "nasipaddress IN ('172.21.2.111')  and ";
								}

						$datepicker11=strtotime($datepicker1);
						$datepicker22=strtotime($datepicker2); 
						$days=round(($datepicker22-$datepicker11)/3600/24) ;
						
						if($days>=1){
							
							//echo $days;     //days为得到的天数;
							for($doo=0 ; $doo <= $days ; $doo++)
							{
								
									$acctstarttime_key = date( "Y-m-d", strtotime( "$datepicker1 +$doo days" ) ); // PHP:  2009-03-03	
									//echo '<br>';
									
									 $sql="SELECT SUM(acctinputoctets),SUM(acctoutputoctets) FROM radacct  where $ass_ap_ip_string $key_string  and acctstarttime like '%$acctstarttime_key%'  ";
									  $result = execute_sql($database_name, $sql, $link);
									  $number1 = mysql_num_rows($result);
									 $day= $days;
									  while ($row= mysql_fetch_assoc($result) )
															{
																 
																$acctinputoctets=$row['SUM(acctinputoctets)']/(1000*1024*1024);
																$acctoutputoctets=$row['SUM(acctoutputoctets)']/(1000*1024*1024);
																  $acctinputoctets=  number_format($acctinputoctets,2);
																  $acctoutputoctets= number_format($acctoutputoctets,2);
																	$array[$doo][0]= $acctstarttime_key;
																	$array[$doo][1]= $acctinputoctets;
																	$array[$doo][2]= $acctoutputoctets;
																	//echo '<br>';
																//echo $j;
																//echo 	$acctstarttime_key;
																//echo '<br>';
																//echo $days; 
																}
									
								
							}
							
						
							
							}else
							{
								
								echo $days; 
								
								//exit();
								
								}
						
						
          
          
          
          
          
          
          //$array = array("2014-10", "2014-11", "2014-12");
          for($doo=0 ; $doo <= $day ; $doo++)
							{
          
						  ?>
							['<?=$array[$doo][0];?>',  <?=$array[$doo][1];?>,<?=$array[$doo][2];?>],
						  
						  <?php
						  
					  }
          
          
          ?>
        
        ]);

        var options = {
          title: '網路流量統計',
          hAxis: {title: '日期',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
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
				<input id="datepicker1" type="text" name="datepicker1" value="<?=$_GET['datepicker1'];?>"/>
				<input id="datepicker2" type="text" name="datepicker2"  value="<?=$_GET['datepicker2'];?>"/>
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
					  $.datepicker.setDefaults($.datepicker.regional["zh-TW"]);
					  $("#datepicker1").datepicker({dateFormat:"yy-mm-dd", onSelect: show_select1});
					  $("#datepicker2").datepicker({dateFormat:"yy-mm-dd", onSelect: show_select2});
					  function show_select1() {
						var date=$("#datepicker1").datepicker("getDate");
						//$("#msgbox1").html("選取的日期 : " + date);
						//$("#msgbox1").dialog("open");        
						}
					 function show_select2() {
						var date=$("#datepicker2").datepicker("getDate");
						//$("#msgbox1").html("選取的日期 : " + date);
						//$("#msgbox1").dialog("open");        
						}
					 
					 
					 
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
	 //echo  $ass_ap_ip;
	  
	      if($realm !=NULL and $ass_ap_ip !=NULL and $datepicker1 !=NULL and $datepicker2 !=NULL )
	      {echo '<div id="chart_div" style="width: 900px; height: 500px;"></div>';
		  }
else
		  {
		 }
	 	//print_r($array);
	 ?>
	  
  
    
    
		</div>
		</div>
 <!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</body>
</html>
