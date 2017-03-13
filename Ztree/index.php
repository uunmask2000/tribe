<!DOCTYPE html>
<HTML>
<HEAD>
	<TITLE> ZTREE DEMO - Simple Data</TITLE>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="css/demo.css" type="text/css">
	<link rel="stylesheet" href="css/zTreeStyle/zTreeStyle.css" type="text/css">
	<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="js/jquery.ztree.core.js"></script>

 </HEAD>

<BODY>
<?php

include("../SQL/dbtools_ps.php"); 
include_once("../SQL/dbtools.inc.php");
$link = create_connection();
?>	
<SCRIPT type="text/javascript">
	var setting = {
			data: {
				simpleData: {
					enable: true
				}
			}
		};
		
		
		var zNodes =[
		
				{ id:'原名會', pId:0, name:"原名會", icon:"css/zTreeStyle/img/diy/4.png"},
				<?php
/// 縣市
$sql_city = "SELECT city_name,id FROM city_array";
$result_city = execute_sql($database_name, $sql_city, $link);
while ($row_city = mysql_fetch_assoc($result_city))
{
	?>
	{ "id":"<?=$row_city['city_name'];?>", pId:0, name:"<?=$row_city['city_name'];?>" , open:true, iconOpen:"css/zTreeStyle/img/diy/1_open.png", iconClose:"css/zTreeStyle/img/diy/1_close.png" , icon:"css/zTreeStyle/img/diy/4.png"},			
	<?php
	 /// 地區
	 $ID = $row_city['id'];
			$sql_township = "SELECT * FROM city_township where township_city='$ID' ";
			$result_township = execute_sql($database_name, $sql_township, $link);
			while ($row_township = mysql_fetch_assoc($result_township))
			{ 
			?>
			{ id:"<?=$row_township['township_name'];?>", pId:"<?=$row_city['city_name'];?>", name:"<?=$row_township['township_name'];?>", open:true, iconOpen:"css/zTreeStyle/img/diy/1_open.png", iconClose:"css/zTreeStyle/img/diy/1_close.png" },
			<?php
					/// 縣市
				$ID2 = $row_township['township_id'];
				$sql_tr = "SELECT * FROM tribe where township_id='$ID2' ";
				$result_tr = execute_sql($database_name, $sql_tr, $link);
				while ($row_tr = mysql_fetch_assoc($result_tr))
				{
				?>
				{ id:"<?=$row_tr['tribe_name'];?>", pId:"<?=$row_township['township_name'];?>", name:"<?=$row_tr['tribe_name'];?>" , open:true, iconOpen:"css/zTreeStyle/img/diy/1_open.png", iconClose:"css/zTreeStyle/img/diy/1_close.png"},
				<?php
				$ID3 = $row_tr['tribe_id'];
//FW
$sql_FW = "SELECT * FROM ass_grouter as A
LEFT JOIN city_array as B ON  (A.ass_grouter_city = B.id )
LEFT JOIN city_township as C ON (A.ass_grouter_twon = C.township_id )
LEFT JOIN tribe as D ON (A.ass_grouter_tribe = D.tribe_id )
WHERE D.tribe_id = '$ID3'
";
$result_FW = execute_sql($database_name, $sql_FW, $link);
while ($row_FW = mysql_fetch_assoc($result_FW))
{
?>
{ id:"<?=$row_FW['tribe_name'].$row_FW['ass_name'];?>", pId:"<?=$row_tr['tribe_name'];?>", name:"<?=$row_FW['tribe_name'].$row_FW['ass_name'];?>"},
<?php
}
//pdu
$sql_pdu = "SELECT * FROM ass_pdu as A
LEFT JOIN city_array as B ON  (A.ass_pdu_city = B.id )
LEFT JOIN city_township as C ON (A.ass_pdu_twon = C.township_id )
LEFT JOIN tribe as D ON (A.ass_pdu_tribe = D.tribe_id )
WHERE D.tribe_id = '$ID3'
";
$result_pdu = execute_sql($database_name, $sql_pdu, $link);
while ($row_pdu = mysql_fetch_assoc($result_pdu))
{
?>
{ id:"<?=$row_pdu['tribe_name'].$row_pdu['ass_pdu_name'];?>", pId:"<?=$row_tr['tribe_name'];?>", name:"<?=$row_pdu['tribe_name'].$row_pdu['ass_pdu_name'];?>"},
<?php
}
//ass_poesw
$sql_ass_poesw = "SELECT * FROM ass_poesw as A
LEFT JOIN city_array as B ON  (A.ass_poesw_city = B.id )
LEFT JOIN city_township as C ON (A.ass_poesw_twon = C.township_id )
LEFT JOIN tribe as D ON (A.ass_poesw_tribe = D.tribe_id )
WHERE D.tribe_id = '$ID3'
";
$result_ass_poesw = execute_sql($database_name, $sql_ass_poesw, $link);
while ($row_ass_poesw = mysql_fetch_assoc($result_ass_poesw))
{
?>
{ id:"<?=$row_ass_poesw['tribe_name'].$row_ass_poesw['ass_poesw_name'];?>", pId:"<?=$row_tr['tribe_name'];?>", name:"<?=$row_ass_poesw['tribe_name'].$row_ass_poesw['ass_poesw_name'];?>"},
<?php
}
//AP
$sql_ass_AP = "SELECT * FROM ass_ap as A
LEFT JOIN city_array as B ON  (A.ass_ap_city = B.id )
LEFT JOIN city_township as C ON (A.ass_ap_twon = C.township_id )
LEFT JOIN tribe as D ON (A.ass_ap_tribe = D.tribe_id )
WHERE D.tribe_id = '$ID3'
";
$result_ass_AP = execute_sql($database_name, $sql_ass_AP, $link);
while ($row_ass_AP = mysql_fetch_assoc($result_ass_AP))
{
?>
{ id:"<?=$row_ass_AP['tribe_name'].$row_ass_AP['ass_ap_name'];?>", pId:"<?=$row_tr['tribe_name'];?>", name:"<?=$row_ass_AP['tribe_name'].$row_ass_AP['ass_ap_name'];?>"},
<?php
}
//ass_4Ggrouter
$sql_ass_ass_4Ggrouter = "SELECT * FROM ass_4Ggrouter as A
LEFT JOIN city_array as B ON  (A.ass_4Ggrouter_city = B.id )
LEFT JOIN city_township as C ON (A.ass_4Ggrouter_twon = C.township_id )
LEFT JOIN tribe as D ON (A.ass_4Ggrouter_tribe = D.tribe_id )
WHERE D.tribe_id = '$ID3'
";
$result_ass_ass_4Ggrouter = execute_sql($database_name, $sql_ass_ass_4Ggrouter, $link);
while ($row_ass_ass_4Ggrouter = mysql_fetch_assoc($result_ass_ass_4Ggrouter))
{
?>
{ id:"<?=$row_ass_ass_4Ggrouter['tribe_name'].$row_ass_ass_4Ggrouter['ass_4Gname'];?>", pId:"<?=$row_tr['tribe_name'];?>", name:"<?=$row_ass_ass_4Ggrouter['tribe_name'].$row_ass_ass_4Ggrouter['ass_4Gname'];?>"},
<?php
}

				}
			
			}
	
		
		
}	

				
				?>
				/*
				{ id:1, pId:0, name:"縣市" , open:true, iconOpen:"css/zTreeStyle/img/diy/1_open.png", iconClose:"css/zTreeStyle/img/diy/1_close.png"},
				{ id:11, pId:1, name:"地區"},
				{ id:111, pId:11, name:"部落"},
				{ id:1111, pId:111, name:"設備"},
*/
				];

		$(document).ready(function(){
			$.fn.zTree.init($("#treeDemo"), setting, zNodes);
		});
	</SCRIPT>
<ul>
		<ul id="treeDemo" class="ztree"></ul>
</BODY>
</HTML>