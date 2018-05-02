<?php
namespace FTCBotCore\Discord;

use GuzzleHttp\Client as HttpClient;
use FTCBotCore\Discord\Message\MessageCreate;

class Client extends HttpClient
{
    
    const BASE_URL = 'https://discordapp.com/api/v6/';
    const ANSWER_URI = self::BASE_URL.'channels/%s/messages';
    const MESSAGE_URI = self::BASE_URL.'channels/%s/messages/%d';
    const CREATE_DM = self::BASE_URL.'users/@me/channels';
    
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
    
    public function deleteMessage(MessageCreate $message)
    {
        $this->request('DELETE', sprintf(self::MESSAGE_URI, $message->getChannelId(), $message->getId()),
        [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bot NDMyMjg5NTU3MzA4NzY4MjY2.DbVtTA.H45OL_4BNlX8v6LsG81kd6F4BLY',
                'Content-Type' => 'application/json',
            ],
        ]);
    }
    
    public function sendDm($userId, $textMsg)
    {
        $ff = $this->request('POST', self::CREATE_DM,
        [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bot NDMyMjg5NTU3MzA4NzY4MjY2.DbVtTA.H45OL_4BNlX8v6LsG81kd6F4BLY',
                'Content-Type' => 'application/json',
            ],
        'json' => [
            'recipient_id' => $userId,
        ]
        ]);
        
        $response = json_decode(($ff->getBody()->__toString()), true);
        
        $channelId = $response['id'];
        
        $this->answer('dlfkmsdfkl', $channelId);
    }
    
}
