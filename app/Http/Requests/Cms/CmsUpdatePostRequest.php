<?php

namespace App\Http\Requests\Cms;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CmsUpdatePostRequest extends FormRequest
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
            'title' => 'required|string|max:255',
        ];
    }

    /**
     * Actions to perform after validation passes
     *
     * @param Post $post
     * @return Post
     */
    public function actions(Post $post): Post
    {
        $post->update($this->safe()->only([
            'title',
        ]));

        session()->flash('flash_message', __('Post updated successfully!'));
        session()->flash('flash_level', 'success');

        // Return post
        return $post;
    }
}
