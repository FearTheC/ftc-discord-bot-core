<?php
namespace FTCBotCore\Broker\Client;

use FTCBotCore\Broker\BrokerClient;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Message\AMQPMessage;
use FTCBotCore\Broker\Message;

class AMQPClient implements BrokerClient
{
    
    /**
     * @var AMQPChannel
     */
    private $channel;
    
    /**
     * @var AMQPStreamConnection
     */
    private $connection;
    
    /**
     * @var \Closure
     */
    private $callback;
    
    
    public function __construct(AMQPStreamConnection $connection)
    {
        $this->connection = $connection;
        $this->channel = $this->connection->channel();
        $this->channel->basic_qos(null, 1, null);
        $this->channel->queue_declare('hello', false, true, false, false);
    }
    
    private function setCallback(\Closure $callback) : void
    {
        $this->callback = function(AMQPMessage $amqpMsg) use ($callback) {
            $message = self::instantiateMessage($amqpMsg);
            
            if($callback($message)) {
                $this->ack($amqpMsg);
            }
        };
    }
    
    public function consume(\Closure $callback)
    {
        $this->setCallback($callback);
        $this->channel->basic_consume('hello', '', false, false, false, false, $this->callback);
        
        while ($this->callback) {
            $this->channel->wait();
        }
        
        $this->closeConnection();
    }
    
    public function ack(AMQPMessage $message) : void
    {
        $messageTag = $message->delivery_info['delivery_tag'];
        $message->delivery_info['channel']->basic_ack($messageTag);
    }
    
    public function closeChannel()
    {
        $this->channel->close();
    }
    
    public function closeConnection()
    {
        $this->closeChannel();
        $this->connection->close();
    }
    
    private static function instantiateMessage(AMQPMessage $amqpMessage) : Message
    {
        $amqpBody = json_decode($amqpMessage->body, true);
        $message = new Message($amqpBody);
        
        return $message;
    }
    
}
