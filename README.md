# 📚 BiblioNet — Application de Gestion de Bibliothèque (PHP MVC)

**Module :** Développement d'Application Web (2e année Informatique — 2026/2027)  
**Application en ligne (Production) :** [https://biblionet.site.je/](https://biblionet.site.je/)

---

## 🔑 Accès de Test (Espace Bibliothécaire / Administrateur)

Pour tester les fonctionnalités d'administration en ligne (CRUD des livres, gestion des emprunts et des retours) sur **[https://biblionet.site.je/](https://biblionet.site.je/)** :

* **Identifiant (Email) :** `agent.biblio@biblionet.com`
* **Mot de passe :** `Biblio2026!`

---

## 👥 Équipe du Projet & Répartition des Tâches

* **Marc-Kevin (`TheGoatMarckevin21`) :** Architecture MVC sur mesure, connexion PDO, sécurité (`.env`, `.htaccess`, anti-XSS), authentification, générateur dynamique de couvertures SVG et déploiement en production.
* **Françoise Ghislaine Princilia OBONE MBA :** Module de Gestion des Ouvrages (Catalogue public, recherche multicritère et CRUD complet des livres).
* **Marie :** Module de Gestion de la Circulation (Enregistrement des emprunts, suivi des dates de retour, validation des restitutions et synchronisation des stocks disponibles).

---

## ✨ Fonctionnalités Principales

1. **Portail Catalogue Public (`/catalogue`) :**
   * Consultation en temps réel des ouvrages répertoriés et de leur statut de disponibilité.
   * Recherche dynamique par titre ou par auteur.
   * Affichage des couvertures téléversées ou génération automatique de couvertures vectorielles SVG par catégorie.
2. **Espace Bibliothécaire Sécurisé :**
   * Authentification par session avec mots de passe hachés via `Bcrypt`.
   * **Gestion des Livres (CRUD) :** Ajout, modification, suppression d'ouvrages et gestion du nombre d'exemplaires.
   * **Gestion des Emprunts & Retours :** Enregistrement d'un prêt avec décrémentation automatique du stock disponible (`disponibles > 0`), suivi des prêts en cours et validation des retours avec réincrémentation automatique du stock.

---

## 🏗️ Architecture Technique (MVC)

```text
biblionet/
├── app/
│   ├── controllers/   # Logique métier (AuthController, LivreController, EmpruntController...)
│   ├── models/        # Requêtes SQL préparées PDO (User, Livre, Emprunt...)
│   └── views/         # Templates HTML5 / Bootstrap 5 (layouts, livres, emprunts, auth)
├── config/
│   └── config.php     # Chargement du .env, constantes DB, helpers XSS e() et SVG
├── core/
│   ├── Controller.php # Classe mère des contrôleurs et middleware requireAuth()
│   └── Database.php   # Singleton de connexion PDO MySQL
├── database/
│   └── biblionet.sql  # Script de création des tables (users, livres, emprunts) et données initiales
├── public/
│   ├── index.php      # Contrôleur frontal (Front Controller) et routeur
│   ├── .htaccess      # Réécriture d'URL vers index.php
│   └── uploads/       # Stockage des couvertures téléversées
├── .env.example       # Modèle de configuration des variables d'environnement
└── .htaccess          # Sécurisation racine et blocage de l'accès au fichier .env
```

---

## 🛡️ Mesures de Sécurité

* **Requêtes préparées PDO :** Protection intégrale contre les injections SQL.
* **Protection XSS :** Échappement systématique des données affichées via la fonction helper `e()`.
* **Hachage Bcrypt :** Mots de passe chiffrés en base de données via `password_hash()` et vérifiés avec `password_verify()`.
* **Protection Serveur (`.htaccess` & `.env`) :** Désactivation du listage des répertoires (`Options -Indexes`), interdiction d'accès HTTP au fichier `.env` et masquage des erreurs PHP en production (`APP_ENV=production`).

---

## ⚙️ Installation en Local (XAMPP / WAMP)

1. **Cloner le dépôt GitHub :**
   ```bash
   git clone https://github.com/TheGoatMarckevin21/biblionet.git
   ```
2. **Importer la base de données :**
   * Ouvrir `phpMyAdmin` (`http://localhost/phpmyadmin`).
   * Créer une base de données nommée `biblionet`.
   * Importer le fichier `database/biblionet.sql`.
3. **Configurer l'environnement :**
   * Dupliquer le fichier `.env.example` en `.env` (ou vérifier les paramètres par défaut dans `config/config.php`).
   * Renseigner vos accès locaux (`DB_HOST=localhost`, `DB_NAME=biblionet`, `DB_USER=root`, `DB_PASS=`).
4. **Lancer l'application :**
   * Accéder à `http://localhost/biblionet/public` dans votre navigateur.