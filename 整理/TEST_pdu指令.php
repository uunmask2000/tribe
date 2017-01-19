<?php
		$host = $IP ='172.21.57.5';

		$port = 6722;
	
		//172.21.57.110
		//echo $message = $id.':'.$time;
		//exit();
		set_time_limit(0);
		$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("無法建立連線\n");
		$result = socket_connect($socket, $host, $port) or die("無法連線\n");
		$message="00:00";
		//$message="11:00";
		//$message="21:00";
		//$message = $id.':'.$time;
		socket_write($socket, $message, strlen($message)) or die("訊息無法傳達\n");
		$result = socket_read ($socket, 1024) or die("無法讀取伺服器回饋訊息\n");
	echo $byte= $result;
		socket_close($socket);





?>