<?php

namespace App\Http\Requests\Cms;

use App\Models\Media;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Spatie\Image\Image;

class CmsStoreDropzoneImagesRequest extends FormRequest
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
            'media.*' => [
                'bail','present','required',
                File::image()->max(2048)->dimensions(Rule::dimensions()->minWidth(200)->minHeight(200)->maxWidth(6000)->maxHeight(6000)),
            ],
        ];
    }

    /**
     * Actions to perform after validation passes
     *
     * @param Media $medium
     * @return void
     */
    public function actions(Media $medium): void
    {
        /* Save width & height to database */
        $image = Image::load($medium->getFullUrl());
        $medium->width = $image->getWidth();
        $medium->height = $image->getHeight();
        $medium->save();
    }
}
