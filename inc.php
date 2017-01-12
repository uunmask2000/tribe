<?php
   ///Googlemap
   
	$base_ico =$row['base_ico'];
	$base_ico2 =$row['base_ico2'];
	$base_ico3 =$row['base_ico3'];

	$sql11 = "SELECT *  FROM  ass_grouter  WHERE `ass_grouter_address`='$addid'   ";//router 
	$result11 = execute_sql($database_name, $sql11, $link);

	$sql22 = "SELECT *  FROM  ass_4Ggrouter    where ass_4Ggrouter_address='$addid'   ";//4Grouter 
	$result22 = execute_sql($database_name, $sql22, $link);

	$sql33 = "SELECT * FROM `ass_pdu` WHERE  ass_pdu_address='$addid'    ";  //PDU
	$result33 = execute_sql($database_name, $sql33, $link);

	$sql44 = "SELECT *  FROM  ass_poesw  WHERE `ass_poesw_address`='$addid'    "; //poesw
	$result44 = execute_sql($database_name, $sql44, $link);

	$sql55 = "SELECT *  FROM  ass_ap  WHERE `ass_ap_address`='$addid'   ";  //AP
	$result55 = execute_sql($database_name, $sql55, $link);

		echo '<style> td img { margin:0 5px 0 0;}</style><div class="google_map"><table class="map">';
		echo '<tr><td>';
		echo ' <iframe class="slider" scrolling="no" src="inc_frame.php?key='.$addid.'"></iframe> ';
		echo '</td></tr>';
		if(($_SESSION['user_lv'])<=2)
			{
		echo '<tr><td>';
		echo '<a href="view_date/view_tribe_msg.php?key='.$tribe_ass_own.'" target="_blank" title="查看部落資訊">查看部落資訊</a>';    //tribe_ass_own
		echo '</td></tr>';
			}
		echo '<tr><td style="background:#e1f5af">'.$tribe_assets_name.'</td></tr>';

		echo '<tr><td>';
		
		
		//$black = 'target="_blank"';
while ($row111 = mysql_fetch_assoc($result11)  )
{


			$IP1 = $row111['ass_ip'];
			if(preg_match("/$IP1,/","$check_ip_death")) {
			//if(preg_match("/\$IP1,/","$check_ip_death")) {
			//echo "OK";
			//echo '<br>';
			$OK =1;

			} else {
			//echo "error";
			//echo '<br>';
			$OK =0;
			}
		if(($_SESSION['user_lv'])<=2)
		{
			//$row111['ass_ip']
			/*
			if($OK>0)
			{
			//echo "<a href=../device_defend/show_router.php?ip=".$row111['ass_ip']." $black>".$row111['ass_name']."</a>";//
			echo '<a title="F/W" href=../device_defend/show_router.php?ip='.$row111['ass_ip'].' target="_blank"><img src="images/icon_fw2.png" /></a>';
			}else
			{
			//echo "<a href=http://".$row111['ass_ip']." $black>".$row111['ass_name']."</a>";//
			echo '<a title="F/W" href=http://'.$row111['ass_ip'].' target="_blank"><img src="images/icon_fw.png" /></a>';
			}
			*/
			if($OK>0)
			{
				echo '<a title="F/W" href="view_date/view_tribe_FW_date.php?ip='.$row111['ass_ip'].'" target="_blank"><img src="images/icon_fw2.png" /></a>';
			}else{
				echo '<a title="F/W" href="view_date/view_tribe_FW_date.php?ip='.$row111['ass_ip'].'" target="_blank"><img src="images/icon_fw.png" /></a>';
			}
			//echo $OK;
		}
		
			
		
}	
	/*echo '<tr>';
			echo '<th colspan="2" style="background:#eee;">';
			echo'4G Router';
			echo '</th>';
		echo '</tr>';*/
	
while ($row22 = mysql_fetch_assoc($result22)  )
{	
	
		
			$IP2 = $row22['ass_4Gip'];
			if(preg_match("/$IP2/","$check_ip_death")) {
			//echo "OK";
			//echo '<br>';
			$OK =1;

			} else {
			//echo "error";
			//echo '<br>';
			$OK =0;
			}
			//if($OK>0){ echo '故障中' ;}	

			
			if(($_SESSION['user_lv'])<=2)
			{
			    /*
				if($OK>0)
				{
				//echo "<a href=../device_defend/show_4grouter.php?ip=".$row22['ass_4Gip']." $black>".$row22['ass_4Gname']."</a>";//
				echo '<a title="4G Router" href=../device_defend/show_4grouter.php?ip='.$row22['ass_4Gip'].' target="_blank"><img src="images/icon_4g2.png" /></a>';
				}else
				{
				//echo "<a href=http://".$row22['ass_4Gip']." $black>".$row22['ass_4Gname']."</a>";//
				echo '<a title="4G Router" href=http://'.$row22['ass_4Gip'].' target="_blank"><img src="images/icon_4g.png" /></a>';
				}	
				*/
				if($OK>0)
				{
				echo '<a title="4G Router" href="view_date/view_tribe_4G_date.php?ip='.$IP2.'" target="_blank"><img src="images/icon_4g2.png" /></a>';
				}else{
				echo '<a title="4G Router" href="view_date/view_tribe_4G_date.php?ip='.$IP2.'" target="_blank"><img src="images/icon_4g.png" /></a>';
				}
				//echo $OK;
			}

}	


/*echo '<tr>';
			echo '<th colspan="2" style="background:#eee;">';
			echo'4G Router';
			echo '</th>';
		echo '</tr>';*/




	/*echo '<tr>';
			echo '<th colspan="2" style="background:#eee;">';
			echo'PDU';
			echo '</th>';
		echo '</tr>';*/
while ($row33 = mysql_fetch_assoc($result33)  )
{	
	
		
				$IP3 = $row33['ass_pdu_ip'];
				if(preg_match("/$IP3/","$check_ip_death")) {
				//echo "OK";
				//echo '<br>';
				$OK =1;

				} else {
				//echo "error";
				//echo '<br>';
				$OK =0;
				}
			
			if(($_SESSION['user_lv'])<=2)
			{
						/*
						if($OK>0)
						{
						//echo  "<a href=../device_defend/show_pdu.php?ip=".$row33['ass_pdu_ip']." $black>".$row33['ass_pdu_name']."</a>";//
						echo '<a title="PDU" href=../device_defend/show_pdu.php?ip='.$row33['ass_pdu_ip'].' target="_blank"><img src="images/icon_pdu2.png" /></a>';
						}else
						{
						//echo  "<a href=../ap_data.php?ip=".$row33['ass_pdu_ip']." $black>".$row33['ass_pdu_name']."</a>";//
						echo '<a title="PDU" href=../ap_data.php?ip='.$row33['ass_pdu_ip'].' target="_blank"><img src="images/icon_pdu.png" /></a>';
						}	
						*/
						
				if($OK>0)
				{
				echo '<a title="PDU" href="view_date/view_tribe_PDU_date.php?ip='.$row33['ass_pdu_ip'].'" target="_blank"><img src="images/icon_pdu2.png" /></a>';
				}else{
				echo '<a title="PDU" href="view_date/view_tribe_PDU_date.php?ip='.$row33['ass_pdu_ip'].'" target="_blank"><img src="images/icon_pdu.png" /></a>';
				}	
//echo $OK;				

			}		

	
}

	/*echo '<tr>';
			echo '<th colspan="2" style="background:#eee;">';
			echo'PoESW';
			echo '</th>';
		echo '</tr>';*/

while ($row44 = mysql_fetch_assoc($result44)  )
{	


				$IP4 = $row44['ass_poesw_ip'];
				if(preg_match("/$IP4/","$check_ip_death")) {
				//echo "OK";
				//echo '<br>';
				$OK =1;

				} else {
				//echo "error";
				//echo '<br>';
				$OK =0;
				}

			if(($_SESSION['user_lv'])<=2)
			{
				/*
				if($OK>0)
				{
				//echo  "<a href=../device_defend/show_poe_sw.php?ip=".$row44['ass_poesw_ip']." $black>".$row44['ass_poesw_name']."</a>";//
				echo '<a title="POE S/W" href=../device_defend/show_poe_sw.php?ip='.$row44['ass_poesw_ip'].' target="_blank"><img src="images/icon_poe2.png" /></a>';
				}else
				{
				//echo  "<a href=http://".$row44['ass_poesw_ip']." $black>".$row44['ass_poesw_name']."</a>";//
				echo '<a title="POE S/W" href=http://'.$row44['ass_poesw_ip'].' target="_blank"><img src="images/icon_poe.png" /></a>';
				}
				*/
				if($OK>0)
				{
				echo '<a title="POE" href="view_date/view_tribe_POE_date.php?ip='.$row44['ass_poesw_ip'].'" target="_blank"><img src="images/icon_poe2.png" /></a>';
				}else{
				echo '<a title="POE" href="view_date/view_tribe_POE_date.php?ip='.$row44['ass_poesw_ip'].'" target="_blank"><img src="images/icon_poe.png" /></a>';
				}
				//echo $OK;
			}
}


while ($row55 = mysql_fetch_assoc($result55)  )
{


			$IP5 = $row55['ass_ap_ip'];
			if(preg_match("/$IP5/","$check_ip_death")) {
			//echo "OK";
			//echo '<br>';
			$OK =1;

			} else {
			//echo "error";
			//echo '<br>';
			$OK =0;
			}

		if(($_SESSION['user_lv'])<=2)
			{	
						/*
						if($OK>0)
						{
						//echo  "<a href=../device_defend/show_ap.php?ip=".$row55['ass_ap_ip']." $black>".$row55['ass_ap_name']."</a>";//
						echo '<a title="AP" href=../device_defend/show_ap.php?ip='.$row55['ass_ap_ip'].' target="_blank"><img src="images/icon_ap2.png" /></a>';
						}else
						{
						//echo  "<a href=http://".$row55['ass_ap_ip']." $black>".$row55['ass_ap_name']."</a>";//
						echo '<a title="'.$row55['ass_ap_name'].'" href=http://'.$row55['ass_ap_ip'].' target="_blank"><img src="images/icon_ap.png" /></a>';
						}
						*/	
					if($OK>0)
					{
					echo '<a title="AP" href="view_date/view_tribe_AP_date.php?ip='.$row55['ass_ap_ip'].'" target="_blank"><img src="images/icon_ap2.png" /></a>';
					}else{
					echo '<a title="AP" href="view_date/view_tribe_AP_date.php?ip='.$row55['ass_ap_ip'].'" target="_blank"><img src="images/icon_ap.png" /></a>';
					}
					//echo $OK;
						
			}

}


		echo '</td></tr>';

echo '</table></div>';



/*echo '<tr>';
			echo '<th colspan="2" style="background:#eee;">';
			echo'AP';
			echo '</th>';
		echo '</tr>';

while ($row55 = mysql_fetch_assoc($result55)  )
{	
	
		echo '<tr>';
			echo '<td>';
			 echo $row55['ass_ap_name'];
			echo '</td>';
			echo '<td>';
			echo  "<a href=http://".$row55['ass_ap_ip'].">管理AP</a>";
			echo '</td>';
		echo '</tr>';
	
}


echo '</table></div>';
?>
