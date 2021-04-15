<?php

namespace App\Http\Resources\Methods;

use App\Models\Methods\CompetitiveMethodCalculation;
use App\Models\Methods\CompetitiveMethodParameter;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CompetitiveMethodResource
 * @package App\Http\Resources\Methods
 * @property-read CompetitiveMethodCalculation $resource
 */
class CompetitiveMethodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'cost' => $this->resource->cost,
            'values' => (object)$this->resource->values->pluck('value', 'key')->all(),
            'parameters' => $this->resource->parameters
                ->sortBy('index')
                ->map(function (CompetitiveMethodParameter $parameter) {
                    return (object)[
                        'name' => $parameter->name,
                        'direction' => (int)$parameter->direction,
                        'q_value' => (float)$parameter->q_value,
                        'analog_value' => (float)$parameter->analog_value,
                        'own_value' => (float)$parameter->own_value,
                    ];
                }),
        ];
    }
}
