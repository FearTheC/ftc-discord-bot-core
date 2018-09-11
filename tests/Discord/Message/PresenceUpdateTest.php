<?php
namespace FTCBotCoreTest\Discord\Message;

use PHPUnit\Framework\TestCase;
use FTCBotCore\Message\PresenceUpdate;

class PresenceUpdateTest extends TestCase
{
    
    /**
     * @dataProvider gameSessionProvider
     */
    public function testIsGameSessionStart($body, $truth)
    {
        $testee = new PresenceUpdate($body);
        $this->assertEquals($truth['isSessionStart'], $testee->isGameSessionStart());
    }
    
    
    /**
     * @dataProvider gameSessionProvider
     */
    public function testGetGameName($body, $truth)
    {
        $testee = new PresenceUpdate($body);
        $this->assertEquals($truth['gameName'], $testee->getGameName());
    }
    
    
    /**
     * @dataProvider gameSessionProvider
     */
    public function testGetSessionStart($body, $truth)
    {
        $testee = new PresenceUpdate($body);
        $this->assertEquals($truth['sessionStartTime'], $testee->getSessionStart());
    }
    
    public function gameSessionProvider()
    {
        return [
            [
                [
                    'data' => [
                        'game' => [
                            'type' => 0,
                            'timestamps' => [
                                'start' => 1524824928316,
                            ],
                            'name' => 'A Video Game',
                        ],
                    ],
                    'timestamp' => 1524824928316,
                ],
                [
                    'isSessionStart' => true,
                    'gameName' => 'A Video Game',
                    'sessionStartTime' => 1524824928316,
                ],
            ],
            [
                [
                    'data' => [
                        'game' => null,
                    ],
                    'timestamp' => 1524824928316,
                ],
                [
                    'isSessionStart' => false,
                    'gameName' => null,
                    'sessionStartTime' => null,
                ],
            ],
        ];
    }
// "nick":null,"guild_id":"384396784807575552","game":{"type":0,"timestamps":{"start":1524824928316},"name":"Tom Clancy's Rainbow Six Siege"}}}
}
