<html>
<head>
<title>無線AP網管系統</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<script type="text/javascript" src="../js/jquery-latest.js"></script>
<link href="../include/style.css" rel="stylesheet" type="text/css" />
<link href="../include/reset.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrap">

<!-------------------------------------- TOP -->
	<div id="header">
    <?php 
			include("../include/top.php"); 
			include_once("../SQL/dbtools.inc.php");
			$link = create_connection();
		
		?>
	</div>

<!-------------------------------------- MAIN -->
	<div id="main">

		<?php include("../alert/alert2.php"); ?>

		<div class="tab_container">
			 <form action="mng_tribe_proc.php?mode=fix_tribe" method="POST">
			<?php
                                    $id= $_GET['id'];
				$sql = "SELECT *  FROM  tribe where tribe_id='$id' ";
				$result = execute_sql($database_name, $sql, $link);
				while ($row = mysql_fetch_assoc($result))
				{			
				   
					$tribe_name = $row['tribe_name'];
					$tribe_x= $row['tribe_x'];
					$tribe_y = $row['tribe_y'];
					$tribe_o = $row['tribe_o'];
					$tribe_label = $row['tribe_label'];
					//
					$tribe_member = $row['tribe_member'];
					$tribe_phone = $row['tribe_phone'];
					$tribe_note = $row['tribe_note'];
 
				}

			?>
					 <input type="hidden" name="ckeck_key"  value="check" >
					 <input type="hidden" name="uid"  value="<?=$id;?>" >


			<table cellpadding="5" cellspacing="0" class="edit">
				<tr>
					<th colspan="2">修改部落</th>
				</tr>
				
				
					<tr>
						<td>選擇期標</td>
						<td>
						<select id="tribe_label" name="tribe_label" onchange="this.form.submit();">
						  <?php
						  if($tribe_label==0)
						  {
							?>
							 <option value="2"    <?php  if($tribe_label=='0'){ echo 'selected';  }          ;?> >無期</option>
							<?php  
						  }
						  
						  
						  ?>
						 <option value="2"    <?php  if($tribe_label=='2'){ echo 'selected';  }          ;?> >二期</option>
						 <option value="3"     <?php  if($tribe_label=='3'){ echo 'selected';  }          ;?>     >三期</option>
						
						</select>
						</td>
					</tr>
				
				
				

				<tr>
					<td>部落名稱</td>
					<td><input type="text" name="tribe_name"  value="<?=$tribe_name ;?>" ></td>
				</tr>

				<tr>
					<td>部落中心座標(X)</td>
					<td><input type="text" name="tribe_x"  value="<?=$tribe_x;?>" ></td>
				</tr>

				<tr>
					<td>部落中心座標(Y)</td>
					<td><input type="text" name="tribe_y"  value="<?=$tribe_y ;?>" ></td>
				</tr>

				<tr>
					<td>地圖尺寸(預設16)</td>
					<td><input type="number" name="tribe_o"  value="<?=$tribe_o ;?>" ></td>
				</tr>
				
				<!-----部落聯絡資訊------->
				<tr>
					<td>部落聯絡人</td>
					<td><input type="text" name="tribe_member" value="<?=$tribe_member ;?>" ></td>
				</tr>				
				<tr>
					<td>部落聯絡電話</td>
					<td><input type="text" name="tribe_phone" value="<?=$tribe_phone ;?>" ></td>
				</tr>
				
				
				<tr>
					<td>部落聯絡備註</td>
					<td><input type="text" name="tribe_note" value="<?=$tribe_note ;?>" ></td>
				</tr>
				
				
				<tr>
					<td colspan="2" align="center">
						<input class="edit_btn" type="submit" value="儲存">
						<input class="edit_btn" type="button" onClick="history.back()" value="回上頁">
					</td>
				</tr>
			</table>
		</div>	
	</div>	

<!-------------------------------------- FOOTER -->

  	<div id="footer">
	<?php include("../include/bottom.php"); ?>
	</div>
		
</div>

</body>
</html>
