# BileMo

***
| Projet 7 OC - BileMo est une entreprise offrant toute une sélection de téléphones mobiles haut de gamme. Exposiez un certain nombre d’API pour que les applications des autres plateformes web puissent effectuer des opérations |
|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|

## Installation du projet

Cloner le projet sur votre disque dur avec la commande :

```text
git clone https://github.com/duffman033/API.git
```

Ensuite, effectuez la commande "npm install" depuis le répertoire du projet cloné, afin d'installer les dépendances nécessaires :

```text
npm install
```

### Base de données

Le projet ne possède pas de base de données, c'est pourquoi vous allez devoir en créer une.
Ajoutez les paramètre de connection à votre server Mysql dans le fichier .env

```text
DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8&charset=utf8mb4"
```

Maintenant que vos paramètres de connexion sont configurés, Doctrine peut créer le db_name base de données pour vous: 

```text
php bin/console doctrine:database:create
```

Pour avoir la structure nécessaire au bon fonctionnement du projet vous devez utiliser :

```text
php bin/console make:migration
```
Suivie de : 

```text
php bin/console doctrine:migrations:migrate
```

Après avoir créer votre base de données, vous pouvez également injecter un jeu de données en effectuant la commande suivante :

```text
php bin/console doctrine:fixtures:load
```

## Lancer le projet

*   Pour lancer le serveur, effectuez un `symfony serve:start`.

### Bravo, le projet est désormais accessible à l'adresse : http://127.0.0.1:8000
