# 📚 BiblioNet — Système de Gestion de Bibliothèque (Architecture MVC)

Application web développée en **PHP 8 natif (sans framework)** et **MySQL (PDO)** selon le patron d'architecture **Modèle-Vue-Contrôleur (MVC)**.

## 👥 Équipe du projet
- **Membre 1 (Chef de groupe)** : Marc-Kevin — Socle MVC (`Router`, `Database`, `Controller`), Authentification (`AuthController`, `User`), Intégration & Déploiement.
- **Membre 2** : Obone Mba — Module Livres (CRUD complet) & Catalogue public avec recherche multicritères.
- **Membre 3** : Marie Inercia — Base de données SQL, Module Adhérents (CRUD complet) & Gestion des Emprunts/Retours.

---

## 🛠️ Prérequis techniques
- **PHP** >= 8.0 (avec extension `pdo_mysql` activée)
- **MySQL / MariaDB**
- Serveur web Apache (**XAMPP** ou **WAMP**) avec `mod_rewrite` activé

---

## 🚀 Installation en local (5 minutes)

1. **Cloner le dépôt dans le répertoire du serveur web :**
   ```bash
   cd C:/xampp/htdocs
   git clone [https://github.com/TheGoatMarckevin21/biblionet.git](https://github.com/TheGoatMarckevin21/biblionet.git)