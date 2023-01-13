<?php

declare(strict_types=1);

namespace Modules\Blog\Providers;

use Illuminate\Support\ServiceProvider;

final class BlogServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Blog';

    protected string $moduleNameLower = 'blog';

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    public function boot(): void
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->loadMigrations();
    }

    protected function registerConfig(): void
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path("{$this->moduleNameLower}.php"),
        ], 'config');

        $this->mergeConfigFrom(module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower);
    }

    protected function registerTranslations(): void
    {
        $langPath = resource_path("lang/modules/{$this->moduleNameLower}");

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'Resources/lang'));
        }
    }

    protected function loadMigrations(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }
}
