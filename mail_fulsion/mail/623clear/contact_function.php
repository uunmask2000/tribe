<?php
//20080317 泓璋    [用來處理 mail 及 後台 function]

function contact_admin($contact_field)
{
	include_once('../../include/connect_db.php');
	include_once('../../include/sql_db.php');
	
	$table="contact";
	$field=array(1=>'contact_name',2=>'contact_phone',3=>'contact_time',4=>'contact_mail',5=>'contact_address',6=>'contact_subject',7=>'contact_msg',8=>'contact_ip',9=>'contact_date');
	$data=array(1=>$contact_field['姓名'],2=>$contact_field['電話'],3=>$contact_field['聯絡時間'],4=>$contact_field['E-Mail'],5=>$contact_field['居住地區'],6=>$contact_field['標題'],7=>$contact_field['詢問內容'],8=>$_SERVER['REMOTE_ADDR'],9=>date('Y-m-d H:i:s'));
	$sql=sql_insert($table,$field,$data);
	$result = query_db($sql);
	
	return '您的訊息已寄出,我們會盡快跟你回覆,謝謝';
}

function make_contact_html($mail_title,$contact_field)
{
	$content_html=null;
	$content_html.='
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>' . $mail_title . '</title>
	</head>
	<body>
		<table width="80%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolorlight="#D0D0D0" bordercolordark="#FFFFFF">
			<tr>
				<th colspan="2" align="center" bgcolor="#FFCC66"><span style="font-size: 12px;color: #333333;">'. $mail_title .'</span></th>
			</tr>';
	foreach($contact_field as $key=>$value)
	{
		$content_html.='<tr>
								<th align="right" width="20%" bgcolor="#FF9999"><span style="font-size: 12px;color: #333333;">
									' . $key . ' ：
								</span></th>
								<td align="left"><span style="font-size: 12px;color: #6A6A6A;">
									' . (($key=='詢問內容')? nl2br($value):$value) . '&nbsp;
								</span></td>
							</tr>';
	}
	$content_html.='<table></body></html>';
	return $content_html;
}

function make_contact_reply_html($mail_title,$contact_field,$reply_msg)
{
	$content_html=null;
	$content_html.='
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>' . $mail_title . '</title>
	</head>
	<body>
			<table width="80%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolorlight="#D0D0D0" bordercolordark="#FFFFFF">
				<tr>
					<th align="center" colspan="2" bgcolor="#FFCC66"><span style="font-size: 12px;color: #333333;">' . $contact_field['姓名'] . '您好 ：</span></th>
				</tr>
				<tr>
					<th align="right" width="20%" bgcolor="#FF9999"><span style="font-size: 12px;color: #333333;">詢問標題 ：</span></th>
					<td align="left"><span style="font-size: 12px;color: #6A6A6A;">' . $contact_field['標題'] . '</span></td>
				</tr>
				<tr>
					<th align="right" width="20%" bgcolor="#FF9999"><span style="font-size: 12px;color: #333333;">詢問內容 ：</span></th>
					<td align="left"><span style="font-size: 12px;color: #6A6A6A;">' . nl2br($contact_field['詢問內容']) . '</span></td>
				</tr>
				<tr>
					<th align="center" colspan="2" bgcolor="#FFCC66"><span style="font-size: 12px;color: #333333;">我們的回覆內容如下：</span></th>
				</tr>
				<tr>
					<td align="left" colspan="2"><span style="font-size: 12px;color: #6A6A6A;">' . nl2br($reply_msg) . '</span></td>
				</tr>
		';
		
	$content_html.='</table></body></html>';
	return $content_html;
}

function make_contact_forget_password($mail_title,$contact_field)   //忘記密碼的格式
{
	$content_html=null;
	$content_html.='
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>' . $mail_title . '</title>
	</head>
	<body>
		<table width="80%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolorlight="#D0D0D0" bordercolordark="#FFFFFF">
			<tr>
				<th colspan="2" align="center" bgcolor="#FFCC66"><span style="font-size: 12px;color: #333333;">'. $mail_title .'</span></th>
			</tr>';
	foreach($contact_field as $key=>$value)
	{
		$content_html.='<tr>
                                        <th align="right" width="20%" bgcolor="#FF9999"><span style="font-size: 12px;color: #333333;">
                                                ' . $key . ' ：
                                        </span></th>
                                        <td align="left"><span style="font-size: 12px;color: #6A6A6A;">
                                                ' . (($key=='詢問內容')? nl2br($value):$value) . '&nbsp;
                                        </span></td>
                                </tr>';
	}
        $content_html.='<tr>
                                <th align="right" width="20%" bgcolor="#FF9999"><span style="font-size: 12px;color: #333333;">修改密碼：</span></th>
                                <td align="left"><span style="font-size: 12px;color: #6A6A6A;">'.'<a href='.'http://work.juncheng.tw/program/fix/forget_password.php'.'>修改</a>'.'</span></td>
                        </tr>';
        
        
	$content_html.='<table></body></html>';
	return $content_html;
}



?>