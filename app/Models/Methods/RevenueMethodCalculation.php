<?php

namespace App\Models\Methods;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class RevenueMethodCalculation
 * @package App\Models\Methods
 * @property-read int id
 * @property-read int project_id
 * @property-read float cost
 * @property float discount_rate
 * @property-read Collection|RevenueMethodPeriod[] periods
 */
class RevenueMethodCalculation extends Model
{
    protected $with = ['periods'];
    protected $fillable = ['discount_rate', 'cost'];

    public function periods(): HasMany
    {
        return $this->hasMany(RevenueMethodPeriod::class);
    }

    public function getCostAttribute(): float
    {
        $subtotal = $this->periods
            ->sortBy('index')
            ->reduce(function ($carry, RevenueMethodPeriod $period) {
                $sum = (float)$period->sales_volume
                    * ((float)$period->expected_price - (float)$period->expected_cost)
                    * pow(1. + (float)$this->discount_rate / 100, ($period->index + 1));

                $carry['sum'] = ($carry['sum'] ?? 0.) + $sum;
                $carry['licensor'] = ($carry['licensor'] ?? 0.) + $sum * ((float)$period->licensor_percentage / 100);

                return $carry;
            }, []);

        return round(0.8 * $subtotal['sum'] - $subtotal['licensor'], 2);
    }
}
