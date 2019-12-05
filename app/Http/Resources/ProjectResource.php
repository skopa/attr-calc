<?php

namespace App\Http\Resources;

use App\Models\Attribute;
use App\Models\Project;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * Class ProjectResource
 * @package App\Http\Resources
 * @property-read Project project
 * @property-read Collection parameters
 */
class ProjectResource extends JsonResource
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
        $projectParameters = $this->project->parameters
            ->keyBy('id')
            ->map(function (Attribute $attribute) {
                return $attribute->pivot->value;
            });

        return [
            'id' => $this->project->id,
            'user' => $this->project->user,
            'name' => $this->project->name,
            'description' => $this->project->description | '',
            'score' => $this->project->score,
            'parameters' => $this->parameters->map(function (Attribute $attribute) use ($projectParameters) {
                return [
                    'id' => $attribute->id,
                    'name' => $attribute->name,
                    'value' => $projectParameters->get($attribute->id, 0),
                    'parameter' => $attribute->parameter,
                    'min' => $attribute->min,
                    'max' => $attribute->max,
                ];
            })
        ];
    }
}
