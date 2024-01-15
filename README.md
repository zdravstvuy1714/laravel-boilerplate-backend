# Basic boilerplate application based on "Laravel" framework with modular structure
> The focus of boilerplate is on developing headless API applications.

## Basic advantages of the boilerplate:
1. The official "Laravel Sail" wrapper over docker with PHP version 8.2 was chosen as the development environment
2. Configured code style fixer "Laravel Pint" `composer pint`
3. Configured static analyser "PHPStan" `composer phpstan`
4. Configured the configuration and custom stubs for the module generator "Laravel Modules"
5. Configured eloquent strictness
6. CarbonImmutable used by default instead Carbon
7. "Laravel Pint" configuration requires final classes (_final_class_) and strict types (_declare_strict_types_)
8. Convert responses to JsonResponse via ConvertResponsesToJSON middleware
9. Configured basic authentication for Horizon using `HORIZON_USERNAME` and `HORIZON_USERNAME` credentials at .env
10. Configured basic authentication for Telescope using `TELESCOPE_USERNAME` and `TELESCOPE_USERNAME` credentials at .env

## Application setup & launch
1. Copy the base application configuration:
`cp .env.example .env`
2. Installing composer dependencies for existing application: 
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```
3. Launch application: `./vendor/bin/sail up -d`
4. Running migrations: `php artisan migrate`
5. Running seeders: `php artisan db:seed`
6. Run code static analyser & style fixer (PHPStan & Pint): `composer analyse`

## Useful packages installed by default:
- laravel/pint (Code style fixing)
- laravel/horizon (Redis queues monitoring dashboard)
- laravel/telescope (Application requests monitoring dashboard)
- nwidart/laravel-modules (Modular project structure)
- spatie/laravel-data (Transformation of output data)
- spatie/laravel-fractal (Data transfer object)
- roave/security-advisories (Packages security vulnerabilities)
- nunomaduro/larastan (Static analysis)
- archtechx/enums (Extending default PHP enums via traits)

## Framework changes:
- Since the boilerplate focuses on the headless API of the application, the following changes were made to the framework:
  - Removed web.php routes file from routes folder
  - Removed web route mapping from RouteServiceProvider
  - Removed 'web' group from middlewareGroups in Kernel
  - Changed stubs path in module generator configuration to custom _stubs/api_
