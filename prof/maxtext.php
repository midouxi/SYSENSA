    <head>
    <script>
   // textarea est la référence du TEXTAREA à contrôler, max en est la valeur maximal, count est la référence
   // du champs texte de contrôle où s'affichera le nombre de caractère en cour
   
  function verif_press(textarea,max,count) // vérifie que le nombre maxi n'a pas été atteint pendant que l'utilisateur reste appuyé sur la touche
 {
          if (textarea.value.length > max -1){ //s'il dépasse la taille requise, on sort
               return false;
           }
          else { // sinon
               count.value = textarea.value.length +1 ; // on met à jour le champs de contrôle.
               return true;
          }
   }
    
   // textarea est la référence du TEXTAREA à contrôler, max en est la valeur maximal, pour cette fonction count n'est pas inclu
   // car lorsqu'elle est appellée, le nombre de caractère a déja été inscrit lors de l'évenement "onkeyup"
    
   function verif_change(textarea,max) // vérifie que le nombre maxi n'a pas été atteint lorsque l'utilisateur sort du champs
  {
          if (textarea.value.length > max ){ // s'il dépasse la taille requise, on prévient et on sort
              alert('Vous ne pouvez rentrer que '+ max +' caractères maximum pour ce champs');
              return false;
          }
          else return true; // sinon, on continu
   }
  
   // textarea est la référence du TEXTAREA à contrôler, count est la référence
   // du champs texte de contrôle où s'affichera le nombre de caractère en cour. Cette fonction est appelée lors de l'évenement "onkeyup"
   function show_nb_car(textarea,count)
  {
            count.value = textarea.value.length;
             return true;
 }
  </script>
   </head>
   <body>
  <form name="text" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <span class="BlancLarge">Début de votre texte : </span><br>
 <TEXTAREA name="rappel" rows="4" cols="80" onKeyup="show_nb_car(this,document.text.nb_car_rappel)" onKeypress="return verif_press(this,200,document.text.nb_car_rappel)" onchange="return verif_change(this,200)" ></TEXTAREA><br>
  <span class="VertSmall">Nombre de caractères de ce champs : <input type="text" name="nb_car_rappel" size="3" value="<?php echo strlen($_SESSION['annonce'][2]); ?>"> / 200 max.</span><br><br>
   <span class="BlancLarge">Suite de votre texte : </span><br>
   <TEXTAREA name="suite" rows="13" cols="80" onKeyup="show_nb_car(this,document.text.nb_car_suite)" onKeypress="return verif_press(this,800,document.text.nb_car_suite)" onchange="return verif_change(this,800)" ></TEXTAREA><br>
  <span class="VertSmall">Nombre de caractères de ce champs : <input type="text" name="nb_car_suite" size="3" value="<?php echo strlen($_SESSION['annonce'][27]); ?>"> / 800 max.</span><br>
  <input type="hidden" name="mode" value="<?php echo _ACTION_; ?>"><br>
   <span class="BlancMedium">Pour valider et enregistrer votre texte : </span><input type="submit" value="Cliquez ici">
   </form>
  </body>
