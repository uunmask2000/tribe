<?php

/*
//$file = "nadmin/file_download/upload/20160428170826.jpg";
//$file = 

$filename = $_GET['file'] ;
$file = "PHPExcel/Examples/Fire_down/".$_GET['file'] ;
if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
	header('Content-Type: application-x/force-download'); 
    //header('Content-Disposition: attachment; filename='.basename($file));
	header('Content-Disposition: attachment; filename='.$filename);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
	
	
    ob_clean();
    flush();
    readfile($file);
    exit;
}

*/

$i = $_GET['mode'];

switch ($i) {
    case 'A':
        //echo "i equals 0";
				$filename = $_GET['file'] ;
				$file = "PHPExcel/Examples/Fire_down/A/".$_GET['file'] ;
				if (file_exists($file)) {
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Type: application-x/force-download'); 
				//header('Content-Disposition: attachment; filename='.basename($file));
				header('Content-Disposition: attachment; filename='.$filename);
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));


				ob_clean();
				flush();
				readfile($file);
				exit;
				}
        break;
    case 'B':
        //echo "i equals 1";
						$filename = $_GET['file'] ;
				$file = "PHPExcel/Examples/Fire_down/B/".$_GET['file'] ;
				if (file_exists($file)) {
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Type: application-x/force-download'); 
				//header('Content-Disposition: attachment; filename='.basename($file));
				header('Content-Disposition: attachment; filename='.$filename);
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));


				ob_clean();
				flush();
				readfile($file);
				exit;
				}

        break;
    case 'C':
       // echo "i equals 2";
	   				$filename = $_GET['file'] ;
				$file = "PHPExcel/Examples/Fire_down/C/".$_GET['file'] ;
				if (file_exists($file)) {
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Type: application-x/force-download'); 
				//header('Content-Disposition: attachment; filename='.basename($file));
				header('Content-Disposition: attachment; filename='.$filename);
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));


				ob_clean();
				flush();
				readfile($file);
				exit;
				}

        break;
}

?>