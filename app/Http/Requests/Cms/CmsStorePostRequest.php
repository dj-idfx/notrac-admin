<?php

namespace App\Http\Requests\Cms;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Spatie\Image\Image;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

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
            'quill' => 'required|string',
            'cover' => [
                'nullable',
                File::image()->max(2048)->dimensions(Rule::dimensions()->minWidth(200)->minHeight(200)->maxWidth(6000)->maxHeight(6000)),
            ],
        ];
    }

    /**
     * Actions to perform after validation passes
     *
     * @return Post
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function actions(): Post
    {
        $post = new Post([
            'title' => $this->safe()->title,
            'quill' =>$this->safe()->quill,
        ]);
        Auth::user()->posts()->save($post);

        // Upload cover
        if($this->hasFile("cover")) {
            $media = $post->addMedia($this->safe()->cover)
                ->toMediaCollection('cover');

            $image = Image::load($media->getFullUrl());
            $media->width = $image->getWidth();
            $media->height = $image->getHeight();
            $media->save();
        }

        // Flash message
        session()->flash('flash_message', __('New post created successfully!'));
        session()->flash('flash_level', 'success');

        // Return Post
        return $post;
    }
}
