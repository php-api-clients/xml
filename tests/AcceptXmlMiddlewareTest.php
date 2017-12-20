<?php declare(strict_types=1);

namespace ApiClients\Tests\Middleware\Xml;

use ApiClients\Middleware\Xml\AcceptXmlMiddleware;
use ApiClients\Tools\TestUtilities\TestCase;
use React\EventLoop\Factory;
use RingCentral\Psr7\Request;
use function Clue\React\Block\await;

class AcceptXmlMiddlewareTest extends TestCase
{
    public function testPre()
    {
        $middleware = new AcceptXmlMiddleware();
        $request = new Request('GET', 'https://example.com', [], '');

        $modifiedRequest = await($middleware->pre($request, 'abc'), Factory::create());
        self::assertSame(
            [
                'Host' => ['example.com'],
                'Accept' => ['text/xml'],
            ],
            $modifiedRequest->getHeaders()
        );
    }
}
