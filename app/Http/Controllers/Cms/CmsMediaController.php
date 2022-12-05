<?php

namespace App\Http\Controllers\Cms;

use App\Http\Requests\Cms\CmsUpdateMediaRequest;
use App\Models\Media;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CmsMediaController extends BaseCmsController
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
        // Add extra 'manage content' middleware
        $this->middleware(['can:manage content'])->except(['index', 'show']);
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
        $images = Media::where('mime_type', 'like', 'image/%')->orderByDesc('created_at')->get();

        return view('cms.media.index', compact('images'));
    }

    /**
     * Display the specified resource.
     *
     * @param Media $medium
     * @return View
     */
    public function show(Media $medium): View
    {
        return view('cms.media.show', compact('medium'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Media $medium
     * @return View
     */
    public function edit(Media $medium): View
    {
        return view('cms.media.edit', compact('medium'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CmsUpdateMediaRequest $request
     * @param Media $medium
     * @return RedirectResponse
     */
    public function update(CmsUpdateMediaRequest $request, Media $medium): RedirectResponse
    {
        $medium = $request->actions($medium);

        return redirect()->route('cms.media.show', $medium);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Media $medium
     * @return RedirectResponse
     */
    public function destroy(Media $medium): RedirectResponse
    {
        $medium->delete();

        session()->flash('flash_message', __('Media deleted successfully!'));
        session()->flash('flash_level', 'warning');

        return redirect()->route('cms.media.index');
    }
}
