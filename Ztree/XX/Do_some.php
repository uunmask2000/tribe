<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#A1").click(function()
	{
        $("#div1").load("demo_test.txt", function(responseTxt, statusTxt, xhr){
           // if(statusTxt == "success")
               // alert("External content loaded successfully!");
           // if(statusTxt == "error")
              //  alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }
	);
	$("#A2").click(function()
	{
        $("#div1").load("2demo_test.txt", function(responseTxt, statusTxt, xhr){
			// if(statusTxt == "success")
			//alert("External content loaded successfully!");
			// if(statusTxt == "error")
			// alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }
	);
	$("#A3").click(function()
	{
        $("#div1").load("ajax.php", function(responseTxt, statusTxt, xhr){
			// if(statusTxt == "success")
			//alert("External content loaded successfully!");
			// if(statusTxt == "error")
			// alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }
	);
});
</script>
</head>
<body>

<div id="div1"></div>

<button id="A1">Get AJAX 1 </button>
<button id="A2">Get AJAX 2</button>
<button id="A3">Get AJAX 3</button>
</body>
</html>