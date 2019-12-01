<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class ProjectAttribute
 * @package App\Models
 * @property int project_id
 * @property int attribute_id
 * @property float value
 */
class ProjectAttribute extends Pivot
{
    protected $table = 'project_attribute';

    protected $fillable = [
        'project_id', 'attribute_id', 'value'
    ];
}
