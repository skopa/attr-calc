<?php

namespace App\Http\Requests\Methods;

use App\Http\Requests\AttributeValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class RevenueMethodRequest extends FormRequest
{
    use AttributeValidationTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'discount_rate' => 'required|'.$this->attributeRules('revenue_method.discount_rate'),
            'periods' => 'required|'.$this->attributeRules('revenue_method.periods_count'),
            'periods.*.sales_volume' => 'required|'.$this->attributeRules('revenue_method.period.sales_volume'),
            'periods.*.expected_price' => 'required|'.$this->attributeRules('revenue_method.period.expected_price'),
            'periods.*.expected_cost' => 'required|'.$this->attributeRules('revenue_method.period.expected_cost'),
            'periods.*.licensor_percentage' => 'required|gt:0|'.$this->attributeRules('revenue_method.period.licensor_percentage'),
        ];
    }
}
