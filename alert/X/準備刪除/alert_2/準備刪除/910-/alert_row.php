
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link href="../include/style.css" rel="stylesheet" type="text/css" />
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jq-1.11.1.js"></script>

</head>

<body>

<div id="wrap">

<!-------------------------------------- TOP -->
	<div id="header">
	<?php include("../include/top.php"); ?>
	</div>

<!-------------------------------------- MAIN -->
  	<div id="main">

		<?php include("alert.php"); ?>
<?php





?>

		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		<?php
			$conn = pg_connect("host=127.0.0.1 port=5432 dbname=opennms user=opennms password=0932969495");


/*
if($_GET['mode']=='del_event')
{
     $eventid = $_GET['eventid'];
    $sql_del=" DELETE FROM events  WHERE eventid = '$eventid'; "; 
    $result_del= pg_query($conn, $sql_del);

}
*/






			//$result = pg_query($conn, "SELECT eventtime,eventlogmsg FROM events WHERE eventseverity=6 order by eventid DESC  ");

		//$result = pg_query($conn, "SELECT eventtime,eventlogmsg,nodeid FROM events WHERE eventlogmsg like '%up%' or eventlogmsg like '%down%' order by eventid DESC  ");
$sql1="SELECT eventtime,eventlogmsg,nodeid,eventid,ipaddr FROM events WHERE nodeid IS NOT NULL and  eventuei like '%nodeDown%' or eventuei like '%nodeUp%'   order by eventid DESC    ";

$result = pg_query($conn, $sql1);

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

				//取得要顯示第幾頁的記錄
				//if (isset($_GET["page"]))
				//{
				//$page = $_GET["page"];

					if (isset($_POST['page']))
					{
					$page = $_POST['page'];
					}
					else{
						$page = 1;
						$_POST['page']=$page ;
					}


						$total_records = pg_num_rows($result);

						//計算總頁數
						$total_pages = ceil($total_records / $records_per_page);
					 
					//計算本頁第一筆記錄的序號
					$started_redcord = $records_per_page * ($page - 1);
					 
					//將記錄指標移至本頁第一筆記錄的序號
					pg_result_seek($result, $started_redcord);           
					//顯示記錄
		?>

			<table cellpadding="0" cellspacing="0" class="bar" style="width:980px;">
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
				<ul class="row">
					<?php
                    $j = 1;
   					//echo $_POST['view_num'];
                    // echo 'AAAAAAAAAAAAAAAA';
					while ($row = pg_fetch_row($result) and $j <= $records_per_page) 
					{
						$row[1] = str_replace("<p>","", $row[1]) ;
						$row[1] = str_replace("</p>","", $row[1]) ;
						$nodeid = $row[2];
						
						//echo ' <a href="?mode=del_event&eventid='.$row[3].'">Del</a> ';
						//echo '<br>';
						echo '<li>';
						echo "[$j].";
						
						//echo "eventid: $row[3] ";
												
						$SQL = "SELECT ipaddr FROM ipinterface WHERE  nodeid = $nodeid  ";
						//echo $SQL;
						$result2 = pg_query($conn, $SQL);
						$count2 = pg_num_rows($result2);
if($count2>0)
{
while ($row2 = pg_fetch_row($result2)) 
							{
								
//echo $SQL;echo '<br>';
								echo '<a href="http://'.$row2[0].'" target="_blank">';	
								echo "時間: $row[0] ";
									
									
																
									
								//	echo '<br>';
									echo "訊息: $row[1] ";	
								echo '</a>';
							}
						
}else{
echo '資料以遺失'.$nodeid.'需要確認'.'eventid: '.$row[3]   ;
echo "時間: $row[0] ";

}

						
						
						
						
					
						echo '</li>';
						$j++;
					}

					
					?>
				</ul>
				
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

					<!--
					<?php //echo $_POST['page'] ;?>
					<font size="2">page</font>
					-->

					<?php

					if ($page < $total_pages)
					{
					//echo "<a href='?page=". ($page + 1) . "'>下一頁</a> ";
					?>
					<input type="button" value="下一頁" onClick="document.form.action='<?php echo $_SERVER['PHP_SELF'];?>?do=right&view_num=<?php  echo $_POST['view_num']; ?>';document.form.submit()"/>
					<?php
					}
					?>
				</div>

			</div>
		</div>
</form>
<!-------------------------------------- FOOTER -->
  	<div id="footer">
	<?php  include("../include/bottom.php"); ?>
	</div>

</div>
</body>
</html>

