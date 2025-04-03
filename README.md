# projet dans un Codespace PHP avec mariadb

blablablba projet

TODO :
- finir le readme ^^
- améliorer la structure
- travailler la persistance bdd (historique des scripts ? detection quand on a un nouveau script ?)

## Arborescence du dépôt

Voici l'arborescence du dépôt et le rôle des différents composants. Les fichiers et dossiers à modifier sont en gras :

├── .devcontainer/ # config du codespace
|  ├── devcontainer.json # Configuration du Dev Container pour VS Code
|  └── Dockerfile # Dockerfile pour construire l'image du Dev Container  dans mariadb 
├── .github/ # config pour les alertes de dépendances (sécurité)
├── .vscode/ # config pour XDebug et parametres de vscode
├── database # scripts pour la BDD
|  ├── scripts # contient 3 scripts bash : 1 pour initialiser la BDD métier (avec ses utilisateurs système), 1 pour sauver la bdd métier du codespace et 1 pour la recharger à partir du .sql présent dans le dépot
|  └── sources-sql # fichiers SQL pour contruire la BDD métier, ses utilisateurs et ses données 
├── site # Dossier racine du serveur web
├── start.sh # Script de lancement pour démarrer le service mariadb et les instances web du site et de phpMyAdmin.
└── stop.sh # Script pour arreter le service mariadb et les instances web du site et de phpMyAdmin.


## Configuration du Codespace et lancement de l'application

Ce dépôt est configuré pour fonctionner avec les Codespaces de GitHub et les Dev Containers de Visual Studio Code. Suivez les étapes ci-dessous pour configurer votre environnement de développement.

!important! 
Pour être executables, les scripts bash executés dans le codespace (start.sh, stop.sh, initBDD.sh, ...) doivent avoir les bonnes permissions.

Utilisez la commande ```ls -l``` pour afficher les permissions des fichiers dans le répertoire contenant vos scripts bash.
Cela affichera les permissions actuelles des fichiers. Les scripts doivent avoir l'autorisation d'exécution (x) pour être exécutables.

2. Ajouter les droits d'exécution
Si les scripts n'ont pas les bonnes permissions, utilisez la commande chmod pour leur ajouter les droits d'exécution :
```chmod +x ./start.sh ./stop.sh ./database/scripts/*.sh```


### Utilisation avec GitHub Codespaces
1. **Créez un codespace pour ouvrir ce dépot** :
   - Cliquez sur le bouton "Code" dans GitHub et sélectionnez "Open with Codespaces".
   - Si vous n'avez pas encore de Codespace, cliquez sur "New Codespace".

   Le Codespace ainsi créé contient toutes les configurations nécessaires pour démarrer le développement.

### Serveur php et service mariadb (avec la base métier)

1. **Pour lancer les services** :
   - Dans le terminal, exécutez le script `start.sh` :
     ```bash
     ./start.sh
     ```
   Ce script démarre le serveur PHP intégré sur le port 8000, démarre maraidb et crée la base métier depuis le script renseigné (mettre à jour en fonction du projet).

2. **Ouvrir le service php dans un navigateur** :
   - Accédez à `http://localhost:8000` pour voir la page d'accueil de l'API.

3. **Accèder à la BDD** :
   - En mode commande depuis le client mysql en ligne de commande
   Exemple : 
      ```bash
      mysql -u mediateq-web -p
      ```
   - En client graphique avec l'extension Database dans le codespace (Host:127.0.0.1)

   - avec phpMyAdmin sur le port 8080

4. **initialiser la BDD** :
   - Au premier démarrage, créez la bdd métier avec le fichier sql 
      ```bash
      ./database/scripts/initBDD.sh 
      ```

5. **Sauver et mettre à jour la BDD** :
   - A chaque fois que vous avez fait des modifs significatives dans la BDD métier, lancer le script bash saveBDD pour écraser le fichier sql actuel de la bdd par votre sauvegarde (puis pensez à push sur le distant pour vos collaborateurs)
      ```bash
      ./database/scripts/saveBDD.sh 
      ```
   - Si des modifs ont été faites à la BDD et que vous avez récupéré du dépot distant (pull) une version mise à jour du script de la BDD métier, lancer le script bash reloadBDD pour écraser la bdd actuelle de votre codespace par celle du script récupéré.
      ```bash
      ./database/scripts/reloadBDD.sh 
      ```

## Système de Layout dans l'Architecture MVC

Le projet utilise un système de **layout** pour gérer l'héritage des vues dans l'architecture MVC. Cela permet de centraliser la structure HTML commune (comme le header, le footer, ou les menus) dans un fichier unique, tout en permettant aux vues spécifiques d'injecter leur contenu dans des sections définies.

### 1. Structure du système de layout

Le système de layout repose sur un fichier principal appelé `layout.php`, qui définit la structure HTML globale. Les vues spécifiques injectent leur contenu dans ce layout via des variables.

#### Exemple de structure :
- **`site/vue/layout.php`** : Contient la structure HTML commune.
- **`site/vue/accueil_vue.php`** : Vue spécifique pour la page d'accueil.
- **`site/vue/bateau_vue.php`** : Vue spécifique pour afficher les bateaux.

---

### 2. Exemple de `layout.php`

Voici un exemple de fichier `layout.php` qui définit la structure HTML globale :

```php
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $description ?? '' ?>">
    <meta name="keywords" content="<?= $keywords ?? '' ?>">
    <title><?= $title ?? 'Mon Application' ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Mon Application</h1>
        <nav>
            <!-- Menu de navigation -->
        </nav>
    </header>

    <main>
        <?= $content ?? '' ?> <!-- Section où le contenu spécifique sera injecté -->
    </main>

    <footer>
        <p>&copy; 2025 Mon Application. Tous droits réservés.</p>
    </footer>
</body>
</html>
```

---

### 3. Exemple d'une vue spécifique

Les vues spécifiques (par exemple, `bateau_vue.php`) définissent leur contenu et utilisent le layout pour l'afficher.

#### Exemple de `bateau_vue.php` :
```php
<?php
// Définir les variables spécifiques à cette vue
$title = "Nos Bateaux";
$keywords = "bateaux, ferries, accessibilité";
$description = "Découvrez notre flotte et les caractéristiques de nos différents ferries.";

// Capturer le contenu spécifique dans une variable
ob_start();
?>
<h1>Nos Bateaux</h1>
<p>Bienvenue à bord ! Découvrez notre flotte et les caractéristiques de nos différents ferries.</p>
<!-- Contenu spécifique -->
<?php
$content = ob_get_clean(); // Stocker le contenu dans une variable
include 'layout.php'; // Inclure le layout
```

---

### 4. Fonctionnement

1. **Variables dynamiques** :
   - Les variables comme `$title`, `$keywords`, `$description`, et `$content` sont définies dans les vues spécifiques.
   - Ces variables sont utilisées dans `layout.php` pour personnaliser le contenu.

2. **Injection de contenu** :
   - La fonction `ob_start()` est utilisée pour capturer le contenu HTML spécifique dans une variable (`$content`).
   - Ce contenu est ensuite injecté dans le layout via `<?= $content ?>`.

3. **Inclusion du layout** :
   - Chaque vue inclut le fichier `layout.php` à la fin, ce qui applique la structure HTML commune.

---

### 5. Avantages du système de layout

- **Réutilisation** :
  - La structure HTML commune (header, footer, etc.) est centralisée dans un seul fichier (`layout.php`), ce qui évite la duplication de code.

- **Modularité** :
  - Chaque vue se concentre uniquement sur son contenu spécifique, ce qui rend le code plus clair et maintenable.

- **Facilité de maintenance** :
  - Les modifications globales (comme le style ou le menu) peuvent être effectuées dans le fichier `layout.php`, sans avoir à modifier chaque vue.

---

### 6. Résumé

Le système de layout permet de :
- Centraliser la structure HTML commune dans un fichier unique (`layout.php`).
- Injecter dynamiquement le contenu spécifique des vues dans des sections définies.
- Simplifier la maintenance et améliorer la modularité du code.

Avec ce système, votre projet suit une architecture MVC propre et maintenable, tout en offrant une flexibilité pour personnaliser les vues.


## Utilisation de XDebug

Ce Codespace contient XDebug pour le débogage PHP. 

1. **Exemple de déboguage avec Visual Studio Code** :
   - Ouvrez le panneau de débogage en cliquant sur l'icône de débogage dans la barre latérale ou en utilisant le raccourci clavier `Ctrl+Shift+D`.
   - Sélectionnez la configuration "Listen for XDebug" et cliquez sur le bouton de lancement (icône de lecture).
   - Ouvrez un fichier php
   - Ajouter un point d'arrêt.
   - Solicitez dans le navigateur une page qui appelle le traitement
   - Une fois le point d'arrêt atteint, essayez de survoler les variables, d'examiner les variables locales, etc.

[Tuto Grafikart : Xdebug, l'exécution pas à pas ](https://grafikart.fr/tutoriels/xdebug-breakpoint-834)


## Tests unitaires

Ce projet utilise PHPUnit pour les tests unitaires.

1. ** Installer les dépendances **
Pour exécuter les tests unitaires, assurez-vous que les dépendances nécessaires sont installées via Composer en executant :
```bash
composer install
```
2. ** Lancer les tests **
Une fois les dépendances installées, lancez les tests avec la commande suivante :
```bash
vendor/bin/phpunit --testdox tests/
```
Cela exécutera tous les tests définis dans le projet et affichera les résultats dans le terminal.

3. ** Structure des tests **
Les tests sont organisés dans le répertoire ``tests/`` et suivent cette structure :
- tests/modele/ : Contient les tests pour les modèles (par exemple, BateauModeleTest.php).
- tests/controleur/ : Contient les tests pour les contrôleurs (par exemple, BateauControleurTest.php).


4. ** Ajouter de nouveaux tests **
Pour ajouter un nouveau test :
- Créez un fichier de test dans le répertoire approprié (par exemple, tests/modele/NouveauModeleTest.php).

- Assurez-vous que le fichier suit la convention de nommage `NomClasseTest.php` et que la classe de test étend `PHPUnit\Framework\TestCase`.

Exemple de test unitaire simple :

```php
<?php

use PHPUnit\Framework\TestCase;

class ExempleTest extends TestCase
{
   public function testAddition()
   {
      $this->assertEquals(4, 2 + 2);
   }
}
```

Une fois le test ajouté, relancez la commande PHPUnit pour vérifier son bon fonctionnement.

