<?php

use Hotify\Hotify\Hotify;

require __DIR__ . '/../vendor/autoload.php';

$hotify = new Hotify('YOUR_TOKEN');
$hotify
    ->title('Hi')
    ->text('Just notification')
    ->to(1)
    ->send();