@author : LE VEVE Mathieu
@date: 2017-10-16
@course: M1 Alt ILSEN
@group: LE VEVE - DURET


TP2: La couche modèle d’un projet d’application Web

Individual Question: 
Expliquer clairement les mécanismes php permettant d'appeler et exécuter les méthodes - 
findOneByidentifiant()  ou  findByidentifiant()  - sur  un  repository  associé  à  l'entité utilisateur sachant que identifiant est une de ces propriétés

Step 1: dans le répertoire model, avoir un nom de classe similaire a un nom de repository utilisé dans l'étape 3, classe portant le même nom que le fichier 
associé tel que {nom_de_classe}.class.php ou {nom_de_classe} est le nom de la classe ET du repository sous Doctrine.

Step 2: Dans le fichier {nom_de_classe}Table.php, il est important d'obtenir une instance de la connection à la base de données.
 (e.g dbconnection::getInstance()->getEntityManager();)


Step 3: Il est important d'obtenir l'intégralité des résultats colonnes d'un repository existant (Rappel Step 1), d'où l'importance du nommage des classes.
(e.g $userRepository = $em->getRepository('utilisateur');)
--> Recupére l'intégralité des enregistrements du repository 'utilisateur' (ou table)

Step 4 : IL existe plusieurs méthodes sous doctrine pour récupérer 1 ou un ensemble d'enregistrement sous forme de liste d'objets. Voici le détail:

find($id) te permet de récupérer un objet à partir d'un identifiant.
findBy() te permet de récupérer une liste d'objets à partir des champs souhaités. Exemple : findBy(array('nom' => 'Symfony')) retournera une liste d'objets comportant le nom "Symfony".
findOneBy() a le même comportement que findBy pour effectuer la recherche, mais ne retourne qu'un seul résultat.

A noter selon les informations fournies par le TP: 
'findOneByidentifiant()  ou  findByidentifiant()  - sur  un  repository  associé  à  l'entité utilisateur sachant que identifiant est une de ces propriétés'
identifiant correspond a une propriété (colonne) de la classe utilisateur. Par exemple pour récupérer l'ensemble des messages d'un parent cela correspondrait à:
getMessagesByParent(...)

Particularité: la différence entre 'findOneBy{attribut}' et 'findBy{attribut}' concerne le nombre de résultats.



