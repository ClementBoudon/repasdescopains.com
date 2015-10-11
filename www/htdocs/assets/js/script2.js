$(function(){

	/*la variable id_gagnant contien l'identifiant du gagnant*/
	var speed = 50; /* Délais avant le lancemetn de l'animation suivante. Va de moins en moins vite. */
	var id_courant = 1; /* Permet de savoir quel image est affiché à chaque itération */
	var compteur_max = 14;

	var nb_animation = 1; /* Nombre d'animation, utilisé pour faire évoluer la vitesse de rotation par plancher */
	
	var nb_boucle_min = 2 /* Nombre de boucle avant d'afficher le vrai gagnant */

	var nb_animation_palier = compteur_max/2; /* Nombre d'animation pour faire évoluer la vitess */

    var vitesse_animation =30;

   	function animate_liste(){

   	  nb_animation++;



      $(".slideshow ul").animate(
	      {
	      	marginLeft:-350
	      },
	      vitesse_animation,
	      function(){
	         $(this).css(
	         	{
	         		marginLeft:0
	         	}
	         ).find("li:last").after($(this).find("li:first"));
	      }
      );
      id_courant++;

      if(id_courant > compteur_max)
      	id_courant=1;

      if((nb_animation%nb_animation_palier == 0) && (speed < 4000)){
      		/*toutes les "nb_animation_palier" boucles on ralenti l'animation*/
	      speed = speed + 50;

          vitesse_animation = vitesse_animation+30;

	      //on diminue au fur et à mesure le nombre de boucle pour changer de palier : effet ralentit */
	      if (nb_animation_palier>1)
	      	nb_animation_palier--;
	  }
	  window.console.log('le courant '+id_courant);
	  if((nb_animation/compteur_max > nb_boucle_min) && (id_courant == id_gagnant)){
	  		//on appel la fonction gagnant
	  		window.console.log('le gagnant '+id_gagnant+', soit le '+id_courant);
            $(".texts_tirage").hide();
            $(".texts_res").show();
	  }else{
      	setTimeout(animate_liste,speed);

	  }
	};
   setTimeout(animate_liste,speed);


});