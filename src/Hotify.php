<?php

namespace Hotify\Hotify;

use GuzzleHttp\Client;
use Hotify\Hotify\NotificationPriority;
use GuzzleHttp\Exception\ClientException;


class Hotify
{
    const URL = 'https://hotify.pw/api/v1/';

    public function __construct(string $token)
    {
        $this->token = $token;
        $headers = [
            'Authorization' => $this->token
        ];
        $this->client = new Client([
            'base_uri' => self::URL,
            'headers' => $headers,
        ]);
        $this->priority = NotificationPriority::DEFAULT;
    }
    
    /**
     * Notification title
     *
     * @param  string $title
     * @return Hotify
     */
    public function title(string $title)
    {
        $this->title = $title;

        return $this;
    }
    
    /**
     * Notification text
     *
     * @param  string $text
     * @return Hotify
     */
    public function text(string $text)
    {
        $this->text = $text;

        return $this;
    }
        
    /**
     * Приоритет сообщения
     *
     * @param  string $priority
     * @return Hotify
     */
    public function priority(string $priority)
    {
        $this->priority = $priority;

        return $this;
    }
    
    /**
     * Высокий приоритет
     *
     * @return Hotify
     */
    public function highPriority()
    {
        return $this->priority(NotificationPriority::HIGH);
    }
    
    /**
     * Низкий приоритет
     *
     * @return Hotify
     */
    public function lowPriority()
    {
        return $this->priority(NotificationPriority::LOW);
    }

    /**
     * Application id or tag
     *
     * @param  mixed $appIdOrTag
     * @return Hotify
     */
    public function to($appIdOrTag)
    {
        $this->to = $appIdOrTag;

        return $this;
    }

    
    /**
     * Send it
     *
     * @return array
     */
    public function send()
    {
        $json = [
            'title' => $this->title,
            'text' => $this->text,
            'priority' => $this->priority
        ];

        if (is_numeric($this->to)) {
            $json['app_id'] = $this->to;
        } else {
            $json['tag'] = $this->to;
        }
        
        try {
            $response = $this->client->request('POST', 'notifications', [
                'json' => $json
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $e) {
            return [
                'success' => false,
                'error' => 'Request error'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => 'Unknown error'
            ];
        }
    }
}