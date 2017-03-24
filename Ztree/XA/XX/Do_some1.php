<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h1>My First Bootstrap Page</h1>
  <p>Resize this responsive page to see the effect!</p> 
</div>
  <script>
setInterval(function() {
  $("#container").load(location.href+" #container>*","");
  $(document).ready(function () {
    $.ajax({ 
        type: 'GET', 
        url: 'ajax.php', 
        data: { get_param: 'value' }, 
        success: function (data) { 
         for (var i=0;i<data.length;++i)
         {
         $('#cand').append('<div class="name">data[i].name</>');
         }
        }
    });
});
}, 5000);
</script>
<div class="container" id="container" name="container" >

<div class="row">
					<div class="col-sm-4">
					<h3>Column 2</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
					<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
					</div>
					<div class="col-sm-4">
					<h3>Column dfsdfsdfsdf2</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
					<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
					</div>
					<div class="col-sm-4">
					<h3>Column sdfsdfsdfsfsdf31234564</h3>        
					<p>Lorem i123485um dolor sit amet, consectetur adipisicing elit...</p>
					<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
					</div>
					</div>
					<div class="cand" id="cand">
					
					</div>
<?php
///include("ajax.php");

?>
</div>

</body>
</html>