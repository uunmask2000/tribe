
<?php
$NewArray=array('Client_Number','Client_Number_5G','Client_Number_Vs_Air_Time','Client_Number_Vs_Air_Time_5G','Client_Number_Vs_Air_Time_ALL','Client_Number_Vs_Air_Time_ALL_5G','Continuously_Disconnected_APs','Continuously_Disconnected_APs_D','Failed_Client_Associations','Failed_Client_Associations_5G','new_Client_Associations','new_Client_Associations_5G','System_Resource_Utilization','TX_and_Rx','TX_and_Rx_5G');　
/*
for($i=0;$i<15;$i++){
?>

<a href="show_record<?=$i;?>.php" target="_blank" title="<?=$NewArray[$i];?>">連結<?=$i;?></a>
<?php
}
*/
?>
<div class="report_bar">
<?php
	for($i=0;$i<15;$i++)
	{
?>
		  <a href="show_record<?=$i;?>.php" target="_self" title="<?=$NewArray[$i];?>">連結<?=$i;?></a> 
	<?php
		if($i>=0)
		{
		 echo ' ' ;
		}
	}
?>
     
</div>
