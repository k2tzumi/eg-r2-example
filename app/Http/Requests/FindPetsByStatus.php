<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Litalico\EgR2\Http\Requests\FormRequestPropertyHandlerTrait;
use Litalico\EgR2\Http\Requests\RequestRuleGeneratorTrait;
use OpenApi\Attributes as OA;

#[OA\Schema(
    required: ['status'],
)]
class FindPetsByStatus extends FormRequest
{
    use FormRequestPropertyHandlerTrait;
    use RequestRuleGeneratorTrait;

    #[OA\Property(
        property: 'status',
        title: 'status',
        description: 'status',
        type: 'string',
        default: 'available',
        enum: ['available', 'pending', 'sold']
    )]
    public string $status;
}
