<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $posts = Post::isPublished()->with('user')->orderByDesc('created_at')->get();

        return view('public.posts.index', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return RedirectResponse|View
     */
    public function show(Post $post): View|RedirectResponse
    {
        if (! $post->published) {
            return redirect()->route('posts.index');
        }

        return view('public.posts.show', compact('post'));
    }
}
