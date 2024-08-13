<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Http\Controllers\Pet;
use Kirschbaum\OpenApiValidator\ValidatesOpenApiSpec;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[CoversClass(Pet::class)]
class PetControllerTest extends TestCase
{
    use ValidatesOpenApiSpec;

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
            'photoUrls' => ['images/image-2.png'],
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
        $this->skipRequestValidation = true;
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

    /**
     * @test
     */
    #[Test]
    public function findPetsByStatus(): void
    {
        $response = $this->getJson('/api/pet/findByStatus?status=available', ['X-API-Key' => 'dummy']);

        $response->assertStatus(200);
        $response->assertJson([
            ['id' => 1, 'category' => ['id' => 1, 'name' => 'category'], 'name' => 'name', 'photoUrls' => ['photo'], 'tags' => ['tag']],
        ]);
    }
}
