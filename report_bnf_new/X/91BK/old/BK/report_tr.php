<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link href="../include/style.css" rel="stylesheet" type="text/css" />
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
<!--表格-->
<link rel="stylesheet" type="text/css" href="../include/tablesort_style.css" />
<script type="text/javascript" src="../js/jquery-latest.js"></script>
<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="../js/jquery.tablesorter.pager.js"></script>
<script type="text/javascript">
$(function() {
	$("table")
		.tablesorter({widthFixed: true, widgets: ['zebra']})
		.tablesorterPager({container: $("#pager")});
});
</script>
<!--匯出excel-->
<script src="../js/excellentexport.js"></script>
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

		<?php // include("../include/report_nav.php"); ?>

		<?php
		require_once("dbtools.inc.php");
		$link = create_connection();
		?>
		
		<div class="report_bar">
			<div class="search">
			<form action="" method="post">
				<select name="nasipaddress" size="1" onchange="this.form.submit();"> 
					<option   value="all" <?php if($_POST['nasipaddress']=='all'){echo 'selected'; }?>>列出所有</option>
						<?php
 
						$sql_zone = "SELECT *  FROM radacct where realm<>'itw'  GROUP BY nasipaddress";
						$result_zone = execute_sql($database_name, $sql_zone, $link); 
						while($row_zone = mysql_fetch_assoc($result_zone))
						{
						?>
						<option value="<?=$row_zone['nasipaddress'];?>" <?php if($_POST['nasipaddress']==$row_zone['nasipaddress']){echo 'selected'; }?> ><?=$row_zone['nasipaddress'];?></option>		
						<?php
						}
						?>
				</select>
				
				<select  name="year" size="1" onchange="this.form.submit();">
					<option value=""   <?php if($_POST['year']==''){echo 'selected'; }?>>all</option>
									
					<?php
					    $dat_y = date("Y")+2;
					 for($y=2016 ; $y<=$dat_y  ; $y++)
                        {
							
							 ?>
							 <option value="<?=$y;?>" <?php if($_POST['year']==$y){echo 'selected'; }?> ><?=$y;?></option>
							 <?php
						}					
					
					
					?>  
					
  
				</select>
				<?php
				if($_POST['year']!=NULL)
					{
						
					?>
					<select  name="month" size="1" onchange="this.form.submit();">
					<option value=""   <?php if($_POST['month']==''){echo 'selected'; }?>>all</option>
					<?php
					 for($month_row=1 ; $month_row <= 12 ;$month_row++)
							{
								if($month_row < 10)
								{
								   $month_row = '0'. $month_row;
								}
								
								
								
								?>
								<option value="<?=$month_row;?>"   <?php if($_POST['month']==$month_row){echo 'selected'; }?>><?=$month_row;?></option>
								<?php
								
							}
					
					
					?>
										  
					</select>
					
							
					
					
					<?php	
						
					}
					
				
				
				?>
				
				<?php
				if($_POST['month']!=NULL)
					{
						
					?>
					<select  name="day" size="1" onchange="this.form.submit();">
		    			<option value=""   <?php if($_POST['day']==''){echo 'selected'; }?>>all</option>
		    			<?php
		    			for($day_row=1 ; $day_row <= 31 ;$day_row++)
							{
								if($day_row < 10)
								{
								   $day_row = '0'. $day_row ;
								}
								?>
								<option value="<?=$day_row;?>"   <?php if($_POST['day']==$day_row){echo 'selected'; }?>><?=$day_row;?></option>
								<?php
								
							}
		    			
		    			
		    			?>
						
					</select>	
				
					<?php
					}
					
				?>
				<?php
				$chan_year = $_POST['year'] ;
				$chan_month= $_POST['month'] ;
				$chan_day = $_POST['day'] ;
				
				
				//$like_text = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
				
				if($chan_year!=null)
				   {
					  $chan_year = $chan_year.'-'; 
					}
				
				
				if($chan_month!=null)
				   {
					  $chan_month = $chan_month.'-'; 
					}
				
				$like_text = $chan_year.$chan_month.$chan_day ;
					//echo $chan_year ;
					//echo $chan_month ;
					//echo $chan_day ;
				
				
				
				?>
				
				
			</form>
			</div>
			<div class="tool">
				<a name="b_print" class="ipt" href="#" onClick="printdiv('div_print');">
				<img src="../images/print.png" width="24">
				</a>
				<a download="execl<?=date("Ymd");?>.csv" href="#" onclick="return ExcellentExport.csv(this, 'table1');">
				<img src="../images/excel.png" width="24">
				</a>
			</div>
			<div class="c"></div>
		</div>

		<div class="report">
		<div id="div_print"><style>table td { padding:5px;} table th { padding:5px; border:#000 1px solid;}</style>
			<table class="tablesorter" id="table1">
				<thead>
					<tr>
					<th colspan="8">itribe各Ap(ip)   服務效益總表</th> 
					</tr>
					<tr>
						<th width="60">使用人次</th>
						<th>使用人數</th>
						<th>設備IP</th>
					　	<th>使用時間(時)</th>
						<th>上行流量(GB)</th>
						<th>下行流量(GB)</th>
						
					</tr>
				</thead>
				
				<tbody>
				<?php

				$nasipaddress = $_POST['nasipaddress'];
				//echo $zone_5G_change;
				if($nasipaddress==NULL)
				{
					$sql0 = "SELECT *  FROM radacct where realm<>'itw' and acctstarttime like '%$like_text%'  GROUP BY nasipaddress";	
				}else if($nasipaddress=='all')
				{
					$sql0 = "SELECT *  FROM radacct where realm<>'itw'  and acctstarttime like '%$like_text%' GROUP BY nasipaddress";	
				}
				else
				{
					$sql0 = "SELECT *  FROM radacct where nasipaddress='$nasipaddress' and realm<>'itw'  and acctstarttime like '%$like_text%' GROUP BY nasipaddress";


				}
				//echo $sql0;

				$result0 = execute_sql($database_name, $sql0, $link); 
				while($row0 = mysql_fetch_assoc($result0))
				{
					$nasipaddress = $row0['nasipaddress'];

				$sql= "SELECT SUM(acctsessiontime),SUM(acctinputoctets),SUM(acctoutputoctets),SUM(acctstartdelay),SUM(acctstopdelay) FROM radacct where nasipaddress='$nasipaddress' and acctstarttime like '%$like_text%'    GROUP BY nasipaddress ";	
				$result = execute_sql($database_name, $sql, $link);
				///
				$sql1="SELECT radacctid FROM radacct where nasipaddress='$nasipaddress' and acctstarttime like '%$like_text%'  ";
				$result1 = execute_sql($database_name, $sql1, $link);
				$number = mysql_num_rows($result1);
				  ///
				  $sql2="SELECT username   FROM radacct where nasipaddress='$nasipaddress' and acctstarttime like '%$like_text%'   GROUP BY username ";
				  $result2 = execute_sql($database_name, $sql2, $link);
				  $number2 = mysql_num_rows($result2);

				while ($row = mysql_fetch_assoc($result) )
							{
								$acctsessiontime=$row['SUM(acctsessiontime)']/(60*60);
								$acctinputoctets=$row['SUM(acctinputoctets)']/(1000*1024*1024);
								$acctoutputoctets=$row['SUM(acctoutputoctets)']/(1000*1024*1024);

								//$acctstartdelay=$row['SUM(acctstartdelay)'];
								//$acctstopdelay=$row['SUM(acctstopdelay)'];
								
								
								$acctsessiontime=  number_format($acctsessiontime,2);
								$acctinputoctets=  number_format($acctinputoctets,2);
								$acctoutputoctets= number_format($acctoutputoctets,2);
								?>
					<tr>
						<td><?=$number;?></td>
						<td><?=$number2;?></td>
						<td><?=$nasipaddress;?></td>
						<td><?=$acctsessiontime;?></td>
						<td><?=$acctinputoctets;?></td>
						<td><?=$acctoutputoctets;?></td>
						
					</tr>
								<?php
							}
				}
				?>
				</tbody>
			</table>
			</div>

			<div id="pager" class="pager" >
				<form bgcolor="#00BFFF">
					<img src="../images/first.png" height="20" width="20" class="first"/>
					<img src="../images/prev.png" height="20" width="20" class="prev"/>
					<input type="text" class="pagedisplay"  disabled />
					<img src="../images/next.png" height="20" width="20"  class="next"/>
					<img src="../images/last.png" height="20" width="20" class="last"/>
					<select class="pagesize">
						<option value="2">2</option>
						<option selected="selected"  value="10">10</option>
						<option value="20">20</option>
						<option value="30">30</option>
						<option  value="40">40</option>
					</select>
				</form>
			</div>
		</div>
 <!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>

</body>
</html>
