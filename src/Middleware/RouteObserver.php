<?php
namespace FTCBotCore\Middleware;

use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Zend\Expressive\Router\RouteResult;

class RouteObserver implements MiddlewareInterface
{
    
    private $router;
    
    public function __construct()
    {
    }
    
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $routeResult = $request->getAttribute('Zend\Expressive\Router\RouteResult');
        
        if ($routeResult) {
            $routeName = $routeResult->getMatchedRouteName();
            $request = $request->withAttribute('routeName', $routeName);
        }
        
        return $delegate->process($request);
    }
}
