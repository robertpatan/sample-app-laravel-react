## Source code
Back-end main business logic is in ./app/Http and ./database/seeds/DatabaseSeeder

Front-end is in ./resources/react-app. Don't focus on this, I made it fast and messy :)

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
1. run `docker-compose up -d` in the project root folder from a terminal. This will boot up the containers.

If you are using the zip with the dependencies included, skip the next step
2. run `docker exec -it php7.4-mg bash`  - this will give you access to the php container terminal. In there run:
 - `composer install` - installs Laravel framework and dependencies
 - `php artisan key:generate` - generate a key for app encryption
 - `php artisan migrate` - runs the database migrations
 - `php artisan db:seed` t- his will call the provided resource link, parse the data and insert into the database and store the images locally
 - to run tests: `php artisan test --env=testing`. Unit test will use  the .env.testing file so make sure it's correctly set up as well
 - ctrl + c to exit

## Start React App
In the project directory /resources/react-app, you can run: yarn start` or `npm run start` .
The front-end will run on `localhost:3000`

### Framework: https://laravel.com/docs/7.x
### PHP version : 7.4

## Notes
I knowingly broke the Repository pattern by using the model instance in the MovieService class. Why?
Because using a repository pattern on this kinda of project is over engineering. Or on any project where it's not very like to switch the persistance layer.


    public function attachDirector(Movie $movie, array $data): void
    {
        $person = $this->personRepository->insertIfNotExists($data);

        **$movie->directors()->attach($person->id);**
    }



