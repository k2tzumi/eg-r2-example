<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;
use Litalico\EgR2\Http\Requests\FormRequestPropertyHandlerTrait;
use Litalico\EgR2\Http\Requests\RequestRuleGeneratorTrait;


/**
 * Class Pet.
 */
#[OA\Schema(
    description: "Pet model",
    title: "Pet model",
    required: ["name", "photoUrls"],
    xml: new OA\Xml(
        name: "Pet"
    )
)]
class Pet extends FormRequest
{
    use FormRequestPropertyHandlerTrait, RequestRuleGeneratorTrait;

    #[OA\Property(
        format: "int64",
        description: "ID",
        title: "ID"
    )]    
    public int $id;

    #[OA\Property(
        title: "Category",
        ref: "#/components/schemas/Category"
    )]
    public Category $category;

    #[OA\Property(
        format: "string",
        description: "Pet name",
        title: "Pet name"
    )]
    public string $name;

    /** @var string[] */
    #[OA\Property(
        description: "Photo urls",
        title: "Photo urls",
        xml: new OA\Xml(
            name: "photoUrl",
            wrapped: true
        ),
        items: new OA\Items(
            type: "string",
            default: "images/image-1.png"
        )
    )]
    public array $photoUrls;

    #[OA\Property(
        description: "Pet tags",
        title: "Pet tags",
        xml: new OA\Xml(
            name: "tag",
            wrapped: true
        ),
        items: new OA\Items(
            type: "string",
            default: "dog"
        )
    )]
    public array $tags;

    // /**
    //  * Determine if the user is authorized to make this request.
    //  */
    // public function authorize(): bool
    // {
    //     return false;
    // }
}
