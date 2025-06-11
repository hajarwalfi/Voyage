<div align="center">

# ✈️ Voyage Reservation System ✈️
### *Gestion des Réservations pour Agence de Voyage*

![PHP](https://img.shields.io/badge/PHP-FFE4E1?style=for-the-badge&logo=php&logoColor=FF69B4&labelColor=FFF0F5)
![MySQL](https://img.shields.io/badge/MySQL-E6E6FA?style=for-the-badge&logo=mysql&logoColor=9370DB&labelColor=F8F8FF)
![CSS3](https://img.shields.io/badge/CSS3-FFFACD?style=for-the-badge&logo=css3&logoColor=FFB6C1&labelColor=FFFFF0)
![UML](https://img.shields.io/badge/UML-FFE4F1?style=for-the-badge&logo=uml&logoColor=FF69B4&labelColor=FFF5F5)

</div>

## 🌍 À Propos du Projet

**Voyage Reservation System** est une application web de gestion complète pour agence de voyage, développée pour moderniser les processus de réservation manuels. Cette solution numérique permet la gestion des clients, l'affichage dynamique des offres touristiques et la réservation d'activités en ligne avec personnalisation avancée.

Développé avec une approche backend robuste utilisant PHP procédural et MySQL, le système inclut une modélisation de base de données complète et une architecture documentée via ERD et diagrammes UML.

## ✨ Fonctionnalités Principales

### 🏢 Gestion Agence de Voyage
- 👥 **Gestion Clients** - Inscription et profils détaillés
- 🗂️ **Catalogue d'Activités** - Vols, hôtels, circuits touristiques
- 📅 **Système de Réservation** - Booking en ligne avec personnalisation
- 💰 **Gestion Tarifs** - Prix dynamiques et promotions
- 📊 **Suivi Réservations** - Dashboard complet administrateur

### 🔧 Fonctionnalités CRUD Complètes
- ➕ **Création** - Ajout clients, activités, réservations
- 📖 **Lecture** - Affichage dynamique des données
- ✏️ **Modification** - Mise à jour formulaires intuitifs
- 🗑️ **Suppression** - Gestion sécurisée des suppressions
- 🔍 **Recherche** - Filtres par critères multiples

### 📊 Architecture et Modélisation
- 🗺️ **ERD Complet** - Schéma relationnel documenté
- 📋 **UML Cas d'Usage** - Interactions système détaillées
- 🏗️ **Base de Données** - MySQL optimisée avec relations
- 📚 **Documentation** - Instructions configuration complètes

## 🛠️ Technologies Utilisées

<div align="justify">

![PHP](https://img.shields.io/badge/PHP-FFE4E1?style=for-the-badge&logo=php&logoColor=FF69B4&labelColor=FFF0F5)
![MySQL](https://img.shields.io/badge/MySQL-E6E6FA?style=for-the-badge&logo=mysql&logoColor=9370DB&labelColor=F8F8FF)
![CSS3](https://img.shields.io/badge/CSS3-FFFACD?style=for-the-badge&logo=css3&logoColor=FFB6C1&labelColor=FFFFF0)
![UML](https://img.shields.io/badge/UML-FFE4F1?style=for-the-badge&logo=uml&logoColor=FF69B4&labelColor=FFF5F5)
![Git](https://img.shields.io/badge/Git-FFE0E6?style=for-the-badge&logo=git&logoColor=FF69B4&labelColor=FFF5F8)
![HTML5](https://img.shields.io/badge/HTML5-FFF0E6?style=for-the-badge&logo=html5&logoColor=FF8C00&labelColor=FFFAF0)

</div>

**Stack Technique :**
- **Backend :** PHP 8.0+ avec approche procédurale
- **Base de Données :** MySQL avec jointures optimisées
- **Frontend :** HTML5 sémantique + CSS3 responsive
- **Modélisation :** UML + ERD documentés
- **Validation :** Standards W3C respectés

## 🚀 Installation et Configuration

### Prérequis
```bash
# Serveur local requis
- XAMPP / WAMP / MAMP
- PHP 8.0+
- MySQL 5.7+
- Apache Web Server
```

## 📖 Structure du Projet

```
voyage-reservation-system/
├── 📁 assets/
│   ├── css/                 # Styles responsive
│   ├── img/                 # Images activités et destinations
│   └── js/                  # Scripts interactifs
├── 📁 docs/
│   ├── ERD.pdf             # Diagramme Entité-Relation
│   ├── Use Case Diagram and Scenarios.pdf
│   └── Documentation de configuration.pdf
├── 📄 index.php            # Page d'accueil
├── 📄 client.php           # Gestion clients
├── 📄 activite.php         # Gestion activités
├── 📄 reservation.php      # Système réservations
├── 📄 database.php         # Connexion base de données
├── 📄 design.php           # Templates et styles
├── 📄 style.css            # Styles principaux
├── 📄 voyage.sql           # Script création BDD
└── 📄 README.md            # Documentation
```

## 🗺️ Modélisation de la Base de Données

### Entités Principales

#### 👥 Table Clients
```sql
CREATE TABLE clients (
    id_client INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    telephone VARCHAR(20),
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 🏖️ Table Activités
```sql
CREATE TABLE activites (
    id_activite INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(200) NOT NULL,
    description TEXT,
    destination VARCHAR(100),
    prix DECIMAL(10,2) NOT NULL,
    date_debut DATE,
    date_fin DATE,
    places_disponibles INT DEFAULT 0
);
```

#### 📅 Table Réservations
```sql
CREATE TABLE reservations (
    id_reservation INT PRIMARY KEY AUTO_INCREMENT,
    id_client INT,
    id_activite INT,
    date_reservation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    nombre_personnes INT DEFAULT 1,
    prix_total DECIMAL(10,2),
    statut ENUM('en_attente', 'confirmee', 'annulee') DEFAULT 'en_attente',
    FOREIGN KEY (id_client) REFERENCES clients(id_client),
    FOREIGN KEY (id_activite) REFERENCES activites(id_activite)
);
```

### Relations et Contraintes
- **1:N** Client → Réservations (Un client peut avoir plusieurs réservations)
- **1:N** Activité → Réservations (Une activité peut être réservée plusieurs fois)
- **Contraintes d'intégrité** avec clés étrangères
- **Index optimisés** pour les requêtes fréquentes


## 📊 Diagrammes UML

### Cas d'Usage Principaux
**Acteurs :**
- 👤 **Client** - Consultation, réservation, modification
- 🏢 **Système** - Validation, calculs, notifications
- 👨‍💼 **Administrateur** - Gestion complète (bonus)

**Fonctionnalités :**
- 🔍 Consulter catalogue d'activités
- 📅 Effectuer une réservation
- 🎯 Personnaliser le voyage
- ✏️ Modifier/Annuler réservation
- 💳 Gérer les paiements (bonus)

## 🔧 Fonctionnalités Bonus Implémentées

### 🎯 Recherche Avancée
- 🗺️ **Filtres géographiques** - Par destination
- 💰 **Filtres prix** - Fourchettes personnalisées
- 📅 **Filtres dates** - Périodes disponibles
- ⭐ **Tri par popularité** - Activités tendances

## 📋 Livrables et Évaluations

### 📅 Planning de Livraison
**J1 - Modélisation :**
- ✅ Diagramme ERD complet
- ✅ Diagramme UML cas d'usage

**J3 - Scripts SQL :**
- ✅ Création base de données
- ✅ Scripts CRUD optimisés

**J5 - Code PHP :**
- ✅ Formulaires dynamiques
- ✅ Affichage données connectées

### 🏆 Critères de Performance
**Qualité Code :**
- ✅ **Clean Code** - Standards respectés
- ✅ **W3C Compliance** - Validation réussie
- ✅ **Documentation** - Commentaires détaillés
- ✅ **Sécurité** - Requêtes préparées

**Fonctionnalités :**
- ✅ **CRUD Complet** - Toutes opérations
- ✅ **Jointures SQL** - Requêtes optimisées
- ✅ **Interface Intuitive** - UX soignée
- ✅ **Responsive Design** - Multi-devices

