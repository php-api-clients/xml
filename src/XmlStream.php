<?php declare(strict_types=1);

namespace ApiClients\Middleware\Xml;

use ApiClients\Foundation\Transport\ParsedContentsInterface;
use Psr\Http\Message\StreamInterface;
use RingCentral\Psr7\BufferStream;

class XmlStream implements StreamInterface, ParsedContentsInterface
{
    /**
     * @var array
     */
    private $xml = [];

    /**
     * @var StreamInterface
     */
    private $bufferStream;

    public function __construct(array $xml)
    {
        $this->xml = $xml;
        $jsonString = json_encode($xml);
        $this->bufferStream = new BufferStream(strlen($jsonString));
        $this->bufferStream->write($jsonString);
    }

    public function __toString()
    {
        return $this->getContents();
    }

    /**
     * @return array
     */
    public function getParsedContents(): array
    {
        return $this->xml;
    }

    public function getContents()
    {
        return $this->bufferStream->getContents();
    }

    public function close()
    {
    }

    public function detach()
    {
    }

    public function getSize()
    {
        return $this->bufferStream->getSize();
    }

    public function isReadable()
    {
        return $this->bufferStream->isReadable();
    }

    public function isWritable()
    {
        return $this->bufferStream->isWritable();
    }

    public function isSeekable()
    {
        return $this->bufferStream->isSeekable();
    }

    public function rewind()
    {
        return $this->bufferStream->rewind();
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        return $this->bufferStream->seek($offset, $whence);
    }

    public function eof()
    {
        return $this->bufferStream->eof();
    }

    public function tell()
    {
        return $this->bufferStream->tell();
    }

    /**
     * Reads data from the buffer.
     * @param mixed $length
     */
    public function read($length)
    {
        return $this->bufferStream->read($length);
    }

    /**
     * Writes data to the buffer.
     * @param mixed $string
     */
    public function write($string)
    {
        return $this->bufferStream->write($string);
    }

    public function getMetadata($key = null)
    {
        return $this->bufferStream->getMetadata($key);
    }
}
