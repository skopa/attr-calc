<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Project
 * @package App\Models
 * @property int id
 * @property string name
 * @property float score
 * @property Collection parameters
 * @property User user
 */
class Project extends Model
{
    protected $scoreDecimals = 8;

    protected $fillable = [
        'name'
    ];

    protected $appends = [
        'score'
    ];

    protected $with = [
        'user'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projectParameters()
    {
        return $this->hasMany(ProjectAttribute::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function parameters()
    {
        return $this->belongsToMany(Attribute::class, 'project_attribute')
            ->withPivot(['id', 'value', 'created_at', 'updated_at'])
            ->using(ProjectAttribute::class);
    }

    public function getScoreAttribute()
    {
        return round(
            $this->parameters->sum(function ($attr) {
                return $attr->pivot->value * $attr->parameter;
            }),
            $this->scoreDecimals
        );
    }
}
