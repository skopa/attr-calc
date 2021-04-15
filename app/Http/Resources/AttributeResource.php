<?php

namespace App\Http\Resources;

use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AttributeResource
 * @package App\Http\Resources
 * @property-read Attribute $resource
 */
class AttributeResource extends JsonResource
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
            'path' => $this->resource->path,
            'rule' => $this->resource->rule,
            'name' => $this->resource->name,
            'order' => $this->resource->order,

            'key' => $this->resource->key,
        ];
    }
}
