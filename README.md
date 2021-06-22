## Run Application

```console
docker-compose up -d
```

### Install dependencies
```console
docker exec -it attr-calc_web composer install
```

### Create (migrate) database
```console
docker exec -it attr-calc_web php artisan migrate
```

### Proceed database with start data
```console
docker exec -it attr-calc_web php artisan db:seed
```

## Access to app: http://localhost:8080/

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
