<?php
namespace FTCBotCore\Discord;

use GuzzleHttp\Client as HttpClient;

class Client extends HttpClient
{
    
    const BASE_URL = 'https://discordapp.com/api/v6/';
    const ANSWER_URI = self::BASE_URL.'channels/%s/messages';
    
    private $defaults;
    
    public function __construct($config)
    {
        parent::__construct($config);
    }
    
    public function answer(string $message, $channelId)
    {
        $this->request('POST', sprintf(self::ANSWER_URI, $channelId),
            [
            'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bot NDMyMjg5NTU3MzA4NzY4MjY2.DbVtTA.H45OL_4BNlX8v6LsG81kd6F4BLY',
                        'Content-Type' => 'application/json',
                    ],
            'json' => [
                        'content' => $message,
                ]
        ]);
    }
    
}
