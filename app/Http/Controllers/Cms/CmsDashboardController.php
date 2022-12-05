<?php

namespace App\Http\Controllers\Cms;

use App\Models\Media;
use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;

class CmsDashboardController extends BaseCmsController
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
    }

    /**
     * Display the CMS dashboard view.
     *
     * @return View
     */
    public function index(): View
    {
        $userCount = User::count();
        $userUnverifiedCount = User::whereNull('email_verified_at')->count();
        $userInactiveCount = User::where('active', false)->count();

        $postCount = Post::count();
        $postPublishedCount = Post::isPublished()->count();
        $postNotPublishedCount = Post::isUnpublished()->count();

        $mediaCount = Media::count();
        $mediaImageCount = Media::where('mime_type', 'like', 'image/%')->count();
        $mediaVideoCount = Media::where('mime_type', 'like', 'video/%')->count();

        return view('cms.index', compact(
            'userCount', 'userUnverifiedCount', 'userInactiveCount',
            'postCount', 'postPublishedCount', 'postNotPublishedCount',
            'mediaCount', 'mediaImageCount', 'mediaVideoCount',
        ));
    }
}
