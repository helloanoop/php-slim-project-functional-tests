<?php

namespace Tests\Functional;
use GuzzleHttp\Psr7\Response as GuzzleResponse;

class BookTest extends BaseTestCase
{
    /**
     * Test that the index route returns a rendered response containing the text 'SlimFramework' but not a greeting
     */
    public function testGetBooks()
    {
        $mockResponse = array(new GuzzleResponse(200, ['X-Foo' => 'Bar'], 'Hello World!')
            );
        $response = $this->runApp('GET', '/books/foo/bar', $mockResponse);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Hello World!', $response->getBody());
    }
}