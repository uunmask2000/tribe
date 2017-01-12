<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>昨日各時段告警數量
</title>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		</head>
	<body>
	<?php
include_once("../SQL/dbtools_ps.php");
$today = date("Y-m-d ",strtotime("-1 day"));

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
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="../highcharts/exporting.js"></script>
 昨日告警總數: <?=$sum_arry ;?>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'areaspline'
        },
        title: {
            text: '昨日各時段告警數量'
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 15000,
            y: 10000,
            floating: true,
            borderWidth: 1,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        xAxis: {
            categories: [
			<?php
			for($doo=0;$doo<24;$doo++)
			{
				echo "'".''.$doo.'時'."'".',';
				
			}
			?>
			/*
               
               	'2016-03',
				'2016-03',
				'2016-03',
				'2016-03',
				'2016-03',
				'2016-03',
				'2016-03',
				'2016-03',
				'2016-03',
				*/
            ]
        },
		
        yAxis: {
            title: {
                text: '次數'
            }
        },
        tooltip: {
            shared: true,
            valueSuffix: ' 次'
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            areaspline: {
                fillOpacity: 0.5
            }
        },
		/*
        series: [{
            name: '上傳',
            data: [3, 4, 3, 5, 4, 10, 12]
        }, {
            name: '下載',
            data: [1, 3, 4, 3, 3, 5, 4]
        }]
		*/
		series: [
					{
						name: '告警次數',
						data: [
								
								<?php
								for($doo=0;$doo<24;$doo++)
								{
								echo $data_row[$doo].',';

								}
								?>
								
								//3, 4, 3, 5, 4, 10, 12
							  ]
					}
				]
    });
});
		</script>

















	</body>
</html>
