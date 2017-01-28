# API DOCUMENTATION

Composer Install
Run php artisan migrate
Run php artisan passport:install

## Swagger Implementation

Run php artisan l5-swagger:publish to publish everything
Run php artisan l5-swagger:publish-config to publish configs (config/l5-swagger.php)
Run php artisan l5-swagger:publish-assets to publish swagger-ui to your public folder (public/vendor/l5-swagger)
Run php artisan l5-swagger:publish-views to publish views (resources/views/vendor/l5-swagger)
Run php artisan l5-swagger:generate to generate docs or set L5_SWAGGER_GENERATE_ALWAYS param to true in your config or .env file given to .env.example

## Dingo Implementation

copy from .env.example to .env to specify version of API


#CMS DOCUMENTATION

- Clone CMS from https://github.com/hgurung/cms.git
- Run Composer Install
- Set Permission 777 to storage and bootstrap folder
- Run php artisan key:generate from terminal
- Setup .env with database and PREFIX
- Run php artisan migrate
- Run php artisan db:seed
