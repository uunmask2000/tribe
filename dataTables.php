
<!DOCTYPE html>
<!--[if lt IE 9]>
<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<html>
<head>
  
  <meta http-equiv="Content-Type" content="text/html; charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=11">
  <title>jQuery UI 測試</title>
  <!--------dataTables---------->
  <link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.2/themes/hot-sneaks/jquery-ui.css" rel="stylesheet">
  <link href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" rel="stylesheet">
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.0.min.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.2/jquery-ui.min.js"></script>
  <!---CDN
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
  -->
  <script type="text/javascript" src="dataTables/jquery.dataTables.min.js"></script>
  <style>
    article,aside,figure,figcaption,footer,header,hgroup,menu,nav,section {display:block;}
    body {font: 62.5% "Trebuchet MS", sans-serif; margin: 50px;}
  </style>
</head>
<body>
  <table id="show_date">
      <thead>
          <tr>
              <th>股票名稱</th>
              <th>股票代號</th>
              <th>收盤價 (元)</th>
              <th>成交量 (張)</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td>台積電</td>
              <td>2330</td>
              <td>111.5</td>
              <td>19268</td>
          </tr>
          <tr>
              <td>台積電</td>
              <td>2330</td>
              <td>111.5</td>
              <td>19268</td>
          </tr>
      </tbody>
  </table>
  <script language="JavaScript">
    $(document).ready(function(){ 
      var opt={"oLanguage":{"sProcessing":"處理中...",
                            "sLengthMenu":"顯示 _MENU_ 項結果",
                            "sZeroRecords":"沒有匹配結果",
                            "sInfo":"顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
                            "sInfoEmpty":"顯示第 0 至 0 項結果，共 0 項",
                            "sInfoFiltered":"(從 _MAX_ 項結果過濾)",
                            "sSearch":"搜索:",
                            "oPaginate":{"sFirst":"首頁",
                                         "sPrevious":"上頁",
                                         "sNext":"下頁",
                                         "sLast":"尾頁"}
		            }
	       };
      $("#show_date").dataTable(opt);
      });
  </script>
</body>
</html>