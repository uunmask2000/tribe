<title>cytoscape-dagre.js demo</title>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-2.0.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cytoscape/2.5.4/cytoscape.min.js"></script>

<!-- <script src="http://cytoscape.github.io/cytoscape.js/api/cytoscape.js-latest/cytoscape.min.js"></script> -->
<!-- for testing with local version of cytoscape.js -->
<!--<script src="../cytoscape.js/build/cytoscape.js"></script>-->

<script src="https://cdn.rawgit.com/cpettitt/dagre/v0.7.4/dist/dagre.min.js"></script>
<script src="https://cdn.rawgit.com/cytoscape/cytoscape.js-dagre/1.1.2/cytoscape-dagre.js"></script>
<style>
body {
  font-family: helvetica;
  font-size: 14px;
}

#cy {
  border: solid;
  border-width: 1;
  height: 100%;
}

h1 {
  opacity: 0.5;
  font-size: 1em;
}
</style>


<body>


  <h1>cytoscape-dagre demo</h1>
<?php

include("../SQL/dbtools_ps.php"); 
include_once("../SQL/dbtools.inc.php");
$link = create_connection();
?>
<script>
/* cytoscape js selector demo
moved to http://codepen.io/yeoupooh/pen/BjWvRa
 */
$(function() {

  var win = $(window);

  win.resize(function() {
    resize();
  });

  function resize() {
    console.log(win.height(), win.innerHeight());
    $("#cy-container").height(win.innerHeight() - 130);
    cy.resize();
  }

  setTimeout(resize, 0);

  var nodeOptions = {
    normal: {
      bgColor: 'grey'
    },
    selected: {
      bgColor: 'yellow'
    }
  };

  var edgeOptions = {
    selected: {
      lineColor: 'yellow'
    }
  };

  var cy = window.cy = cytoscape({
    container: document.getElementById('cy'),

    minZoom: 0.1,
    maxZoom: 100,
    wheelSensitivity: 0.1,

    // panningEnabled: false,
    //boxSelectionEnabled: true,
    //autounselectify: false,
    //selectionType: 'additive',
    //autoungrabify: true,

    layout: {
      name: 'dagre'
    },

    style: [{
        selector: 'node',
        style: {
          'width': 200,
          'height': 200,
          'content': 'data(text)',
          //          'text-opacity': 0.5,
          'text-valign': 'center',
          'color': 'white',
          'background-color': nodeOptions.normal.bgColor,
          'text-outline-width': 2,
          'text-outline-color': '#222'
        }
      },

      {
        selector: 'edge',
        style: {
          'width': 10,
          'target-arrow-shape': 'triangle',
          'line-color': 'data(color)',
          'target-arrow-color': '#9dbaea'
        }
      },

      {
        selector: ':selected',
        style: {
          'background-color': 'yellow',
          'line-color': 'yellow',
          'target-arrow-color': 'black',
          'source-arrow-color': 'black',
        }
      },

      {
        selector: 'edge:selected',
        style: {
          'width': 20
        }
      }
    ],

    elements: {
      //selectable: false, 
      grabbable: false,
      nodes:
	  [
	    {
			data:
			{
			  id: 'ROOT',
			  text: 'ROOT'
			}
		},
<?php

    /// 縣市
	$sql_city = "SELECT city_name,id FROM city_array";
	$result_city = execute_sql($database_name, $sql_city, $link);
	while ($row_city = mysql_fetch_assoc($result_city))
	{
		//echo "{ data: { id: '".$row_city['city_name']."', name: '".$row_city['city_name']."', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },";
		//echo "{ data: { source: 'ROOT', target: '".$row_city['city_name']."', faveColor: '#6FB1FC', strength: 90 } },";
		echo "		
		  {
				data: {
				  id: '".$row_city['city_name']."',
				  text: '".$row_city['city_name']."'
				}
		  },
		";
	}
	
	/////地區
	$sql_township = "SELECT * FROM city_township";
	$result_township = execute_sql($database_name, $sql_township, $link);
	while ($row_township = mysql_fetch_assoc($result_township))
	{
		//echo "{ data: { id: '".$row_township['township_name']."', name: '".$row_township['township_name']."', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },";
		echo "		
		{
			data: {
			  id: '".$row_township['township_name']."',
			  text: '".$row_township['township_name']."'
			}
		},
		";
	}
	////部落
	$sql_tribe = "SELECT * FROM tribe";
	$result_tribe = execute_sql($database_name, $sql_tribe, $link);
	while ($row_tribe = mysql_fetch_assoc($result_tribe))
	{
		//echo "{ data: { id: '".$row_tribe['tribe_name']."', name: '".$row_tribe['tribe_name']."', weight: 65, faveColor: '#6FB1FC', faveShape: 'octagon' } },";
		echo "		
		{
			data: {
			  id: '".$row_tribe['tribe_name']."',
			  text: '".$row_tribe['tribe_name']."'
			}
		},
		";
	}
?>		
<?php
//FW
$sql_FW = "SELECT * FROM ass_grouter as A
LEFT JOIN city_array as B ON  (A.ass_grouter_city = B.id )
LEFT JOIN city_township as C ON (A.ass_grouter_twon = C.township_id )
LEFT JOIN tribe as D ON (A.ass_grouter_tribe = D.tribe_id )
";
$result_FW = execute_sql($database_name, $sql_FW, $link);
while ($row_FW = mysql_fetch_assoc($result_FW))
{
echo "{ data: { id: '".$row_FW['tribe_name'].$row_FW['ass_name']."', text:'".$row_FW['tribe_name'].$row_FW['ass_name']."' } },";
}

?>
	  
	  
/*	  
		  {
			data: {
			  id: 'FW',
			  text: 'FW'
			}
		  }, {
			data: {
			  id: '4GR',
			  text: '4GR'
			}
		  }, {
			data: {
			  id: 'PDU',
			  text: 'PDU'
			}
		  }, {
			data: {
			  id: 'POE',
			  text: 'POE'
			}
		  }
		  
*/		  
			  
	  ], // nodes
      edges: 
	  [
		<?php
		 /// 縣市
		$sql_city = "SELECT city_name,id FROM city_array";
		$result_city = execute_sql($database_name, $sql_city, $link);
		while ($row_city = mysql_fetch_assoc($result_city))
		{
          
				echo "
				  {
						data:
						{
						color: '#f00',
						source: 'ROOT',
						target: '".$row_city['city_name']."'
						}
				  },
				 ";
             /// 地區
			 $ID = $row_city['id'];
				$sql_township = "SELECT * FROM city_township where township_city='$ID' ";
				$result_township = execute_sql($database_name, $sql_township, $link);
				while ($row_township = mysql_fetch_assoc($result_township))
				{
				echo "
				  {
						data:
						{
						color: '#f00',
						source: '".$row_city['city_name']."',
						target: '".$row_township['township_name']."'
						}
				  },
				 ";
				 /// 縣市
$ID2 = $row_township['township_id'];	
					$sql_tr = "SELECT * FROM tribe where township_id='$ID2' ";
					$result_tr = execute_sql($database_name, $sql_tr, $link);
					while ($row_tr = mysql_fetch_assoc($result_tr))
					{
								echo "
								{
								data:
								{
								color: '#f00',
								source: '".$row_township['township_name']."',
								target: '".$row_tr['tribe_name']."'
								}
								},
								";	
$ID3 = $row_tr['tribe_id'];
//FW
$sql_FW = "SELECT * FROM ass_grouter as A
LEFT JOIN city_array as B ON  (A.ass_grouter_city = B.id )
LEFT JOIN city_township as C ON (A.ass_grouter_twon = C.township_id )
LEFT JOIN tribe as D ON (A.ass_grouter_tribe = D.tribe_id )
WHERE D.tribe_id = '$ID3'
";
$result_FW = execute_sql($database_name, $sql_FW, $link);
while ($row_FW = mysql_fetch_assoc($result_FW))
{
	
	echo "
	{
	data:
	{
	color: '#f00',
	source: '".$row_tr['tribe_name']."',
	target: '".$row_FW['tribe_name'].$row_FW['ass_name']."'
	}
	},
	";	
	
//echo "{ data: { id: '".$row_FW['tribe_name'].$row_FW['ass_name']."' } },";	
/*						
echo " 
{ data: { source: '".$row_tr['tribe_name']."', target: '".$row_FW['tribe_name'].$row_FW['ass_name']."' } },
";
*/
}
				
					}			
				}
			 
			 
			 
		}
		?>
	  
	  
/*	  
				{
				data: {
				color: '#f00',
				source: 'FW',
				target: '4GR'
				}
				},{
				data: {
				color: '#f00',
				source: 'FW',
				target: 'PDU'
				}
				}, 
				{
					data: 
					{
					color: '#f00',
					source: 'FW',
					target: 'POE'
					}
				}
*/				
		] // edges
    } // elements
  }); // cytoscape

  var selectedNodeHandler = function(evt) {
    //console.log(evt.data); // 'bar'

    $("#edge-operation").hide();
    $("#node-operation").show();

    var target = evt.cyTarget;
    console.log('select ' + target.id(), target);
    $("#selected").text("Selected:" + target.id());
  }

  var unselectedHandler = function(evt) {
    $("#edge-operation").hide();
    $("#node-operation").hide();
  }

  var selectedEdgeHandler = function(evt) {
    $("#edge-operation").show();
    $("#node-operation").hide();

    var target = evt.cyTarget;
    console.log('tapped ' + target.id(), target);
    $("#selected").text("Selected:" + target.id());
  }

  cy.on('select', 'node', selectedNodeHandler);
  cy.on('unselect', 'node', unselectedHandler);
  cy.on('select', 'edge', selectedEdgeHandler);
  cy.on('unselect', 'edge', unselectedHandler);

  // NOTE: Use selector(':selected') instead of event handler
  function addSelectHandler() {
    cy.on('select', 'node', function(evt) {
      console.log('select node:', evt.cyTarget);
      evt.cyTarget.animate({
        style: {
          'background-color': nodeOptions.selected.bgColor
        }
      }, {
        duration: 100
      });
    });
    cy.on('unselect', 'node', function(evt) {
      console.log('unselect node:', evt.cyTarget);
      evt.cyTarget.stop();
      evt.cyTarget.style({
        'background-color': nodeOptions.normal.bgColor
      });
    });
    cy.on('select', 'edge', function(evt) {
      console.log('select edge:', evt.cyTarget);
      evt.cyTarget.animate({
        style: {
          'line-color': edgeOptions.selected.lineColor
        }
      }, {
        duration: 100
      });
    });
    cy.on('unselect', 'edge', function(evt) {
      console.log('unselect edge:', evt.cyTarget);
      evt.cyTarget.stop();
      evt.cyTarget.style({
        'line-color': evt.cyTarget.data('color')
      });
    });
  }

  $("#fit").click(function() {
    console.log('cy=', cy);
    cy.fit();
  });

  $("#layout").click(function() {
    console.log('cy=', cy);
    cy.layout({
      name: 'dagre'
    });
  });

}); // ready
</script>
  <!-- container-fluid : start -->
  <div class="container-fluid">
    <row>

      <div class="col-md-8 col-sm-8 col-lg-8">

        <!-- graph : start -->
        <div class="panel panel-primary">
          <div class="panel-heading">Graph</div>
          <div class="panel-body">
            <div id="cy-container">
              <div id="cy"></div>
            </div>

          </div>
        </div>
        <!-- graph : end -->

      </div>
<!---
      <div class="col-md-4 col-sm-4 col-lg-8">
       <?php 	   ///editr : start  	   ?> 
        <div class="editor">

          <div id="tools" class="panel panel-primary">
            <div class="panel-heading">Tools</div>
            <div class="panel-body">
              <button id="fit" class="btn btn-success">Fit</button>
              <button id="layout" class="btn btn-success">Layout</button>
            </div>
          </div>

     

        </div>
		  <?php 	   ///editr : end  	   ?> 
      </div>
---->
    </row>
  </div>
  <!-- container-fluid : end -->

</body>