<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>jquery DataTables插件自定?分?ajax??</title>
    <link href="http://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="http://cdn.bootcss.com/datatables/1.10.11/css/dataTables.bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="http://cdn.bootcss.com/datatables/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet" media="screen">
</head>
<body>
<div class="row-fluid">
    <h3>JQuery DataTables插件自定?分?Ajax??</h3>
    <table id="example" class="display table-striped table-bordered table-hover table-condensed" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>??</th>
            <th>姓名</th>
            <th>性?</th>
        </tr>
        </thead>
    </table>
</div>
<script src="http://cdn.bootcss.com/datatables/1.10.11/js/jquery.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="http://cdn.bootcss.com/datatables/1.10.11/js/jquery.dataTables.min.js"></script>
<script src="http://cdn.bootcss.com/datatables/1.10.11/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(function () {
        //提示信息
        var lang = {
            "sProcessing": "?理中...",
            "sLengthMenu": "每? _MENU_ ?",
            "sZeroRecords": "?有匹配?果",
            "sInfo": "?前?示第 _START_ 至 _END_ ?，共 _TOTAL_ ?。",
            "sInfoEmpty": "?前?示第 0 至 0 ?，共 0 ?",
            "sInfoFiltered": "(由 _MAX_ ??果??)",
            "sInfoPostFix": "",
            "sSearch": "搜索:",
            "sUrl": "",
            "sEmptyTable": "表中?据?空",
            "sLoadingRecords": "?入中...",
            "sInfoThousands": ",",
            "oPaginate": {
                "sFirst": "首?",
                "sPrevious": "上?",
                "sNext": "下?",
                "sLast": "末?",
                "sJump": "跳?"
            },
            "oAria": {
                "sSortAscending": ": 以升序排列此列",
                "sSortDescending": ": 以降序排列此列"
            }
        };

        //初始化表格
        var table = $("#example").dataTable({
            language:lang,  //提示信息
            autoWidth: false,  //禁用自??整列?
            stripeClasses: ["odd", "even"],  //?奇偶行加上?式，兼容不支持CSS??的?合
            processing: true,  //?藏加?提示,自行?理
            serverSide: true,  //?用服?器端分?
            searching: false,  //禁用原生搜索
            orderMulti: false,  //?用多列排序
            order: [],  //取消默?排序查?,否?复?框一列?出?小箭?
            renderer: "bootstrap",  //渲染?式：Bootstrap和jquery-ui
            pagingType: "simple_numbers",  //分??式：simple,simple_numbers,full,full_numbers
            columnDefs: [{
                "targets": 'nosort',  //列的?式名
                "orderable": false    //包含上?式名‘nosort’的禁止排序
            }],
            ajax: function (data, callback, settings) {
                //封??求??
                var param = {};
                param.limit = data.length;//?面?示????，在?面?示每??示多少?的?候
                param.start = data.start;//?始的??序?
                param.page = (data.start / data.length)+1;//?前??
                //console.log(param);
                //ajax?求?据
                $.ajax({
                    type: "GET",
                    url: "/hello/list",
                    cache: false,  //禁用?存
                    data: param,  //?入??的??
                    dataType: "json",
                    success: function (result) {
                        //console.log(result);
                        //setTimeout????延?效果
                        setTimeout(function () {
                            //封?返回?据
                            var returnData = {};
                            returnData.draw = data.draw;//?里直接自行返回了draw??器,??由后台返回
                            returnData.recordsTotal = result.total;//返回?据全部??
                            returnData.recordsFiltered = result.total;//后台不????功能，每次查?均?作全部?果
                            returnData.data = result.data;//返回的?据列表
                            //console.log(returnData);
                            //?用DataTables提供的callback方法，代表?据已封?完成并?回DataTables?行渲染
                            //此?的?据需确保正确??，异常判??在?行此回?前自行?理完?
                            callback(returnData);
                        }, 200);
                    }
                });
            },
            //列表表?字段
            columns: [
                { "data": "Id" },
                { "data": "Name" },
                { "data": "Sex" }
            ]
        }).api();
        //此?需?用api()方法,否?返回的是JQuery?象而不是DataTables的API?象
    });
</script>
</body>
</html>