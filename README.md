# Laravel Userstamps

Laravel Userstamps is a simple Laravel package for your Eloquent Model user specific fields.
This package automatically inserts/updates an user id on your table on who created, last updated and deleted the record.

## Install
1. Add repositories in composer.json

```
composer require fnematov/laravel-userstamps
```
## Usage

Update your model's migration and add `created_by`, `updated_by` and `deleted_by` field using the `userstamps()` blueprint macro.

```php
Schema::create('users', function (Blueprint $table) {
    $table->userstamps();
});
```

Then use `UserstampsTrait` on your model.

``` php
namespace App;

use Fnematov\LaravelUserstamps\UserstampsTrait;

class User extends Model
{
    use UserstampsTrait;
}
```

## Dropping columns

You can drop auditable columns using `dropUserstamps()` method.

```php
Schema::create('users', function (Blueprint $table) {
    $table->dropUserstamps();
});
```

And your done!


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
