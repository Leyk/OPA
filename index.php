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
    </section>

      <a href='#' data-reveal-id="myVolet" data-reveal-ajax='true'>   
      <div id="myVolet" class="hide reveal-modal medium" data-reveal>
        <h2 id="modalTitle">TITRE</h2>
        <p class="lead">Texte</p>
        <p>Vidéo</p>
        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
      </div>


      <a href='fiche_action.php?id=22' data-reveal-id="test" data-reveal-ajax='true'>Test</a>
      <div id="test" class="hide reveal-modal medium" data-reveal>
        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
      </div>


    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="http://d3js.org/d3.v3.min.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/foundation/foundation.reveal.js"></script>
    <script src="js/foundation/foundation.tooltip.js"></script>
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
     <script>

         <?php echo affiche_tree(); ?>   // Affichage en mode fichier JSON des données 

        var margin = 10,
            diameter = 1000;   // diamètre du cercle "root"

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

            var focus = root,   /* focus initial sur le root (variable contenant tout l'arbre de données) */
                nodes = pack.nodes(root),
                view;

            var circle = svg.selectAll("circle")
                .data(nodes)
                .enter().append("circle")
                .attr("class", function (d) {
                return d.parent ? d.children ? "node" : "node node--leaf" : "node node--root";
          /* si le cercle a un parent mais pas d'enfant = feuille ; si enfant mais pas parent = root si enfant et parent = noeud */

            })
                .style("fill", function (d) {
                return d.children ? color(d.depth) : null;
                /* si le cercle a un enfant on le colorie */
            })
                .on("click", function (d) {
                if (focus !== d){  /* si on n'est pas centré sur le focus, on zoom dessus */
                
                  zoom(d);
                  d3.event.stopPropagation();  /* fonction qui permet le zoom */
                }  

                /* ---- Permet de gérer l'affichage de la lightbox ---- */
                var query = document.getElementById('myVolet');
               /* var cl = query.getAttribute('class');*/
                query.setAttribute('class','hide reveal-modal medium open');
                var dt = query.setAttribute('href',"fiche_action.php?id=22");
               /* alert(query.getAttribute('href'));*/
                alert(root.children[1].name);
                
                $('#myVolet').css('display','inline');
                $('#myVolet').css('opacity','1');
                $('#myVolet').css('visibility','visible');
                $('#myVolet').css('margin-left','-60%');
                $('#myVolet').css('width','40%');
                $('#myVolet').css('height','100%');
                $('#myVolet').css('margin-top','7%');
                $('#myVolet').css('margin-bottom','10%');
                /* ---------------------------------------------------- */          
            });

            /*var circleLeaf = svg.selectAll("circle.node--leaf")
                .attr('data-tooltip', '')
                .attr('aria-haspopup', 'true')
                .attr('title', 'Test !!')
                .attr("class", "node node--leaf has-tip")
                .on("click", function (d) {
                alert("Test");               
            });*/

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
                .style("background", color(-2))  /* change la couleur du fond avec une couleur proche du cercle root */
                .on("click", function () {   /* zoom sur le cercle root si on clique dessus */
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
          $(".button-collapse").sideNav();
          $(document).foundation('tooltip', 'reflow'); </script>
       
        <script src="//cdn.transifex.com/live.js"></script>
  </body>
  <footer>
  <div class="row">
    <div class="large-12 columns">
      <h1 class="logo">Forces<span>Vives</span></h1>
    </div>
  </div>
 </footer>
</html>
