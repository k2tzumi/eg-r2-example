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
        format: "int64",
        description: "ID",
        title: "ID"
    )]    
    private int $id;

    #[OA\Property(
        format: "string",
        description: "Category name",
        title: "Category name"
    )]
    private string $name;
}
