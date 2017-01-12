
			<div id="qaContent">
				<ul class="accordionPart">
				<?php
						require_once("SQL/dbtools.inc.php");
				$link = create_connection();
				 $sql = "SELECT * FROM city_array ORDER BY city_sort ASC";
				$result = execute_sql($database_name, $sql, $link);
				while ($row = mysql_fetch_assoc($result))
				 {
							$id = $row["id"] ;
				     //	   echo $id ;
				   			?>
								<li>
					   	   <?php	
							$sql33 = "SELECT *  FROM  city_township where township_city='$id'  ";
							$result33 = execute_sql($database_name, $sql33, $link);
							if (mysql_num_rows($result33) == 0)
							{}
							else
								{
									
									//echo NO ;
									?>
									<div id="q<?php echo $id;?>" class="qa_title"><?php echo $row["city_name"] ;   ?>
									</div>
									
									<?php 
								}
								?>
									<div class="qa_content">
										<?php
					
										$sql1 = "SELECT *  FROM  city_township where township_city='$id'   ";
										$result1 = execute_sql($database_name, $sql1, $link);
										while ($row1 = mysql_fetch_assoc($result1))
											{   
													$township_id = $row1["township_id"] ;
										            // echo $row1["township_name"] ;  
										             ?>
														<ul>				
															<li>
																	<p>
	                               <input class="clkopen" value="on" type="radio" onclick="A<?php  echo $township_id ; ?>.style.display=A<?php  echo $township_id ; ?>.style.display=='none'?'':'none'">
									<?php  echo $row1["township_name"] ;   ?>
																		<ol id="A<?php  echo $township_id ; ?>" style="display:none;">
																			<?php
																			  $sql2 = "SELECT *  FROM  tribe where township_id='$township_id'   ";
																			$result2 = execute_sql($database_name, $sql2, $link);
																				while ($row2 = mysql_fetch_assoc($result2))
																				{
																							?>
																								<li>
																										<a href="index.php?tribe_id=<?php echo $row2["tribe_id"] ; ?>&map=<?php echo $row2["tribe_x"] ; ?>,<?php echo $row2["tribe_y"] ; ?>&size=<?php echo $row2["tribe_o"] ; ?>" target="_self" style="text-decoration:none;color:red;"><?php  echo $row2["tribe_name"] ;   ?></a>
																								</li>
																							<?php
																				}
																			
																			?>
																		</ol>	
									
																	</p>
																	
														   </li>
													</ul>				
														
										            <?php
										
										
										 }
										
				}
				?>
					
					

				</ul>
			</div>
