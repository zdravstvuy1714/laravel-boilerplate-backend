<?php

declare(strict_types=1);

namespace App\Providers;

use App\Enum\EnvironmentEnum;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use UnhandledMatchError;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        /** @var string $environment */
        $environment = $this->app->environment();

        // Configuring default password rules.
        Password::defaults(static function () use ($environment) {
            $rule = Password::min(8);

            return match ($environment) {
                EnvironmentEnum::Production->value,
                EnvironmentEnum::Testing->value => $rule
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                EnvironmentEnum::Local->value => $rule,
                default => throw new UnhandledMatchError($environment),
            };
        });

        // Configuring eloquent strictness.
        Model::shouldBeStrict();

        // Setting immutable dates.
        Date::use(CarbonImmutable::class);
    }
}
