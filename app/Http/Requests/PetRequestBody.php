<?php

namespace App\Http\Requests;

use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: "Pet",
    description: "Pet object that needs to be added to the store",
    required: true,
    content: new OA\JsonContent(ref: "#/components/schemas/Pet")
)]
class PetRequestBody
{
}
