<?php

declare(strict_types=1);

namespace App\Providers;

use App\Enum\EnvironmentEnum;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        // Configuring default password rules.
        Password::defaults(function () {
            $rule = Password::min(6);

            return match ($this->app->environment()) {
                EnvironmentEnum::Production->value,
                EnvironmentEnum::Testing->value => $rule
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                EnvironmentEnum::Local->value => $rule,
            };
        });

        // Configuring eloquent strictness.
        Model::shouldBeStrict();

        // Setting immutable dates.
        Date::use(CarbonImmutable::class);
    }
}
