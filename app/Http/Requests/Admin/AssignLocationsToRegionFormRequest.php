<?php

namespace Pterodactyl\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AssignLocationsToRegionFormRequest extends AdminFormRequest
{
    public function authorize(): bool // artisan created this, not sure if it's necessary but not going to remove it
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'locations' => 'required|array', // Assuming locations should be an array
            'locations.*' => 'exists:locations,id', // Assuming you want to validate if location IDs exist
        ];
    }
}
