<?php
declare(strict_types=1);

namespace Tests\Feature;

use Kirschbaum\OpenApiValidator\ValidatesOpenApiSpec;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StoreControllerTest extends TestCase
{
    use ValidatesOpenApiSpec;

    /**
     * @test
     */
    #[Test]
    public function placeOrder(): void
    {
        setup:
        $payload = [
            'id' => 1,
            'petId' => 2,
            'quantity' => 1,
            'shipDate' => '2021-10-10 10:10:10',
            'status' => 'placed',
            'complete' => true,
        ];
        $expected = [
            'id' => 1,
            'petId' => 2,
            'quantity' => 1,
            'shipDate' => '2021-10-10 10:10:10',
            'status' => 'placed',
            'complete' => true,
        ];

        when:
        $response = $this->postJson('/api/store/order', $payload);

        then:
        $response->assertStatus(200);
        $response->assertJson($expected);
    }
}
