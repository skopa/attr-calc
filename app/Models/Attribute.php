<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attribute
 * @package App\Models
 * @property int id
 * @property string name
 * @property float parameter
 * @property float min
 * @property float max
 * @property-read ProjectAttribute pivot
 */
class Attribute extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'parameter', 'min', 'max'
    ];
}
