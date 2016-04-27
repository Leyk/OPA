<?php
  require_once "inc/_var_fv.php";
?>
<!doctype html>
<html class="no-js" lang="fr" xmlns:xlink="http://www.w3.org/1999/xlink">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Outil de mise en synergie</title>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/fv.css" />
    <link rel="stylesheet" href="css/foundation-icons.css" />
	<!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>


    <script src="http://d3js.org/d3.v3.min.js"></script>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/foundation/foundation.reveal.js"></script>

    <script>
      $(document).foundation();

      $(function() {

        $("#boutonactions").click(function() {
          $("#interactions").slideToggle();
        });

        $('header .logo').animate({ letterSpacing: '10px' }, 500);
        setTimeout(function() { $('header .logo').removeAttr("style"); }, 1000);

      });      
    </script>

  </head>
  <body class="homecarto">
    
    <header>
      <div class="row">
        <div class="large-12 columns">
          <h2>Un outil de</h2>
          <h1 class="logo">Mise en <span>Synergie</span></h1>
        </div>
      </div>
      <div id="menu" class="row">
        <div class="large-12 columns">
          <a href="index.php" title="Constellation">Constellation</a> | 
          <a href="inscrivez-vous.php" title="Inscrivez-vous">Inscrivez-vous</a> | 
          <a href="liste-projets.php" title="Liste des projets">Liste des projets</a>
        </div>
      </div>
    </header>
    
     <section class="presentation">

      <script>

         <?php echo affiche_tree(); ?>

        var margin = 10,
            diameter = 900;

        var color = d3.scale.linear()
            .domain([-1, 5])
            .range(["hsl(152,80%,80%)", "hsl(228,30%,40%)"])
            .interpolate(d3.interpolateHcl);

        var pack = d3.layout.pack()
            .padding(2)
            .size([diameter - margin, diameter - margin])
            .value(function (d) {
            return d.size;
        });

        var svg = d3.select("body").append("svg")
            .attr("width", diameter)
            .attr("height", diameter)
            .attr("id","carto")
            .append("g")
            .attr("transform", "translate(" + diameter / 2 + "," + diameter / 2 + ")");

        //d3.json("flare.json", function (error, root) {
            //if (error) return console.error(error);

            var focus = root,
                nodes = pack.nodes(root),
                view;

            var circle = svg.selectAll("circle")
                .data(nodes)
                .enter().append("circle")
                .attr("class", function (d) {
                return d.parent ? d.children ? "node" : "node node--leaf" : "node node--root";
            })
                .style("fill", function (d) {
                return d.children ? color(d.depth) : null;
            })
                .on("click", function (d) {
                if (focus !== d) zoom(d), d3.event.stopPropagation(); 
                $('#volet').foundation('reflow');

            });

            var text = svg.selectAll("text")
                .data(nodes)
                .enter().append("text")
                .attr("class", "label")
                .style("fill-opacity", function (d) {
                return d.parent === root ? 1 : 0;
            })
                .style("display", function (d) {
                return d.parent === root ? null : "none";
            })
                .text(function (d) {
                return d.name;
            });

            var node = svg.selectAll("circle,text");

            d3.select("body")
                .style("background", color(-1))
                .on("click", function () {
                  zoom(root);
                });

            zoomTo([root.x, root.y, root.r * 2 + margin]);

            function zoom(d) {
                var focus0 = focus;
                focus = d;

                var transition = d3.transition()
                    .duration(d3.event.altKey ? 7500 : 750)
                    .tween("zoom", function (d) {
                    var i = d3.interpolateZoom(view, [focus.x, focus.y, focus.r * 2 + margin]);
                    return function (t) {
                        zoomTo(i(t));
                    };
                });

                transition.selectAll("text")
                    .filter(function (d) {
                    return d.parent === focus || this.style.display === "inline";
                })
                    .style("fill-opacity", function (d) {
                    return d.parent === focus ? 1 : 0;
                })
                    .each("start", function (d) {
                    if (d.parent === focus) this.style.display = "inline";
                })
                    .each("end", function (d) {
                    if (d.parent !== focus) this.style.display = "none";
                });
            }

            function zoomTo(v) {
                var k = diameter / v[2];
                view = v;
                node.attr("transform", function (d) {
                    return "translate(" + (d.x - v[0]) * k + "," + (d.y - v[1]) * k + ")";
                });
                circle.attr("r", function (d) {
                    return d.r * k;
                });
            }
        //});

        d3.select(self.frameElement).style("height", diameter + "px");
        </script>
        <script>
          $(".button-collapse").sideNav(); </script>
       
        <script src="//cdn.transifex.com/live.js"></script>


     

     <div id="interac" class="row">
        <ul id="interactions" class="hide">
          <li class="ajout">Ajouter une action<span class="fi-align-left"></span></li>
          <li class="ajout">Ajouter une rubrique<span class="fi-align-left"></span></li>
          <li class="ajout">Ajouter du contenu dans cette action<span class="fi-align-left"></span></li>
          <li class="moderateur">Je suis modérateur de cette action<span class="fi-lock"></span></li>
          <li class="moderateur">Je suis modérateur de cette rubrique<span class="fi-lock"></span></li>
          <li class="contact">Contacter les forces vives de cette action<span class="fi-mail"></span></li>
          <li class="contact">Contacter les forces vives de cette plateforme<span class="fi-mail"></span></li>
          <li class="forcevive">Je suis force vive de cette action<span class="fi-male-female"></span></li>
          <li class="forcevive">Je suis force vive de cette rubrique<span class="fi-male-female"></span></li>
          <li class="forcevive">Je suis force vive de cette plateforme<span class="fi-male-female"></span></li>
          <li class="finance">J'ai besoin de financement pour cette action<span class="fi-euro"></span></li>
          <li class="finance">J'ai besoin de financement pour cette rubrique<span class="fi-euro"></span></li>
          <li class="conseil">J'ai besoin de conseils pour cette action<span class="fi-lightbulb"></span></li>
          <li class="conseil">J'ai besoin de conseils pour cette rubrique<span class="fi-lightbulb"></span></li>
          <li class="aide">J'ai besoin d'aide pour cette action<span class="fi-anchor"></span></li>
          <li class="aide">J'ai besoin d'aide pour cette rubrique<span class="fi-anchor"></span></li>
          <li class="finance">Je finance cette action<span class="fi-folder"></span></li>
          <li class="finance">Je finance cette rubrique<span class="fi-folder"></span></li>
          <li class="finance">J'organise une réunion à distance<span class="fi-folder"></span></li>
          <li class="finance">J'organise une discussion à distance<span class="fi-folder"></span></li>
          <li class="moderateur">Je signale un problème<span class="fi-alert"></span></li>
        </ul>
        <div id="boutonactions" class="ajout">InterActions<span class="fi-plus"></span></div>
      </div>
        <div id="volet_clos">
      	<div id="volet">
      		<p> Mon titre </p>
      		<p> Mon texte </p>
          <p> Ma vidéo </p>
      		<a id ="ouv" href="#volet" class="ouvrir">Ouvrir </a>
      		<a href="#volet_clos" class="fermer">fermer</a>
      	</div>
    </section>

    <footer>
      <div class="row">
        <div class="large-12 columns">
          <h1 class="logo">Forces<span>Vives</span></h1>
        </div>
      </div>
    </footer>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
  </body>
</html>
