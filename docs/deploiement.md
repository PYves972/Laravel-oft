# Procédure de déploiement — Ôft Atelier

## 1. Objet

Ce document décrit le déploiement de l'application Ôft Atelier sur Render : configuration de l'environnement de production, démarrage de l'application, initialisation de la base de données et contrôles après la mise en ligne.

- Dépôt du code source : https://github.com/PYves972/Laravel-oft
- Application en production : https://laravel-oft-1.onrender.com

## 2. Environnement technique

| Élément                    | Valeur                                              |
| -------------------------- | --------------------------------------------------- |
| Application                | Ôft Atelier                                         |
| Framework                  | Laravel 13.30.1                                     |
| Langage                    | PHP 8.4 (image `php:8.4-cli`)                       |
| Interface d'administration | Filament                                            |
| Front-end                  | Vite, Tailwind CSS (Node.js 22 pour la compilation) |
| Conteneurisation           | Docker                                              |
| Hébergement                | Render                                              |
| Base de données            | PostgreSQL                                          |
| Gestion du code source     | Git et GitHub                                       |

## 3. Configuration de la production

Les paramètres propres à la production sont définis dans les variables d'environnement de Render, et non dans le dépôt. Le fichier `.env` n'est pas versionné ; seul `.env.example` l'est, comme modèle.

Variables à renseigner :

- `APP_ENV=production` et `APP_DEBUG=false`
- `APP_KEY` : clé de l'application (générée avec `php artisan key:generate --show`)
- `APP_URL` : adresse publique de l'application, en `https://` (le schéma HTTPS est forcé par l'application en production pour chiffrer les échanges)
- `DB_CONNECTION=pgsql` et les paramètres de connexion à la base PostgreSQL (hôte, port, nom de la base, utilisateur, mot de passe), fournis par Render
- `PORT` : fourni automatiquement par Render

Aucune valeur secrète ne doit figurer dans ce document ni dans le dépôt Git.

## 4. Préparation et démarrage de l'application

### 4.1 Construction de l'image (Dockerfile)

Le `Dockerfile` à la racine du dépôt réalise les opérations suivantes :

1. Utilise l'image `php:8.4-cli` et installe les extensions PHP nécessaires (`intl`, `pdo_pgsql`, `pdo_mysql`, `mbstring`, `zip`, `bcmath`, `exif`).
2. Installe Composer et Node.js 22.
3. Copie le code de l'application dans `/var/www/html`.
4. Installe les dépendances PHP : `composer install --no-dev --optimize-autoloader`.
5. Installe les dépendances Node et compile les assets : `npm install` puis `npm run build`.
6. Crée le lien de stockage des images : `php artisan storage:link`.
7. Ajuste les permissions de `storage` et `bootstrap/cache`.

### 4.2 Démarrage du conteneur

La commande de démarrage (`CMD` du Dockerfile) est :

```bash
php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
```

Elle applique les migrations en attente, puis lance le serveur sur l'adresse `0.0.0.0` et sur le port fourni par Render (variable `PORT`, avec 10000 par défaut, également déclaré avec `EXPOSE 10000`).

## 5. Initialisation de la base de données

L'application utilise PostgreSQL en production.

**Structure.** Les migrations Laravel définissent les tables et les relations. Elles sont appliquées à chaque démarrage avec `php artisan migrate --force`, qui n'exécute que les migrations non encore appliquées.

**Données initiales.** Elles sont insérées une seule fois, après la première migration, depuis le Shell Render :

```bash
php artisan db:seed --force
```

Cette commande exécute `DatabaseSeeder`, qui crée les trois services (Formations, Ateliers, Confections) puis appelle les seeders issus de la base réelle : catégories, tags, formations, documents pédagogiques, commentaires, progressions et témoignages.

**Clés étrangères.** Pour éviter les erreurs d'insertion liées à l'ordre des tables, `DatabaseSeeder` désactive temporairement les contraintes (`Schema::disableForeignKeyConstraints()`) puis les réactive à la fin (`Schema::enableForeignKeyConstraints()`), de manière compatible avec PostgreSQL.

**Attention.** `TrainingsTableSeeder` vide d'abord la table `trainings` : `TRUNCATE TABLE trainings CASCADE` sous PostgreSQL, `delete()` sur les autres bases. Comme les clés étrangères sont en cascade, cela supprime aussi les sessions, les réservations et les documents liés. Aucun seeder appelé par `DatabaseSeeder` ne recrée les sessions ni les réservations : elles seraient donc perdues définitivement. Le seeder ne doit être lancé qu'une seule fois, juste après la première migration, et jamais sur une base contenant des données réelles. Le démarrage du conteneur n'exécute que les migrations, jamais les seeders. Pour repartir de zéro, uniquement sur un environnement de test :

```bash
php artisan migrate:fresh --seed --force
```

Cette commande supprime toutes les données et ne doit jamais être utilisée sur la base de production.

## 6. Vérifications après déploiement

Contrôles effectués le 17/10/2026 (après correction du `CMD` du Dockerfile) sur https://laravel-oft-1.onrender.com :

| Point contrôlé                                   | Résultat                                                                                                                                                                                               |
| ------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| Logs Render (déploiement, migrations, démarrage) | Déploiement du 17/10/2026 à 20:46 : « Nothing to migrate » (migrations déjà à jour), serveur lancé sur le port 10000, « Your service is live ». Aucune ligne de seeding au démarrage et aucune erreur. |
| Page d'accueil                                   | S'affiche                                                                                                                                                                                              |
| Images                                           | S'affichent correctement                                                                                                                                                                               |
| Pages de formations et de catégories             | Affichent les données issues de la base                                                                                                                                                                |
| Panel d'administration Filament                  | Accès fonctionnel                                                                                                                                                                                      |

Problèmes rencontrés et corrigés lors de la mise en production : connexion à la base de données, port d'écoute du serveur, contraintes de clés étrangères lors du seeding, affichage de certaines images, et seeding exécuté à chaque démarrage du conteneur (`db:seed` retiré du `CMD`, corrigé le 17/10/2026).

## 7. Traçabilité et maintenance

- Les modifications et corrections sont suivies dans Git ; l'historique des commits permet de retrouver les évolutions de configuration.
- Un nouveau déploiement reconstruit l'image Docker à partir du code du dépôt GitHub.
- Avant toute migration risquée, sauvegarder la base PostgreSQL depuis Render.
- En cas de problème, consulter les logs Render, puis revenir au commit précédent si nécessaire.

## 8. Points d'attention connus

- Le serveur utilisé est `php artisan serve`, prévu à l'origine pour le développement. Il est suffisant pour une démonstration, mais un serveur web dédié (Nginx ou Apache avec PHP-FPM) serait préférable pour un usage intensif.
- Le système de fichiers d'un service Render n'est pas persistant par défaut : les fichiers envoyés par les utilisateurs dans `storage` peuvent disparaître à chaque redéploiement, sauf utilisation d'un disque persistant ou d'un stockage externe.
- Plusieurs seeders existent dans `database/seeders` (`CategoryTrainingSeeder`, `TrainingSeeder`, `TrainingSessionSeeder`, `TrainingCalendarSeeder`) sans être appelés par `DatabaseSeeder`.
- `TrainingsTableSeeder` est destructif (vidage de `trainings` en cascade) et `DatabaseSeeder` n'est pas idempotent (les services seraient dupliqués). Amélioration possible : utiliser `updateOrCreate` (sur le `slug` pour les formations, sur le titre pour les services), ou bloquer l'exécution si les tables contiennent déjà des données.
