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

    public function testGetAll_HttpCallFails_CacheNotPopulated()
    {
        // Arrange
        $cache = [];
        $expected = [];
        $returnValue = (object)[
            'body' => '',
            'code' => 500
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

    public function testFrequency_ReturnsSortedListOfObjects()
    {
        // Arrange
        $cache = [
            (object)['email_address' => 'abbccc'],
            (object)['email_address' => 'ddddeeeee'],
            (object)['email_address' => 'gggggg'],
        ];
        $expected = [
            ['g' => 6],
            ['e' => 5],
            ['d' => 4],
            ['c' => 3],
            ['b' => 2],
            ['a' => 1],
        ];
        $httpMock = $this->createMock(Http::class);
        $p = new \Models\SalesLoft\People($httpMock, 'ak_secret1234', $cache);

        // Act
        $result = $p->frequency();

        // Assert
        $this->assertEqualsCanonicalizing($expected, $result, "Did not get expected list of characters");
    }

    public function testGetPossibleDuplicates_ReturnsPossibleDuplicates()
    {
        // Arrange
        $cache = [
            (object)['id' => 1, 'email_address' => 'jonny@gmail.com'],
            (object)['id' => 2, 'email_address' => 'jpnny@gmail.com'],
            (object)['id' => 3, 'email_address' => 'jony@gmail.com'],
            (object)['id' => 4, 'email_address' => 'jony@ymail.com'],
            (object)['id' => 4, 'email_address' => 'mando@ymail.com'],
            (object)['id' => 5, 'email_address' => 'yoda@mail.com'],
            (object)['id' => 6, 'email_address' => 'yoda_baby@mail.com'],
            (object)['id' => 7, 'email_address' => 'yoda_babby@mail.com'],
            (object)['id' => 7, 'email_address' => 'yodababby@mail.com'],
        ];
        $expected = [
            'jonny@gmail.com',
            'jpnny@gmail.com',
            'jony@gmail.com',
            'yoda_baby@mail.com',
            'yoda_babby@mail.com',
            'yodababby@mail.com',
        ];
        $httpMock = $this->createMock(Http::class);
        $p = new \Models\SalesLoft\People($httpMock, 'ak_secret1234', $cache);

        // Act
        $result = $p->getPossibleDuplicates();

        // collect list of duplicates to assert on
        $duplicates = [];
        foreach($result as $email) {
            if (isset($email->isDuplicate)) {
                $duplicates[] = $email->email_address;
            }
        }

        // Assert
        $this->assertEqualsCanonicalizing($expected, $duplicates, 'Did not get expected list of duplicate emails');
    }

    public function testGetPeople_ReturnsCachedData()
    {
        // Arrange
        $cache = [];
        $httpMock = $this->createMock(Http::class);

        $p = new \Models\SalesLoft\People($httpMock, 'ak_secret1234', $cache);

        // Act
        $result = $p->getPeople();

        // Assert
        $this->assertEquals($cache, $result, 'Did not get expected value stored in cache');
    }
}