<?php declare(strict_types=1);

namespace ApiClients\Tests\Tools\Xml;

final class Constant
{
    const XML = '<?xml version="1.0" encoding="UTF-8"?><foo><bar>beer</bar></foo>';
    const TREE = [
        'foo' => [
            'bar' => 'beer',
        ],
    ];
}
