<?php
namespace FTCBotCoreTest\Discord\Message;

use PHPUnit\Framework\TestCase;
use FTCBotCore\Command\CountMembers;
use FTC\Discord\Message\MessageCreate;
use FTC\Discord\Model\GuildMemberRepository;
use FTCBotCore\Command\CreateGuildMember;

final class CreateGuildMemberTest extends TestCase
{
    
    public function testCreateMember()
    {
        $repoMock = $this->createMock(GuildMemberRepository::class);
        
        $sut = new CreateGuildMember($repoMock);
        
        
        var_dump($sut());
    }
    
//     public function testEEEEE()
//     {
//         $stubStmt = $this->createMock(\PDOStatement::class);
//         $stubStmt->method('fetchAll')
//             ->willReturn([['name' => 'Ami', 'count' => 5], ['name' => 'Membre', 'count' => 12]]);
        
//         $stub = $this->createMock(\PDO::class);
//         $stub->method('prepare')
//         ->willReturn($stubStmt);
        
//         $stubMsg = $this->createMock(MessageCreate::class);
//         $stubMsg->method('getContent')
//         ->willReturn('!count Membre');
        
//         $sut = new CountMembers($stub);
        
//         $this->assertEquals('Membre: 12'.PHP_EOL, $sut($stubMsg));
//     }
    
    
}
    