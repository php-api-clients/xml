<?php declare(strict_types=1);

namespace ApiClients\Tests\Tools\Xml;

use ApiClients\Tools\TestUtilities\TestCase;
use ApiClients\Tools\Xml\XmlDecodeService;
use React\EventLoop\Factory;
use function Clue\React\Block\await;

class XmlDecodeServiceTest extends TestCase
{
    public function testDecode()
    {
        $loop = Factory::create();
        $service = new XmlDecodeService($loop);
        self::assertSame(Constant::TREE, await($service->decode(Constant::XML), $loop));
    }
}
