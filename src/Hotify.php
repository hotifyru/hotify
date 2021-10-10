<?php

namespace Hotify\Hotify;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;


class Hotify
{
    const URL = 'https://hotify.ru/api/v1.0/';

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
    }
    
    /**
     * Заголовок уведомления
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
     * Текст уведомления
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
     * Приложение - адресат
     *
     * @param  int $app_id
     * @return Hotify
     */
    public function to(int $app_id)
    {
        $this->to = $app_id;

        return $this;
    }

    
    /**
     * Отправить уведомление
     *
     * @return array
     */
    public function send()
    {
        try {
            $response = $this->client->request('POST', 'notification', [
                'json' => [
                    'app_id' => $this->to,
                    'title' => $this->title,
                    'text' => $this->text,
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $e) {
            return [
                'success' => false,
                'error' => 'Ошибка запроса'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => 'Неизвестная ошибка'
            ];
        }
    }
}