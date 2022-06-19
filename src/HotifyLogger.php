<?php

namespace Hotify\Hotify;

use Monolog\Logger;
use Hotify\Hotify\HotifyHandler;

class HotifyLogger
{
    public function __invoke(array $config)
    {
        return new Logger(
            config('app.name'),
            [
                new HotifyHandler($config),
            ]
        );
    }
}
