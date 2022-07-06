# Library for Hotify.ru
## Using
Just a few lines of code:
```php
$apiToken = YOUR_TOKEN_HERE;
$appId = YOUR_APP_ID_OR_TAG_HERE; 

$hotify = new Hotify($apiToken);
$hotify
    ->title('First notification') //optional
    ->text('Hello World!')
    ->to($appId)
    ->send();
```       
That's all!

## Laravel

You can use this package as a Laravel logger.

```bash
php artisan vendor:publish --provider="Hotify\Hotify\HotifyServiceProvider" --tag="config"
```
            
Create log config in *config/logging.php*

```php
...
'hotify' => [
    'driver' => 'custom',
    'via'    => \Hotify\Hotify\HotifyLogger::class,
    'level'  => 'debug',
],
...
```

And use it!

```php
Log::channel('hotify')->info('Hello world');
```