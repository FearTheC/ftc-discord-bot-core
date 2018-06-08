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
    
    private $defaultHeaders = [
        'Accept' => 'application/json',
        'Authorization' => 'Bot ',
        'Content-Type' => 'application/json',
    ];
    
    private $defaults;
    
    public function __construct($config)
    {
        $authToken = $this->defaultHeaders['Authorization'].$config['auth_token'];
        $this->defaultHeaders['Authorization'] = $authToken;
        parent::__construct($config['http']);
    }
    
    public function answer(string $message, $channelId)
    {
        $this->request('POST', sprintf(self::ANSWER_URI, $channelId),
            [
                'headers' => $this->defaultHeaders,
                'json' => [
                        'content' => $message,
                ]
        ]);
    }
    
    public function deleteMessage(MessageCreate $message)
    {
        $this->request('DELETE', sprintf(self::MESSAGE_URI, $message->getChannelId(), $message->getId()),
        [
            'headers' => $this->defaultHeaders,
        ]);
    }
    
    public function sendDm($userId, $textMsg)
    {
        $ff = $this->request('POST', self::CREATE_DM,
        [
            'headers' => $this->defaultHeaders,
        'json' => [
            'recipient_id' => $userId,
        ]
        ]);
        
        $response = json_decode(($ff->getBody()->__toString()), true);
        
        $channelId = $response['id'];
        
        $this->answer($textMsg, $channelId);
    }
    
}
