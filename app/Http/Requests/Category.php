<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;


/**
 * Pets Category.
 */
#[OA\Schema(
    title: "Pets Category.",
    xml: new OA\Xml(
        name: "Category"
    )
)]
class Category extends FormRequest
{
    #[OA\Property(
        property: "id",
        format: "int",
        description: "id",
        type: "integer",
        title: "id",
        minimum: 1
    )]
     public int $id;

    #[OA\Property(
        property: "name",
        format: "string",
        description: "Category name",
        type: "string",
        title: "Category name"
    )]
    public string $name;
}
