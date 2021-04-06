<?php

namespace App\Http\Requests\Methods;

use App\Http\Requests\AttributeValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class ProjectCostMethodRequest extends FormRequest
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
            'percentage_of_cost' => 'required|' . $this->attributeRules('cost_method.percentage_of_cost'),

            'sum.raw_materials' => 'required|' . $this->attributeRules('cost_method.sum.raw_materials'),
            'sum.returnable_waste' => 'required|' . $this->attributeRules('cost_method.sum.returnable_waste'),
            'sum.third_parties_production' => 'required|' . $this->attributeRules('cost_method.sum.third_parties_production'),
            'sum.fuel_and_energy' => 'required|' . $this->attributeRules('cost_method.sum.fuel_and_energy'),
            'sum.wages' => 'required|' . $this->attributeRules('cost_method.sum.wages'),
            'sum.social_events_deductions' => 'required|' . $this->attributeRules('cost_method.sum.social_events_deductions'),
            'sum.defective_lose' => 'required|' . $this->attributeRules('cost_method.sum.defective_lose'),
            'sum.total_expenditures' => 'required|' . $this->attributeRules('cost_method.sum.total_expenditures'),
            'sum.general_expenses' => 'required|' . $this->attributeRules('cost_method.sum.general_expenses'),
            'sum.commercial_expenses' => 'required|' . $this->attributeRules('cost_method.sum.commercial_expenses'),
        ];
    }
}
