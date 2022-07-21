## Installation Guid


- Clone the Repository
- Create .env file in root folder
- Run composer install
- Run php artisan breeze:install
- Run npm install
- Run npm run dev 
- Run php artisan migrate --seed

## Generate App Key
- php artisan key:generate

## (.env) file updates
- Create Database Connection

## Commands
- If you need to fetch latest results from api then run command "php artisan fetch:covid:data"
- Or you can start your scheduler using "php artisan schedule:work" it will be automatically fetch data and update your tables each 5 minutes.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
