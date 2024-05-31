<?php

namespace Tests;

use DT\Home\Illuminate\Http\Request;
use DT\Home\Illuminate\Http\Response;

use function DT\Home\container;

class AppFormSubmitTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // Set up any necessary data or state
    }

    public function tearDown(): void
    {
        parent::tearDown();
        // Clean up
    }

    public function testFormSubmitWithValidData()
    {
        $data = [
            'name' => 'Test App',
            'type' => 'web',
            'icon' => 'path/to/icon.png',
            'url' => 'http://example.com',
            'slug' => 'test-app',
            'is_hidden' => false,
        ];

        $response = $this->post( '/form-submit-url', $data );

        $this->assertEquals( 200, $response->getStatusCode() );
        $this->assertNotEmpty( $response->getBody() );
        // Add more assertions as needed
    }

    public function testFormSubmitWithMissingData()
    {
        $data = [
            // Missing 'name' field
            'type' => 'web',
            'icon' => 'path/to/icon.png',
            'url' => 'http://example.com',
            'slug' => 'test_app',
            'is_hidden' => false,
        ];

        $response = $this->post( '/form-submit-url', $data );

        $this->assertEquals( 400, $response->getStatusCode() );
        $this->assertContains( 'name is required', $response->getBody() );
        // Add more assertions as needed
    }

    public function post( $uri, $data = [], $headers = [] )
    {
        // Implement the POST request similar to the TestCase.php example
        return $this->request( 'POST', $uri, $data, $headers );
    }
}
