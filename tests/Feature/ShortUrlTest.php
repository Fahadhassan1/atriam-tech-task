<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\ShortUrl;

class ShortUrlTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test URL encoding (shortening a URL).
     */
    public function test_encode_url()
    {
        $response = $this->postJson('/api/encode', ['url' => 'https://www.example.com']);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'message',
                     'original_url',
                     'short_code',
                     'short_url'
                 ]);

        $this->assertDatabaseHas('short_urls', [
            'original_url' => 'https://www.example.com'
        ]);
    }

    /**
     * Test encoding with invalid URL.
     */
    public function test_encode_invalid_url()
    {
        $response = $this->postJson('/api/encode', ['url' => 'invalid-url']);

        $response->assertStatus(422)
                 ->assertJsonStructure(['error']);
    }

    /**
     * Test decoding a short code.
     */
    public function test_decode_url()
    {
        $shortUrl = ShortUrl::create([
            'original_url' => 'https://www.example.com',
            'short_code' => 'AbCdEf'
        ]);

        $response = $this->getJson('/api/decode/AbCdEf');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'URL has been decoded',
                     'original_url' => 'https://www.example.com'
                 ]);
    }

    /**
     * Test decoding an invalid short code.
     */
    public function test_decode_invalid_code()
    {
        $response = $this->getJson('/api/decode/xxxxxx');

        $response->assertStatus(404)
                 ->assertJson(['error' => 'URL not found']);
    }

    /**
     * Test decoding a short code of incorrect length.
     */
    public function test_decode_invalid_code_size()
    {
        $response = $this->getJson('/api/decode/short');

        $response->assertStatus(400)
                 ->assertJson(['error' => 'Invalid short code size']);
    }
}

