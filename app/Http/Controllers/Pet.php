<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use App\Http\Requests\Pet as PetRequest;
use App\Http\Resources\ApiResponse;

class Pet extends Controller
{
    #[OA\Post(
        path: "/pet",
        description: "Add a new pet to the store.",
        tags: ["pet"],
        operationId: "addPet",
        responses: [
            new OA\Response(
                response: 405,
                description: "Invalid input"
            )
        ],
        security: [
            ["petstore_auth" => ["write:pets", "read:pets"]]
        ],
        requestBody: new OA\RequestBody(ref: "#/components/requestBodies/Pet")
    )]
    /**
     * Add a new pet to the store.
     */
    public function addPet(PetRequest $pet)
    {
        $response = new ApiResponse("200", "success");
        return response()->json($response, 200);
    }

    #[OA\Put(
        path: "/pet",
        description: "Update an existing pet.",
        tags: ["pet"],
        operationId: "updatePet",
        responses: [
            new OA\Response(
                response: 400,
                description: "Invalid ID supplied"
            ),
            new OA\Response(
                response: 404,
                description: "Pet not found"
            ),
            new OA\Response(
                response: 405,
                description: "Validation exception"
            )
        ],
        security: [
            ["petstore_auth" => ["write:pets", "read:pets"]]
        ],
        requestBody: new OA\RequestBody(ref: "#/components/requestBodies/Pet")
    )]
    /**
     * Update an existing pet.
     */
    public function updatePet()
    {
    }

    #[OA\Get(
        path: "/pet/findByStatus",
        tags: ["pet"],
        summary: "Finds Pets by status",
        description: "Multiple status values can be provided with comma separated string",
        operationId: "findPetsByStatus",
        deprecated: true,
        security: [
            ["api_key" => []]
        ]
    )]
    #[OA\Parameter(
        name: "status",
        in: "query",
        description: "Status values that needed to be considered for filter",
        required: true,
        explode: true,
        schema: new OA\Schema(
            default: "available",
            type: "string",
            enum: ["available", "pending", "sold"]
        )
    )]
    #[OA\Response(
        response: 200,
        description: "successful operation",
        content:[
            new OA\JsonContent(
                type: "array",
                items:new OA\Items(ref: "#/components/schemas/Pet")
            ),
            new OA\XmlContent(
                type: "array",
                items:new OA\Items(ref: "#/components/schemas/Pet")
            ),
        ]
    )]
    /**
     * @param int $id
     */
    public function getPetById(int $id)
    {
    }

    #[OA\Post(
        path: "/pet/{petId}",
        tags: ["pet"],
        summary: "Updates a pet in the store with form data",
        operationId: "updatePetWithForm",
        parameters: [
            new OA\Parameter(
                name: "petId",
                in: "path",
                description: "ID of pet that needs to be updated",
                required: true,
                schema: new OA\Schema(
                    type: "integer",
                    format: "int64"
                )
            )
        ],
        responses: [
            new OA\Response(
                response: 405,
                description: "Invalid input"
            )
        ],
        security: [
            ["petstore_auth" => ["write:pets", "read:pets"]]
        ],
        requestBody: new OA\RequestBody(
            description: "Input data format",
            content: new OA\MediaType(
                mediaType: "application/x-www-form-urlencoded",
                schema: new OA\Schema(
                    type: "object",
                    properties: [
                        new OA\Property(
                            property: "name",
                            description: "Updated name of the pet",
                            type: "string"
                        ),
                        new OA\Property(
                            property: "status",
                            description: "Updated status of the pet",
                            type: "string"
                        )
                    ]
                )
            )
        )
    )]
    public function updatePetWithForm()
    {
    }

    #[OA\Delete(
        path: "/pet/{petId}",
        tags: ["pet"],
        summary: "Deletes a pet",
        operationId: "deletePet",
        parameters: [
            new OA\Parameter(
                name: "api_key",
                in: "header",
                required: false,
                schema: new OA\Schema(
                    type: "string"
                )
            ),
            new OA\Parameter(
                name: "petId",
                in: "path",
                description: "Pet id to delete",
                required: true,
                schema: new OA\Schema(
                    type: "integer",
                    format: "int64"
                )
            )
        ],
        responses: [
            new OA\Response(
                response: 400,
                description: "Invalid ID supplied"
            ),
            new OA\Response(
                response: 404,
                description: "Pet not found"
            )
        ],
        security: [
            ["petstore_auth" => ["write:pets", "read:pets"]]
        ]
    )]
    public function deletePet()
    {
    }

    #[OA\Post(
        path: "/pet/{petId}/uploadImage",
        tags: ["pet"],
        summary: "uploads an image",
        operationId: "uploadFile",
        parameters: [
            new OA\Parameter(
                name: "petId",
                in: "path",
                description: "ID of pet to update",
                required: true,
                schema: new OA\Schema(
                    type: "integer",
                    format: "int64",
                    example: 1
                )
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "successful operation",
                content: new OA\JsonContent(ref: "#/components/schemas/ApiResponse")
            )
        ],
        security: [
            ["petstore_auth" => ["write:pets", "read:pets"]]
        ],
        requestBody: new OA\RequestBody(
            description: "Upload images request body",
            content: new OA\MediaType(
                mediaType: "application/octet-stream",
                schema: new OA\Schema(
                    type: "string",
                    format: "binary"
                )
            )
        )
    )]
    public function uploadFile()
    {
    }
}
