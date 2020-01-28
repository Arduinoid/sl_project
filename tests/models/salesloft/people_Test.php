<?php

use PHPUnit\Framework\TestCase;

final class PeopleTest extends TestCase
{
    public function testGetAll_CacheContainsPeopleData()
    {
        // Arrange
        $cache = [];
        $expected = [1,2,3];
        $returnValue = (object)[
            'body' => json_encode(['data' => $expected]),
            'code' => 200
        ];
        $httpMock = $this->createMock(Http::class);
        $httpMock->method('request')
                 ->will($this->returnValue($returnValue));

        $p = new \Models\SalesLoft\People($httpMock, 'ak_secret1234', $cache);

        // Act
        $p->getAll();

        // Assert
        $this->assertEquals($expected, $cache, 'Did not get expected value stored in cache');
    }
}