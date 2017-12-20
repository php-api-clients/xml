<?php
declare(strict_types=1);

namespace ApiClients\Tests\Middleware\Xml;

use ApiClients\Middleware\Xml\XmlStream;
use ApiClients\Tools\TestUtilities\TestCase;

class XmlStreamTest extends TestCase
{
    public function testBasics()
    {
        $stream = new XmlStream([]);
        self::assertSame([], $stream->getParsedContents());
        self::assertSame(2, $stream->getSize());
        self::assertSame('[]', $stream->getContents());
    }
}
