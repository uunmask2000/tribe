<html>
<head>
<script src="selectuser.js"></script>
</head>
<body>
<!---
<form> 
Select a User:
<select name="users" onchange="showUser(this.value)">
<option value="456">Peter Griffin</option>
<option value="454">Lois Griffin</option>
<option value="453">Glenn Quagmire</option>
<option value="452">Joseph Swanson</option>
</select>

</form>
<input type="button"  name="users" value="我是按鈕" onclick="showUser()">
-->
<script> 
var test = setInterval( showUser , 2000 );

</script> 


<p>
<div id="txtHint"><b>CPU 使用量表 </b></div>
</p>

</body>
</html>