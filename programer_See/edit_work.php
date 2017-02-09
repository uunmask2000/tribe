<?php
include("../SQL/dbtools.inc.php");
include("../function_php/function_class.php");
$link = create_connection();

?>

<link rel="stylesheet" href="../colorbox_acces/colorbox.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="../colorbox_acces/jquery.colorbox.js"></script>
<script>
$(document).ready(function(){
//Examples of how to assign the Colorbox event to elements

$(".inline_mail").colorbox({inline:true, width:"50%"}); // 首回復
$(".inline_A").colorbox({inline:true, width:"50%"}); // 派工
$(".inline_B").colorbox({inline:true, width:"50%"}); // 派工
$(".inline_C").colorbox({inline:true, width:"50%"}); // 派工
$(".inline_D").colorbox({inline:true, width:"50%"}); // 派工
//Example of preserving a JavaScript event for inline calls.
$("#click").click(function(){ 
$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
return false;
});
});
</script>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
.button {
    display: block;
    width: 115px;
    height: 30px;
    background: #4E9CAF;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;
}
.button_off {
    display: block;
    width: 115px;
    height: 25px;
    background: gray;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;
}
.button_ok {
    display: block;
    width: 115px;
    height: 25px;
    background: #FFDC35	;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;
}
a {
    text-decoration:none;
}
.button_A {
    display: block;
    width: 115px;
    height: 40px;
    background: #4E9CAF;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;
}
.button2 {background-color: #008CBA;} /* Blue */
.button3 {background-color: #f44336;} /* Red */ 
.button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
.button5 {background-color: #555555;} /* Black */
</style>


<?php
session_start();
date_default_timezone_set('Asia/Taipei');
$name = $_SESSION['user_name']   ;
$key =$_GET['key'];

if(get_numeric($key) =='NOT')
{
		?>
		<script type="text/javascript">
		alert("錯誤參數");history.back();　 
		</script>
		<?php
	
}else{
	$sql  =  "SELECT * FROM alert_ap_date_filter WHERE alert_ap_date_filter_id='$key' ";
		$result  = execute_sql($database_name, $sql, $link);
		while ($row  = mysql_fetch_assoc($result))
		{
			$alert_ap_date_filter_id = $row['alert_ap_date_filter_id']; //PK		    
			$calling_bar_id      = $row['calling_bar_id']; //事件處理編號
			$Processing_status   = $row['Processing_status'];
			$Period_AP = $row['Period_AP'];
			
			$alert_written_time  = $row['alert_written_time']; //告警發信時間
			$Processing_time_A   = $row['Processing_time_A'];
			$note_A              = $row['note_A'];  
			$Processing_time_B   = $row['Processing_time_B'];
			$note_B              = $row['note_B'];
			$accendant           = $row['accendant'];
			$Processing_time_C   = $row['Processing_time_C'];
			$processing_engineer           = $row['processing_engineer'];
			$note_C              = $row['note_C'];
			$Processing_time_D   = $row['Processing_time_D'];
			$note_D              = $row['note_D'];
			$Processing_time_E   = $row['Processing_time_E'];
			$note_E              = $row['note_E'];
			
			$Processor_A   = $row['Processor_A'];
			$Processor_B   = $row['Processor_B'];
			$Processor_C   = $row['Processor_C'];
			$Processor_D   = $row['Processor_D'];
			$Processor_E   = $row['Processor_E'];
			///
			$alert_ap_date_city   =  $row['alert_ap_date_city'];
			$alert_ap_date_township   =  $row['alert_ap_date_township'];
			$alert_ap_date_tribe   =  $row['alert_ap_date_tribe'];
			$alert_ap_date_ap_name  =  $row['alert_ap_date_ap_name'];
			
		}
	
	
}
//$sql_check  =  "SELECT * FROM  Equipment_Repair  where  Equipment_Repair_number='$key' and Equipment_Repair_type = '01' or Equipment_Repair_type='02'  ";
$sql_check  =  "SELECT * FROM  Equipment_Repair  where  Equipment_Repair_number='$key'  ";
$result_check   = execute_sql($database_name, $sql_check, $link);
$num_rows_check = mysql_num_rows($result_check);

///echo get_numeric($key);
//echo '目前登入者 : '.$name ;
echo '<H1>'.$alert_ap_date_city .$alert_ap_date_township .$alert_ap_date_tribe .$alert_ap_date_ap_name .'服務中斷時間: ' .$alert_written_time  .'</h1>';
echo '<H2>處理編號:'.$calling_bar_id.'<H2>';
echo '<H2>叫修編號:'.$alert_ap_date_filter_id.'<H2>';
//00 = 派工 01=處理中 02==到達 03=已結案
	$sql_1 =  "SELECT * FROM Equipment_Repair WHERE Equipment_Repair_number='$key'  order by Equipment_Repair_id desc limit 1  ";
	$result_1  = execute_sql($database_name, $sql_1, $link);
	while ($row_1  = mysql_fetch_assoc($result_1))
	{
	   $Closing_time_reference = $row_1['Equipment_Repair_time'];
	   $Closing_Equipment_Repair_engineer_reference = $row_1['Equipment_Repair_engineer'];
	}
//echo $Closing_Equipment_Repair_engineer_reference ;
echo date("Y-m-d h:i:s");
?>
目前處理狀態：<?=$Processing_status ;?>
<div>
<p>發信資訊:</p> 
發信時間：<?=$alert_written_time ;?>
<br>
</div>
<div>
<p>首回覆資訊:</p> 		
回覆時間：<?=$Processing_time_A ;?>
<br>
回覆內容：<?=$note_A ;?>
<br>

<?php
if($calling_bar_id!=0)
{

		if($Processor_A==$name)
		{
		//echo 'Match';
		echo '<button onclick="edit_maill()"  class="button_A button2">編輯首回覆</button>';
		}else{
		//echo 'NOT Match';
		echo '<button class="button_A button5" >編輯首回覆</button>';
		}

}
?>


<script>
function edit_maill() {
  window.open("./Frame/edit_caseA.php?key=<?=$_GET['key'];?>", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
}
</script>
</div>
<div>
<p>派工資訊:</p> 
<table>
		<tr>
		<th>指派工程師</th>
		<th>時間</th>
		<th>備註</th>
		<th>編輯</th>
		</tr>
		<?php
		$sql_0  =  "SELECT * FROM Equipment_Repair WHERE Equipment_Repair_number='$key' AND Equipment_Repair_type='00' ";
		$result_0  = execute_sql($database_name, $sql_0, $link);
		$num_rows = mysql_num_rows($result_0);
		if($num_rows > 0)
		{
				while ($row_0  = mysql_fetch_assoc($result_0))
				{
				echo '<tr>';
				echo '<td>'.$row_0['Equipment_Repair_engineer'].'</td>';
				echo '<td>'.$row_0['Equipment_Repair_time'].'</td>';
				echo '<td>'.$row_0['Equipment_Repair_remark'].'</td>';
				?>
				<td>
				<?php
					//if($row_0['Equipment_Repair_engineer']==$name)
					if($name==$name)
					{
					//echo 'Match';
					?>
					<a href="#" target="popup" class='button_ok' onclick="window.open('./Frame/edit_case_event _A.php?key=<?=$row_0['Equipment_Repair_id'];?>','name','width=500,height=500')">編輯派工</a>				
					<?php
					}else{
					//echo 'NOT Match';
					?>
					<a href="#" class='button_off' >編輯派工</a>						
					<?php
					}

				?>
				</td>
				<?php
				echo '</tr>';

				}	
		}else{
			echo '<tr>';
			echo '<td colspan="4">目前沒有資料</td>';
				echo '</tr>';
		}
		
			?>

</table>


</div>
<div>
到場資訊:
<table>
	<tr>
	<th>到場工程師</th>
	<th>時間</th>
	<th>處理內容</th>
	<th>編輯</th>
	</tr>
		<?php
		$sql_0  =  "SELECT * FROM Equipment_Repair WHERE Equipment_Repair_number='$key' AND Equipment_Repair_type='02' ";
		$result_0  = execute_sql($database_name, $sql_0, $link);
		$num_rows = mysql_num_rows($result_0);
		if($num_rows > 0)
		{
				while ($row_0  = mysql_fetch_assoc($result_0))
				{
				echo '<tr>';
				echo '<td>'.$row_0['Equipment_Repair_engineer'].'</td>';
				echo '<td>'.$row_0['Equipment_Repair_time'].'</td>';
				echo '<td>'.$row_0['Equipment_Repair_remark'].'</td>';
				?>
				<td>
				<?php
//if($row_0['Equipment_Repair_engineer']==$name)
if($name==$name)
{
//echo 'Match';
?>
<a href="#" target="popup" class='button_ok' onclick="window.open('./Frame/edit_case_event _A.php?key=<?=$row_0['Equipment_Repair_id'];?>','name','width=500,height=500')">編輯到場</a>				
<?php
}else{
//echo 'NOT Match';
?>
<a href="#" class='button_off' >編輯到場</a>						
<?php
}



				?>
					</td>
				<?php
				echo '</tr>';

				}	
		}else{
			echo '<tr>';
			echo '<td colspan="4">目前沒有資料</td>';
				echo '</tr>';
		}
			?>


</table>
</div>
<div>
處理資訊:
	<table>
	<tr>
	<th>處理工程師</th>
	<th>時間</th>
	<th>處理內容</th>
	<th>編輯</th>
	</tr>
		<?php
		$sql_0  =  "SELECT * FROM Equipment_Repair WHERE Equipment_Repair_number='$key' AND Equipment_Repair_type='01' ";
		$result_0  = execute_sql($database_name, $sql_0, $link);
		$num_rows = mysql_num_rows($result_0);
		if($num_rows > 0)
		{
				while ($row_0  = mysql_fetch_assoc($result_0))
				{
				echo '<tr>';
				echo '<td>'.$row_0['Equipment_Repair_engineer'].'</td>';
				echo '<td>'.$row_0['Equipment_Repair_time'].'</td>';
				echo '<td>'.$row_0['Equipment_Repair_remark'].'</td>';
				?>
				<td>
				<?php
	//if($row_0['Equipment_Repair_engineer']==$name)
if($name==$name)
{
//echo 'Match';
?>
<a href="#" target="popup" class='button_ok' onclick="window.open('./Frame/edit_case_event _A.php?key=<?=$row_0['Equipment_Repair_id'];?>','name','width=500,height=500')">編輯處理</a>				
<?php
}else{
//echo 'NOT Match';
?>
<a href="#" class='button_off' >編輯處理</a>						
<?php
}



				?>
				</td>
				<?php
				echo '</tr>';
                
				}	
		}else{
			echo '<tr>';
			echo '<td colspan="4">目前沒有資料</td>';
				echo '</tr>';
		}
			?>


</table>
</div>
<div>
結案資訊:
<table>
  <tr>
  <th>結案工程師</th>
	<th>時間</th>
	<th>備註</th>
	<th>編輯</th>
  </tr>
  	<?php
		$sql_0  =  "SELECT * FROM Equipment_Repair WHERE Equipment_Repair_number='$key' AND Equipment_Repair_type='03' ";
		$result_0  = execute_sql($database_name, $sql_0, $link);
		$num_rows = mysql_num_rows($result_0);
		if($num_rows > 0)
		{
				while ($row_0  = mysql_fetch_assoc($result_0))
				{
				echo '<tr>';
				echo '<td>'.$row_0['Equipment_Repair_engineer'].'</td>';
				echo '<td>'.$row_0['Equipment_Repair_time'].'</td>';
				echo '<td>'.$row_0['Equipment_Repair_remark'].'</td>';
				?>				
				<td>
					<?php
//if($row_0['Equipment_Repair_engineer']==$name)
if($name==$name)
{
//echo 'Match';
?>
<a href="#" target="popup" class='button_ok' onclick="window.open('./Frame/edit_case_event _A.php?key=<?=$row_0['Equipment_Repair_id'];?>','name','width=500,height=500')">編輯結案</a>				
<?php
}else{
//echo 'NOT Match';
?>
<a href="#" class='button_off' >編輯結案</a>						
<?php
}


					?>
				</td>
				<?php
				echo '</tr>';

				}	
		}else{
			echo '<tr>';
			echo '<td colspan="4">目前沒有資料</td>';
				echo '</tr>';
		}
			?>

</table>
</div>

<HR color="#00FF00" size="10" width="100%">
<?php
if($Processing_status=='已發信')
{
	?>
	<p><a class='inline_mail button ' href="#inline_content_mail" title="首回覆">首回覆</a></p>
	<p><a class='button_off' >派工</a></p>	
	<p><a class='button_off' >到達</a></p>
	<p><a class='button_off' >處理</a></p>
	<p><a class='button_off' >結案</a></p>
	<?php
}

if($Processing_status=='首回覆'){
	?>
	<p><a class='button_ok'>首回覆</a></p>
	<p><a class='inline_A button' href="#inline_content_A"  title="派工">派工</a></p>	
	<p><a class='button_off' >到達</a></p>
	<p><a class='button_off' >處理</a></p>
	<p><a class='button_off' >結案</a></p>
	<?php
}

if($Processing_status=='已派工' or $Processing_status=='已到達' or $Processing_status=='處理中')
{
	
	
		//if($Closing_Equipment_Repair_engineer_reference==$name)
		if($name==$name)
		{
		    //echo 'Match';
				?>
				<p><a class='button_ok'>首回覆</a></p>
				<p><a class='button_ok' >派工</a></p>
				<p><a class='inline_B button' href="#inline_content_B"  title="到達">到達</a></p>
				<p><a class='inline_C button' href="#inline_content_C"  title="處理">處理</a></p>
				<?php
				//echo $num_rows_check ;
				if($num_rows_check > 1)
				{
				?>
				<p><a class='inline_D button' href="#inline_content_D"  title="結案">結案</a></p>
				<?php
				}else{
				?>
				<p><a class='button_off' >結案</a></p>
				<?php
				}
		}else{
				?>
				<p><a class='button_ok' >首回覆</a></p>
				<p><a class='button_ok' >派工</a></p>	
				<p><a class='button_off' >到達</a></p>
				<p><a class='button_off' >處理</a></p>
				<?php
				if($num_rows_check > 1)
				{
				?>
				<p><a class='button_off' >結案</a></p>
				<?php
                }
		//echo 'NOT Match';
		}
	
}
if($Processing_status=='已結案'){
				?>
				<p><a class='button_off' >首回覆</a></p>
				<p><a class='button_off' >派工</a></p>	
				<p><a class='button_off' >到達</a></p>
				<p><a class='button_off' >處理</a></p>
				<p><a class='button_off' >結案</a></p>
				<?php
				}
	

?>
	
	
	


<div style='display:none'>
	<div id='inline_content_mail' style='padding:10px; background:#fff;'>
				<form action="edit_work_proc.php?mode=mail" method="post">
				信件發送時間：<?=$alert_written_time  ;?>
				<br>
				回覆時間：  <input  type="text"  name="time"  value="<?=$alert_written_time  ;?>"/> PS 格式為 0000-00-00 00:00:00  <br>					  
				備註 :<textarea style="width:98%;" rows="5" name="item_wrong_text" placeholder="備註"><?=$note_A ;?></textarea>
				<input type="hidden" name="key" value="<?=$alert_ap_date_filter_id ;?>">
				<input type="hidden" name="item_wrong" value="首回覆">
				<input type="hidden" name="title" value="<?=$alert_ap_date_city .$alert_ap_date_township .$alert_ap_date_tribe .$alert_ap_date_ap_name .'服務中斷時間: ' .$alert_written_time  ;?>">
				<input type="hidden" name="Period_AP" value="<?=$Period_AP ;?>">
				
				　	<input type="submit" value="確定">
				</form>		
					</div>	
		</div>	


<div style='display:none'>
					<div id='inline_content_A' style='padding:10px; background:#fff;'>
					<form action="edit_work_proc.php?mode=0" method="post">
							回覆時間：<?=$Processing_time_A ;?>
						<br>
					　派工時間  <input  type="text"  name="time"  value="<?=$Processing_time_A ;?>"/> PS 格式為 0000-00-00 00:00:00  <br>
					  指派工程師
							<select name="accendant">
							<?php
							$sql_Engineer  = "SELECT * FROM `web_user` WHERE `user_engineer_radio` =1 ";
							$result_Engineer  = execute_sql($database_name, $sql_Engineer, $link);
							while ($row_Engineer  = mysql_fetch_assoc($result_Engineer))
							{
							?>
							<option value="<?=$row_Engineer['user_name'];?>"  selected><?=$row_Engineer['user_name'];?></option>
							<?php
							}
							?>
							</select>
							<br>
					 備註 :<textarea style="width:98%;" rows="5" name="item_wrong_text" placeholder="備註"></textarea>
					 <input type="hidden" name="key" value="<?=$alert_ap_date_filter_id ;?>">
						<input type="hidden" name="item_wrong" value="已派工">
					　	<input type="submit" value="確定">
					</form>		
					</div>	
		</div>	

	<div style='display:none'>
										<div id='inline_content_B' style='padding:10px; background:#fff;'>
										已到達
										
											<form action="edit_work_proc.php?mode=2" method="post">
												處理時間  <input  type="text"  name="time" value="<?=$Closing_time_reference;?>" /> PS 格式為 0000-00-00 00:00:00  <br>
												處理工程師
												<select name="accendant">
												<?php
												$sql_Engineer  = "SELECT * FROM `web_user` WHERE `user_engineer_radio` =1 ";
												$result_Engineer  = execute_sql($database_name, $sql_Engineer, $link);
												while ($row_Engineer  = mysql_fetch_assoc($result_Engineer))
												{
												?>
												<option value="<?=$row_Engineer['user_name'];?>"  <?php if($row_Engineer['user_name']==$Closing_Equipment_Repair_engineer_reference  ){echo 'selected';} ?>><?=$row_Engineer['user_name'];?></option>
												<?php
												}
												?>
												</select>
												<br>
												處理內容 :<textarea style="width:98%;" rows="5" name="item_wrong_text" placeholder="處理內容"></textarea>
												<input type="hidden" name="key" value="<?=$alert_ap_date_filter_id ;?>">
												<input type="hidden" name="item_wrong" value="已到達">
												　	<input type="submit" value="確定">
												</form>	
												
										</div>	
										<div id='inline_content_C' style='padding:10px; background:#fff;'>
										處理
										<form action="edit_work_proc.php?mode=1" method="post">
												處理時間  <input  type="text"  name="time" value="<?=$Closing_time_reference ;?>" /> PS 格式為 0000-00-00 00:00:00  <br>
												處理工程師
												<select name="accendant">
												<?php
												$sql_Engineer  = "SELECT * FROM `web_user` WHERE `user_engineer_radio` =1 ";
												$result_Engineer  = execute_sql($database_name, $sql_Engineer, $link);
												while ($row_Engineer  = mysql_fetch_assoc($result_Engineer))
												{
												?>
												<option value="<?=$row_Engineer['user_name'];?>"  <?php if($row_Engineer['user_name']==$Closing_Equipment_Repair_engineer_reference  ){echo 'selected';} ?>><?=$row_Engineer['user_name'];?></option>
												<?php
												}
												?>
												</select>
												<br>
												處理內容 :<textarea style="width:98%;" rows="5" name="item_wrong_text" placeholder="處理內容"></textarea>
												<input type="hidden" name="key" value="<?=$alert_ap_date_filter_id ;?>">
												<input type="hidden" name="item_wrong" value="處理中">
												　	<input type="submit" value="確定">
												</form>		
										
										
										
										</div>	
										<div id='inline_content_D' style='padding:10px; background:#fff;'>
										結案
										<form action="edit_work_proc.php?mode=3" method="post">
												結案時間  <input  type="text"  name="time" value="<?=$Closing_time_reference ;?>" /> PS 格式為 0000-00-00 00:00:00  <br>												
												<br>
												結案工程師
												<select name="accendant">
												<?php
												$sql_Engineer  = "SELECT * FROM `web_user` WHERE `user_engineer_radio` =1 ";
												$result_Engineer  = execute_sql($database_name, $sql_Engineer, $link);
												while ($row_Engineer  = mysql_fetch_assoc($result_Engineer))
												{
												?>
												<option value="<?=$row_Engineer['user_name'];?>"  <?php if($row_Engineer['user_name']==$Closing_Equipment_Repair_engineer_reference  ){echo 'selected';} ?> ><?=$row_Engineer['Maintenance_Engineer_menu_name'];?></option>
												<?php
												}
												?>
												</select>
												<br>
												備註 :<textarea style="width:98%;" rows="5" name="item_wrong_text" placeholder="備註"></textarea>
												<input type="hidden" name="key" value="<?=$alert_ap_date_filter_id ;?>">
												<input type="hidden" name="item_wrong" value="已結案">
												
													<input type="hidden" name="Period_AP" value="<?=$Period_AP ;?>">
												　	<input type="submit" value="確定">
												</form>		
										</div>	
						</div>	
<button onclick="myFunction()">返回</button>
<script>
function myFunction() {
  window.location.assign("show_AP_date_form_2.php?A=<?=$Period_AP;?>");
}
</script>



