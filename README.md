# TD Noté Laravel DAWIN 2023 Paul Gubbiotti

Le TD portera sur la création d'une petite plateforme pour gérer la reservation de place pour le télé-travail dans une
entreprise.

Chaque salarié peut se connecter à la plateforme, voir les réservations pour aujourd'hui et demain, et réserver une
place.

Les administrateurs peuvent également gérer la liste des bâtiments de la société.

Pour certaines questions, vous devrez répondre sur ce fichier.
Les questions concernées sont suivi d'un bloc "> Réponse :" où vous devrez saisir votre réponse en suivant.

## Remise

La date limite est fixée au **lundi 16 janvier 2023 23:59:59**.

Il faudra push votre dépôt sur le GitLab de l'IUT en **dépôt privé**, et m'ajouter au dépot :

- Sur votre dépôt, allez sur la section **"Members"**
- Dans la section "Invite member", tapez dans "GitLab member" : `marlamoureux`
- Choisissez comme rôle "Developer"

## Installation

Comme pour tout projet Laravel, copiez le fichier `.env.example` vers `.env`, et modifiez-le pour y indiquer les
informations de connexion à votre base de données locale, puis éxécutez les commandes suivantes :

```bash
$ php artisan migrate
```

## 1. Authentification

**1.1.**    Sur la page de login `/login`, on peut saisir n'importe quel type d'entrée dans le champ "Adresse E-mail".
Faites-en sorte de *valider* la valeur du formulaire pour restreindre uniquement les valeur ayant un
format d'adresse e-mail.

Attention : Quand on revient sur un formulaire après un échec de validation, il est coutume de ne jamais re-remplir
les champs mot de passe !

**1.2.**    Maintenant que les adresses e-mail mal formattées sont rejetées, on remarque que l'on revient sur le
formulaire de connexion avec un joli message d'erreur.
Par contre nous pouvons remarquer que nous avons perdu l'entrée tapée, et on doit tout retaper, même si on
a juste fait une petite faute de frappe ! Pas très user friendly...
Modifiez le code, notamment le fichier `resources/views/auth/login.blade.php` afin de pouvoir préserver
la valeur qui avait été entrée.

Astuce :    Informez-vous sur la fonction globale `old()` que Laravel vous fournit.

**1.3.**    La logique de connexion a été fait "en dur" (on utilise pas de système déjà construits ou générés).
Décrivez cette logique en recherchant dans le code, au niveau des routes et des contrôleurs notamment.

>           Réponse : Le code regarde si un utilisateur avec l'adresse mail et le mot de passe saisi existe, si c'est le cas une redirection a lieu.
>

Executez maintenant la commande suivante :

```shell
$ php artisan db:seed --class=InitialData
```

**1.4.**    En ayant lu la classe `database/seeders/InitialData.php`, pouvez-vous me dire que fait cette commande ?

>           Réponse : La commande "php artisan db:seed --class=InitialData" permet de faire de l'ensemencement de la base de données, ce qui consiste à remplir la base de données avec un ensemble initial de données. La commande a donc créé dans la base 11 utilisateurs.
>

## 2. Gestion des bâtiments

Ajoutons maintenant la gestion des bâtiments.

Chaque bâtiment possède deux attributs :

* `name` : Son nom
* `capacity` : Sa capacité d'accueil maximale

**2.1.**    Créez la migration pour créer la table `buildings`

**2.2.**    Créez le modèle `Building`

**2.3.**    Modifiez le fichier `routes/web.php` à l'endroit indiqué pour y ajouter nos routes :
- GET /buildings :                  Liste des bâtiments
- GET /buildings/create :           Formulaire de création d'un bâtiment
- POST /buildings/create :          Traitement du formulaire de création
- GET /buildings/:building :        Formulaire de modification d'un bâtiment  
- POST /buildings/:building :       Traitement du formulaire de modification
- GET /buildings/:building/delete : Suppression d'un bâtiment

**2.4.**    Ajoutez vos méthodes dans le controller `BuildingsController` pour gérer toutes ces requêtes.
Pour vous simplifier le travail et se concentrer uniquement sur la partie PHP, les vues sont déjà réalisées.
Les deux instructions pour retourner ces vues sont déjà disponibles dans la classe.
N'oubliez pas de correctement valider les entrées de votre formulaire, notamment avec les règles suivantes :
- Le nom est obligatoire
- Le nom doit être unique (il ne peut pas y avoir deux bâtiments avec le même nom)
- La capacité maximale doit être un nombre entier
- La capacité maximale ne doit pas être inférieure à 1

## 3. Autorisations

L'application pourra être accédée par deux types d'utilisateurs : les administrateurs, et les salariés.

Vu la simplicité des niveaux de droits, on va se permettre d'utiliser une simple valeur booléenne `is_admin` pour
déterminer si un utilisateur est administrateur ou non.

**3.1.**    Créez la migration qui va ajouter ce champ `is_admin` à votre table `users`.
Vous prendrez bien soin de vous assurer que la valeur par défaut soit bien fausse.

Executez ensuite la migration avec la commande `php artisan migrate` et lancez la commande suivante :

```shell
$ php artisan db:seed --class=AddRolesToUsers
```

**3.2.**    Il faut désormais contrôler l'accès à notre partie "Bâtiments" pour que les salariés ne puissent pas accéder
à cette partie de l'application.
Faites en sorte notamment que le lien "Bâtiments" de la barre de navigation ne s'affiche pas pour les
salariés. Vérifiez également qu'on ne puisse pas accéder aux URL directement !

## 4. A vous de jouer !

C'est le moment de s'attaquer au coeur de notre application : la réservation de place.

Pour cette dernière partie, je vous laisse libre court à votre imagination pour l'implémentation.

Voici les consignes :

- Chaque utilisateur peut réserver une place sur une journée en précisant une date (dans le futur) et le bâtiment.
- Si la journée dépasse sa capacité maximale pour le bâtiment sélectionné, il n'est pas possible de réserver une place.
- Tableau de bord : Chaque utilisateur peut voir les personnes ayant réservé un créneau pour la journée et pour demain,
  avec le format suivant par exemple :
    * Aujourd'hui
        * Bâtiment 1
            - Luke Skywalker
            - Harry Potter
        * Bâtiment 2
            - Tony Stark
              etc...

- Bonus :   Pour la journée d'aujourd'hui et de demain, et pour chaque bâtiment : indiquez le pourcentage d'occupation
  Par ex : * Bâtiment 1 (23%)

## Bonus

De manière générale, essayez d'optimiser votre code le plus possible, essayez de respecter les bonnes pratiques, et
écrivez du code joli !
