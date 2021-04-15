<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'name' => 'required|string|min:5',
            'description' => 'nullable|string',
            'ready_level' => 'required|' . $this->attributeRules('project_ready_level'),
            'has_competitors' => 'required|' . $this->attributeRules('project_has_competitors')
        ];
    }
}
