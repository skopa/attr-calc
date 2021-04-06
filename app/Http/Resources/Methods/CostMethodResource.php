<?php

namespace App\Http\Resources\Methods;

use App\Models\Methods\CostMethodCalculation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CostMethodResource
 * @package App\Http\Resources
 * @property-read CostMethodCalculation $resource
 */
class CostMethodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'cost' => $this->resource->cost,
            'percentage_of_cost' => $this->resource->percentage_of_cost,
            'sum' => (object)$this->resource->values->pluck('value', 'key')->all()
        ];
    }
}
