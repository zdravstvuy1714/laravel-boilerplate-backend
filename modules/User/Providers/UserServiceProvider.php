<?php

declare(strict_types=1);

namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;

final class UserServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'User';

    protected string $moduleNameLower = 'user';

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    public function boot(): void
    {
        $this->registerConfig();
        $this->registerTranslations();
        $this->registerViews();
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

    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath,
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    protected function loadMigrations(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];

        /** @var array<string> $viewPaths */
        $viewPaths = config('view.paths');

        foreach ($viewPaths as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }

        return $paths;
    }
}
