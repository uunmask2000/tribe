
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title>jQuery TreeView</title>
	
	<link rel="stylesheet" href="http://design2u.me/blog/example/treeView/css/jquery.treeview.css" />
	
	<script src="http://design2u.me/blog/example/treeView/js/jquery.js" type="text/javascript"></script>
	<script src="http://design2u.me/blog/example/treeView/js/jquery.cookie.js" type="text/javascript"></script>
	<script src="http://design2u.me/blog/example/treeView/js/jquery.treeview.js" type="text/javascript"></script>
	
	<script type="text/javascript">
		$(function() {
			//初始設定
			$("#browser").treeview({
				collapsed: false, //是否預先打開
				animated: "fast", //動畫使用
				control:"#sidetreecontrol", //將 打開/折合事件綁定至該 div
				persist: "cookie",
				cookieId: "navigationtree",
				prerendered:false, //預先載入同 Layer 內容
				unique:true //打開某選項，關閉其他選項
			});
			/*
			//增加資料夾
			$("#addDirectory").click(function() {
				var branches = $( 
					"<li><img src='images/folder.gif' />資料夾</span></li>")
					.appendTo("#browser");
				$("#browser").treeview({
					add: branches
				});
			});
			
			//增加檔案
			$("#addFile").click(function() {
				var branches = $( 
					"<li><span class='file'>子資料</span></li></ul></li>")
					.appendTo("#browser");
				$("#browser").treeview({
					add: branches
				});
			});
			*/
		});
	</script>
	</head>
	<body>
	
	<div id="main">

	<h1>jQuery Tree View</h1>
	
	<div id="sidetreecontrol"> <a href="?#">折疊全部</a> | <a href="?#">打開全部</a> </div><br>
	<button id="addFile">addFile</button> <button id="addDirectory">addDirectory</button>
	<hr>
	
	<ul id="browser" class="filetree">
	<img src="images/folder.gif" />主資料夾</span>
		<li><img src="images/folder.gif" />資料夾</span></li>
		<li><img src="images/folder.gif" />資料夾</span>
			<ul>
				<li><img src="images/file.gif" /> 子資料</li>
			</ul>
		</li>
		<li><img src="images/folder.gif" />資料夾</span>
			<ul>
				<li><img src="images/folder.gif" /> 子資料夾</span>
					<ul id="folder21">
						<li><img src="images/file.gif" />子資料</li>
						<li><img src="images/file.gif" />子資料</li>
						<li><img src="images/file.gif" />子資料</li>
					</ul>
				</li>
				<li><img src="images/file.gif" />子資料</li>
			</ul>
		</li>
		<li><img src="images/folder.gif" />資料夾</span>
			<ul>
				<li><img src="images/file.gif" /> 子資料</li>
			</ul>
		</li>
		<li><img src="images/file.gif" /> 子資料</li>
	</ul>
		
</div>
 
</body></html>