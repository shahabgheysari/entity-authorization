# Entity Authorization For Laravel 5.2
Simple,Small and Powerful! package for handling an entity authorization in Laravel 5.2.
It was part of a big package that i developed for a project (don't worry! i take care of copyright,the project was failed!).
Based on the [dcn/rbac](https://github.com/mbm-rafal/RBAC) Package.The RBAC package has an entity authorization solution but because we needed an specilized one we developed our own package.


Entity: based on entity definition! In my package I considered Page as an entity! A Form,Field,Menu can be considered as an entity.In general,I mean any object that you need to authorize,which can be accessed by logged-in user.

The Page entity is considered (as a sample) to authorize user for visit any page(route),either by the middlewares or in views by blade commands.

## Usage
Sorry,I didn't publish it on any Package Repository. If you find it usefull following below steps. Have a good development!

 **1. Read RBAC documnet before starting**
 
[RBAC GitHub Page](https://github.com/mbm-rafal/RBAC).


 **2. Clone project**
 
clone this rep and copy in `vendor` folder

 **3. Update root composer.json.**

update PSR-4 section of your root composer file.
```js
"psr-4": {
            "App\\": "app/",
            "Shahab\\EA\\":"vendor/shahab/src"
        }
    },
```
yours may be different.just add ` "Shahab\\EA\\":"vendor/shahab/src"` to this section.
After that run `composer du` command inside terminal!

**4. Add middlewars**

To use package middlewares edit `app/Http/Kernel.php` file.
```php
/**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'EARole' => \Shahab\EA\Middlewares\EARole::class,
        'EAPermission' => \Shahab\EA\Middlewares\EAPermission::class,
    ];

```

this is a sample of middlware usage:
```php
Route::get('/createpermission', ['middleware'=>['auth','EAPermission:Shahab\EA\Models\Page,name,createpermission'],'uses'=>'HomeController@create_permission']);
```
A middlware has 3 parameters: 

1- `$entityFullyQualifiedName`: the namespace of entity(model).

2- `$entitySearchField`: The name of entity table field that should be searched(id,name,...).

3- `$entitySearchValue`: The value of entity that should be authorized.

In above example i am going to authorize user for accessing to `createpermission` page.

**5- Migration**

Publish the package migration file to your application.

    php artisan vendor:publish --provider="Shahab\EA\EAServiceProvider" --tag=migrations

And also run migrations.

    php artisan migrate
    
after `migrate` command done, Page entity table and two other tables have been added as a sample for testing the package. you can change `page` word in migration file and create your own entity tables. your entity is a model that can be exist or be placed anywhere that you want to be. also it can have necessary fileds based on your design.(it is a model with two related tables that have Many-to-Many relations).

In your model,implement `HasRoleAndPermission` contract and also Include `HasRoleAndPermission` & `Authorize` traits 

```php
use DCN\RBAC\Traits\HasRoleAndPermission as HasRoleAndPermissionTrait;
use DCN\RBAC\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Shahab\EA\Traits\Authorize;

class Page extends Model implements HasRoleAndPermissionContract
{
    use HasRoleAndPermissionTrait,Authorize;
```

For relation definition you can override RBAC package definition of `userPermissions()` and `roles()` methods:
Due to alphabetical order of the related model names ([see laravel doc](https://laravel.com/docs/5.2/eloquent-relationships#many-to-many)) I had an exception: `page_permission table dosen't exist`. By default query builder make query for `page_permission` but my table name is `permission_page`.

```php

     /**
     * override RBAC trait function
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function userPermissions()
    {
        return $this->belongsToMany(config('rbac.models.permission'),'permission_page')->withTimestamps()->withPivot('granted');
    }

```


**6- Service Provider**

Add the package to your application service providers in `config/app.php` file
```php
'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
       

        /*
         * Application Service Providers...
         */
       
        Shahab\EA\EAServiceProvider::class,

    ],
    
    
    
    'aliases' => [

        'EA'=> Shahab\EA\EntityAuthorization::class,

    ],

```