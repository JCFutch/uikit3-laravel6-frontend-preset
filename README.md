# Laravel 6 UIKit Frontend Preset

Adds a preset for UIKit 3 scaffolding on new Laravel 6.0+ projects, will add individual SASS components and import the UIKit 3 core javascript.


## Usage

1- Install via composer `composer require jcfutch/uikit3-laravel6-frontend-preset`.

2- The package should use Laravel's new auto discovery. If not,  you can manually register the service provider - typically done inside the `app.php` providers array e.g `JCFutch\UIKit3Laravel6Preset\UIKit3Laravel6PresetServiceProvider::class`.

3- Run `php artisan preset uikit3` this will generate the js and scss needed.

4- *Optional* If you need `make:auth` to use uikit, run `php artisan preset uikit3-auth` to generate the templates.

5- *Optional* You can then run something like the vuejs or react presets as well.

## Warning

This replaces the default Laravel auth scaffolding, so if you want to revert to Bootstrap, you'll need to run `artisan ui:auth` again to overwrite it.
