<?php

namespace App\Models\Methods;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CompetitiveMethodParameter
 * @package App\Models\Methods
 * @property-read int id
 * @property-read int competitive_method_calculation_id
 * @property string name
 * @property int direction
 * @property float q_value
 * @property float analog_value
 * @property float own_value
 * @property int index
 */
class CompetitiveMethodParameter extends Model
{
    protected $fillable = ['name', 'direction', 'q_value', 'analog_value', 'own_value', 'index'];
}
