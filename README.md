# Travaux d'Héraclès #6 : les écuries d'Augias
 
Prérequis : cloner ce *repository*.

Fais un `composer install`

La prochaine mission d'Héraclès est de nettoyer les écuries d'Augias.

> Par rapport à l'atelier précédent, tu verras que les classes dans *src/* ont été réorganisées et que plusieurs sous dossiers ont été crées. Le but est simplement de mieux organiser les classes qui commeçaient à être nombreuses. Cette modification à entraîné un modification des namespaces dans les classes concernées, et une mise à jours des *use* partout où cela était le cas. 

> De plus, tu verras dans index.php que la classe `Arena` n'est plus directement utilisée. Ce sera la classe `ArenaAugias`. Jusqu'à maintenant, toute la phase d'initialisation d'une partie se faisait directement dans *index.php* (qui devenait plutôt long !). On y trouvait la création et le positionnement des tuiles, des combattants, des équipements, *etc.*. Or, chaque arène correspond à un des travaux, avec sa propre carte, ses propres monstres *etc.*. La logique d'initialisation est donc déportée directement dans le `__construct()` de `ArenaAugias`, car elle n'a pas vocation à être modifié, l'emplacement des tuiles et le type de monstre est associé au niveau en cours. Le fichier *index.php* est maintenant bien plus clair et les comportements propres uniquement à un niveau vont pouvoir être définis sans venir surcharger la classe `Arena`.

# Des ptits trous, des ptits trous.
Tu vois la nouvelle carte. Il s'y trouve de l'eau, de l'herbe un nouveau type de tuile, `Building` qui a également été ajouté (il n'est pas *crossable*).

Les écuries d'Augias, c'est la m**** ! Il faut nettoyer tout cela, et avant la fin de la journée. Une seule méthode pour notre héros surhumain, détourner le lit de la rivière pour faire passer les flots directement dans le bâtiment. Décrassage assuré. Pour commencer, il va donc falloir creuser !

# Recursivité

# Roc move/ Vache move

# Win
