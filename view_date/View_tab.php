<!DOCTYPE html>
<html>
<style>
body {font-family: "Lato", sans-serif;}

ul.tab {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Float the list items side by side */
ul.tab li {float: left;}

/* Style the links inside the list items */
ul.tab li a {
    display: inline-block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of links on hover */
ul.tab li a:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
ul.tab li a:focus, .active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
</style>
<body>
<?php
include("../SQL/dbtools.inc.php");
$link = create_connection();
$key = $_GET['key'];
$key ='14';
$sql_show = "SELECT * FROM tribe WHERE tribe_id='$key'  ";  //tribe
$result_show = execute_sql($database_name, $sql_show, $link);
while ($row_show = mysql_fetch_assoc($result_show)  )
{
	$tribe_label_show =  $row_show['tribe_label'];
	$tribe_x_show =  $row_show['tribe_x'];
	$tribe_y_show = $row_show['tribe_y'];
	$tribe_name_show = $row_show['tribe_name'];
	$tribe_member_show = $row_show['tribe_member'];
	$tribe_phone_show = $row_show['tribe_phone'];
	$tribe_note_show = $row_show['tribe_note'];
	///township_id
	$tribe_township_id = $row_show['township_id'];
	
	
}

?>

<ul class="tab">
<li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'tribe')" id="defaultOpen" >部落資訊</a></li>
<li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'area')" >地區資訊</a></li>
<li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Electricity_Information')" >用電資訊</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'F/W')" >F/W</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, '4G Router')">4G Router</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'PoE S/W')">PoE S/W</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'PDU')">PDU</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'AP')">AP</a></li>
</ul>

<div id="tribe" class="tabcontent">
  <h3>部落資訊</h3>
			<?php
			$sql_show3 = "SELECT * FROM city_township where township_id='$tribe_township_id' ";  //tribe
			$result_show3 = execute_sql($database_name, $sql_show3, $link);
			while ($row_show3 = mysql_fetch_assoc($result_show3)  )
			{
			$township_name =    $row_show3['township_name'];
			$Mayor   =    $row_show3['Mayor'];
			$Mayor_phone =    $row_show3['Mayor_phone'];
			$Contact_person =    $row_show3['Contact_person'];
			$Contact_person_phone =    $row_show3['Contact_person_phone'];
			$address =    $row_show3['address'];
			$area_note =    $row_show3['area_note'];

			}

			?>
  
  
			<p>	
			<h2><?=$tribe_name_show ;?></h2>
			<p>座標:<?=$tribe_x_show ;?>,<?=$tribe_y_show ;?></p>   

			<ul class="list-group">
			<li class="list-group-item">部落聯絡人 :  <?=$tribe_member_show ;?></li>
			<li class="list-group-item">部落聯絡電話 : <?=$tribe_phone_show ;?></li>
			<li class="list-group-item">部落聯絡備註 : <?=$tribe_note_show ;?></li>
			</ul>
			</p>
</div>

<div id="area" class="tabcontent">
  <h3>地區資訊</h3>
  <p>
  	<div class="col-md-6">	
			<h2><?=$township_name;?> 相關資訊</h2>
			<ul class="list-group">
				<li class="list-group-item">鄉長  : <?=$Mayor ;?></li>
				<li class="list-group-item">鄉長電話  : <?=$Mayor_phone ;?></li>
				<li class="list-group-item">連絡人  : <?=$Contact_person ;?></li>
				<li class="list-group-item">連絡人電話  : <?=$Contact_person_phone ;?></li>
				<li class="list-group-item">地址  : <?=$address ;?></li>
				<li class="list-group-item" style="height:82px;">備註  : <?=$area_note ;?></li>
			</ul>
		</div>
  
  
  </p>
</div>

<div id="Electricity_Information" class="tabcontent">
  <h3>用電資訊</h3>
  <p>
  <?php
		///  用電 +ISP  放在F/w 欄位
				$sql_show2 = "SELECT * FROM ass_grouter WHERE ass_grouter_tribe='$key'  ";  //tribe
				$result_show2 = execute_sql($database_name, $sql_show2, $link);
				while ($row_show2 = mysql_fetch_assoc($result_show2)  )
				{
					$isp_type   =    $row_show2['isp_type'];
					$isp_members  =    $row_show2['isp_members'];
					$isp_pohoe   =    $row_show2['isp_pohoe'];
					$isp_note  =    $row_show2['isp_note'];
					$power_position  =    $row_show2['power_position'];
					$name_of_subsidy  =    $row_show2['name_of_subsidy'];
					$contact_telephone_number  =    $row_show2['contact_telephone_number'];
					?>
						<ul class="list-group">
						<li class="list-group-item">isp服務種類 : <?=$isp_type ;?></li>
						<li class="list-group-item">isp供應商 : <?=$isp_members ;?></li>
						<li class="list-group-item">isp聯絡電話 :  <?=$isp_pohoe ;?></li>
						<li class="list-group-item">isp備註 :  <?=$isp_note ;?></li>
						<li class="list-group-item">用電位置 :  <?=$power_position ;?></li>
						<li class="list-group-item">補助人名 : <?=$name_of_subsidy ;?></li>
						<li class="list-group-item">連絡電話 : <?=$contact_telephone_number ;?></li>
						</ul>
					
					<?php
				}
				
		?>		
	</p>
</div>

<div id="F/W" class="tabcontent">
  <h3>F/W</h3>
  <p><ul class="list-group">
				<?php
				$sql_show1 = "SELECT * FROM ass_grouter WHERE ass_grouter_tribe='$key'  ";  //tribe
				$result_show1 = execute_sql($database_name, $sql_show1, $link);
				$num_rows = mysql_num_rows($result_show1);
				if($num_rows!=0)
				{
						while ($row_show1 = mysql_fetch_assoc($result_show1)  )
						{
						$NAME1 = $row_show1['ass_name'];
						$IP1 =  $row_show1['ass_ip'];
						echo '<li class="list-group-item">';
						echo '<a title="F/W" href="../view_date/view_tribe_FW_date.php?ip='.$IP1.'" target="_self">'.$NAME1.'</a>';
						echo '</li>';
						}	  
				}else{
					echo '<li class="list-group-item">';
					
					
					echo '</li>';
				}
				

				?>
			</ul></p>
</div>

<div id="4G Router" class="tabcontent">
  <h3>4G Router</h3>
  <p><ul class="list-group">
				<?php
				$sql_show2 = "SELECT * FROM ass_4Ggrouter WHERE ass_4Ggrouter_tribe='$key'  ";  //tribe
				$result_show2 = execute_sql($database_name, $sql_show2, $link);
				$num_rows = mysql_num_rows($result_show2);
				if($num_rows!=0)
				{
						while ($row_show2 = mysql_fetch_assoc($result_show2)  )
						{
						$NAME2 = $row_show2['ass_4Gname'];
						$IP2 =  $row_show2['ass_4Gip'];

						echo '<li class="list-group-item">';
						echo '<a title="4G router" href="../view_date/view_tribe_4G_date.php?ip='.$IP2.'" target="_self">'.$NAME2.'</a>';
						echo '</li>';
						}	  
				}else{
					echo '<li class="list-group-item">';
					
					
					echo '</li>';
				}
				

				?>
			</ul></p>
</div>

<div id="PoE S/W" class="tabcontent">
  <h3>PoE S/W</h3>
  <p><ul class="list-group">
				<?php
				$sql_show3 = "SELECT * FROM ass_poesw WHERE ass_poesw_tribe='$key'  ";  //tribe
				$result_show3 = execute_sql($database_name, $sql_show3, $link);
				$num_rows = mysql_num_rows($result_show3);
				if($num_rows!=0)
				{
					while ($row_show3 = mysql_fetch_assoc($result_show3)  )
				{
				$NAME3 = $row_show3['ass_poesw_name'];
				$IP3 =  $row_show3['ass_poesw_ip'];
				echo '<li class="list-group-item">';
				echo '<a title="POE Switch" href="../view_date/view_tribe_POE_date.php?ip='.$IP3.'" target="_self">'.$NAME3.'</a>';
				echo '</li>';
				}
				}else{
					echo '<li class="list-group-item">';
					
					
					echo '</li>';
				}
				
				
				
			
				?>
			</ul></p>
</div>

<div id="PDU" class="tabcontent">
  <h3>PDU</h3>
  <p><ul class="list-group">
				<?php
					$sql_show4 = "SELECT * FROM ass_pdu WHERE ass_pdu_tribe='$key'  ";  //tribe
					$result_show4 = execute_sql($database_name, $sql_show4, $link);
					$num_rows = mysql_num_rows($result_show4);
				if($num_rows!=0)
				{
				while ($row_show4 = mysql_fetch_assoc($result_show4)  )
					{
					$NAME4 = $row_show4['ass_pdu_name'];
					$IP4 =  $row_show4['ass_pdu_ip'];
					echo '<li class="list-group-item">';
					echo '<a title="PDU" href="../view_date/view_tribe_PDU_date.php?ip='.$IP4.'" target="_self">'.$NAME4.'</a>';
					echo '</li>';
					}
				}else{
					echo '<li class="list-group-item">';
					
					
					echo '</li>';
				}
					
					
				?>
			</ul></p>
</div>

<div id="AP" class="tabcontent">
  <h3>AP</h3>
  <p><ul class="list-group">
				<?php
				$sql_show5 = "SELECT * FROM ass_ap WHERE ass_ap_tribe='$key'  ORDER BY ass_ap.ass_ap_name ASC ";  //tribe
				$result_show5 = execute_sql($database_name, $sql_show5, $link);
				$num_rows = mysql_num_rows($result_show5);
				if($num_rows!=0)
				{
				while ($row_show5 = mysql_fetch_assoc($result_show5)  )
				{
				$NAME5 = $row_show5['ass_ap_name'];
				$IP5 =  $row_show5['ass_ap_ip'];
				echo '<li class="list-group-item">';
				echo '<a title="AP" href="../view_date/view_tribe_AP_date.php?ip='.$IP5.'" target="_self">'.$NAME5.'</a>';
				echo '</li>';
				}
				}else{
					echo '<li class="list-group-item">';
					
					
					echo '</li>';
				}
				
				
				
				?>
			</ul></p>
</div>

<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
     
</body>
</html>

