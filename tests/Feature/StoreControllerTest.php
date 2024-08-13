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

    /**
     * @test
     */
    #[Test]
    public function placeOrderValidationError(): void
    {
        setup:
        $this->skipRequestValidation = true;
        $payload = [
            'id' => 1,
            'petId' => 2,
            'quantity' => 1,
            'shipDate' => '2021-10-10 25:10:10',
            'status' => 'place',
            'complete' => -1,
        ];
        $expected = [
            'message' => [
                'shipDate' => ['The ship date field must match the format Y-m-d H:i:s.'],
                'status' => ['The selected status is invalid.'],
                'complete' => ['The complete field must be true or false.'],
            ],
        ];

        when:
        $response = $this->postJson('/api/store/order', $payload);

        then:
        $response->assertStatus(422);
        $response->assertJson($expected);
    }

}
