# Notrac Admin

Notrac administrator CMS: Take control over content in a simple & elegant way.

## Quick guide for local development:
- Clone the git repo
- Install composer dependencies: `composer install`
- Update .env file (database, mailer, app key, ...)
- Install node packages and build: `npm install && npm run build`   
  When using Powershell terminal: `npm install; npm run build`
- Migrate database: `php artisan migrate`
- Optional db seed: `php artisan db:seed`
- Run local hosting: `php artisan serve`  
  When using Laragon or another local server go to https://notrac-admin.local  

### created with:
- [Laravel 9](https://laravel.com/), the PHP Framework for Web Artisans
- [Bootstrap 5](https://getbootstrap.com/), the most popular HTML, CSS, and JS library in the world.


## Composer packages

[getcomposer.org](https://getcomposer.org/)

Install the packages defined in the **composer.json** file.
All files will be installed in the **vendor** directory:

```
composer install
```

### IDE Helper Generator

Complete **PHPDocs**, directly from the source.  
Package is registered in **AppServiceProvider**, settings can be found in the **ide-helper.php** file inside the **config** folder.    
Docs are generated automatically after running `composer install`   
[Barry Github](https://github.com/barryvdh/laravel-ide-helper)       
`composer require --dev barryvdh/laravel-ide-helper` 

### Laravel Breeze

**Authentication** scaffolding (Breeze & Blade).   
[Official documentation](https://laravel.com/docs/9.x/starter-kits#breeze-and-blade)    
`composer require --dev laravel/breeze`

### Laravel Permission

Associate users with **permissions** and **roles**.   
Settings can be found in the **permission.php** file inside the **config** folder.  
[Official documentation](https://spatie.be/docs/laravel-permission/v5)    
[Spatie Github](https://github.com/spatie/laravel-permission)       
`composer require spatie/laravel-permission`


## NPM packages

### Bootstrap 5 + Icons
`npm i --save bootstrap @popperjs/core`   
`npm i --save-dev sass`
`npm i bootstrap-icons`
