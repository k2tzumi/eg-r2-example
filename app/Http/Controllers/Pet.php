<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\FindPetsByStatus;
use App\Http\Requests\Pet as PetRequest;
use App\Http\Resources\ApiResponse;
use App\Http\Resources\Category;
use App\Http\Resources\Pet as PetResponse;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class Pet extends Controller
{
    #[OA\Post(
        path: '/pet',
        operationId: 'addPet',
        description: 'Add a new pet to the store.',
        security: [
            ['petstore_auth' => ['write:pets', 'read:pets']],
        ],
        requestBody: new OA\RequestBody(ref: '#/components/requestBodies/Pet'),
        tags: ['pet'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'successful operation',
                content: new OA\JsonContent(ref: '#/components/schemas/ApiResponse')
            ),
            new OA\Response(
                response: 405,
                description: 'Invalid input'
            ),
            new OA\Response(
                response: 422,
                description: 'Unprocessable Entity'
            ),
        ]
    )]
    /**
     * Add a new pet to the store.
     * @param PetRequest $pet
     * @return JsonResponse
     */
    public function addPet(PetRequest $pet): JsonResponse
    {
        $response = new ApiResponse(200, 'success');

        return response()->json($response, 200);
    }

    #[OA\Put(
        path: '/pet',
        operationId: 'updatePet',
        description: 'Update an existing pet.',
        security: [
            ['petstore_auth' => ['write:pets', 'read:pets']],
        ],
        requestBody: new OA\RequestBody(ref: '#/components/requestBodies/Pet'),
        tags: ['pet'],
        responses: [
            new OA\Response(
                response: 400,
                description: 'Invalid ID supplied'
            ),
            new OA\Response(
                response: 404,
                description: 'Pet not found'
            ),
            new OA\Response(
                response: 405,
                description: 'Validation exception'
            ),
        ]
    )]
    /**
     * Update an existing pet.
     */
    public function updatePet(): void
    {
    }

    #[OA\Get(
        path: '/pet/findByStatus',
        operationId: 'findPetsByStatus',
        description: 'Multiple status values can be provided with comma separated string',
        summary: 'Finds Pets by status',
        security: [
            ['ApiKeyAuth' => []],
        ],
        tags: ['pet'],
        deprecated: true
    )]
    #[OA\Parameter(
        name: 'status',
        description: 'Status values that needed to be considered for filter',
        in: 'query',
        required: true,
        schema: new OA\Schema(
            type: 'string',
            default: 'available',
            enum: ['available', 'pending', 'sold']
        ),
        explode: true
    )]
    #[OA\Response(
        response: 200,
        description: 'successful operation',
        content:[
            new OA\JsonContent(
                type: 'array',
                items:new OA\Items(ref: '#/components/schemas/PetResponse')
            ),
        ]
    )]
    /**
     * @param FindPetsByStatus $request
     * @return JsonResponse
     */
    public function findPetsByStatus(FindPetsByStatus $request): JsonResponse
    {
        $response = [];
        $response[] = new PetResponse(1, new Category(1, 'category'), 'name', ['photo'], ['tag']);

        return response()->json($response, 200);
    }

    #[OA\Post(
        path: '/pet/{petId}',
        operationId: 'updatePetWithForm',
        summary: 'Updates a pet in the store with form data',
        security: [
            ['petstore_auth' => ['write:pets', 'read:pets']],
        ],
        requestBody: new OA\RequestBody(
            description: 'Input data format',
            content: new OA\MediaType(
                mediaType: 'application/x-www-form-urlencoded',
                schema: new OA\Schema(
                    properties: [
                        new OA\Property(
                            property: 'name',
                            description: 'Updated name of the pet',
                            type: 'string'
                        ),
                        new OA\Property(
                            property: 'status',
                            description: 'Updated status of the pet',
                            type: 'string'
                        ),
                    ],
                    type: 'object'
                )
            )
        ),
        tags: ['pet'],
        parameters: [
            new OA\Parameter(
                name: 'petId',
                description: 'ID of pet that needs to be updated',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64'
                )
            ),
        ],
        responses: [
            new OA\Response(
                response: 405,
                description: 'Invalid input'
            ),
        ]
    )]
    public function updatePetWithForm(): void
    {
    }

    #[OA\Delete(
        path: '/pet/{petId}',
        operationId: 'deletePet',
        summary: 'Deletes a pet',
        security: [
            ['petstore_auth' => ['write:pets', 'read:pets']],
        ],
        tags: ['pet'],
        parameters: [
            new OA\Parameter(
                name: 'api_key',
                in: 'header',
                required: false,
                schema: new OA\Schema(
                    type: 'string'
                )
            ),
            new OA\Parameter(
                name: 'petId',
                description: 'Pet id to delete',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64'
                )
            ),
        ],
        responses: [
            new OA\Response(
                response: 400,
                description: 'Invalid ID supplied'
            ),
            new OA\Response(
                response: 404,
                description: 'Pet not found'
            ),
        ]
    )]
    public function deletePet(): void
    {
    }

    #[OA\Post(
        path: '/pet/{petId}/uploadImage',
        operationId: 'uploadFile',
        summary: 'uploads an image',
        security: [
            ['petstore_auth' => ['write:pets', 'read:pets']],
        ],
        requestBody: new OA\RequestBody(
            description: 'Upload images request body',
            content: new OA\MediaType(
                mediaType: 'application/octet-stream',
                schema: new OA\Schema(
                    type: 'string',
                    format: 'binary'
                )
            )
        ),
        tags: ['pet'],
        parameters: [
            new OA\Parameter(
                name: 'petId',
                description: 'ID of pet to update',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                    example: 1
                )
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'successful operation',
                content: new OA\JsonContent(ref: '#/components/schemas/ApiResponse')
            ),
        ]
    )]
    public function uploadFile(): JsonResponse
    {
        return response()->json();
    }
}
