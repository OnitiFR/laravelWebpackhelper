
## WebPackHelper ##
 
### Installation ###
 
```
    composer require oniti/webpack-helper
```
 
The next required step is to add the service provider to config/app.php :
```
    Oniti\WebPackHelper\WebpackHelperProvider::class,
```

### Publish ###
 
The last required step is to publish views and assets in your application with :
```
    php artisan vendor:publish
```