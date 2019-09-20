<?php
namespace JCFutch\UIKit3Presets;

use Artisan;
use Illuminate\Support\Arr;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset;

class UIKit3Preset extends Preset
{
    /**
     * Install the preset.
     *
     * @return void
     */
    public static function install()
    {
        static::removeOtherFrameworks();
        static::updatePackages();
        static::updateWebpackConfiguration();
        static::updateBootstrapping();
        static::removeNodeModules();
    }

    /**
     * Runs the "none" preset to clean up stuff first
     *
     * @return void
     */
    protected static function removeOtherFrameworks()
    {
        Artisan::call('preset',[
            'type' => 'none'
        ]);
    }

    /**
     * Update the given package array.
     *
     * @param  array  $packages
     * @return array
     */
    protected static function updatePackageArray(array $packages)
    {
        return ['uikit' => '^3.2.0'] + Arr::except($packages, [
            'bootstrap',
            'popper.js'
        ]);
    }

    /**
     * Update the Webpack configuration.
     *
     * @return void
     */
    protected static function updateWebpackConfiguration()
    {
        $mixPath = base_path('vendor/laravel/framework/src/Illuminate/Foundation/Console/Presets/vue-stubs/webpack.mix.js');
        copy($mixPath, base_path('webpack.mix.js'));
    }

    /**
     * Update the bootstrapping files.
     *
     * @return void
     */
    protected static function updateBootstrapping()
    {
        copy(__DIR__.'/includes/app.scss', resource_path('sass/app.scss'));

        tap(new Filesystem, function ($filesystem) {

            $bootstrapJs = str_replace(
                "require('bootstrap');",
                "window.UIkit = require('uikit');",
                $filesystem->get(resource_path('js/bootstrap.js'))
            );

            $bootstrapJs = str_replace("window.Popper = require('popper.js').default;", '', $bootstrapJs);

            $filesystem->put(resource_path('js/bootstrap.js'), $bootstrapJs);
        });
    }

    /**
     * Copies in UIKit auth templates
     *
     * @return void
     */
    public static function addAuthTemplates()
    {
        tap(new Filesystem, function ($filesystem) {
            $filesystem->copyDirectory(__DIR__.'/includes/views', resource_path('views'));
        });
    }
}
