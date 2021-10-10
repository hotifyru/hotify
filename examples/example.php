<?php

use Hotify\Hotify\Hotify;

require __DIR__ . '/../vendor/autoload.php';

$hotify = new Hotify('YOUR_TOKEN');
$hotify
    ->title('First notification')
    ->text('Hello world!')
    ->to(1)
    ->send();