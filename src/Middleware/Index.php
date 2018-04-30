<?php
namespace FTCBotCore\Middleware;

use Zend\Diactoros\Response\HtmlResponse;

class Index
{
    
    private $reaper;
    
    public function __construct($reaper)
    {
        $this->reaper = $reaper;
    }
    
    public function __invoke($request, $response, $next)
    {
$html = '<p>dlfskldfj<p>';
        return new HtmlResponse($html);
    }
    
}
