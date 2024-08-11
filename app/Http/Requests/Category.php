<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

/**
 * Pets Category.
 */
#[OA\Schema(
    title: 'Pets Category.',
    xml: new OA\Xml(
        name: 'Category'
    )
)]
class Category extends FormRequest
{
    #[OA\Property(
        property: 'id',
        title: 'id',
        description: 'id',
        type: 'integer',
        format: 'int',
        minimum: 1
    )]
    public int $id;

    #[OA\Property(
        property: 'name',
        title: 'Category name',
        description: 'Category name',
        type: 'string',
        format: 'string'
    )]
    public string $name;
}
