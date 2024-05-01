# Open_Box

Open_Box est une application web qui permet de gérer les boîtes mails tout en étant personnalisable qui offre des avantages dans une utilisation personel et profesionel.

## Installation :


### du projet :
Clone le projet
```bash
clone http
```

### installation postgres
- installer postgres avec le lien : https://www.postgresql.org/download/
- configurer le '.env' avec les informations de la base de données
- dans le php.ini, décommenter la ligne 
  - 'extension=pdo_pgsql'
  - 'extension=pgsql'

### Installation outil de debug de laravel
```bash
composer require barryvdh/laravel-debugbar --dev
```
```bash
php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"
```

### Installation des dépendances
```bash
composer install
```

### Lancer le serveur
```bash
php artisan serve
```


