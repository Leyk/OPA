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
            <textarea name="posteur_message" placeholder="Votre message *" class="champ"></textarea>
          </fieldset>
          <div class="row">
            <div class="large-10 text-center">
              <button type="submit">Envoyer</button>          
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

    $(function(){

      // Ajustement de la taille des textarea
     /* $('textarea').autosize();*/

      // affichage du formulaire
      $('#dest_msg').change(function(){
        $('html, body').animate({ /* ajuste l'écran sur l'ouverture du formulaire */
              scrollTop: $("#formcontact").offset().top
          }, 1000);
        if ($(this).val()==="")
            $('#formcontact-contenu').slideUp(); /* ferme le corps du formulaire */
          else
            $('#formcontact-contenu').slideDown(); /* ouvre le corps du formulaire */
      });

      // soumission du formulaire
      $('$formcontact').on('submit', function(e) {
        alert("ok");
        e.preventDefault(); // on annule la fonction par défaut du bouton d'envoi
        var nom_personne = $('#posteur_nom').val();
        var prenom_personne = $('#posteur_prenom').val();
        var mail_personne = $('#posteur_email').val();
        var msg_personne = $('#posteur_message').val();

        if (nom_personne === '' || mail_personne === '' || msg_personne === '' ){
          $('#messager').removeClass().addClass("alert-box radius").addClass("alert").html("Les champs marqués * doivent êtres remplis.").slideDown().delay(3000).slideUp();
        }
        else {
          /*$.ajax({
            url: $this.attr('action'),
            type: $this.attr('method'),
            data: $this.serialize(),
            success: 
          })*/
        }
      })
    });

    </script>
  </body>
</html>