<?php declare(strict_types=1);

namespace ApiClients\Tests\Middleware\Xml;

use ApiClients\Middleware\Json\JsonStream;
use ApiClients\Middleware\Json\JsonEncodeMiddleware;
use ApiClients\Middleware\Xml\XmlEncodeMiddleware;
use ApiClients\Middleware\Xml\XmlStream;
use ApiClients\Tools\Json\JsonEncodeService;
use ApiClients\Tools\TestUtilities\TestCase;
use React\EventLoop\Factory;
use RingCentral\Psr7\BufferStream;
use RingCentral\Psr7\Request;
use function Clue\React\Block\await;

class XmlEncodeMiddlewareTest extends TestCase
{
    public function testPre()
    {
        $loop = Factory::create();
        $middleware = new XmlEncodeMiddleware();
        $stream = new XmlStream([
            'foo' => [
                'bar' => 'beer',
            ],
        ]);
        $request = new Request('GET', 'https://example.com', [], $stream);

        $modifiedRequest = await($middleware->pre($request, 'abc'), $loop);
        self::assertSame(
            '<?xml version="1.0" encoding="UTF-8"?><foo><bar>beer</bar></foo>',
            (string) $modifiedRequest->getBody()
        );
        self::assertTrue($modifiedRequest->hasHeader('Content-Type'));
        self::assertSame('text/xml', $modifiedRequest->getHeaderLine('Content-Type'));
    }

    public function testPreNoXml()
    {
        $loop = Factory::create();
        $middleware = new XmlEncodeMiddleware();
        $stream = new BufferStream(2);
        $stream->write('yo');
        $request = new Request('GET', 'https://example.com', [], $stream);

        self::assertSame(
            $request,
            await(
                $middleware->pre($request, 'abc'),
                $loop
            )
        );
    }
}
