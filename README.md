# Basic boilerplate application based on "Laravel" framework with modular structure
> The focus of boilerplate is on developing headless API applications.

## Application setup & launch
1. Copy the base application configuration:
`cp .env.example .env`
2. Installing composer dependencies for existing application: 
`
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
`
3. Running migrations: `php artisan migrate`
4. Running seeders: `php artisan db:seed`
5. Run code static analyser & style fixer (PHPStan & Pint): `composer analyse`
