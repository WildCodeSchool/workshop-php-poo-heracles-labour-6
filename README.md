# Travaux d'Héraclès #6 : les écuries d'Augias
 
Prérequis : cloner ce *repository*.

Fais un `composer install`

La prochaine mission d'Héraclès est de nettoyer les écuries d'Augias (Augean stables).

> Par rapport à l'atelier précédent, tu verras que les classes dans *src/* ont été réorganisées et que plusieurs sous dossiers ont été crées. Le but est simplement de mieux organiser les classes qui commeçaient à être nombreuses. Cette modification à entraîné un modification des namespaces dans les classes concernées, et une mise à jours des *use* partout où cela était nécessaire. 

> De plus, tu verras dans *index.php* que la classe `Arena` n'est plus directement utilisée. Ce sera la classe `ArenaAugeas`. Jusqu'à maintenant, toute la phase d'initialisation d'une partie se faisait directement dans *index.php* (qui devenait plutôt long). On y trouvait la création et le positionnement des tuiles, des combattants, des équipements, *etc.* Or, chaque arène correspond à un des travaux, avec sa propre carte, ses propres monstres *etc.* La logique d'initialisation est donc déportée directement dans le `__construct()` de `ArenaAugeas`, car elle n'a pas vocation à être modifiée, l'emplacement des tuiles et le type de monstre est associé au niveau en cours. Le fichier *index.php* est maintenant bien plus clair et les comportements propres uniquement à un niveau vont pouvoir être définis sans venir allourdir la classe `Arena`.

Tu vois la nouvelle carte. Il s'y trouve de l'eau, de l'herbe un nouveau type de tuile, `Building` qui a également été ajouté (et qui est  *crossable*).

Dans les écuries d'Augias, les pieds de notre héros disparaissent dans une couche nauséabonde de fumier ! L'odeur est insoutenable. Il faut nettoyer tout cela, et avant la fin de la journée. Une seule alternative, détourner le lit du fleuve pour faire passer les flots directement dans le bâtiment. Décrassage assuré. Pour commencer, il va donc falloir creuser !

# Du travail à la pelle

Et pour pouvoir creuser, il faut une pelle. 
Commence par créer une classe Shovel dans le dossier Inventory. La pelle *pourrait* hériter de `Weapon`, mais même si un bon coup de pelle peut faire mal, nous allons partir du principe qu'Héraclès va plutôt s'en servir en accessoire, qu'il tiendra dans sa seconde main. Si tu ouvres l'inventaire sur l'interface graphique, tu vois une slot "Second Hand" sous l'arme. C'est ici que la pelle devra aparaître. Pour cela, il lui faut une image, comme pour l'arme, comme pour le bouclier, comme pour... tu vois ou cela nous mène ? Oui ! créons une nouvelle interface `Equipable` qui contiendra la méthode `getImage(): string` et fais en sorte que toutes les classes d'équipement l'implémente. Utilise le fichier *shovel.svg* pour la classe Shovel.

Dans `Hero`, ajoute une propriété `$secondHand` de type `Equipable` ou `null`, et créé les *getter* et *setter* associés.
Modifie `ArenaAugeas` pour qu'Héraclès ait bien son arme en seconde main.

# Des ptits trous, des ptits trous.

Notre héros va maintenant pouvoir creuser. Partons du principe que ce mécanisme de *gameplay* ne sera disponible que pour ce niveau : créé une méthode `digArena()` dans `ArenaAugeas` (le simple fait d'avoir créer la méthode, un bouton "Dig" est apparu sur l'interface !)

Cette méthode va :
1. Vérifier que le héros se trouve sur une tuile de type `Grass` qui vont être les seules qu'il pourra creuser. Sinon renvoyer une exception.
2. Vérifier que le héros porte bien une pelle en seconde main, sinon renvoyer une exception.

Les tuiles de type `Grass` étant creusables, elles vont avoir 2 états possibles (creusées ou non). Commence par y ajouter une propriété `$digged`, de type booléen avec la valeur `false` par défaut. Ajoute un getter `isDigged` te renvoyant la valeur de ce booléen.

Créé ensuite une méthode `dig()` dans `Grass`, qui va avoir pour rôle de passer la propriété `$digged` à `true`.
On a ainsi l'information de savoir si la tuile est creusée ou non, mais visuellement, sur la carte, il n'y a pas d'impact. Pour que cela soit plus visible, fais également en sorte que la méthode `dig()` modifie l'image en `hole.png`.

Enfin, utilise cette méthode `dig()` dans `digArena()`.

# Fill good

L'idée maintenant, c'est de pouvoir dévier le cours de la rivière. Ainsi, si tu creuses juste à côté de l'eau, il faut faire en sorte que ton trou se "remplisse" instantanément. Ta tuile va donc passer de `Grass` "non creusée" à `Grass` "creusée" puis se changer en `Water`.

Dans `digArena()`, juste après l'appel à la méthode `dig()`, tu vas appeler une méthode privée `fill(Tile $tile)` qui va contenir la logique de ce remplissage.

Dans `fill()` tu vas devoir
1. Récupérer les quatre cases adjascentes à la case creusée (pas les diagonales).
Pour cela, créée une méthode privée `getAdjacentTiles(Tile $tile)` qui renverra un tableau (oui nous crééons plein de petites méthodes, avec chacune un petit bout de la logique, c'est plus propre ainsi)
2. Vérifier si l'une de ces tuiles et de type `Water`.
3. Si c'est le cas, tu vas échanger la tuile `Grass` creusée par une nouvelle tuile de type `Water`. Pour réaliser cela, tu vas créer une publice méthode `addTile(Tile $tile)` et `removeTile(Tile $tile)` contenant cette logique. Ce mécanisme étant assez générique (pas spécifiquement propre à `ArenaAugeas`), tu crééra ces méthodes directement dans `Arena`. Une fois que cela fonctionne, créer une méthode `replaceTile(Tile $newTile)` qui en s'appuyant sur les deux méthodes précédentes, ajoutera la nouvelle tuile en supprimant la précédente à la même place.

Super, si tu creuses loin de l'eau, tu fais un trou, si tu creuses le long de l'eau, tu commences à déplacer le lit de la rivière.

# Recursivité

Mais voilà, tout ne fonctionne pas encore bien, car si tu creuses un trou à une distance de 2 cases de l'eau, puis que tu creuses la case entre les deux, le trou le plus proche se remplis mais pas le premier. L'eau s'arrête seulement au trou adjacent. Qu'elle est cette magie ? Héraclès décide de consulter en urgence son oncle Poséidon. Ce dernier lui donne rapidement la solution, utiliser la récursivité ! 

Quelle est le problème ? Reprenons le déroulé de ton code
1. Héraclès creuse dans l'herbe
2. Un trou se forme
3. S'il y a de l'eau à coté de ce trou, il se transforme en eau.
Mais à aucun moment on ne cherche à voir si cette nouvelle tuile d'eau se trouve elle même à proximité d'un trou qu'elle devrait alors remplir. Puis si cette nouvelle tuile d'eau se trouve elle même à proximité d'un trou qu'elle devrait alors remplir. Puis si cette nouvelle tuile d'eau se trouve elle même à proximité d'un trou qu'elle devrait alors remplir. Puis .... STOP ! 

Comme tu le vois, il va falloir utiliser la méthode `fill()` un nombre indéfini de fois. Et à chaque utilisation de `fill()`, il faut retenter de *fill* les éventuels trous jusqu'à ce qu'il n'y en ait plus. La méthode `fill()` va donc devoir **s'appeller elle même**, tant que la condition de sortie (absence de trou adjacent non remplis) ne sera pas validée. C'est celà la **récursivité**.

Reprend donc le code de `fill()`. La méthode :
1. Récupères les tuiles adjascentes au trou
2. Boucles sur celles-ci. 
3. Si l'une d'entre elle est de type Water, on modifie le trou en eau.

Et maintenant, mets en place la récursivité. Tu es toujours dans ta boucle, tu viens de modifier le trou car la tuile adjacente était de type Water.

4. Une fois que le trou est rempli (et uniquement dans ce cas), il faut vérifier s'il n'existe pas un trou autour de cette nouvelle tuile Water. Boucle de nouveau sur les tuiles adjascentes au trou rempli, si tu trouves un trou, exécute la methode `fill()` sur ce dernier. Ainsi, tu appelles `fill()` à l'intérieur de `fill()` tant qu'il y a des nouveaux trous adjacents à des tuiles d'eau. 

Tous les trous se remplissent bien, Héraclès remercie Poséidon pour son aide et file finir de creuser. 

    
# La victoire

Pour mener à bien son travail, notre héros doit amener le lit de la rivière jusqu'aux portes des écuries. Créé une méthode `isVictory()` dans `ArenaAugeas`. Cette méthode renverra true si les conditions de la victoire sont remplis. Pour être certain que cette méthode soit présente pour toutes les arènes futures, ajoute un méthode abstraite `isVictory()`  dans la classe mère `Arena`. Le méthode est abstraite car l'implémentation de la victoire sera différente pour chacun des travaux. Attention, la classe `Arena` devient donc elle-même abstraite.

Pour faire au plus simple, nous allons partir du principe que, pour ce niveau, il faut qu'il y ait de l'eau sur la tuile de coordonnée 5,7 qui est juste devant les "portes" de l'écurie. Afin de ne pas mettre les valeurs en dur, créé deux constantes `VICTORY_X = 5` et `VICTORY_Y = 7` dans `ArenaAugeas`. Dans la méthode `isVictory()`, teste si la tuile aux coordonnées de VICTORY X et Y est de type Water, si c'est bien le cas renvoie `true`, sinon renvoi `false`. La méthode est appelée dans *index.php* à chaque fois qu'une action est effectuée par le héros. Dès lors que la méthode renvoie `true`, un message est affiché à l'écran pour signifier la victoire, félicitations ! 
