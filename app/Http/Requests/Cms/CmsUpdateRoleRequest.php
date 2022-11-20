<?php

namespace App\Http\Requests\Cms;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CmsUpdateRoleRequest extends FormRequest
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
            'name'          => ['required','string', 'max:32', Rule::unique('roles')->ignore($this->role)],
            'permissions.*' => 'bail|nullable|integer',
        ];
    }

    /**
     * Actions to perform after validation passes
     *
     * @param Role $role
     * @return Role
     */
    public function actions(Role $role): Role
    {
        // Update Role, only when the edited role is not admin
        if ($role->name != 'super-admin' && $role->name != 'admin') {
            $role->name = $this->safe()->name;
            $role->save();

            // Sync permissions
            if ($this->permissions) {
                $role->syncPermissions($this->safe()->permissions);
            } else {
                $role->syncPermissions([]);
            }

            session()->flash('flash_message', __('Role updated successfully!'));
            session()->flash('flash_level', 'success');

        } else {
            if ($role->name == 'admin') {
                $role->givePermissionTo(Permission::all());
            }
            session()->flash('flash_message', __('Unable to update role!'));
            session()->flash('flash_level', 'danger');
        }

        // Return Role
        return $role;
    }
}
