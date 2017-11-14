/!\ Penser à ne pas oublier d'utiliser bootstrap quand on créer une vue /!\

mega tuto boostrap -> http://bootstrap-doc.prauds.fr/index1.php  + balises/classes à la fin
icones bootstrap -> https://www.w3schools.com/icons/bootstrap_icons_glyphicons.asp


Pour le tp3 il reste à :

/!\ attention ici on doit faire que le visuel donc si t'as pas le temps de le faire fonctionner c'est pg passe à la suite /!\

----- partie commune -----
+ améliorer le bandeau pour qu'il soit petit et responsive (limite en refaire un nouveau [sûr] [cf:fb])
+ faire une vue showProfil (ou un autre nom) avec un layout qui contiendra toutes les petites vues
	-> une var $views ? qui stockerai le retour d'une méthode executeActions($array),? ici $array serai simplement un tableau contenant tous les noms des petites vues et le retour de la fonction sera un tableau contenant les views (exactement comme pour $view)
 
 => Alors le "point 2" je l'ai géré en prenant l'action profil pour ce qu'elle est (la vue qui affiche profil, liste d'ami, chat etc ... [cf sujet])
  Et pour inclure plusieurs vues patati patata j'ai tout simplement fait une fonction addView dans le dispatcher, qui permet très simplement d'ajouter de nouvelles vues dans le layout (sans variables dégolasses à la bruno/shuai xD)

----- ma partie -----
+ rendre la div profil totalement responsive (même dans le carre blanc)
+ faire un form sur le profil pour modifier le statut
+ faire une vue chat (HORS de bootstrap) qui sera une div flotante (qu'on peut bouger -> cf sujet)
+ css sur le chat 
+ reduire/grandir la fenetre
? éviter que resize le chat resize toute la page (voir lien en bas de app.js)
+ quand on charge la page on spawn sur la fin du chat
* faire la pagination sur le chat
+ faire un écart entre le bandeau et la vue pour pouvoir afficher les notifications


----- ta partie -----
+ liste d'ami pas moche :p (3 de largeurs dans bootstrap) (avec css)
+ faire un form pour envoyer des messages à soit-meme (vue mur, on a déjà showMessages 
*** bouton  submit et input text (1 vue col-sm-6) ***
[que tu peux rennomer stu veux]) (6 de largeur dans bootstrap) 
+ cliquer sur un ami affiche son profil complet, 
+ par contre le form de message enverra le message sur le mur de cet ami (juste post sur l'id de la page)
+ faire un css sur les messages (cf sujet partie 4)

- faire la pagination sur les messages (sur la vue mur/showMessages)
*** Mettre en place la pagination, avec css, sans action ***
- [pas obligé, commence par ne pas le faire et on verra] faire une vue message (chaque message sera une sous-vue)
