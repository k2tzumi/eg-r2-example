<?php
declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PetControllerTest extends TestCase
{
    /**
     * @test
     */
    #[Test]
    public function addPetWithExampleValue(): void
    {
        $payload = [
            'id' => 1,
            'category' => [
                'id' => 1,
                'name' => 'string',
            ],
            'name' => 'string',
            'photoUrls' => ["images/image-2.png"],
            'tags' => ['dog'],
        ];
        $response = $this->postJson('/api/pet', $payload);

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    #[Test]
    #[DataProvider('errorCase')]
    public function addPetForValidationError(array $payload, array $expected): void
    {
        var_export($payload);
        $response = $this->postJson('/api/pet', $payload);

        $response->assertStatus(422);
        $response->assertJson($expected);
    }

    public static function errorCase(): iterable
    {
        return [
            'must be integer' => [
                [
                    'id' => 1,
                    'category' => [
                        'id' => 'a',
                        'name' => 'string',
                    ],
                    'name' => 'string',
                    'photoUrls' => ['images/image-1.png'],
                    'tags' => ['dog'],
                ],
                [
                    'message' => [
                        'category.id' => [
                            'The category.id must be integer.',
                            'The category.id field must be an integer.',
                        ],
                    ],
                ],
            ],
        ];
    }
}
