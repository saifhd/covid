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
- Copy .env.example and create .env file or simply run cp .env.example .env
- Update valid data fetch url for COVID_API_URL=https://hpb.health.gov.lk/api/get-current-statistical
- Create Database Connection

## Commands
- If you need to fetch latest results from api then run command "php artisan fetch:covid:data"
- Or you can start your scheduler using "php artisan schedule:work" it will be automatically fetch data and update your tables each 5 minutes.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
