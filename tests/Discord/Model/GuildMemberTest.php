<?php
namespace FTCBotCoreTest\Discord\Model;

use FTCBotCore\Discord\Model\GuildMember;
use PHPUnit\Framework\TestCase;

class GuildMemberTest extends TestCase
{
    /**
     * @dataProvider simpleMember
     */
    public function testMemberGetAuthor($memberArray)
    {
        $member = GuildMember::register($memberArray['id'], $memberArray['username']);
        $this->assertEquals($memberArray['username'], $member->getUsername());
    }
    
    
    /**
     * @dataProvider simpleMember
     */
    public function testMemberGetId($memberArray)
    {
        $member = GuildMember::register($memberArray['id'], $memberArray['username']);
        $this->assertEquals($memberArray['id'], $member->getId());
    }
    
//     /**
//      * dataProvider simpleMember
//      */
//     public function testMemberIdIsInteger($memberArray)
//     {
//         $member = GuildMember::register((string) $memberArray['id'], $memberArray['username']);
//         $this->assertEquals($memberArray['id'], $member->getId());
//     }
    
    public function simpleMember()
    {
        return [
            [
                [
                    'username' => 'user',
                    'id' => 123456789123456789,
                ]
            ]
        ];
    }
    
}
