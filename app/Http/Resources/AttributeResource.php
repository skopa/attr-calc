<?php

namespace App\Http\Resources;

use App\Models\Attribute;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * Class AttributeResource
 * @package App\Http\Resources
 * @property-read Attribute attribute
 * @property-read Collection projectParameters
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
        $projectParameters = $this->projectParameters ?? collect();

        return [
            'id' => $this->attribute->id,
            'name' => $this->attribute->name,
            'value' => $projectParameters->get($this->attribute->id, 0),
            'parameter' => $this->attribute->parameter,
            'min' => $this->attribute->min,
            'max' => $this->attribute->max,
        ];
    }
}
