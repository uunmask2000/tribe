<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<!--------dataTablesw套件---------->
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.12.3.js"></script>
<!---CDN
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
-->
<script type="text/javascript" src="../dataTables/1.10.12/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../dataTables/1.10.12/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<a href="Project_insert.php">新增專案</a>
<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>專案名稱</th>
                <th>專案對應代號</th>
				<th>編輯</th>
                <th>刪除</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
				<th>專案名稱</th>
				<th>專案對應代號</th>
				<th>編輯</th>
				<th>刪除</th>
            </tr>
        </tfoot>
    </table>
		<script language="JavaScript">
	$(document).ready(function(){ 
	var opt={ "oLanguage":{"sProcessing":"處理中...",
	"sLengthMenu":"顯示 _MENU_ 項結果",
	"sZeroRecords":"沒有匹配結果",
	"sInfo":"顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
	"sInfoEmpty":"顯示第 0 至 0 項結果，共 0 項",
	"sInfoFiltered":"(從 _MAX_ 項結果過濾)",
	"sSearch":"搜索:",
	"oPaginate":{"sFirst":"首頁",
	"sPrevious":"上頁",
	"sNext":"下頁",
	"sLast":"尾頁"},

	},
	"bFilter": true, //开关，是否启用客户端过滤器
	"bPaginate": true, //开关，是否显示分页器
	"bInfo": true, //开关，是否显示表格的一些信息，允许或者禁止表信息的显示，默认为 true，显示信息。
    "ajax": 'Project_view_ajax.php',
	dom: 'Bfrtip',	 
	buttons: 
	[
	{ extend: 'excelHtml5', text: '匯出報表' ,title: '報表' },
	//{ extend: 'print', text: '列印',title: '<?= date("Y-m-d");?>服務效益分析年報表' },	
	  'pageLength',				
	],
	columns: [
				{ title: "專案名稱" },
				{ title: "專案對應代號" },
				{ title: "編輯",
					"render": function ( data, type, full, meta )
					{
					//return '<a href="Project_fix.php?id='+data+'"><img src="../../images/icon/edit.gif" border="0"></a>';
					return '<input type="button" name="delete" value=" 編 輯 " onclick="fixForm('+data+')">';
					} 
				},
				{ title: "刪除" ,
					"render": function ( data, type, full, meta )
					{
					//return '<a href="Project_proc.php?mode=Del&id='+data+'"><img src="../../images/icon/edit.gif" border="0"></a>';
					return '<input type="button" name="delete" value=" 刪 除 " onclick="delForm('+data+')">';
					} 
				}
			]
	
	};
	$("#example").dataTable(opt);
	});
</script>

<script language="javascript">
function delForm(id)
{
	if( confirm("確定要刪除嗎??") )
	{
	location.href="Project_proc.php?mode=Del&id="+id
	}
}
function fixForm(id)
{
	location.href="Project_fix.php?id="+id
}
</script>