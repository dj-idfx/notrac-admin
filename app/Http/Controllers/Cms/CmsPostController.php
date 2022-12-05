<?php

namespace App\Http\Controllers\Cms;

use App\Http\Requests\Cms\CmsStoreDropzoneImagesRequest;
use App\Http\Requests\Cms\CmsStorePostRequest;
use App\Http\Requests\Cms\CmsUpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class CmsPostController extends BaseCmsController
{
    /**
     * Instantiate the controller.
     *
     * @return void
     */
    public function __construct()
    {
        // Import BaseCmsController constructor with the basic CMS routes middleware
        parent::__construct();
        // Add extra 'write article' middleware to create & store routes
        $this->middleware(['can:write article'])->only(['create', 'store']);
        // Add extra 'manage content' middleware to all other editing routes
        $this->middleware(['can:manage content'])->except(['index', 'show', 'create', 'store']);
        // Start media queue
        $this->middleware(['queue_media'])->only(['show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $posts = Post::with('user')->orderByDesc('created_at')->get();

        return view('cms.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('cms.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CmsStorePostRequest $request
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(CmsStorePostRequest $request): RedirectResponse
    {
        $post = $request->actions();

        return redirect()->route('cms.posts.show', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return View
     */
    public function show(Post $post): View
    {
        return view('cms.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return View
     */
    public function edit(Post $post): View
    {
        return view('cms.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CmsUpdatePostRequest $request
     * @param Post $post
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(CmsUpdatePostRequest $request, Post $post): RedirectResponse
    {
        $post = $request->actions($post);

        return redirect()->route('cms.posts.show', $post);
    }

    /**
     * Softdelete the specified resource.
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        session()->flash('flash_message', __('Post trashed successfully!'));
        session()->flash('flash_level', 'warning');

        return redirect()->route('cms.posts.index');
    }

    /**
     * Display a listing of soft deleted resources.
     *
     * @return View
     */
    public function trash(): View
    {
        $posts = Post::onlyTrashed()->orderByDesc('created_at')->get();

        return view('cms.posts.trash', compact('posts'));
    }

    /**
     * Restore the specified resource.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function restore(string $id): RedirectResponse
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();

        session()->flash('flash_message', __('Post restored successfully!'));
        session()->flash('flash_level', 'success');

        return redirect()->route('cms.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function delete(string $id): RedirectResponse
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->forceDelete();

        session()->flash('flash_message', __('Post deleted successfully!'));
        session()->flash('flash_level', 'warning');

        return redirect()->route('cms.posts.trash');
    }

    /**
     * Remove all soft deleted resources from storage.
     *
     * @return RedirectResponse
     */
    public function empty(): RedirectResponse
    {
        Post::onlyTrashed()->forceDelete();

        session()->flash('flash_message', __('Post trash empty!'));
        session()->flash('flash_level', 'warning');

        return redirect()->route('cms.posts.trash');
    }

    /**
     * (un-)Publish the specified resource.
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function publish(Post $post): RedirectResponse
    {
        if ($post->published) {
            $post->published_at = null;
            $post->save();

            session()->flash('flash_message', __('Post unpublished'));
            session()->flash('flash_level', 'warning');

        } else {
            $post->published_at = now();
            $post->save();

            session()->flash('flash_message', __('Post published!'));
            session()->flash('flash_level', 'success');
        }

        return redirect()->route('cms.posts.show', $post);
    }

    /**
     * Add images
     *
     * @param CmsStoreDropzoneImagesRequest $request
     * @param Post $post
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function images(CmsStoreDropzoneImagesRequest $request, Post $post)
    {
        $media = $request->safe()->media;

        foreach ($media as $medium) {
            $medium = $post->addMedia($medium)->toMediaCollection('images');
            $request->actions($medium);
        }
    }
}
