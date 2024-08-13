<?php
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/**
 * Class Pet.
 */
#[OA\Schema(
    schema: 'PetResponse',
    title: 'Pet model',
    description: 'Pet model',
    required: ['name', 'photoUrls'],
    xml: new OA\Xml(
        name: 'Pet'
    )
)]
class Pet extends JsonResource
{
    /**
     * @param int $id
     * @param Category $category
     * @param string $name
     * @param list<string> $photoUrls
     * @param list<string> $tags
     */
    public function __construct(
        #[OA\Property(
            property: 'id',
            title: 'id',
            description: 'id',
            type: 'integer',
            format: 'int64',
            minimum: 1,
            example: 1
        )]
        public int $id,
        #[OA\Property(
            property: 'category',
            ref: '#/components/schemas/Category',
            title: 'Category'
        )]
        public Category $category,
        #[OA\Property(
            property: 'name',
            title: 'Pet name',
            description: 'Pet name',
            type: 'string',
            format: 'string'
        )]
        public string $name,
        #[OA\Property(
            property: 'photoUrls',
            title: 'Photo urls',
            description: 'Photo urls',
            type: 'array',
            items: new OA\Items(
                type: 'string',
                default: 'images/image-1.png'
            ),
            xml: new OA\Xml(
                name: 'photoUrl',
                wrapped: true
            )
        )]
        public array $photoUrls,
        #[OA\Property(
            property: 'tags',
            title: 'Pet tags',
            description: 'Pet tags',
            type: 'array',
            items: new OA\Items(
                type: 'string',
                default: 'dog'
            ),
            xml: new OA\Xml(
                name: 'tag',
                wrapped: true
            )
        )]
        public array $tags
    ) {
        parent::__construct([
            'id' => $id,
            'category' => $category,
            'name' => $name,
            'photoUrls' => $photoUrls,
            'tags' => $tags,
        ]);
    }
}
