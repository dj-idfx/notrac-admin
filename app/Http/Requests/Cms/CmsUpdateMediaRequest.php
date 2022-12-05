<?php

namespace App\Http\Requests\Cms;

use App\Models\Media;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CmsUpdateMediaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if (Auth::user()->can('manage content')) {
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
            'name' => 'required|string|max:255',
        ];
    }

    /**
     * Actions to perform after validation passes
     *
     * @param Media $medium
     * @return Media
     */
    public function actions(Media $medium): Media
    {
        $medium->update($this->safe()->only([
            'name',
        ]));

        // Flash message
        session()->flash('flash_message', __('Media updated successfully!'));
        session()->flash('flash_level', 'success');

        // Return media
        return $medium;
    }
}
