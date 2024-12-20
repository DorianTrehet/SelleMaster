# SelleMaster - Application Symfony

## Description

SelleMaster est une application Symfony permettant de gérer l'inventaire de sellerie. Elle permet de créer et gérer des équipements, ainsi que d'enregistrer des actions de réservation et d'annulation de réservation.

## Prérequis

Avant d'installer l'application, assurez-vous que vous avez les outils suivants installés :

- [Symfony](https://symfony.com/doc/current/setup.html) (au moins la version 5.x)
- [Composer](https://getcomposer.org/) (pour la gestion des dépendances PHP)
- [MySQL](https://www.mysql.com/) ou [SQLite](https://www.sqlite.org/) pour la base de données

## Installation

### 1. Cloner le projet

Clonez ce repository sur votre machine locale :

```bash
git clone https://github.com/DorianTrehet/SelleMaster.git
cd SelleMaster
```

### 2. Installer les dépendances

Exécutez la commande suivante pour installer toutes les dépendances du projet via Composer :

```bash
composer install
```

### 3. Configurer la base de données 

Créez le fichier .env.local à la racine du projet et mettez l'URL de la base de données en fonction de votre configuration locale.

**Si vous utilisez MySQL**, modifiez l'URL comme suit :

```bash
DATABASE_URL="mysql://root:@127.0.0.1:3306/SelleMaster?serverVersion=8.0.32&charset=utf8mb4"
```

**Si vous préférez SQLite**, (aucune configuration de serveur nécessaire), utilisez cette URL :

```bash
DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
```

### 4. Créer la base de données et le schéma

Une fois la configuration de la base de données terminée, créez la base de données et mettez à jour le schéma avec la commande suivante :

```bash
make db-init
```
Cela exécutera les commandes Symfony nécessaires pour créer la base de données et générer les tables à partir des entités de l'application.

### 5. Charger les fixtures

Pour charger les données de test dans la base de données (fixtures), exécutez la commande suivante :

```bash
make fixtures
```

Cela remplira la base de données avec des données de test pour vous permettre de commencer à utiliser l'application immédiatement.

### 6. Démarrer le serveur Symfony

Une fois les étapes précédentes terminées, vous pouvez démarrer le serveur de développement Symfony avec la commande suivante :

```bash
make start
```

L'application sera alors accessible à l'adresse http://localhost:8000.

## Commandes Make disponibles
Voici les commandes make disponibles pour gérer votre application :

* ``` make db-init ``` : Crée la base de données et met à jour le schéma.
* ``` make db-reset ``` : Réinitialise la base de données (supprime et recrée).
* ``` make fixtures ``` : Charge les données de test (fixtures) dans la base de données.
* ``` make start ``` : Lance le serveur Symfony.
