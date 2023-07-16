<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://freepngimg.com/thumb/cart/10-2-cart-png-pic.png" width="250" alt="Cart Logo"></a></p>


# Ecommerce API


Ecommerce API is a simple implementation of cart process in any `Ecommerce Store` with guest checkout enabled.
The APIs are built on `Laravel(10 Framework)`.

## Technology Stack
It is built on Laravel 10.0 `(Latest)` which requires PHP 8.0 + to run it.
* Laravel
* MySQL

The authentication system has been implemneted using third party package `passport`.

## Features
* Login/Register/Logout
* Token based Authentication
* Guest Checkout
* Auth User Checkout
* Merge Cart System On Guest Logged in as Auth User.
* Create Cart
* Add/Remove Cart items.
* View Products & Cart
* PHPUNIT `TEST`
* Event Analytics `Queable`
* Modular Code for easy decoupling and plug in play modules.
* Scalable Database Design.



## Installation

Create `.env` file at the root of the project and add database credentials.

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yourdb
DB_USERNAME=root
DB_PASSWORD=

```


Install composer vendor packages by following command via [composer]

```bash
composer install
```

Run migrations and seeders by following command

```bash
php artisan migrate:fresh --seed
```

Run migrations and seeders by following command

```bash
php artisan passport:install
```

Clear Cache and Routes

```bash
php artisan optimize
```

## Tests

To run the test cases make sure that you have configured the `phpunit.xml` file correclty

sample

```bash
    <php>
        <env name="APP_ENV" value="testing"/>
        <env name="BCRYPT_ROUNDS" value="4"/>
        <env name="CACHE_DRIVER" value="array"/>
        <env name="DB_CONNECTION" value="mysql"/>
        <env name="DB_DATABASE" value="youdbName"/>
        <env name="MAIL_MAILER" value="array"/>
        <env name="QUEUE_CONNECTION" value="sync"/>
        <env name="SESSION_DRIVER" value="array"/>
        <env name="TELESCOPE_ENABLED" value="false"/>
    </php>

```

Run Tests

```bash
php artisan test
```

[composer]:https://getcomposer.org/



## Troubleshooting

Run following commands for troubleshooting

```bash
php artisan optimize
```

```bash
composer du
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)

