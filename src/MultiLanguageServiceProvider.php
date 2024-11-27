<?php

namespace OpenAdmin\MultiLanguage;

use Illuminate\Support\ServiceProvider;
use OpenAdmin\Admin\Facades\Admin;
use OpenAdmin\Admin\Form;
use OpenAdmin\MultiLanguage\Extensions\LangTab;

class MultiLanguageServiceProvider extends ServiceProvider
{
    /**
     * @inheritdoc
     */
    public function boot(MultiLanguage $extension)
    {
        if (!MultiLanguage::boot()) {
            return;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'multi-language');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/open-admin-ext/multi-language')],
                'multi-language'
            );
        }

        Admin::booting(function () {
            //Form::forget(['hasMany']);
            Form::extend('langTab', LangTab::class);
            //Form::extend('hasMany', HasMany::class);
        });

        $this->app->booted(function () {
            MultiLanguage::routes(__DIR__.'/../routes/web.php');
        });
    }
}
