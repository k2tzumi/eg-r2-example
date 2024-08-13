<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

class Store extends Controller
{
    #[OA\Get(
        path: '/store',
        operationId: 'getInventory',
        description: 'Returns a map of status codes to quantities',
        summary: 'Returns pet inventories by status',
        security: [
            ['ApiKeyAuth' => []],
        ],
        tags: ['store'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'successful operation',
                content: new OA\JsonContent(
                    additionalProperties: new OA\AdditionalProperties(
                        type: 'integer',
                        format: 'int32'
                    )
                )
            ),
        ]
    )]
    public function getInventory(): void
    {
    }

    #[OA\Post(
        path: '/store/order',
        operationId: 'placeOrder',
        summary: 'Place an order for a pet',
        requestBody: new OA\RequestBody(
            description: 'order placed for purchasing the pet',
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/Order')
        ),
        tags: ['store'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'successful operation',
                content: [
                    new OA\JsonContent(ref: '#/components/schemas/OrderResponse'),
                    new OA\XmlContent(ref: '#/components/schemas/OrderResponse'),
                ]
            ),
        ]
    )]
    public function placeOrder(): void
    {
    }

    #[OA\Get(
        path: '/store/order/{orderId}',
        operationId: 'getOrderById',
        description: 'For valid response try integer IDs with value >= 1 and <= 10. Other values will generated exceptions',
        tags: ['store'],
        parameters: [
            new OA\Parameter(
                name: 'orderId',
                description: 'ID of pet that needs to be fetched',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                    maximum: 10,
                    minimum: 1
                )
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'successful operation',
                content: [
                    new OA\JsonContent(ref: '#/components/schemas/OrderResponse'),
                    new OA\MediaType(
                        mediaType: 'application/xml',
                        schema: new OA\Schema(ref: '#/components/schemas/OrderResponse')
                    ),
                ]
            ),
            new OA\Response(
                response: 400,
                description: 'Invalid ID supplied'
            ),
            new OA\Response(
                response: 404,
                description: 'Order not found'
            ),
        ]
    )]
    public function getOrderById(): void
    {
    }

    #[OA\Delete(
        path: '/store/order/{orderId}',
        operationId: 'deleteOrder',
        description: 'For valid response try integer IDs with positive integer value. Negative or non-integer values will generate API errors',
        summary: 'Delete purchase order by ID',
        tags: ['store'],
        parameters: [
            new OA\Parameter(
                name: 'orderId',
                description: 'ID of the order that needs to be deleted',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                    minimum: 1
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
                description: 'Order not found'
            ),
        ]
    )]
    public function deleteOrder(): void
    {
    }
}
