<?php

namespace App\Http\Requests\Cms;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class CmsStoreRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if (Auth::user()->can('manage roles')) {
            return true;
        }

        return false;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => Str::slug($this->name),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:32|unique:roles',
            'permissions.*' => 'bail|nullable|integer',
        ];
    }

    /**
     * Actions to perform after validation passes
     *
     * @return Role
     */
    public function actions(): Role
    {
        $role = Role::create(['name' => $this->safe()->name]);

        // Sync permissions
        if ($this->permissions) {
            $role->syncPermissions($this->safe()->permissions);
        }

        // Flash message:
        session()->flash('flash_message', __('New role created successfully!'));
        session()->flash('flash_level', 'success');

        // Return Role
        return $role;
    }
}
