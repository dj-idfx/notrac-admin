# Notrac Admin

Notrac administrator CMS: Take control over content in a simple & elegant way.

## Quick guide for local development:
- Clone the [GitHub repo](https://github.com/dj-idfx/notrac-admin)   
- Install composer dependencies: `composer install`   
- Update .env file (app key, database, mail, ...)   
- Install node packages and build: `npm install && npm run build`     
  When using Powershell terminal: `npm install; npm run build`   
- Migrate database: `php artisan migrate`   
- Optional db seed: `php artisan db:seed`   
- Run local hosting: `php artisan serve`   
  When using Laragon or another local server go to https://notrac-admin.local  

### created with:
- [Laravel 9](https://laravel.com/): the PHP Framework for Web Artisans
- [Bootstrap 5](https://getbootstrap.com/): the most popular HTML, CSS, and JS library in the world.


## Composer packages

[getcomposer.org](https://getcomposer.org/)

Install the packages defined in the **composer.json** file.
All files will be installed in the **vendor** directory:

```
composer install 
```

**Check out this overview of cool packages I used for this project:**

### IDE Helper Generator

Complete **PHPDocs**, directly from the source.  
Package is registered in **AppServiceProvider**, settings can be found in the **ide-helper.php** file inside the **config** folder.    
Docs are generated automatically after running `composer install`   
[Barry Github](https://github.com/barryvdh/laravel-ide-helper)       
`composer require --dev barryvdh/laravel-ide-helper`  

### Breeze

**Authentication** scaffolding for Laravel (Controllers, Requests & Views).   
[Official documentation](https://laravel.com/docs/9.x/starter-kits#breeze-and-blade)    
`composer require --dev laravel/breeze`   

### Laravel Permission

Associate users with **permissions** and **roles**.   
Settings can be found in the **permission.php** file inside the **config** folder.  
[Official documentation](https://spatie.be/docs/laravel-permission/v5)    
[Spatie Github](https://github.com/spatie/laravel-permission)       
`composer require spatie/laravel-permission`   

### Laravel Sluggable

Generate a unique **slug** when saving any Eloquent model.    
[Spatie Github](https://github.com/spatie/laravel-sluggable)       
`composer require spatie/laravel-sluggable`   

### Laravel Honeypot

Preventing **spam** submitted through **forms**.    
Settings can be found in the **honeypot.php** file inside the **config** folder.   
[Spatie Github](https://github.com/spatie/laravel-honeypot)       
`composer require spatie/laravel-honeypot`

### Laravel Media Library

**Associate files** with Eloquent **models**.    
Settings can be found in the **media-library.php** file inside the **config** folder.  
[Official documentation](https://spatie.be/docs/laravel-medialibrary/)    
[Spatie Github](https://github.com/spatie/laravel-medialibrary/)       
`composer require spatie/laravel-medialibrary`

### LaravelCollective HTML

HTML and **Form** Builders.  
[Official documentation](https://laravelcollective.com/docs/6.x/html)    
[LaravelCollective Github](https://github.com/LaravelCollective/html)       
`composer require laravelcollective/html`

### Log Viewer

Log Viewer helps you quickly and clearly see individual **log entries**,   
to search, filter, and make sense of your Laravel logs fast.  
[Opcodesio Github](https://github.com/opcodesio/log-viewer)       
`composer require opcodesio/log-viewer`   


## NPM packages

### Bootstrap 5 + Icons   
Powerful, extensible, and feature-packed **frontend toolkit**.   
[Official website](https://getbootstrap.com/)   
`npm i --save bootstrap @popperjs/core`   
`npm i --save-dev sass`
`npm i bootstrap-icons`

### Quill 
Your powerful **rich text editor**.   
[Official website](https://quilljs.com/)   
`npm install quill`   

### Dropzone
A JavaScript library to add **file drag and drop** functionality to web forms  
[Official website](https://www.dropzone.dev/)   
`npm install dropzone`   
