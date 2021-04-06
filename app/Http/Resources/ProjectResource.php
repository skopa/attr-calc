<?php

namespace App\Http\Resources;

use App\Http\Resources\Methods\CostMethodResource;
use App\Http\Resources\Methods\RevenueMethodResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProjectResource
 * @package App\Http\Resources
 * @property-read Project resource
 */
class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'has_competitors' => $this->resource->has_competitors,
            'ready_level' => $this->resource->ready_level,

            'cost_method' => CostMethodResource::make($this->resource->costMethodCalculation),
            'revenue_method' => RevenueMethodResource::make($this->resource->revenueMethodCalculation),

//            'competitive_method' => [],

            'user' => UserResource::make($this->resource->user),
        ];
    }
}
