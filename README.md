# Library for Hotify.ru
## Using
Just a few lines of code:

    $apiToken = YOUR_TOKEN_HERE;
    $appId = YOUR_APP_ID_HERE;
    
    $hotify = new Hotify($apiToken);
    $hotify
        ->title('First notification') //optional
        ->text('Hello World!')
        ->to($appId)
        ->send();
            
That's all!
            