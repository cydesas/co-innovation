# Co-Innovation Platform 🚀

[![License: Apache 2.0](https://img.shields.io/badge/License-Apache%202.0-blue.svg)](https://opensource.org/licenses/Apache-2.0)
[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-blue.svg)](https://php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-orange.svg)](https://www.mysql.com/)
[![Architecture](https://img.shields.io/badge/Architecture-MVC-green.svg)](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller)

> **Plateforme de co-innovation collaborative** - Connecter les innovateurs, accélérer les projets, transformer les idées en réalité

---

## 📋 Table des matières

- [Contexte & Objectifs](#-contexte--objectifs)
- [Architecture & Technologies](#-architecture--technologies)
- [Installation & Prérequis](#-installation--prérequis)
- [Utilisation](#-utilisation)
- [Configuration](#-configuration)
- [API & Documentation technique](#-api--documentation-technique)
- [Tests & Qualité](#-tests--qualité)
- [Contribuer](#-contribuer)
- [Roadmap & TODO](#-roadmap--todo)
- [Communauté & Support](#-communauté--support)
- [Licence](#-licence)
- [Références & Inspirations](#-références--inspirations)

---

## 🎯 Contexte & Objectifs

### Pourquoi ce projet ?

**Co-Innovation** est née d'un constat simple : l'innovation collaborative est la clé du succès dans un monde interconnecté. Beaucoup d'entreprises hésitent à innover par manque de moyens, de temps ou de partenaires appropriés. Notre plateforme transforme ces contraintes en opportunités.

### Problématiques adressées

- **Coûts élevés** de l'innovation en solo
- **Manque de temps** pour développer des projets innovants
- **Difficulté à trouver** des partenaires complémentaires
- **Idées abandonnées** faute de ressources ou d'accompagnement
- **Fragmentation** des écosystèmes d'innovation

### Personas cibles

- **🏢 Entreprises** : Réduire les coûts d'innovation, accélérer le développement
- **💼 ESN** : Valoriser leurs services, massifier leur activité d'innovation
- **💡 Particuliers** : Transformer leurs idées en projets concrets, bénéficier de l'innovation

### Différenciateurs

- **Accompagnement expert** Cyde intégré dans la plateforme
- **Matching intelligent** entre partenaires complémentaires
- **Protection des idées** avec système de confidentialité
- **Écosystème complet** de l'idée au lancement de projet

---

## 🏗️ Architecture & Technologies

### Stack technique

- **Backend** : PHP 7.4+ (Vanilla, sans framework)
- **Base de données** : MySQL 5.7+ avec PDO
- **Frontend** : HTML5, CSS3, JavaScript vanilla
- **Architecture** : Pattern MVC personnalisé
- **Serveur web** : Apache avec mod_rewrite
- **Sécurité** : Sessions PHP, validation des données

### Organisation du code

```
co-innovation/
├── api/                    # Endpoints API REST
├── config/                 # Configuration (DB, constantes)
├── controllers/            # Contrôleurs MVC
├── models/                 # Modèles de données
├── views/                  # Templates et vues
├── utils/                  # Utilitaires et helpers
├── routes/                 # Système de routage
├── migrations/             # Évolutions de base de données
└── public/                 # Assets statiques
```

### Patterns architecturaux

- **MVC** : Séparation claire entre logique métier, présentation et données
- **Repository** : Abstraction de l'accès aux données
- **Router** : Système de routage personnalisé
- **Template Engine** : Moteur de templates simple et efficace

---

## 🚀 Installation & Prérequis

### Prérequis système

- **PHP** : 7.4 ou supérieur
- **MySQL** : 5.7 ou supérieur
- **Apache** : avec mod_rewrite activé
- **Composer** : pour l'autoloading (optionnel)

### Installation

1. **Cloner le repository**

   ```bash
   git clone https://github.com/votre-username/co-innovation.git
   cd co-innovation
   ```

2. **Configurer la base de données**

   ```bash
   # Créer la base de données
   mysql -u root -p -e "CREATE DATABASE co_innovation CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

   # Importer le schéma (si disponible)
   mysql -u root -p co_innovation < migrations/schema.sql
   ```

3. **Configurer l'environnement**

   ```bash
   # Copier et modifier la configuration
   cp config/database.php.example config/database.php
   # Éditer config/database.php avec vos paramètres
   ```

4. **Configurer Apache**

   ```apache
   # Dans votre VirtualHost
   DocumentRoot /path/to/co-innovation
   <Directory /path/to/co-innovation>
       AllowOverride All
       Require all granted
   </Directory>
   ```

5. **Démarrer l'application**
   ```bash
   # L'application est accessible via votre navigateur
   # http://localhost/co-innovation
   ```

### Exemple d'exécution rapide

```bash
# Avec PHP built-in server (développement uniquement)
cd co-innovation
php -S localhost:8000
# Ouvrir http://localhost:8000
```

---

## 💡 Utilisation

### Workflow principal

1. **Proposer une idée**

   - Créer un compte utilisateur
   - Décrire votre idée d'innovation
   - Définir les domaines et compétences nécessaires

2. **Rencontrer des partenaires**

   - Système de matching automatique
   - Filtrage par domaine et type d'utilisateur
   - Mise en relation avec des profils complémentaires

3. **Lancer votre projet**
   - Planification collaborative
   - Accompagnement Cyde
   - Suivi et développement

### Commandes principales

```bash
# Accéder à l'interface web
http://votre-domaine.com/

# Endpoints API disponibles
GET  /api/idees          # Lister les idées
POST /api/idees          # Créer une idée
GET  /api/domaines       # Lister les domaines
POST /api/like           # Liker une idée
```

### Cas d'usage typiques

- **Entreprise** : Trouver des partenaires pour développer un nouveau produit
- **ESN** : Présenter ses services d'innovation et trouver des clients
- **Particulier** : Transformer une idée en startup avec des co-fondateurs

---

## ⚙️ Configuration

### Variables d'environnement

```php
// config/database.php
define("DBHOST", "localhost:3307");
define("DBUSER", "votre_utilisateur");
define("DBPWD", "votre_mot_de_passe");
define("DBNAME", "co_innovation");

// config/define.php
define("ADMINISTRATEUR", 1);
define("PARTICULIER", 2);
define("ENTREPRISE", 3);
define("ESN", 4);
```

### Configuration Apache (.htaccess)

```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

### Paramètres par défaut

- **Pagination** : 9 idées par page
- **Statuts d'idées** : Brouillon, À modérer, Publiée, Annulée, Archivée
- **Types d'utilisateurs** : Administrateur, Particulier, Entreprise, ESN

---

## 🔌 API & Documentation technique

### Endpoints REST

| Méthode | Endpoint            | Description                      |
| ------- | ------------------- | -------------------------------- |
| `GET`   | `/api/idees`        | Récupérer la liste des idées     |
| `POST`  | `/api/idees`        | Créer une nouvelle idée          |
| `GET`   | `/api/domaines`     | Lister les domaines d'innovation |
| `POST`  | `/api/like`         | Liker une idée                   |
| `GET`   | `/api/get_nb_likes` | Compter les likes d'une idée     |

### Structures de données

#### Modèle Idée

```php
class IdeaModel {
    private $id_idee;
    private $titre;
    private $description;
    private $date_creation;
    private $statut;
    private $utilisateur;
    private $domaines;
}
```

#### Modèle Utilisateur

```php
class UserModel {
    private $id_utilisateur;
    private $email;
    private $nom;
    private $type_utilisateur;
    private $statut;
}
```

### Base de données

**Tables principales :**

- `idee` : Idées d'innovation
- `utilisateur` : Profils utilisateurs
- `idee_domaine` : Domaines d'innovation
- `utilisateur_type` : Types d'utilisateurs
- `like` : Système de likes

---

## 🧪 Tests & Qualité

### Lancement des tests

```bash
# Tests unitaires (à implémenter)
php vendor/bin/phpunit tests/

# Tests d'intégration
php tests/integration.php

# Vérification de la syntaxe
php -l controllers/*.php
php -l models/*.php
```

### Bonnes pratiques

- **Coding Standards** : PSR-12 
- **Documentation** : PHPDoc pour toutes les méthodes publiques
- **Validation** : Validation des données d'entrée
- **Sécurité** : Protection contre les injections SQL, XSS, CSRF

### CI/CD (à implémenter)

- **GitHub Actions** pour l'intégration continue
- **Tests automatisés** à chaque commit
- **Déploiement automatique** sur staging/production
- **Analyse de qualité** avec SonarQube

---

## 🤝 Contribuer

### Workflow Git

1. **Fork** le repository
2. **Créer** une branche feature : `git checkout -b feature/nouvelle-fonctionnalite`
3. **Commiter** vos changements : `git commit -am 'Ajout nouvelle fonctionnalité'`
4. **Pousser** vers la branche : `git push origin feature/nouvelle-fonctionnalite`
5. **Créer** une Pull Request

### Style guide

- **Naming** : camelCase pour les variables, PascalCase pour les classes
- **Indentation** : 4 espaces (pas de tabs)
- **Commentaires** : PHPDoc pour toutes les méthodes publiques
- **Structure** : Respecter l'architecture MVC existante

---

## 🌐 Communauté & Support

### Canaux officiels

- **Entreprise** : [Cyde](https://cyde.fr)
- **LinkedIn** : [Cyde SAS](https://www.linkedin.com/company/cyde-sas/)

### Mainteneurs

- **Équipe Cyde** : Développement et maintenance
- **Contributeurs** : Communauté open source
- **Partners** : Écosystème d'innovation

---

## 📚 Références & Inspirations

### Standards et bonnes pratiques

- [PSR Standards](https://www.php-fig.org/psr/) - Standards PHP
- [MVC Pattern](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller) - Architecture MVC
- [REST API Guidelines](https://restfulapi.net/) - Bonnes pratiques API REST

### Documentation externe

- [PHP Documentation](https://www.php.net/docs.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [Apache Documentation](https://httpd.apache.org/docs/)

---

## 🙏 Remerciements

Un grand merci à tous les contributeurs, testeurs et utilisateurs qui participent à l'évolution de cette plateforme d'innovation collaborative.

---

**Co-Innovation** - Transformons ensemble l'innovation collaborative 🚀

_Développé avec ❤️ par l'équipe Cyde_
