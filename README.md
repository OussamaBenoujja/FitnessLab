# Application Web FitnessLab

## Configuration du Projet et Environnement

### Infrastructure de Développement
- **Système d'Exploitation** : Linux Debian (Machine Virtuelle)
- **Serveur Web** : Serveur Web Natif PHP Intégré
- **Base de Données** : MySQL
- **Accès Distant** : SSH avec Réacheminement de Ports Ngrok

### Configuration Réseau
- Accès SSH à la machine virtuelle Debian
- Utilisation de Ngrok pour le réacheminement de ports :s
  - Port SSH exposé pour l'administration à distance
  - Port du serveur web exposé pour l'accès à l'application

## Configuration de la Base de Données
- **Nom de la Base de Données** : `FitnessLab`
- **Détails de Connexion** :
  ```
  Hôte : localhost
  Nom d'utilisateur : root
  Mot de passe : osama
  ```

## Composants de l'Application

### 1. Connexion à la Base de Données (`dbConf.php`)
- Établit la connexion à la base de données MySQL
- Gestion centralisée de la connexion
- Gestion des erreurs de connexion

### 2. Tableau de Bord Administrateur (`admin.php`)
#### Fonctionnalités
- Système complet de gestion des membres
- Opérations CRUD pour les membres
- Design web responsive
- Suivi du statut des membres

### 3. Gestion des Réservations (`reservePage.php`)
#### Fonctionnalités
- Suivi complet des réservations
- Système de réservation basé sur les activités
- Fonctionnalité CRUD complète
- Gestion du statut des réservations

### 4. Gestion des Activités (`activities.php`)
#### Fonctionnalités
- Gestion du catalogue des activités
- Créer, lire, mettre à jour, supprimer des activités
- Contrôle de la disponibilité des activités
- Suivi détaillé des informations sur les activités

## Schéma de Base de Données

### Table des Membres
- `member_id`
- `name`
- `email`
- `phone_number`
- `date_of_birth`
- `gender`
- `address`
- `join_date`
- `status`

### Table des Activités
- `activity_id`
- `activity_name`
- `description`
- `duration`
- `capacity`
- `price`
- `schedule_time`
- `status`

### Table des Réservations
- `reservation_id`
- `member_id`
- `activity_id`
- `reservation_date`
- `reservation_time`
- `status`

## Déploiement de l'Application

### Prérequis
- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Serveur web 

### Étapes d'Installation
1. Cloner le dépôt
2. Configurer la connexion à la base de données dans `dbConf.php`
3. Importer le schéma de base de données
4. Démarrer le serveur PHP intégré :
   ```bash
   php -S localhost:8000
   ```

## Technologies Utilisées
- PHP
- MySQL
- HTML5
- CSS3
- Serveur Web PHP Natif
- Ngrok
