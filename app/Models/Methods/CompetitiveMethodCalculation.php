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
}
