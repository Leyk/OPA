<!doctype html>
<html class="no-js" lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Outil de mise en synergie</title>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/fv.css" />
    <link rel="stylesheet" href="css/foundation-icons.css" />
  </head>
  <body>
    <div id="erreur">
      <p id="texterreur">Les champs suivants ne sont pas correctement remplis</p>
    </div>
    <form id="formcontact">
      <div id="formcontact-intro" class="row">
        <div class="large-10 columns">
          <fieldset>
            <legend>Qui contacter</legend>
            <select name="dest_msg" id="dest_msg">
              <option value="">Choisissez qui contacter</option>
              <option value="initiateur">Seulement l'initiateur du projet</option>
              <option value="diffusion">Toutes les personnes en lien avec ce projet</option>
            </select>
          </fieldset>
        </div>
      </div>
      <div id="formcontact-contenu" class="row hide">
        <div class="large-10 columns">
          <fieldset>
            <legend>Vos informations</legend>
            <input type="text" id="posteur_nom" name="posteur_nom" placeholder="Votre nom *" class="champ">
            <input type="text" id="posteur_prenom" name="posteur_prenom" placeholder="Votre prénom" class="champ">
            <input type="text" id="posteur_email" name="posteur_email" placeholder="Votre courriel *" class="champ">
            <textarea name="posteur_message" id="posteur_message" placeholder="Votre message *" class="champ"></textarea>
          </fieldset>
          <div class="row">
            <div class="large-10 text-center">
              <button type="submit" id="envoyer">Envoyer</button>          
            </div>
          </div>
        </div>
      </div> <!-- formaction-contenu -->
    </form>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/foundation/foundation.reveal.js"></script>
    <script src="js/jquery.autosize.min.js"></script>
    <script>
    $(document).foundation();

    $(document).ready(function(){
      var $nom_personne = $('#posteur_nom'),
          $prenom_personne = $('#posteur_prenom'),
          $mail_personne = $('#posteur_email'),
          $msg_personne = $('#posteur_message'),
          $champ = $('.champ'),
          $erreur = $('#erreur'),
          $envoi = $('#envoyer');
      // Ajustement de la taille des textarea
     /* $('textarea').autosize();*/

      // affichage du formulaire
      $('#dest_msg').change(function(){
        var $dest = $('#dest_msg option:selected').val();
        $('html, body').animate({ /* ajuste l'écran sur l'ouverture du formulaire */
              scrollTop: $("#formcontact").offset().top
          }, 1000);
        if ($(this).val()==="")
            $('#formcontact-contenu').slideUp(); /* ferme le corps du formulaire */
          else
            $('#formcontact-contenu').slideDown(); /* ouvre le corps du formulaire */
      });

      $champ.keyup(function(){
        $(this).css({
          borderColor:'#CCCCCC'
        })
      });

      // soumission du formulaire
      $envoi.click(function(e) {
        e.preventDefault(); // on annule la fonction par défaut du bouton d'envoi
        $erreur.css('display','none');
        var nom = verifier($nom_personne);
        var mail = verifier($mail_personne);
        var msg = verifier($msg_personne);
        var mailok = validateEmail($mail_personne);

        if(nom && mail && msg && mailok){
          alert("ok");
          /* $.ajax({
          url: 'traitement_formulaire.php', // ressource ciblée
          type: 'POST',  // type de la requete HTTP
          data : 'dest='+ $dest +'&email=' + $mail_personne.val() +'&contenu='+ $msg_personne.val() +'&idproj=' + $id,   // ligne A CHECK
          dataType : 'html' // le type de données à recevoir
        });*/
        }
      });

      function verifier(champ){  // vérification remplissage des champs
        var bool = true;
        if(champ.val() == ""){
          $erreur.css('display','block');
          champ.css({
            borderColor:'red'
          });
          bool = false;
        } 
        return bool;
      }

      function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var bool = re.test(email.val());
        if(!bool){
          $erreur.css('display','block');
          email.css({
            borderColor:'red'
          });
        }
        return bool;
      }
    });
    </script>
  </body>
</html>