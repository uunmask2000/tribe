<?php
include_once("../SQL/dbtools_ps.php");
$today = date("Y-m-d ");

$do = 0 ;
for($t=0;$t<24;$t++)
{
	if($t<10)
	{
		$t= '0'.$t ;
	}else{
		$t =$t ;
	}
	$sql_qery = $today.$t.':' ;
	//echo  $sql_qery.'!';
	//echo '<br>';
	
	$sql_text ="SELECT  iflostservice,ifserviceid,ifregainedservice,outageid,serviceid,svclosteventid  FROM (SELECT * FROM outages ) AS  outages 
INNER JOIN (SELECT * FROM ifservices) AS ifservices ON   outages.ifserviceid=ifservices.id
where serviceid=2 and iflostservice::text like '%$sql_qery%'";
$result_outages = pg_query($conn,$sql_text );
$total_records2 = pg_num_rows($result_outages);
$data_time[$do]=$t ;
$data_row[$do]=$total_records2;

		$do++;

}
  //print_r($data_time);
  //print_r($data_row);
  $sum_arry = array_sum($data_row) ;
?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
         ['時間', '數量'],
		  <?php
			for($tt=0;$tt<24;$tt++)
			{
             ?>
			   ['<?=$tt;?>:時',<?=$data_row[$tt];?>],
			 <?php

			}	  
		  ?>
		  		
        ]);

        var options = {
          title: '本日各時段告警數量',
          hAxis: {title: '時間區間',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  
 <div style=" width:400px, height:400px;">
本日累積告警總數: <?=$sum_arry ;?>
<div id="chart_div" style="width: 500px; height: 500px;"></div>
</div>
