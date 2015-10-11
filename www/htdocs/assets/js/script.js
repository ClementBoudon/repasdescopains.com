$(function(){

	/*la variable id_gagnant contien l'identifiant du gagnant*/
	var id_courant = 1; /* Permet de savoir quel image est affiché à chaque itération */
	var compteur_max = 14;

	var nb_animation = 1; /* Nombre d'animation, utilisé pour faire évoluer la vitesse de rotation par plancher */
	
	var nb_boucle_min = 2 /* Nombre de boucle avant d'afficher le vrai gagnant */

	var nb_animation_palier = compteur_max/2; /* Nombre d'animation pour faire évoluer la vitess */

    var vitesse_animation =300;

    
    var humour_choisi = null;

    var img_courante = document.getElementById('slideshow'); 
    var width_img_courant = img_courante.clientWidth;



   	function animate_liste(){

   	  nb_animation++;

      /*$('#vitesse').html('Courant : '+id_courant);*/
      


      $(".slideshow ul").stop().animate(
	      {
	      	marginLeft:-width_img_courant
	      },
	      vitesse_animation,
	      function(){

	         $(this).css(
	         	{
	         		marginLeft:0
	         	}
	         ).find("li:last").after($(this).find("li:first"));


              if((nb_animation/compteur_max > nb_boucle_min) && (id_courant == id_gagnant)){
                //on appel la fonction gagnant
               
                //On teste si c'est le premier lancé ou non
                if ($.cookie('tirage_1') === undefined){

                    //on marque le tirage humour comme fait (sinon ça serait relourd)
                    $.cookie('tirage_1','1', { expires: 1 });

                   

                    //et on affiche un des élements lol au hasard
                    random_id_humour = Math.floor((Math.random() * tab_humour.length));
                    humour_choisi = tab_humour[random_id_humour];

                   

                    
                    $(".slideshow li").css('width','6.66%'); //100/ 14 +1
                    $(".slideshow ul").css('width','1500%');

                    //on crée l'élément humour à la suite de l'élément actuel
                    content_humour = '<li id="li_h" style="width: 6.66%">';
                    content_humour += '<img id="profilh" src="assets/img/humour/'+humour_choisi['id']+'.jpg" alt="" width="320" class="img_responsive img_shadow" />';
                    content_humour += '<p class="texts_res" id="text_com_humour" style="display:none;">';
                    content_humour += humour_choisi['commentaire']+'<br>';
                    content_humour += '<a href="#" id="lien_humour">Bon ok, t\'as le droit &agrave; une seconde chance :<br><span class="ghost-signup">Relancer</span></a>';
                    content_humour += '</p>';
                    content_humour += '</li>';
                    $('#li_'+id_courant).after(content_humour);

                    //GESTION DE LA RELANCE
                    $('#lien_humour').click(function () { 
                        //Apres un peu d'humour, un peu de sérieux

                        //on enlève tout ce qui avait été fait par amour de l'humour

                        $(".slideshow li").css('width','7.14%'); //100/ 14 
                        $(".slideshow ul").css('width','1400%');
                        $('#li_h').remove();
                        $('#text_resultat_humour').hide();
                        $(".texts_tirage").show();
                        $(".texts_res").hide();

                        if (window.matchMedia("(max-width: 340px)").matches) {
                            $(".slideshow").css({ "border": "solid 1px #717171", "box-shadow": "0px 0px 13px 0px rgba(0, 0, 0, 0.88) inset", "padding": "0px" });    
                        }else{
                            $(".slideshow").css({ "border": "solid 1px #717171", "box-shadow": "0px 0px 13px 0px rgba(0, 0, 0, 0.88) inset", "padding": "30px 0px 30px 0px" });    
                        }
                        


                        //on re-initialise les variables
                        if(id_courant<14)
                            id_courant = id_courant+1;
                        else
                            id_courant=1;

                        compteur_max = 14;
                        nb_animation = 2; /* Nombre d'animation, utilisé pour faire évoluer la vitesse de rotation par plancher */
                        nb_boucle_min = 2 /* Nombre de boucle avant d'afficher le vrai gagnant */
                        nb_animation_palier = compteur_max/2; /* Nombre d'animation pour faire évoluer la vitess */
                        vitesse_animation =300;
                        humour_choisi = null;
                        img_courante = document.getElementById('slideshow'); 
                        width_img_courant = img_courante.clientWidth;


                        //et on relance
                        animate_liste();
                     });

                    //puis on lance une animation supplémentaire


                     $(".slideshow ul").stop().animate(
                      {
                        marginLeft:-width_img_courant
                      },
                      vitesse_animation,
                      function(){


                         $(this).css(
                            {
                                marginLeft:0
                            }
                         ).find("li:last").after($(this).find("li:first"));

                         //on affiche le texte humour
                         $('#text_resultat_humour').html('Tu dois offrir un cadeau &agrave; <strong>'+humour_choisi['nom']+'</strong>. <br><br>'+humour_choisi['nom']+' c\'est lui : <br>');
                        
                        $(".texts_tirage").hide();
                        $(".texts_res").show();
                        $("#text_resultat_humour").show();
                        $('#text_resultat').hide();
                        $(".slideshow").effect("highlight", {color: 'white'}, 500);
                        $(".slideshow").css({ "border": "none", "box-shadow": "none", "padding": "0px" });

                         $("#profilh").css({ "margin": "12px 0px 0px 0px" });
                         });


                }else{
                    $(".texts_tirage").hide();
                    $(".texts_res").show();
                    $(".slideshow").effect("highlight", {color: 'white'}, 500);
                    $("#profil"+id_courant).css({ "margin": "12px 0px 0px 0px" });
                    $(".slideshow").css({ "border": "none", "box-shadow": "none", "padding": "0px" });
                }

                
              }else{
                animate_liste();

              }
	      }
      );
      id_courant++;

      if(id_courant > compteur_max)
      	id_courant=1;

      if((nb_animation%nb_animation_palier == 0) && (vitesse_animation < 4000)){
      		/*toutes les "nb_animation_palier" boucles on ralenti l'animation*/
	      
          vitesse_animation = vitesse_animation+50;

	      //on diminue au fur et à mesure le nombre de boucle pour changer de palier : effet ralentit */
	      if (nb_animation_palier>1)
	      	nb_animation_palier--;
	  }

	 
	};

   

    //AU chargement de la page, on lance l'animation (on pourrait aussi utiliser un bouton de cette manière)
    animate_liste();


});