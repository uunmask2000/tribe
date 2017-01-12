<html>
    <head>
        <title>Export to excel test</title>
        <script src="./js/excellentexport.js"></script>
       
    </head>
    <body>
        
        <a download="somedata.csv" href="#" onclick="return ExcellentExport.csv(this, 'datatable');">Export to CSV</a>
        <br/>

        <table id="datatable">
            <tr>
                <th>Column 1</th>
                <th>Column "cool" 2</th>
                <th>Column 3</th>
                <th>Column 4</th>
            </tr>
            <tr>
                <td>100,111</td>
                <td>200</td>
                <td>300</td>
                <td>中</td>
            </tr>
            <tr>
                <td>400</td>
                <td>500</td>
                <td>600</td>
                <td>國</td>
            </tr>
            
        </table>

    </body>
</html>
