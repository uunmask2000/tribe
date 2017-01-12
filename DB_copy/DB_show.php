<?php
date_default_timezone_set('Asia/Taipei');
echo  date ("Y-m-d H:i:s");

	  header('refresh: 7200;url="DB_show.php"') ;
      require_once("dbtools.inc.php");

			$link = create_connection();
			$link2 = create_connection2();

      //執行 SQL 命令
	  //$sql = "SELECT *  FROM radacct where nasipaddress ORDER BY `radacct`.`radacctid` DESC limit 5000 ";	
	  
	  //$sql = "SELECT * FROM `radacct` WHERE  acctstoptime  <>'0000-00-00 00:00:00' and acctstoptime < '2016-10-29 00:00:00' and acctstoptime > '2016-10-27 00:00:00'";	
      $sql = "SELECT * FROM `radacct` WHERE  acctstoptime  <>'0000-00-00 00:00:00' and acctstoptime  < timestamp(DATE_SUB(NOW(), INTERVAL 30 MINUTE))  and acctstoptime > date_sub(curdate(),interval 2 day)";
	  $result = execute_sql($database_name, $sql, $link);
	  //取得欄位數
      $total_fields = mysql_num_fields($result);
	  //$Arr1 = array();
	   while ($row = mysql_fetch_row($result))
      {
		   for($i = 0; $i < $total_fields; $i++)
		   {
			   //echo $row[$i] ;
			   if($row[$i]==NULL)
			   {
				   $row[$i]= 0 ;
			   }else{
				   $row[$i] = $row[$i];
			   }
			 $Arr1[$i] = '"'.$row[$i].'"' ;
			   
			   //echo '"'.$row[$i].'",';
			  // echo '<br>';	
			   //$VALUES_text = '"'.$row[$i].'",';
			  // $VALUES_text = substr($VALUES_text,0,-1);
				//echo $VALUES_text ;
			   
//				$sql = "INSERT INTO `radacct`(`radacctid`, `acctsessionid`, `acctuniqueid`, `username`, `groupname`, `realm`, `nasipaddress`, `nasportid`, `nasporttype`, `acctstarttime`, `acctstoptime`, `acctsessiontime`, `acctauthentic`, `connectinfo_start`, `connectinfo_stop`, `acctinputoctets`, `acctoutputoctets`, `calledstationid`, `callingstationid`, `acctterminatecause`, `servicetype`, `framedprotocol`, `framedipaddress`, `acctstartdelay`, `acctstopdelay`, `xascendsessionsvrkey`) VALUES ( )";
	//			execute_sql($database_name2, $sql, $link2);
		   }
	       //echo '<br>';
		   
		    //echo $Arr1[0];
			
			$radacctid =$Arr1[0];
			$radacctid = str_replace('"',"",$radacctid);
			
			$str = implode(",", $Arr1);
			//str_replace(',"',",",$str);
			//echo $str ;
			$sql_check = "SELECT * FROM radacct WHERE radacctid='$radacctid'      ";	
		//echo $sql_check ;
		//echo '<br>';	
			$result_check = execute_sql2($database_name2, $sql_check, $link2);
			$rowcount=mysql_num_rows($result_check);
			if($rowcount>0)
			{
				//echo 'A';
			}else{
				//echo 'B';
				$sql_insert = "INSERT INTO `radacct`(`radacctid`, `acctsessionid`, `acctuniqueid`, `username`, `groupname`, `realm`, `nasipaddress`, `nasportid`, `nasporttype`, `acctstarttime`, `acctstoptime`, `acctsessiontime`, `acctauthentic`, `connectinfo_start`, `connectinfo_stop`, `acctinputoctets`, `acctoutputoctets`, `calledstationid`, `callingstationid`, `acctterminatecause`, `servicetype`, `framedprotocol`, `framedipaddress`, `acctstartdelay`, `acctstopdelay`, `xascendsessionsvrkey`) VALUES ($str )";
				execute_sql2($database_name2, $sql_insert, $link2);	
				//echo $sql_insert ;
				//echo '<br>';	
				
			}
			
			
				
			
			/*
			
			$sql_check = "SELECT * FROM radacct WHERE radacctid='$check_radacctid'      ";	
			$result_check = execute_sql($database_name2, $sql_check, $link2);
			$rowcount=mysql_num_rows($result_check);
			if($rowcount>0)
			{
				echo 'A';
			}else{
				echo 'B';
			}
			*/
			//echo $str;
			
			//$sql = "INSERT INTO `radacct`(`radacctid`, `acctsessionid`, `acctuniqueid`, `username`, `groupname`, `realm`, `nasipaddress`, `nasportid`, `nasporttype`, `acctstarttime`, `acctstoptime`, `acctsessiontime`, `acctauthentic`, `connectinfo_start`, `connectinfo_stop`, `acctinputoctets`, `acctoutputoctets`, `calledstationid`, `callingstationid`, `acctterminatecause`, `servicetype`, `framedprotocol`, `framedipaddress`, `acctstartdelay`, `acctstopdelay`, `xascendsessionsvrkey`) VALUES ( )";
			//execute_sql($database_name2, $sql, $link2);
			
			//print_r($Arr1) ; 
			//echo '<br>';		 
	  }
      //釋放記憶體空間
	  
	 
      mysql_free_result($result);
      mysql_close($link);
    ?>

