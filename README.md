## Env deployment
I used Docker to setup my env. The containers info is found in the `docker-compose.yml`.
Docker Compose is included in the Docker client. https://docs.docker.com/compose/install/

If you do not want to use Docker you need to setup your own PostgreSQL, Redis, Nginx and PHP 7.4 with posgreSQL and redis support and add the credentials
to the .env file in the project root.

### First step
After you place the application in a project directory, copy the `.env.example` file and rename it to `.env`.
Edit the `.env` file and  fill in the variables with the correct information. They are preset to match the docker containers

## Docker
### Web Server Setup
Will serve by default from localhost on port 80.
If you want a custom local domain name for the app, go to `docker/nginx/sites-available/default.conf`,
modify the `serve_name` directive from `_` to ex: `mg-app.local`, then if you are using a unix based OS, add an
entry to you `/etc/hosts` to map the local domain to localhost: `127.0.0.1  mg-app.local`.

## App Deployment
run `docker-compose up -d` in the project root folder from a terminal. This will boot up the containers.
run `docker exec -it php7.4-blog bash`  this will give you access to the php container terminal. In there run:
 - `composer install`
 - `php artisan key:generate`
 - `php artisan migrate`
 - `php artisan db:seed` this will call the provided resource link, parse the data and insert into the database and cache the images
 - ctrl + c to exit

## Start React App
In the project directory /resources/react-app, you can run:
### `yarn start` or `npm run start`

## Testing
### run `php artisan test --env=testing`

### Framework: https://laravel.com/docs/7.x
### PHP version : 7.4
