<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>jquery DataTables����۩w?��?ajax??</title>
    <link href="http://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="http://cdn.bootcss.com/datatables/1.10.11/css/dataTables.bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="http://cdn.bootcss.com/datatables/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet" media="screen">
</head>
<body>
<div class="row-fluid">
    <h3>JQuery DataTables����۩w?��?Ajax??</h3>
    <table id="example" class="display table-striped table-bordered table-hover table-condensed" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>??</th>
            <th>�m�W</th>
            <th>��?</th>
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
        //���ܫH��
        var lang = {
            "sProcessing": "?�z��...",
            "sLengthMenu": "�C? _MENU_ ?",
            "sZeroRecords": "?���ǰt?�G",
            "sInfo": "?�e?�ܲ� _START_ �� _END_ ?�A�@ _TOTAL_ ?�C",
            "sInfoEmpty": "?�e?�ܲ� 0 �� 0 ?�A�@ 0 ?",
            "sInfoFiltered": "(�� _MAX_ ??�G??)",
            "sInfoPostFix": "",
            "sSearch": "�j��:",
            "sUrl": "",
            "sEmptyTable": "��?�u?��",
            "sLoadingRecords": "?�J��...",
            "sInfoThousands": ",",
            "oPaginate": {
                "sFirst": "��?",
                "sPrevious": "�W?",
                "sNext": "�U?",
                "sLast": "��?",
                "sJump": "��?"
            },
            "oAria": {
                "sSortAscending": ": �H�ɧǱƦC���C",
                "sSortDescending": ": �H���ǱƦC���C"
            }
        };

        //��l�ƪ��
        var table = $("#example").dataTable({
            language:lang,  //���ܫH��
            autoWidth: false,  //�T�Φ�??��C?
            stripeClasses: ["odd", "even"],  //?�_����[�W?���A�ݮe�����CSS??��?�X
            processing: true,  //?�å[?����,�ۦ�?�z
            serverSide: true,  //?�ΪA?���ݤ�?
            searching: false,  //�T�έ�ͷj��
            orderMulti: false,  //?�Φh�C�Ƨ�
            order: [],  //�����q?�ƧǬd?,�_?�`?�ؤ@�C?�X?�p�b?
            renderer: "bootstrap",  //��V?���GBootstrap�Mjquery-ui
            pagingType: "simple_numbers",  //��??���Gsimple,simple_numbers,full,full_numbers
            columnDefs: [{
                "targets": 'nosort',  //�C��?���W
                "orderable": false    //�]�t�W?���W��nosort�����T��Ƨ�
            }],
            ajax: function (data, callback, settings) {
                //��??�D??
                var param = {};
                param.limit = data.length;//?��?��????�A�b?��?�ܨC??�ܦh��?��?��
                param.start = data.start;//?�l��??��?
                param.page = (data.start / data.length)+1;//?�e??
                //console.log(param);
                //ajax?�D?�u
                $.ajax({
                    type: "GET",
                    url: "/hello/list",
                    cache: false,  //�T��?�s
                    data: param,  //?�J??��??
                    dataType: "json",
                    success: function (result) {
                        //console.log(result);
                        //setTimeout????��?�ĪG
                        setTimeout(function () {
                            //��?��^?�u
                            var returnData = {};
                            returnData.draw = data.draw;//?�������ۦ��^�Fdraw??��,??�ѦZ�x��^
                            returnData.recordsTotal = result.total;//��^?�u����??
                            returnData.recordsFiltered = result.total;//�Z�x��????�\��A�C���d?��?�@����?�G
                            returnData.data = result.data;//��^��?�u�C��
                            //console.log(returnData);
                            //?��DataTables���Ѫ�callback��k�A�N��?�u�w��?�����}?�^DataTables?���V
                            //��?��?�u���̫O����??�A�ݱ`�P??�b?�榹�^?�e�ۦ�?�z��?
                            callback(returnData);
                        }, 200);
                    }
                });
            },
            //�C���?�r�q
            columns: [
                { "data": "Id" },
                { "data": "Name" },
                { "data": "Sex" }
            ]
        }).api();
        //��?��?��api()��k,�_?��^���OJQuery?�H�Ӥ��ODataTables��API?�H
    });
</script>
</body>
</html>