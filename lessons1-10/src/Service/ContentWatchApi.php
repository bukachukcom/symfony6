<?php
namespace App\Service;

class ContentWatchApi
{
    private const API_URL = 'https://content-watch.ru/public/api/';
    public function __construct(
        private readonly string $key
    ) {
    }

    public function checkText(string $text): int
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, [
                'key' => $this->key,
                'text' => $text,
                'test' => 0
            ]
        );
        curl_setopt($curl, CURLOPT_URL, self::API_URL);

        $data = json_decode(trim(curl_exec($curl)), true);

        curl_close($curl);

        return $data['percent'];
    }
}
