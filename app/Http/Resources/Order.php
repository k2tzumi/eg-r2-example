<?php
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/**
 * Class Order.
 */
#[OA\Schema(
    title: 'Order model',
    description: 'Order model'
)]
class Order extends JsonResource
{
    /**
     * @param int $id
     * @param int $petId
     * @param int $quantity
     * @param \DateTime $shipDate
     * @param string $status
     * @param bool $complete
     */
    public function __construct(
        #[OA\Property(
            title: 'ID',
            description: 'ID',
            format: 'int64',
            default: 1
        )]
        public int $id,
        #[OA\Property(
            title: 'Pet ID',
            description: 'Pet ID',
            format: 'int64',
            default: 1
        )]
        public int $petId,
        #[OA\Property(
            title: 'Quantity',
            description: 'Quantity',
            format: 'int32',
            default: 12
        )]
        public int $quantity,
        #[OA\Property(
            title: 'Shipping date',
            description: 'Shipping date',
            type: 'string',
            format: 'datetime',
            default: '2017-02-02 18:31:45'
        )]
        public \DateTime $shipDate,
        #[OA\Property(
            title: 'Order status.',
            description: 'Order status.',
            default: 'placed',
            enum: ['placed', 'approved', 'delivered']
        )]
        public string $status,
        #[OA\Property(
            title: 'Complete status',
            description: 'Complete status',
            format: 'int64',
            default: false
        )]
        public bool $complete
    ) {
        parent::__construct([
            'id' => $id,
            'petId' => $petId,
            'quantity' => $quantity,
            'shipDate' => $shipDate,
            'status' => $status,
            'complete' => $complete,
        ]);
    }
}
