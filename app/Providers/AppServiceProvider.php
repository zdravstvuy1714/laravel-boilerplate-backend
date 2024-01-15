<?php

declare(strict_types=1);

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Modules\User\Entities\User;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        // Configuring default password rules.
        Password::defaults(static function (): Password {
            return Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised();
        });

        // Configuring eloquent strictness.
        Model::shouldBeStrict();

        // Setting immutable dates.
        Date::use(CarbonImmutable::class);

        // Setting morph map for polymorphic relations.
        Relation::enforceMorphMap([
            'user' => User::class,
        ]);
    }
}
