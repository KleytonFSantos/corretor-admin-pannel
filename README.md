

## How to start

Copy the .env.example in .env inside the project folder

```shell
cp .env.example .env
```
Start the docker compose in your pc to setting up the enviromment

```shell
docker compose up -d
```
Make the migration and create a user in the first steps

```shell
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed
```
## Using the skeleton

Try to navigate on localhost
``
http://localhost:8000/admin
``

And use the created user to login

```
Credentials 

cpf: 12345678911
password: password
```
