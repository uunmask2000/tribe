<html>
<head>
<title>Hello~ Ajax</title>
<script type="text/javascript" src="creatRequestObj.js"> </script>
<script language="javascript" type="text/javascript">
//create XMLHttpRequest Object
var request = null;
request = creatRequestObj();
if (request == null){
//無法取得XMLHttpRequest物件時發出警告
alert("Error creating request object!");
}
//Send data to Server
function sendData() {
var url = "ajax.php";
request.open("GET", url, true);//開啟連線，選擇連線方式GET,POST
request.onreadystatechange = updatePage;//狀態完成時所要執行的函式
request.send(null);//送出
}
function updatePage() {
if (request.readyState == 4) {//完成狀態有好幾種，4代表資料傳回完成
var data = request.responseText;//取得傳回的資料存在變數中<
//更新文字框中的值
var txt = document.getElementById("data");
txt.value = data;
//以下的部份會把html中id為show的元素清除，然後再加入資料
var el = document.getElementById("show");
var newNode = document.createTextNode(data);
//clear nodes
if (el.childNodes) {
for (var i = 0; i < el.childNodes.length; i++) {
var childNode = el.childNodes[i];
el.removeChild(childNode);
}
}
el.appendChild(newNode);
}
}
</script>
</head>
<body>
<h1>Hello~ Ajax</h1>
<form method="GET">
<input type="text" id="data" />
<input value="Get Number" type="button" onClick="sendData();" />
</form>
<h2><div id="show"> </div></h2>
</body>
</html>