<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Litalico\EgR2\Http\Requests\FormRequestPropertyHandlerTrait;
use Litalico\EgR2\Http\Requests\RequestRuleGeneratorTrait;
use OpenApi\Attributes as OA;

/**
 * Class Pet.
 */
#[OA\Schema(
    title: 'Pet model',
    description: 'Pet model',
    required: ['name', 'photoUrls'],
    xml: new OA\Xml(
        name: 'Pet'
    )
)]
class Pet extends FormRequest
{
    use FormRequestPropertyHandlerTrait;
    use RequestRuleGeneratorTrait;

    #[OA\Property(
        property: 'id',
        title: 'id',
        description: 'id',
        type: 'integer',
        format: 'int64',
        minimum: 1,
        example: 1
    )]
    public int $id;

    #[OA\Property(
        property: 'category',
        ref: '#/components/schemas/Category',
        title: 'Category'
    )]
    public Category $category;

    #[OA\Property(
        property: 'name',
        description: 'Pet name',
        type: 'string',
        format: 'string'
    )]
    public string $name;

    /** @var string[] */
    #[OA\Property(
        property: 'photoUrls',
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
    public array $photoUrls;

    /** @var string[] */
    #[OA\Property(
        property: 'tags',
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
    public array $tags;
}
