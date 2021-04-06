<?php

namespace App\Models\Methods;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CostMethodValue
 * @package App\Models\Methods
 * @property-read int id
 * @property-read int cost_method_calculation_id
 * @property string key
 * @property float value
 */
class CostMethodValue extends Model
{
    protected $fillable = ['key', 'value'];
    protected $casts = [
        'value' => 'float'
    ];
}
