<?php declare(strict_types=1);

namespace ApiClients\Tests\Tools\Json;

use ApiClients\Tests\Tools\Xml\Constant;
use ApiClients\Tools\TestUtilities\TestCase;
use ApiClients\Tools\Xml\XmlEncodeService;
use React\EventLoop\Factory;
use function Clue\React\Block\await;

class XmlEncodeServiceTest extends TestCase
{
    public function testEncoded()
    {
        $loop = Factory::create();
        $handler = new XmlEncodeService($loop);
        self::assertSame(
            Constant::XML,
            str_replace(
                ["\r", "\n", '  '],
                '',
                await($handler->encode(Constant::TREE), $loop)
            )
        );
    }
}
