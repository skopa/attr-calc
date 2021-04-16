<?php

namespace App\Http\Requests\Methods;

use App\Http\Requests\AttributeValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class CostMethodRequest extends FormRequest
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
            'percentage_of_cost' => $this->attributeRules('cost_method.percentage_of_cost'),

            'sum.raw_materials' => $this->attributeRules('cost_method.sum.raw_materials'),
            'sum.returnable_waste' => $this->attributeRules('cost_method.sum.returnable_waste'),
            'sum.third_parties_production' => $this->attributeRules('cost_method.sum.third_parties_production'),
            'sum.fuel_and_energy' => $this->attributeRules('cost_method.sum.fuel_and_energy'),
            'sum.wages' => $this->attributeRules('cost_method.sum.wages'),
            'sum.social_events_deductions' => $this->attributeRules('cost_method.sum.social_events_deductions'),
            'sum.defective_lose' => $this->attributeRules('cost_method.sum.defective_lose'),
            'sum.total_expenditures' => $this->attributeRules('cost_method.sum.total_expenditures'),
            'sum.general_expenses' => $this->attributeRules('cost_method.sum.general_expenses'),
            'sum.other_production_expenses' => $this->attributeRules('cost_method.sum.other_production_expenses'),
            'sum.commercial_expenses' => $this->attributeRules('cost_method.sum.commercial_expenses'),
        ];
    }
}
