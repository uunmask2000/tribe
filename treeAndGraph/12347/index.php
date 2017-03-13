<!DOCTYPE html>

<html>
  <head>
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="jquery.cookie.js"></script>
    <script type="text/javascript" src="jquery.tree.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('ul.telefilms').tree({default_expanded_paths_string : '0/0/0,0/0/2,0/2/4'});
		
        $('.expand_button').on('click', function() {
          $('ul.telefilms.first').expand();
        });
        $('.collapse_button').on('click', function() {
          $('ul.telefilms.first').collapse();
        });
      });
    </script>
    <title>jQuery tree plugin</title>
  </head>

  <body>
<?php

include("../../SQL/dbtools_ps.php"); 
include_once("../../SQL/dbtools.inc.php");
$link = create_connection();
?>
    <div>

      <a href="#" class="expand_button">全展開</a>
      <a href="#" class="collapse_button">全收合</a>
	  <ul>
	     <li>原名會</li>
      <ul class="telefilms first" data-cookie="cookie1"> <!-- Use 'cookie1' as unique key to save cookie only for this tree -->
	  <?php
		 /// 縣市
		$sql_city = "SELECT city_name,id FROM city_array";
		$result_city = execute_sql($database_name, $sql_city, $link);
		while ($row_city = mysql_fetch_assoc($result_city))
		{
			 /// 地區
			 $ID = $row_city['id'];
			?>
			<li>
			<?=$row_city['city_name'];?>
			<?php
				$sql_township = "SELECT * FROM city_township where township_city='$ID' ";
				$result_township = execute_sql($database_name, $sql_township, $link);
				while ($row_township = mysql_fetch_assoc($result_township))
				{ 
			/// 縣市
						$ID2 = $row_township['township_id'];
?>
<ul>
<li>
<span class="jtree-button"><?=$row_township['township_name'];?></span>
<?php
$sql_tr = "SELECT * FROM tribe where township_id='$ID2' ";
$result_tr = execute_sql($database_name, $sql_tr, $link);
while ($row_tr = mysql_fetch_assoc($result_tr))
{
	$ID3 = $row_tr['tribe_id'];
	?>
		<ul>
		<li>
		<a href="#"><?=$row_tr['tribe_name'];?></a>
		<ul>
		<?php
$sql_FW = "SELECT * FROM ass_grouter as A
LEFT JOIN city_array as B ON  (A.ass_grouter_city = B.id )
LEFT JOIN city_township as C ON (A.ass_grouter_twon = C.township_id )
LEFT JOIN tribe as D ON (A.ass_grouter_tribe = D.tribe_id )
WHERE D.tribe_id = '$ID3'
";
$result_FW = execute_sql($database_name, $sql_FW, $link);
while ($row_FW = mysql_fetch_assoc($result_FW))
{
		
  echo '<li><a href="#">'.$row_FW['tribe_name'].$row_FW['ass_name'].'</a></li>';
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
		
echo '<li><a href="#">'.$row_pdu['tribe_name'].$row_pdu['ass_pdu_name'].'</a></li>';
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
		
echo '<li><a href="#">'.$row_ass_poesw['tribe_name'].$row_ass_poesw['ass_poesw_name'].'</a></li>';
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
		
echo '<li><a href="#">'.$row_ass_AP['tribe_name'].$row_ass_AP['ass_ap_name'].'</a></li>';
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
		
echo '<li><a href="#">'.$row_ass_ass_4Ggrouter['tribe_name'].$row_ass_ass_4Ggrouter['ass_4Gname'].'</a></li>';
}
		
		
		
		
		
		
		?>
		
		
				
		</ul>
		</li>
		</ul>
	<?php

}

?>
		
</li>
</ul>
<?php

				}
			?>			
			</li>
			<?php
			
			
	    }
	  
	  
	  
	  ?>
			
        <!--
		<li>
         縣市
          <ul>
            <li>
              <span class="jtree-button">地區 (click me to expand/collapse)</span>
              <ul>
                <li>
                  <a href="#">部落</a>
                  <ul>
                    <li><a href="#">設備</a></li>
                    <li><a href="#">link 2</a></li>
                    <li><a href="#">link 3</a></li>
                    <li><a href="#">link 4</a></li>
                    <li><a href="#">link 5</a></li>
                    <li><a href="#">link 6</a></li>
                  </ul>
                </li>
                <li>
                  <a href="#">Episode 2</a>
                  <ul>
                    <li><a href="#">link 1</a></li>
                    <li><a href="#">link 2</a></li>
                    <li><a href="#">link 3</a></li>
                    <li><a href="#">link 4</a></li>
                    <li><a href="#">link 5</a></li>
                    <li><a href="#">link 6</a></li>
                  </ul>
                </li>
                <li>
                  <a href="#">Episode 3</a>
                  <ul>
                    <li><a href="#">link 1</a></li>
                    <li><a href="#">link 2</a></li>
                    <li><a href="#">link 3</a></li>
                    <li><a href="#">link 4</a></li>
                    <li><a href="#">link 5</a></li>
                    <li><a href="#">link 6</a></li>
                  </ul>
                </li>
                <li>
                  <a href="#">Episode 4</a>
                  <ul>
                    <li><a href="#">link 1</a></li>
                    <li><a href="#">link 2</a></li>
                    <li><a href="#">link 3</a></li>
                    <li><a href="#">link 4</a></li>
                    <li><a href="#">link 5</a></li>
                    <li><a href="#">link 6</a></li>
                  </ul>
                </li>
                <li>
                  <a href="#">Episode 5</a>
                  <ul>
                    <li><a href="#">link 1</a></li>
                  </ul>
                </li>
                <li>
                  <a href="#">Episode 6</a>
                  <ul>
                    <li><a href="#">link 1</a></li>
                    <li><a href="#">link 2</a></li>
                    <li><a href="#">link 3</a></li>
                    <li><a href="#">link 4</a></li>
                    <li><a href="#">link 5</a></li>
                    <li><a href="#">link 6</a></li>
                  </ul>
                </li>
              </ul>
            </li>
		   -->	
	     </ul>
	 </ul>
    </div>
  </body>
</html>
