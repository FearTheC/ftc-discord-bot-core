<?php
namespace FTCBotCoreTest\Discord\Message;

use PHPUnit\Framework\TestCase;
use FTC\Discord\Message\GuildCreate;

final class GuildCreateTest extends TestCase
{
    
    /**
     * @dataProvider provider
     */
    public function testGetEventType($body)
    {
        $testee = new GuildCreate($body);
        $this->assertEquals('GUILD_CREATE', $testee->getEventType());
    }
    
    /**
     * @dataProvider provider
     */
    public function testGetChannels($body)
    {
        $testee = new GuildCreate($body);
        $this->assertEquals($body['data']['channels'], $testee->getChannels());
    }
    
    
    /**
     * @dataProvider provider
     */
    public function testGetGuildId($body)
    {
        $testee = new GuildCreate($body);
        $this->assertEquals($body['data']['id'], $testee->getGuildId());
    }
    
    
    /**
     * @dataProvider provider
     */
    public function testGetRoles($body)
    {
        $testee = new GuildCreate($body);
        $this->assertEquals($body['data']['roles'], $testee->getRoles());
    }
    
    
    /**
     * @dataProvider provider
     */
    public function testGetUsers($body)
    {
        $testee = new GuildCreate($body);
        $this->assertEquals($body['data']['members'], $testee->getUsers());
    }
    
    
    public function provider()
    {
        return [
            [
                [
                    'data' => [
                        'id' => '123456789123456789',
                        'members' => [
                            'array-of-users',
                        ],
                        'channels' => [
                            'array-of-channels',
                        ],
                        'roles' => [
                            'array-of-roles',
                        ],
                    ],
                    'timestamp' => 1524824928316,
                ],
            ],
        ];
    }
    
}
