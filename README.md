Laravel 5 Admin Amazing blog
======================
after install this packages, you need install base admin
[adminamazing](https://github.com/selfrelianceme/adminamazing)
and [Intervention Image](https://github.com/Intervention/image)

-----------------
Install via composer
```
composer require selfreliance/iblog
```

Make migrations
```
php artisan migrate
```

Go to `http://myapp/admin/blog` to view admin amazing

**Move public fields** for view customization:

```
php artisan vendor:publish
``` 


Controller for admin in file `IblogController.php`

- Add news in function `add`

- Delete news in function `destroy`

- Edit news in function `update`

Example controller for main site in file `NewsController.php` 

- Function `trim_text` cuts the text to the specified length

- Function `show` displays all the news or selected one news item

