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
      nodes: [
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
	  ], // nodes
      edges: [
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
<body>


  <h1>cytoscape-dagre demo</h1>

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

      <div class="col-md-4 col-sm-4 col-lg-8">
        <!-- editr : start -->
        <div class="editor">

          <div id="tools" class="panel panel-primary">
            <div class="panel-heading">Tools</div>
            <div class="panel-body">
              <button id="fit" class="btn btn-success">Fit</button>
              <button id="layout" class="btn btn-success">Layout</button>
            </div>
          </div>

     

        </div>
        <!-- editor : end -->

      </div>

    </row>
  </div>
  <!-- container-fluid : end -->

</body>