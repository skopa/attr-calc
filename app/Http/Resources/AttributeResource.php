<?php

namespace App\Http\Resources;

use App\Models\Attribute;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AttributeResource
 * @package App\Http\Resources
 * @property-read Attribute $resource
 */
class AttributeResource extends JsonResource
{
    public static $wrap = false;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'parameter' => $this->resource->parameter,
            'min' => $this->resource->min,
            'max' => $this->resource->max,
        ];
    }
}
