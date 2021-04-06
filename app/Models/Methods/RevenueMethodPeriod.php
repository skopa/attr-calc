<?php

namespace App\Models\Methods;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RevenueMethodPeriod
 * @package App\Models\Methods
 * @property-read int id
 * @property-read int cost_method_calculation_id
 * @property integer index
 * @property float sales_volume
 * @property float expected_price
 * @property float expected_cost
 * @property float licensor_percentage
 */
class RevenueMethodPeriod extends Model
{
    protected $fillable = ['index', 'sales_volume', 'expected_price', 'expected_cost', 'licensor_percentage'];
}
