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
git clone https://github.com/votre-utilisateur/votre-repository.git
cd votre-repository
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
