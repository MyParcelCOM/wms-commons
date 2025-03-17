# wms-commons
Library with common classes used for constructing MyParcel.com warehouse management system (MWS) integrations

## PHP 8
The minimum PHP version is `8.4`. To update dependencies on a system without PHP 8 use:
```shell
docker run --rm --mount type=bind,source="$(pwd)",target=/app composer:2 composer update
```

## Run tests
You can run the test through docker:
```shell
docker run -v $(pwd):/app --rm -w /app php:8.4-cli vendor/bin/phpunit
```
