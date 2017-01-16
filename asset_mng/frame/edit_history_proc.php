<?php

include_once("../../SQL/dbtools.inc.php");
$link = create_connection(); 


$i  = $_GET['case'];


switch ($i) {
    case 'FW':
        ///echo "i equals 0";
				$ass_change_name_router = trim($_POST['ass_change_name_router']);
				$ass_change_sn_router = trim($_POST['ass_change_sn_router']);
				$ass_change_mac_router = trim($_POST['ass_change_mac_router']);
				$ass_change_pn_router = trim($_POST['ass_change_pn_router']);
				$ass_change_label_router = trim($_POST['ass_change_label_router']);
				$ass_change_id_router = trim($_POST['ass_change_id_router']);
		$sql = " UPDATE ass_change_router SET ass_change_name_router='$ass_change_name_router' ,ass_change_sn_router='$ass_change_sn_router' ,ass_change_mac_router='$ass_change_mac_router' ,ass_change_pn_router='$ass_change_pn_router' ,ass_change_label_router='$ass_change_label_router' WHERE ass_change_id_router='$ass_change_id_router'";
		$result = execute_sql($database_name, $sql, $link);
		echo"<script>alert('資料存檔');history.back();window.opener=null;window.close();</script>";

		
        break;
    case '4G':
          ///echo "i equals 0";
				$ass_change_name_4Grouter = trim($_POST['ass_change_name_4Grouter']);
				$ass_change_sn_4Grouter = trim($_POST['ass_change_sn_4Grouter']);
				$ass_change_mac_4Grouter = trim($_POST['ass_change_mac_4Grouter']);
				$ass_change_pn_4Grouter = trim($_POST['ass_change_pn_4Grouter']);
				$ass_change_label_4Grouter = trim($_POST['ass_change_label_4Grouter']);
				$ass_change_id_4Grouter = trim($_POST['ass_change_id_4Grouter']);
		$sql = " UPDATE ass_change_4Grouter SET 
			ass_change_name_4Grouter='$ass_change_name_4Grouter' ,
			ass_change_sn_4Grouter='$ass_change_sn_4Grouter' ,
			ass_change_mac_4Grouter='$ass_change_mac_4Grouter' ,
			ass_change_pn_4Grouter='$ass_change_pn_4Grouter' ,
			ass_change_label_4Grouter='$ass_change_label_4Grouter'
		WHERE
				ass_change_id_4Grouter='$ass_change_id_4Grouter'";
		$result = execute_sql($database_name, $sql, $link);
		echo"<script>alert('資料存檔');history.back();window.opener=null;window.close();</script>";
        break;
    case 'PDU':
          ///echo "i equals 0";
				$ass_change_name_PDU = trim($_POST['ass_change_name_PDU']);
				$ass_change_sn_PDU = trim($_POST['ass_change_sn_PDU']);
				$ass_change_mac_PDU = trim($_POST['ass_change_mac_PDU']);
				$ass_change_pn_PDU = trim($_POST['ass_change_pn_PDU']);
				$ass_change_label_PDU = trim($_POST['ass_change_label_PDU']);
				$ass_change_id_PDU = trim($_POST['ass_change_id_PDU']);
		$sql = " UPDATE ass_change_PDU SET 
			ass_change_name_PDU='$ass_change_name_PDU' ,
			ass_change_sn_PDU='$ass_change_sn_PDU' ,
			ass_change_mac_PDU='$ass_change_mac_PDU' ,
			ass_change_pn_PDU='$ass_change_pn_PDU' ,
			ass_change_label_PDU='$ass_change_label_PDU'
		WHERE
				ass_change_id_PDU='$ass_change_id_PDU'";
		$result = execute_sql($database_name, $sql, $link);
		echo"<script>alert('資料存檔');history.back();window.opener=null;window.close();</script>";
        break;
	case 'poe':
          ///echo "i equals 0";
				$ass_change_name_poe_sw = trim($_POST['ass_change_name_poe_sw']);
				$ass_change_sn_poe_sw = trim($_POST['ass_change_sn_poe_sw']);
				$ass_change_mac_poe_sw = trim($_POST['ass_change_mac_poe_sw']);
				$ass_change_pn_poe_sw = trim($_POST['ass_change_pn_poe_sw']);
				$ass_change_label_poe_sw = trim($_POST['ass_change_label_poe_sw']);
				$ass_change_id_poe_sw = trim($_POST['ass_change_id_poe_sw']);
		$sql = " UPDATE ass_change_poe_sw SET 
			ass_change_name_poe_sw='$ass_change_name_poe_sw' ,
			ass_change_sn_poe_sw='$ass_change_sn_poe_sw' ,
			ass_change_mac_poe_sw='$ass_change_mac_poe_sw' ,
			ass_change_pn_poe_sw='$ass_change_pn_poe_sw' ,
			ass_change_label_poe_sw='$ass_change_label_poe_sw'
		WHERE
				ass_change_id_poe_sw='$ass_change_id_poe_sw'";
		$result = execute_sql($database_name, $sql, $link);
		echo"<script>alert('資料存檔');history.back();window.opener=null;window.close();</script>";
        break;
	case 'AP':
          ///echo "i equals 0";
				$ass_change_name_ap = trim($_POST['ass_change_name_ap']);
				$ass_change_sn_ap = trim($_POST['ass_change_sn_ap']);
				$ass_change_mac_ap = trim($_POST['ass_change_mac_ap']);
				$ass_change_pn_ap = trim($_POST['ass_change_pn_ap']);
				$ass_change_label_ap = trim($_POST['ass_change_label_ap']);
				$ass_change_id_ap = trim($_POST['ass_change_id_ap']);
		$sql = " UPDATE ass_change_ap SET 
			ass_change_name_ap='$ass_change_name_ap' ,
			ass_change_sn_ap='$ass_change_sn_ap' ,
			ass_change_mac_ap='$ass_change_mac_ap' ,
			ass_change_pn_ap='$ass_change_pn_ap' ,
			ass_change_label_ap='$ass_change_label_ap'
		WHERE
				ass_change_id_ap='$ass_change_id_ap'";
		$result = execute_sql($database_name, $sql, $link);
		echo"<script>alert('資料存檔');history.back();window.opener=null;window.close();</script>";
        break;	
case 'other':
          ///echo "i equals 0";
				$ass_change_name_other = trim($_POST['ass_change_name_other']);
				$ass_change_sn_other = trim($_POST['ass_change_sn_other']);
				$ass_change_mac_other = trim($_POST['ass_change_mac_other']);
				$ass_change_pn_other = trim($_POST['ass_change_pn_other']);
				$ass_change_label_other = trim($_POST['ass_change_label_other']);
				$ass_change_id_other = trim($_POST['ass_change_id_other']);
		$sql = " UPDATE ass_change_other SET 
			ass_change_name_other='$ass_change_name_other' ,
			ass_change_sn_other='$ass_change_sn_other' ,
			ass_change_mac_other='$ass_change_mac_other' ,
			ass_change_pn_other='$ass_change_pn_other' ,
			ass_change_label_other='$ass_change_label_other'
		WHERE
				ass_change_id_other='$ass_change_id_other'";
		$result = execute_sql($database_name, $sql, $link);
		echo"<script>alert('資料存檔');history.back();window.opener=null;window.close();</script>";
        break;				
    default:
       echo "i is not equal to 0, 1 or 2";
}





?>
