

## How to start

Start the docker compose in your pc to setting up the enviromment

```shell
docker compose up -d
```
Make the migration and create a user in the first steps

```shell
docker exec app php artisan migrate
docker exec app php artisan fillament:upgrade
```
## Using the skeleton

Try to navigate on localhost
``
http://localhost:8000/admin
``

And use the created user to login
