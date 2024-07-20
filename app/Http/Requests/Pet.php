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
        property: "id",
        format: "int64",
        description: "id",
        type: "integer",
        title: "id",
        minimum: 1,
        example: 1
    )]
    public int $id;

    #[OA\Property(
        property: "category",
        title: "Category",
        ref: "#/components/schemas/Category"
    )]
    public Category $category;

    #[OA\Property(
        property: "name",
        format: "string",
        description: "Pet name",
        type: "string",
        title: "Pet name"
    )]
    public string $name;

    /** @var string[] */
    #[OA\Property(
        property: "photoUrls",
        description: "Photo urls",
        type: "array",
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
        property: "tags",
        description: "Pet tags",
        type: "array",
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

    public function rules(): array
    {
        $rules = $this->convertRules();
        // var_export($rules);
        return $rules;
    }
}
