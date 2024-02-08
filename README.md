
Kit de démarrage Laravel 10 avec Vue.js
Dans cette expérience d'apprentissage complète, nous explorons la puissante combinaison de Laravel 10, un framework d'application Web PHP renommé, et de Vue.js, un framework JavaScript progressif. Explorons l'intégration transparente des robustes capacités backend de Laravel avec les composants frontend réactifs de Vue.js, ouvrant ainsi un monde de possibilités pour créer des solutions Web évolutives, efficaces et riches en fonctionnalités.

1. Création du projet laravel-vue

```bash
composer global require laravel/installer
```
```bash
laravel new app_vino
```
 
2. Kit de démarrage avec Breeze, Vue et MySQL

1. Choisissez Breeze 
2. Choisissez Vue
3. Choisissez TypeScript (experimental) 
4. Choisissez PHPUnit
5. Choisissez Yes 
6. Choisissez MySQL


Configurez le fichier Laravel .env :

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8889
DB_DATABASE=projetweb2
DB_USERNAME=root
DB_PASSWORD=root

cd vino

----

commande pour commencer le projet 

Installer le gitignore:

vendor:
composer install

node_module:
npm install

Creer un fichier .env :
Prendre le model .env.exemple
Changer la config comme en haut.

-----
npm run build
npm run dev

-----

MySQL:

create database app_vino;


php artisan migrate

php artisan serve


----------
http://localhost:5173/
