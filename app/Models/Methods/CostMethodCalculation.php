<?php

namespace App\Models\Methods;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CostMethodCalculation
 * @package App\Models\Methods
 * @property-read int id
 * @property-read int project_id
 * @property-read float cost
 * @property float percentage_of_cost
 * @property-read Collection|CostMethodValue[] values
 */
class CostMethodCalculation extends Model
{
    protected $fillable = ['percentage_of_cost'];
    protected $with = ['values'];
    protected $casts = [
        'percentage_of_cost' => 'float',
    ];

    public function values(): HasMany
    {
        return $this->hasMany(CostMethodValue::class);
    }

    public function getCostAttribute(): float
    {
        $sum = $this->values
            ->keyBy('key')
            ->reduce(function (float $sum, CostMethodValue $value) {
                return $sum + (float)$value->value;
            }, .0);

        return round($sum * (1 + (float)$this->percentage_of_cost / 100), 2);
    }
}
