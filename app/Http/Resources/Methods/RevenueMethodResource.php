<?php

namespace App\Http\Resources\Methods;

use App\Models\Methods\RevenueMethodCalculation;
use App\Models\Methods\RevenueMethodPeriod;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class RevenueMethodResource
 * @package App\Http\Resources\Methods
 * @property-read RevenueMethodCalculation $resource
 */
class RevenueMethodResource extends JsonResource
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
            'discount_rate' => $this->resource->discount_rate,
            'periods' => $this->resource->periods
                ->sortBy('index')
                ->map(function (RevenueMethodPeriod $period) {
                    return (object)[
                        'sales_volume' => $period->sales_volume,
                        'expected_price' => $period->expected_price,
                        'expected_cost' => $period->expected_cost,
                        'licensor_percentage' => $period->licensor_percentage,
                    ];
                })
        ];
    }
}
