<?php

namespace JCFutch\UIKit3Laravel6FrontendPreset;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\PresetCommand;

class UIKit3Laravel6PresetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        PresetCommand::macro('uikit3', function ($command) {
            $command->info('UIKit3 frontend scaffolding installed successfully.');
            $command->comment('Please run "npm install && npm run dev" to compile the new frontend scaffolding.');
            UIKit3Laravel6Preset::install();
        });

        PresetCommand::macro('uikit3-auth', function ($command) {
            $command->info('UIKit3 frontend auth scaffolding installed successfully.');
            UIKit3Laravel6Preset::addAuthTemplates();
        });
    }
}
