De manière individuelle, vous devez répondre à cette question dans un fichier readme.
Expliquer clairement les mécanismes php permettant d'appeler et exécuter les méthodes 
- findOneByidentifiant() ou findByidentifiant() - sur un repository associé à l'entité utilisateur
sachant que identifiant est une de ces propriétés.

---------------------------------------------------------------------------------

Il existe plusieurs méthodes find que doctrine nous propose :
- find($id)
- findAll()
- findBy()
- findOneBy()


Et ensuite il y a ce qu'on appelle les méthodes magiques.
Ici on peut concaténer findBy et findOneBy avec le nom d'une propriété (colonne) d'une entité.

Exemple : (utilisateurTable.class.php L25)
	$user = $userRepository->findOneById($id);

Cela nous permet de récupérer l'utilisateur qui a l'id '$id' sans passer par un array qui associe les propriétés avec les données.

La méthode magique qui est utilisée ici est __call() qui va émuler les méthodes précédemment évoquées.