- Génération du script SQL à partir du MCD critique_photo.mcd
    avec JMerise

- Correction d'une erreur de syntaxe dans le script SQL généré par JMerise
    pour la création d'un index sur le champ pseudo de la table user
    dans le script

- Ajout des valeurs par défaut CURRENT_TIMESTAMP sur les champs suivants:
    - created de la table photo
    - created de la table comment
    dans PhpMyAdmin

- Correction de l'ordre des champs de la table user pour pouvoir sélectionner
    un utilisateur par son pseudo quand on insère une photo ou un commentaire
    dans PhpMyAdmin

- On souhaite que les photos et commentaires d'un utilisateur supprimé le soient également:
    - Modification de la contrainte ON DELETE de la clé étrangère Photo_User_FK (id_User) pour CASCADE
    - Modification de la contrainte ON DELETE de la clé étrangère Comment_Photo0_FK (id_Photo) pour CASCADE
    - Modification de la contrainte ON DELETE de la clé étrangère Comment_User_FK (id_User) pour CASCADE
    dans PhpMyAdmin

- Un champ a été oublié à la création du MCD:
    - Ajout du champ 'content' de type TEXT dans la table 'comment'

- Corrigé longueurs VARCHAR incorrectes dans la table `user`:
    hash: 50 -> 255
    pseudo: 100 -> 50
