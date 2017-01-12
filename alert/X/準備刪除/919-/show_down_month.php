
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link href="../include/style.css" rel="stylesheet" type="text/css" />
<link href="../include/reset.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../js/jq-1.11.1.js"></script>

<style>
table.alert_tb { width:100%;}
table.alert_tb tr th {
background:#f3c641;
}
table.alert_tb tr td ,table.alert_tb th {
	padding: 7px;
    text-align: center;
    border: #aaa 1px solid;
}

.alert_tt {padding:7px; margin:0 0 10px;}
</style>


</head>

<body>

<div id="wrap">

<!-------------------------------------- TOP -->
	<div id="header">
	<?php include("../include/top.php"); ?>
	</div>

<!-------------------------------------- MAIN -->
  	<div id="main">

		<?php 
		
		
		
		include("alert.php"); 
		require_once("../SQL/dbtools.inc.php");
		$link = create_connection();
		?>

		
		<?php
		$conn = pg_connect("host=127.0.0.1 port=5432 dbname=opennms user=opennms password=0932969495");
		
		if($_GET['do']=='left')
			{
				//$_POST['page']= $_GET['page']-1;
				$_GET['page'] = $_POST['page']-1;
				$_POST['page']=  $_GET['page'];
				
				$_POST['view_num']= $_GET['view_num'];
				$records_per_page= $_POST['view_num'];

			}else if($_GET['do']=='right')
			{
				
				
				//$_POST['page']= $_GET['page']+1;
				$_GET['page'] = $_POST['page']+1;
				 $_POST['page']=  $_GET['page'];
				
				$_POST['view_num']= $_GET['view_num'];
				$records_per_page= $_POST['view_num'];
			}else if($_GET['do']=='change')
			{
				 $_GET['page'] = $_POST['page'];
				 $_POST['page']=  $_GET['page'];
				$_POST['view_num']= $_GET['view_num'];
				$records_per_page= $_POST['view_num'];
			}
				//指定每頁顯示幾筆記錄
				if(empty($_POST['view_num']))
				{
				$records_per_page = 10;
				$_POST['view_num']= 10;
				}
				else{
						$records_per_page= $_POST['view_num'];
					}

					if (isset($_POST['page']))
					{
					$page = $_POST['page'];
					}
					else{
						$page = 1;
						$_POST['page']=$page ;
					}
           ?>
		  
		   <?php
			$txt1 = date("Y");
			$txt2 =  date("m");
			 $txt3 =  date("m")+1;
			//$result = pg_query($conn, "SELECT eventtime,eventlogmsg FROM events WHERE eventseverity=6 order by eventid DESC  ");
          $sql_text ="SELECT  iflostservice,ifserviceid,ifregainedservice,outageid,serviceid,svclosteventid  FROM (SELECT * FROM outages ) AS  outages 
INNER JOIN (SELECT * FROM ifservices) AS ifservices ON   outages.ifserviceid=ifservices.id
where serviceid=2 and  iflostservice BETWEEN '$txt1-$txt2-01' AND '$txt1-$txt3-01' order by ifregainedservice desc,outageid desc
";
		//$result = pg_query($conn, " SELECT iflostservice,ifserviceid     FROM outages     where  	svcregainedeventid is NULL  ");
		$result = pg_query($conn,$sql_text );
		
		//echo  $sql_text;
		
		 $sql_text2 ="SELECT  iflostservice,ifserviceid,ifregainedservice,outageid,serviceid  FROM (SELECT * FROM outages ) AS  outages 
INNER JOIN (SELECT * FROM ifservices) AS ifservices ON   outages.ifserviceid=ifservices.id
where serviceid=2 and  svcregainedeventid is NULL ";
		$result2 = pg_query($conn,$sql_text2 );
			

						$total_records = pg_num_rows($result);
						$total_records2 = pg_num_rows($result2);
						//計算總頁數
						$total_pages = ceil($total_records / $records_per_page);
					 
					//計算本頁第一筆記錄的序號
					$started_redcord = $records_per_page * ($page - 1);
					 
					//將記錄指標移至本頁第一筆記錄的序號
					pg_result_seek($result, $started_redcord);           
					//顯示記錄
		?>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		<table cellpadding="0" cellspacing="0" class="bar" style="width:980px;border:none;">
			<tr>
			<td align="right">
				<select name="view_num" size="1" onchange="this.form.submit();"> 
					<option value="5" <?php if($_POST['view_num']==5){echo 'selected'; }?> >5</option>
					<option value="10" <?php if($_POST['view_num']==10){echo 'selected'; }?> >10</option>
					<option value="20" <?php if($_POST['view_num']==20){echo 'selected'; }?>>20</option>
					<option value="30" <?php if($_POST['view_num']==30){echo 'selected'; }?>>30</option>
				</select>
				<font size="2">筆資料</font>
			</td>
			</tr>
		</table>
		</form>

		<div id="content0">
			<div id="port_data">
				<table class="alert_tb">
					<?php
                    $j = 1;
   					//echo $_POST['view_num'];
                    // echo 'AAAAAAAAAAAAAAAA';
					echo '<div class="alert_tt">目前本月事件:'.$total_records.'數' ;
					echo ' / 目前斷線數量:'.$total_records2.'數</div>' ;
				     echo '<tr>
							<th>斷電事件編號</th>
							<th>事件編號</th>
							<th>部落</th>
							<th>設備</th>
							<th>IP</th>
							<th>斷線時間</th>
							<th>復電時間</th>
							<th>狀態</th>
						  </tr>';
					while ($row = pg_fetch_row($result) and $j <= $records_per_page) 
					{
						/*
						echo '<li>';
						echo "事件編號: $row[3] ";
						echo '<br>';
						echo "斷線時間: $row[0] ";
						echo "復電時間: $row[2] ";
						echo '<br>';
						*/
						$SQL = "SELECT ipinterfaceid,serviceid  FROM ifservices  where id= $row[1]   ";
						//echo $SQL;
						$result2 = pg_query($conn, $SQL);
						while ($row2 = pg_fetch_row($result2)) 
							{
								
								$SQL2 = "SELECT 	nodeid  FROM ipinterface  where id= $row2[0]   ";	
								$result22 = pg_query($conn, $SQL2);
								while ($row22 = pg_fetch_row($result22)) 
									{
									//echo $row22[0];
										$SQL3 = "SELECT 	nodelabel  FROM node  where nodeid= $row22[0]   ";	
										$result23 = pg_query($conn, $SQL3);
										$SQL31 = "SELECT 	ipaddr  FROM ipinterface  where nodeid	= $row22[0]   ";	
										$result231 = pg_query($conn, $SQL31);
										
										if(empty($row[2]))
										{
											//$row[2]= '斷線中';
											$dwon_msg = '斷線中';
										}else
										{
											
											$row[2]=$row[2];
											$dwon_msg = '正常連線';
										}
										
										
										
										
										while ($row23 = pg_fetch_row($result23) and $row231 = pg_fetch_row($result231) )
										{
											//echo '<a href="http://'.$row231[0].'" target="_blank">服務中斷中'.$row23[0].'</a>';
											
											?>
											 <tr>
											<td><?=$row[3] ;?></td>
											<td><?=$row[5] ;?></td>
											<?php 
											$key_ip = $row231[0];
											/*
											//AP
											SELECT ass_ap_name,ass_ap_ip,tribe_name,township_name,city_name FROM (SELECT * FROM ass_ap) AS  ass_ap
											INNER JOIN (SELECT * FROM tribe) AS tribe ON   ass_ap.ass_ap_tribe=tribe.tribe_id
											INNER JOIN (SELECT * FROM city_township) AS city_township ON   tribe.township_id= city_township.township_id
											INNER JOIN (SELECT * FROM city_array) AS city_array ON   tribe.city_id= city_array.id 
											where  ass_ap_ip='172.21.19.101'
											//// ass_grouter
											SELECT ass_name,	ass_ip,tribe_name,township_name,city_name FROM (SELECT * FROM  ass_grouter) AS   ass_grouter
											INNER JOIN (SELECT * FROM tribe) AS tribe ON    ass_grouter.ass_grouter_tribe=tribe.tribe_id
											INNER JOIN (SELECT * FROM city_township) AS city_township ON   tribe.township_id= city_township.township_id
											INNER JOIN (SELECT * FROM city_array) AS city_array ON   tribe.city_id= city_array.id 
											where  ass_ip='172.21.22.1'
											///4G
											SELECT ass_4Gname,ass_4Gip,tribe_name,township_name,city_name FROM (SELECT * FROM  ass_4Ggrouter) AS   ass_4Ggrouter
											INNER JOIN (SELECT * FROM tribe) AS tribe ON   ass_4Ggrouter.ass_4Ggrouter_tribe=tribe.tribe_id
											INNER JOIN (SELECT * FROM city_township) AS city_township ON   tribe.township_id= city_township.township_id
											INNER JOIN (SELECT * FROM city_array) AS city_array ON   tribe.city_id= city_array.id 
											where  ass_4Gip='172.21.22.1'
											/////PDU
											SELECT ass_pdu_name,ass_pdu_ip,tribe_name,township_name,city_name FROM (SELECT * FROM  ass_pdu) AS   ass_pdu
											INNER JOIN (SELECT * FROM tribe) AS tribe ON   ass_pdu.ass_pdu_tribe=tribe.tribe_id
											INNER JOIN (SELECT * FROM city_township) AS city_township ON   tribe.township_id= city_township.township_id
											INNER JOIN (SELECT * FROM city_array) AS city_array ON   tribe.city_id= city_array.id 
											where  ass_pdu_ip='172.21.22.1'
											/////poesw
											SELECT ass_poesw_name,ass_poesw_ip,tribe_name,township_name,city_name FROM (SELECT * FROM  ass_poesw) AS ass_poesw
											INNER JOIN (SELECT * FROM tribe) AS tribe ON   ass_poesw.ass_poesw_tribe=tribe.tribe_id
											INNER JOIN (SELECT * FROM city_township) AS city_township ON   tribe.township_id= city_township.township_id
											INNER JOIN (SELECT * FROM city_array) AS city_array ON   tribe.city_id= city_array.id 
											where  ass_poesw_ip='172.21.22.1'
											*/
										
											$sql_ap = "SELECT ass_ap_name,ass_ap_ip,tribe_name,township_name,city_name FROM (SELECT * FROM ass_ap) AS  ass_ap
											INNER JOIN (SELECT * FROM tribe) AS tribe ON   ass_ap.ass_ap_tribe=tribe.tribe_id
											INNER JOIN (SELECT * FROM city_township) AS city_township ON   tribe.township_id= city_township.township_id
											INNER JOIN (SELECT * FROM city_array) AS city_array ON   tribe.city_id= city_array.id 
											where  ass_ap_ip='$key_ip'  ";
											
											$sql_router = "SELECT ass_name,	ass_ip,tribe_name,township_name,city_name FROM (SELECT * FROM  ass_grouter) AS   ass_grouter
											INNER JOIN (SELECT * FROM tribe) AS tribe ON    ass_grouter.ass_grouter_tribe=tribe.tribe_id
											INNER JOIN (SELECT * FROM city_township) AS city_township ON   tribe.township_id= city_township.township_id
											INNER JOIN (SELECT * FROM city_array) AS city_array ON   tribe.city_id= city_array.id 
											where  ass_ip='$key_ip'  ";
											
											$sql_4G_router = "SELECT ass_4Gname,ass_4Gip,tribe_name,township_name,city_name FROM (SELECT * FROM  ass_4Ggrouter) AS   ass_4Ggrouter
											INNER JOIN (SELECT * FROM tribe) AS tribe ON   ass_4Ggrouter.ass_4Ggrouter_tribe=tribe.tribe_id
											INNER JOIN (SELECT * FROM city_township) AS city_township ON   tribe.township_id= city_township.township_id
											INNER JOIN (SELECT * FROM city_array) AS city_array ON   tribe.city_id= city_array.id 
											where  ass_4Gip='$key_ip' ";
											
											$sql_PDU = "SELECT ass_pdu_name,ass_pdu_ip,tribe_name,township_name,city_name FROM (SELECT * FROM  ass_pdu) AS   ass_pdu
											INNER JOIN (SELECT * FROM tribe) AS tribe ON   ass_pdu.ass_pdu_tribe=tribe.tribe_id
											INNER JOIN (SELECT * FROM city_township) AS city_township ON   tribe.township_id= city_township.township_id
											INNER JOIN (SELECT * FROM city_array) AS city_array ON   tribe.city_id= city_array.id 
											where  ass_pdu_ip='$key_ip' ";
											
											$sql_poesw = "SELECT ass_poesw_name,ass_poesw_ip,tribe_name,township_name,city_name FROM (SELECT * FROM  ass_poesw) AS ass_poesw
											INNER JOIN (SELECT * FROM tribe) AS tribe ON   ass_poesw.ass_poesw_tribe=tribe.tribe_id
											INNER JOIN (SELECT * FROM city_township) AS city_township ON   tribe.township_id= city_township.township_id
											INNER JOIN (SELECT * FROM city_array) AS city_array ON   tribe.city_id= city_array.id 
											where  ass_poesw_ip='$key_ip'";
											//echo $sql_4G_router;
											$result_ap = execute_sql($database_name, $sql_ap, $link);
											$result_router = execute_sql($database_name, $sql_router, $link);
											$result_4G_router = execute_sql($database_name, $sql_4G_router, $link);
											$result_PDU = execute_sql($database_name, $sql_PDU, $link);
											$result_poesw = execute_sql($database_name, $sql_poesw, $link);
					                        
											$total_ap = mysql_num_rows($result_ap);											
											$total_router = mysql_num_rows($result_router);	
											$total_4G_router = mysql_num_rows($result_4G_router);	
											$total_PDU = mysql_num_rows($result_PDU);	
											$total_poesw = mysql_num_rows($result_poesw);	
					 if($total_ap>0 or  $total_router >0 or  $total_4G_router >0 or $total_PDU >0 or  $total_poesw >0)
					 {
						 while ($row_ap = mysql_fetch_assoc($result_ap))
																{
																	  
																	  //echo $row_ap['ass_ap_name'];
																	  ?>
																	  <td><?=$row_ap['tribe_name'];?></td>
																	  <td><?=$row_ap['ass_ap_name'];?></td>
																	  <?php
																}
																//echo '<br>';//
																while ($row_router = mysql_fetch_assoc($result_router))
																{
																	 // echo $row_router['ass_name'];
																	  ?>
																	  <td><?=$row_router['tribe_name'];?></td>
																		<td><?=$row_router['ass_name'];?></td>
																	  <?php
																}
																//echo '<br>';
																
																while ($row_4G_router = mysql_fetch_assoc($result_4G_router))
																{
																	 // echo $row_4G_router['ass_4Gname'];
																	  ?>
																	  <td><?=$row_4G_router['tribe_name'];?></td>
																	  <td><?=$row_4G_router['ass_4Gname'];?></td>
																	  <?php
																}
																//echo '<br>';
																
																while ($row_PDU = mysql_fetch_assoc($result_PDU))
																{
																	// echo $row_PDU['ass_pdu_name'];
																	 
																	?>
																	 <td><?=$row_PDU['tribe_name'];?></td>
																	  <td><?=$row_PDU['ass_pdu_name'];?></td>
																	 <?php
																}
																//echo '<br>';
																while ($row_poesw = mysql_fetch_assoc($result_poesw))
																{
																	 // echo $row_poesw['ass_poesw_name'];
																	  ?>
																	  <td><?=$row_poesw['tribe_name'];?></td>
																	  <td><?=$row_poesw['ass_poesw_name'];?></td>
																	  <?php
																}
																
						 
					 }else{
						 ?>
																	  <td></td>
																	  <td></td>
																	  <?php
						 
					 }
												
					
											
											
											
											
											//echo substr("abcd", 0, 3); 
										
											?>
											<td><?php 
											
															//echo '<a href="http://'.$row231[0].'" target="_blank">'.$row231[0].'</a>';
										 if (preg_match("/.5/i",$row231[0]))
										 {
											//echo 'A'; 
											//ap_data.php?ip=172.21.19.5
											echo '<a href="../ap_data.php?ip='.$row231[0].'" target="_blank">'.$row231[0].'</a>';
											}
										else {
											//echo 'B';
											echo '<a href="http://'.$row231[0].'" target="_blank">'.$row231[0].'</a>';
											}											
													
															?></td>
											<td><?= substr($row[0], 0, 19);?></td>
											<td><?= substr($row[2], 0, 19);?></td>
											<td><?=$dwon_msg;?></td>
										  </tr>
											<?php
											
											
											
										} 
										
										
										
										
										
									
									}
								
							}
						
						
						
						
					
						echo '</li>';
						$j++;
					}

					
					?>
				</table>
				
				<div id="ert">

					<?php
						if ($page > 1)
						{
							//echo "<a href='?page=". ($page - 1) . "'>上一頁</a> ";
					?>
					<input type="button" value="上一頁" onClick="document.form.action='<?php echo $_SERVER['PHP_SELF'];?>?do=left&view_num=<?php  echo $_POST['view_num']; ?>';document.form.submit()"/>

					<?php
						}
					?>
					<form style="display:inline-block;" name="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?do=change&view_num=<?php  echo $_POST['view_num']; ?>">
						<select name="page" size="1" onchange="this.form.submit();"> 
						<?php
						for ($ii = 1; $ii <= $total_pages; $ii++)
						{
							if ($ii == $page)
							{
							echo '<option Selected value='.$ii.'>'.$ii.'&nbsp</option>';
							}
							else
							{
							echo '<option value='.$ii.'>'.$ii.'&nbsp</option>'; 
							}
						}
						?>
						</select>
					</form>
					<?php

					if ($page < $total_pages)
					{
					?>
					<input type="button" value="下一頁" onClick="document.form.action='<?php echo $_SERVER['PHP_SELF'];?>?do=right&view_num=<?php  echo $_POST['view_num']; ?>';document.form.submit()"/>
					<?php
					}
					?>
				</div>

			</div>
		</div>
		
</form>
</div>
<!-------------------------------------- FOOTER -->
  	<div id="footer">
	<?php  include("../include/bottom.php"); ?>
	</div>

</div>
</body>
</html>

