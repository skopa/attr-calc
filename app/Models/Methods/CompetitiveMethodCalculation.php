<?php

namespace App\Models\Methods;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CompetitiveMethodCalculation
 * @package App\Models\Methods
 * @property-read int id
 * @property-read int project_id
 * @property-read float cost
 * @property-read Collection|CompetitiveMethodParameter[] parameters
 * @property-read Collection|CompetitiveMethodValue[] values
 */
class CompetitiveMethodCalculation extends Model
{
    protected $with = [
        'parameters', 'values'
    ];

    public function parameters(): HasMany
    {
        return $this->hasMany(CompetitiveMethodParameter::class);
    }

    public function values(): HasMany
    {
        return $this->hasMany(CompetitiveMethodValue::class);
    }

    public function getCostAttribute(): float
    {
        $parameters_cost = $this->parameters
            ->sortBy('index')
            ->reduce(function ($carry, CompetitiveMethodParameter $item) {
                switch ($item->direction) {
                    case 1:
                        return $carry + ((float)$item->analog_value / (float)$item->own_value) * (float)$item->q_value;
                    case -1:
                        return $carry + ((float)$item->own_value / (float)$item->analog_value) * (float)$item->q_value;
                    default:
                        return $carry;
                }
            }, .0);

        $values = $this->values->pluck('value', 'key');

        $num = (
            $parameters_cost *
            (
                $values->get('own_quality_value', .0) /
                $values->get('analog_quality_value', .0)
            ) *
            $values->get('weight_factor', .0) *
            $values->get('k1', .0) *
            $values->get('k2', .0) *
            $values->get('k5', .0)
        );

        $numth = (
            $values->get('k3', .0) / (
                $values->get('analog_implementation_costs', .0) /
                $values->get('own_implementation_costs', .0)
            ) +
            $values->get('k4', .0) / (
                $values->get('analog_support_cost', .0) /
                $values->get('own_support_cost', .0)
            )
        );

        return round($num / $numth, 2);
    }
}
