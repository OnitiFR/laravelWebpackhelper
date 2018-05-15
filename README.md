
## WebPackHelper ##
 
### Installation ###
 
```
    composer require oniti/docga-api
```
 
The next required step is to add the service provider to config/app.php :
```
    Oniti\DocgaApi\DocgaApiServiceProvider::class,
```

### Publish ###
 
The last required step is to publish views and assets in your application with :
```
    php artisan vendor:publish
```