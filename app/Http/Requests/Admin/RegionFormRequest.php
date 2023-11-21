<?php

namespace Pterodactyl\Http\Requests\Admin;

use Pterodactyl\Models\Region;

class RegionFormRequest extends AdminFormRequest
{
    /**
     * Set up the validation rules to use for these requests.
     */
    public function rules(): array
    {
        if ($this->method() === 'PATCH') {
            return Region::getRulesForUpdate($this->route()->parameter('region')->id);
        }

        return Region::getRules();
    }
}
