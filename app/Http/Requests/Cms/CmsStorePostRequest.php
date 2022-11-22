<?php

namespace App\Http\Requests\Cms;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CmsStorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if (Auth::user()->can('write article')) {
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
     * @return Post
     */
    public function actions(): Post
    {
        $post = new Post(['title' => $this->safe()->title]);
        Auth::user()->posts()->save($post);

        // Flash message:
        session()->flash('flash_message', __('New post created successfully!'));
        session()->flash('flash_level', 'success');

        // Return Post
        return $post;
    }
}
