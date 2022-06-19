<?php

namespace Hotify\Hotify;

use Monolog\Logger;
use Hotify\Hotify\Hotify;
use Monolog\Formatter\LineFormatter;
use Monolog\Formatter\FormatterInterface;
use Monolog\Handler\AbstractProcessingHandler;

class HotifyHandler extends AbstractProcessingHandler
{
    private $config;
    private $token;
    private $appId;
    private $hotify;

    public function __construct(array $config)
    {   
        $level = Logger::toMonologLevel($config['level']);

        parent::__construct($level, true);

        $this->config = $config;
        $this->token = $this->getConfigValue('token');
        $this->appId   = $this->getConfigValue('app_id');
        $this->hotify = new Hotify($this->token);
    }

    /**
     * @param array $record
     */
    public function write(array $record): void
    {
        $this->hotify
            ->to($this->appId)
            ->title($record['level_name'])
            ->text($record['formatted'])
            ->send();
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultFormatter(): FormatterInterface
    {
        return new LineFormatter("%message% %context% %extra%\n", null, false, true);
    }

    /**
     * @param string $key
     * @param string $defaultConfigKey
     * @return string
     */
    private function getConfigValue($key, $defaultConfigKey = null): string
    {
        if (isset($this->config[$key])) {
            return $this->config[$key];
        }
        
        return config($defaultConfigKey ?: "hotify.$key");
    }
}
