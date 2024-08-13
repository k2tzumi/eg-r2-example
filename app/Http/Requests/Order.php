<?php
declare(strict_types=1);

namespace App\Http\Requests;

use DateTime;
use Illuminate\Foundation\Http\FormRequest;
use Litalico\EgR2\Http\Requests\FormRequestPropertyHandlerTrait;
use Litalico\EgR2\Http\Requests\RequestRuleGeneratorTrait;
use OpenApi\Attributes as OA;

/**
 * Class Order.
 */
#[OA\Schema(
    title: 'Order model',
    description: 'Order model',
    required: ['id', 'petId', 'quantity', 'shipDate', 'status', 'complete']
)]
class Order extends FormRequest
{
    use FormRequestPropertyHandlerTrait;
    use RequestRuleGeneratorTrait;

    #[OA\Property(
        property: 'id',
        description: 'ID',
        format: 'int64',
        default: 1
    )]
    public int $id;

    #[OA\Property(
        property: 'petId',
        description: 'Pet ID',
        format: 'int64',
        default: 1
    )]
    public int $petId;

    #[OA\Property(
        property: 'quantity',
        description: 'Quantity',
        format: 'int32',
        default: 12
    )]
    public int $quantity;

    #[OA\Property(
        property: 'shipDate',
        description: 'Shipping date',
        type: 'string',
        format: 'datetime',
        default: '2017-02-02 18:31:45'
    )]
    public DateTime $shipDate;

    #[OA\Property(
        property: 'status',
        description: 'Order status.',
        default: 'placed',
        enum: ['placed', 'approved', 'delivered']
    )]
    public string $status;

    #[OA\Property(
        property: 'complete',
        description: 'Complete status',
        format: 'int64',
        default: false
    )]
    public bool $complete;
}
