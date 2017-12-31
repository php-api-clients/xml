<?php declare(strict_types=1);

namespace ApiClients\Tools\Xml;

use LSS\Array2XML;
use React\EventLoop\LoopInterface;
use React\Promise\CancellablePromiseInterface;
use function WyriHaximus\React\futureFunctionPromise;

class XmlEncodeService
{
    /**
     * @var LoopInterface
     */
    private $loop;

    /**
     * @param LoopInterface $loop
     */
    public function __construct(LoopInterface $loop)
    {
        $this->loop = $loop;
    }

    public function encode(array $input): CancellablePromiseInterface
    {
        return futureFunctionPromise($this->loop, $input, function ($input) {
            $key = key($input);

            return Array2XML::createXML($key, $input[$key])->saveXML();
        });
    }
}
