<?php declare(strict_types=1);

namespace ApiClients\Tools\Xml;

use LSS\XML2Array;
use React\EventLoop\LoopInterface;
use React\Promise\CancellablePromiseInterface;
use function WyriHaximus\React\futureFunctionPromise;

class XmlDecodeService
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

    public function decode(string $input): CancellablePromiseInterface
    {
        return futureFunctionPromise($this->loop, $input, function ($input) {
            return XML2Array::createArray($input);
        });
    }
}
