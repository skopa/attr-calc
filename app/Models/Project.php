<?php

namespace App\Models;

use App\Models\Methods\CompetitiveMethodCalculation;
use App\Models\Methods\CostMethodCalculation;
use App\Models\Methods\RevenueMethodCalculation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Project
 * @package App\Models
 * @property int id
 * @property string name
 * @property string description
 * @property float ready_level
 * @property boolean has_competitors
 * @property Collection parameters
 * @property User user
 * @property CompetitiveMethodCalculation|null competitiveMethodCalculation
 * @property CostMethodCalculation|null costMethodCalculation
 * @property RevenueMethodCalculation|null revenueMethodCalculation
 */
class Project extends Model
{
    use SoftDeletes;

    protected $scoreDecimals = 8;

    protected $fillable = [
        'name', 'description', 'ready_level', 'has_competitors'
    ];

    protected $with = [
        'user', 'competitiveMethodCalculation', 'costMethodCalculation', 'revenueMethodCalculation'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function competitiveMethodCalculation(): HasOne
    {
        return $this->hasOne(CompetitiveMethodCalculation::class);
    }

    public function costMethodCalculation(): HasOne
    {
        return $this->hasOne(CostMethodCalculation::class);
    }

    public function revenueMethodCalculation(): HasOne
    {
        return $this->hasOne(RevenueMethodCalculation::class);
    }
}
