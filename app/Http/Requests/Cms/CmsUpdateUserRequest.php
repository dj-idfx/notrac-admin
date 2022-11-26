<?php

namespace App\Http\Requests\Cms;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class CmsUpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if (Auth::user()->can('manage users')) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => ['required','string','email','max:255', Rule::unique('users')->ignore($this->user)],
            'role'       => ['required', 'string', 'max:255', 'exists:roles,name' ],
            'avatar'     => [
                'nullable',
                File::image()->max(2048)->dimensions(Rule::dimensions()->minWidth(200)->minHeight(200)->maxWidth(2000)->maxHeight(2000)),
            ],
        ];
    }

    /**
     * Actions to perform after validation passes
     *
     * @param User $user
     * @return User
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function actions(User $user): User
    {
        // Update User, only when the edited user is not a super-admin
        if (! $user->hasRole('super-admin')) {
            $user->update($this->safe()->only([
                'first_name',
                'last_name',
                'email',
            ]));

            // Assign Role to User
            if ($this->safe()->role != 'super-admin') {
                $user->syncRoles([$this->safe()->role]);
            }

            // Upload avatar
            if($this->hasFile("avatar")) {
                $user->addMedia($this->safe()->avatar)->toMediaCollection('avatar');
            }

            session()->flash('flash_message', __('User updated successfully!'));
            session()->flash('flash_level', 'success');

        } else {
            session()->flash('flash_message', __('Unable to update user!'));
            session()->flash('flash_level', 'danger');
        }

        // Return User
        return $user;
    }
}
