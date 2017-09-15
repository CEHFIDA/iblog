Laravel 5 Admin Amazing blog
======================
after install this packages, you need install base admin
[adminamazing](https://github.com/selfrelianceme/adminamazing)

-----------------
Install via composer
```
composer require selfreliance/iblog
```

Add Service Provider to `config/app.php` in `providers` section
```php
Selfreliance\Iblog\IblogServiceProvider::class,
```

Go to `http://myapp/admin/blog` to view admin amazing

**Move public fields** for view customization:

```
php artisan vendor:publish
``` 
