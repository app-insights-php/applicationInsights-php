## Build and Unit Test

Unit tests uses `phpunit`. You'd need to install dependencies using composer.

From the root folder:

``` sh
composer install
cd tools
composer install
cd ..
composer test
composer cs:php:fix
```