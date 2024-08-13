<?php
declare(strict_types=1);

namespace App\Http\Resources;

use http\Client\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/**
 * Pets Category.
 */
#[OA\Schema(
    schema: 'CategoryResponse',
    title: 'Pets Category.',
    xml: new OA\Xml(
        name: 'Category'
    )
)]
class Category extends JsonResource
{
    /**
     * @param int $id
     * @param string $name
     */
    public function __construct(
        #[OA\Property(
            property: 'id',
            title: 'id',
            description: 'id',
            type: 'integer',
            format: 'int',
            minimum: 1
        )]
        public int $id,
        #[OA\Property(
            property: 'name',
            title: 'Category name',
            description: 'Category name',
            type: 'string',
            format: 'string'
        )]
        public string $name
    ) {
        parent::__construct([
            'id' => $id,
            'name' => $name,
        ]);
    }
}
