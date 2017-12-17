<?php declare(strict_types=1);

namespace ApiClients\Middleware\Xml;

use ApiClients\Foundation\Middleware\Annotation\Third;
use ApiClients\Foundation\Middleware\ErrorTrait;
use ApiClients\Foundation\Middleware\MiddlewareInterface;
use ApiClients\Foundation\Middleware\PostTrait;
use fillup\A2X;
use Psr\Http\Message\RequestInterface;
use React\Promise\CancellablePromiseInterface;
use RingCentral\Psr7\BufferStream;
use function React\Promise\resolve;

class XmlEncodeMiddleware implements MiddlewareInterface
{
    use PostTrait;
    use ErrorTrait;

    /**
     * @param RequestInterface $request
     * @param array $options
     * @return CancellablePromiseInterface
     *
     * @Third()
     */
    public function pre(
        RequestInterface $request,
        string $transactionId,
        array $options = []
    ): CancellablePromiseInterface {
        if (!($request->getBody() instanceof XmlStream)) {
            return resolve($request);
        }

        $xml = (new A2X($request->getBody()->getXml()))->asXml();
        $body = new BufferStream(strlen($xml));
        $body->write($xml);
        return resolve($request->withBody($body)->withAddedHeader('Content-Type', 'text/xml'));
    }
}
