<?php
declare(strict_types=1);

namespace Tests\Unit;

use App\Http\Requests\Pet;
use Litalico\EgR2\Rules\Integer;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class PetRequestTest extends TestCase
{
    #[Test]
    public function convertRules(): void
    {
        setup:
        $instance = new Pet();
        $expected = [
            'id' => [
                new Integer(),
                'integer',
                'min:1',
            ],
            'category.id' => [
                new Integer(),
                'integer',
                'min:1',
            ],
            'category.Category name' => [
                'string',
            ],
            'name' => [
                'required',
                'string',
            ],
            'photoUrls' => [
                'present',
                'array',
            ],
            'photoUrls.*' => [
                'string',
            ],
            'tags' => [
                'array',
            ],
            'tags.*' => [
                'string',
            ],
        ];

        when:
        $actual = $instance->rules();

        then:
        self::assertEquals($expected, $actual);
    }
}
