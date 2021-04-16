<?php

namespace App\Http\Requests\Methods;

use App\Http\Requests\AttributeValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class CompetitiveMethodRequest extends FormRequest
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
            'values.own_quality_value' => $this->attributeRules('competitive_method.own_quality_value'),
            'values.analog_quality_value' => $this->attributeRules('competitive_method.analog_quality_value'),
            'values.weight_factor' => $this->attributeRules('competitive_method.weight_factor'),
            'values.analog_implementation_costs' => $this->attributeRules('competitive_method.analog_implementation_costs'),
            'values.own_implementation_costs' => $this->attributeRules('competitive_method.own_implementation_costs'),
            'values.analog_support_cost' => $this->attributeRules('competitive_method.analog_support_cost'),
            'values.own_support_cost' => $this->attributeRules('competitive_method.own_support_cost'),

            'values.k1' => $this->attributeRules('competitive_method.k1'),
            'values.k2' => $this->attributeRules('competitive_method.k2'),
            'values.k3' => $this->attributeRules('competitive_method.k3'),
            'values.k4' => $this->attributeRules('competitive_method.k4'),
            'values.k5' => $this->attributeRules('competitive_method.k5'),

            'parameters' => $this->attributeRules('competitive_method.parameters_count'),
            'parameters_q_value_sum' => $this->attributeRules('competitive_method.parameters_q_value_sum'),
            'parameters.*.name' => $this->attributeRules('competitive_method.parameters.name'),
            'parameters.*.direction' => $this->attributeRules('competitive_method.parameters.direction'),
            'parameters.*.q_value' => $this->attributeRules('competitive_method.parameters.q_value'),
            'parameters.*.analog_value' => $this->attributeRules('competitive_method.parameters.analog_value'),
            'parameters.*.own_value' => $this->attributeRules('competitive_method.parameters.own_value'),
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'parameters_q_value_sum' => collect($this->get('parameters'))->sum('q_value'),
        ]);
    }
}
