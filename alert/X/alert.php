<?php
if(($_SESSION['user_lv'])==1)
			{
				
				
				
		
?>

<style type="text/css">
	div#abgne_marquee {
		position: relative;
		top:0px;left:90px;
		overflow: hidden;
		width: 890px;
		height: 25px;
		background: #fff;
	}
	div#abgne_marquee ul, div#abgne_marquee li {
		margin: 0;
		padding: 0;
		list-style: none;
	}
	div#abgne_marquee ul {
		position: absolute;
		left: 30px;			/* 往後推個 30px */
	}
	div#abgne_marquee ul li a {
		display: block;
		overflow: hidden;	/* 超出範圍的部份要隱藏 */
		font-size:12px;
		height: 25px;
		line-height: 25px;
		padding-left: 0px;
		text-decoration: none;
		text-indent: 0;
	}
	div#abgne_marquee div.marquee_btn {
		position: absolute;
		cursor: pointer;

	}
	div#abgne_marquee div#marquee_next_btn {
		left: -75px;
	}
	div#abgne_marquee div#marquee_prev_btn {
		right: 5px;
	}
</style>
<script type="text/javascript">
	$(function(){
		// 先取得 div#abgne_marquee ul
		// 接著把 ul 中的 li 項目再重覆加入 ul 中(等於有兩組內容)
		// 再來取得 div#abgne_marquee 的高來決定每次跑馬燈移動的距離
		// 設定跑馬燈移動的速度及輪播的速度
		var $marqueeUl = $('div#abgne_marquee ul'),
			$marqueeli = $marqueeUl.append($marqueeUl.html()).children(),
			_height = $('div#abgne_marquee').height() * -1,
			scrollSpeed = 600,
			timer,
			speed = 3000 + scrollSpeed,
			direction = 1,	// 0 表示往上, 1 表示往下
			_lock = false;

		// 先把 $marqueeli 移動到第二組
		$marqueeUl.css('top', $marqueeli.length / 2 * _height);
		
		// 幫左邊 $marqueeli 加上 hover 事件
		// 當滑鼠移入時停止計時器；反之則啟動
		$marqueeli.hover(function(){
			clearTimeout(timer);
		}, function(){
			timer = setTimeout(showad, speed);
		});
		
		// 判斷要往上還是往下
		$('div#abgne_marquee .marquee_btn').click(function(){
			if(_lock) return;
			clearTimeout(timer);
			direction = $(this).attr('id') == 'marquee_next_btn' ? 0 : 1;
			showad();
		});
		
		// 控制跑馬燈上下移動的處理函式
		function showad(){
			_lock = !_lock;
			var _now = $marqueeUl.position().top / _height;
			_now = (direction ? _now - 1 + $marqueeli.length : _now + 1)  % $marqueeli.length;
			
			// $marqueeUl 移動
			$marqueeUl.animate({
				top: _now * _height
			}, scrollSpeed, function(){
				// 如果已經移動到第二組時...則馬上把 top 設回到第一組的最後一筆
				// 藉此產生不間斷的輪播
				if(_now == $marqueeli.length - 1){
					$marqueeUl.css('top', $marqueeli.length / 2 * _height - _height);
				}else if(_now == 0){
					$marqueeUl.css('top', $marqueeli.length / 2 * _height);
				}
				_lock = !_lock;
			});
			
			// 再啟動計時器
			timer = setTimeout(showad, speed);
		}
		
		// 啟動計時器
		timer = setTimeout(showad, speed);

		$('a').focus(function(){
			this.blur();
		});
	});
</script>

<?php
if(($_SESSION['login'])=='login')
			{
				
			}
?>

<div id="alert">
	<div id="abgne_marquee">
		<div class="marquee_btn" id="marquee_next_btn"><img src="../images/marquee_next_btn.jpg"></div>
		<ul style="top: -55px;">

<?php

//$conn = pg_connect("host=127.0.0.1 port=5432 dbname=opennms user=opennms password=0932969495");
include("SQL/dbtools_ps.php");
 
$sql_text ="SELECT  iflostservice,ifserviceid,ifregainedservice,outageid,serviceid,svclosteventid  FROM (SELECT * FROM outages ) AS  outages 
INNER JOIN (SELECT * FROM ifservices) AS ifservices ON   outages.ifserviceid=ifservices.id
where serviceid=2 and  svcregainedeventid is NULL ";
$result_outages = pg_query($conn,$sql_text );
$total_records2 = pg_num_rows($result_outages);
//echo 	$total_records2;
while ($row_outages = pg_fetch_row($result_outages) )
{
	$events_id=$row_outages[5];
	$events_time=$row_outages[0];
	//eventid	
	$sql_events =" SELECT nodeid,eventlogmsg	FROM events where eventid='$events_id'   ";
	$result_events = pg_query($conn,$sql_events );
	//echo  $sql_events ;
	while ($row_events = pg_fetch_row($result_events) )
	{
	    //echo $row_events[1];
		//echo '<br>';
		$node_id = $row_events[0];
		$eventlogmsg = $row_events[1];
	
		$sql_ipinterface =" SELECT ipaddr	FROM ipinterface where 	nodeid='$node_id'   ";
		$result_ipinterface = pg_query($conn,$sql_ipinterface );
		//echo  $sql_ipinterface ;
		while ($row_ipinterface = pg_fetch_row($result_ipinterface) )
		{
			//echo $row_ipinterface[0];
			//echo '<br>';
			//`ass_grouter_address`='$addid'  
			$query_ip = $row_ipinterface[0];
			/*
			if (preg_match("/\.5/i", $query_ip))
				{
				
				 ?>
				<li><a href="../ap_data.php?ip=<?=$query_ip;?>" target="_blak"> 時間: <?php echo substr($events_time, 0, 19);?> 訊息:<?=$eventlogmsg?>  </a></li>
				<?php
			
				
				}else
				{
			
				 ?>
				<li><a href="http://<?=$query_ip;?>" target="_blak"> 時間: <?php echo substr($events_time, 0, 19);?>訊息:<?=$eventlogmsg?>  </a></li>
				<?php
			
				}
			*/
	?>
	<li><a href="../alert/check_alert_ip_type.php?ip=<?=$query_ip;?>" target="_blak"> 時間: <?php echo substr($events_time, 0, 19);?> 訊息:<?=$eventlogmsg?>  </a></li>
	<?php

			
				
			}
		
	}
	
}	
?>
	</ul>
		<div class="marquee_btn" id="marquee_prev_btn"><img src="../images/marquee_prev_btn.jpg"></div>
	</div>
</div>
<?php
	}

pg_close($conn);
?>

