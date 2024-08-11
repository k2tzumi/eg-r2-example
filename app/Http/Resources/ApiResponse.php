<?php
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/**
 * Class ApiResponse.
 */
#[OA\Schema(
    description: 'Api response',
    title: 'Api response'
)]
class ApiResponse extends JsonResource
{
    public function __construct(
        #[OA\Property(
            title: 'code',
            description: 'code',
            type: 'integer',
            format: 'int32'
        )]
        public int $code,
        #[OA\Property(
            title: 'Message',
            description: 'Message',
            type: 'string'
        )]
        public string $message,
    ) {
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
