<?php

namespace App\Http\Controllers\Cms;

use App\Http\Requests\Cms\CmsStoreUserRequest;
use App\Http\Requests\Cms\CmsUpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CmsUserController extends BaseCmsController
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
        // Add extra 'manage users' middleware
        $this->middleware(['can:manage users'])->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $users = User::with('roles:id,name')->orderBy('last_name')->get();

        return view('cms.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('cms.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CmsStoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(CmsStoreUserRequest $request): RedirectResponse
    {
        $user = $request->actions();

        return redirect()->route('cms.users.show', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        return view('cms.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view('cms.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CmsUpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(CmsUpdateUserRequest $request, User $user): RedirectResponse
    {
        $user = $request->actions($user);

        return redirect()->route('cms.users.show', $user);
    }

    /**
     * Softdelete the specified resource.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        // Flash message:
        session()->flash('flash_message', __('User trashed successfully!'));
        session()->flash('flash_level', 'success');

        return redirect()->route('cms.users.index');
    }

    /**
     * Display a listing of soft deleted resources.
     *
     * @return View
     */
    public function trash(): View
    {
        $users = User::onlyTrashed()->orderBy('last_name')->get();

        return view('cms.users.trash', compact('users'));
    }

    /**
     * Restore the specified resource.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        // Flash message:
        session()->flash('flash_message', __('User restored successfully!'));
        session()->flash('flash_level', 'success');

        return redirect()->route('cms.users.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();

        // Flash message:
        session()->flash('flash_message', __('User deleted successfully!'));
        session()->flash('flash_level', 'success');

        return redirect()->route('cms.users.trash');
    }

    /**
     * Remove all soft deleted resources from storage.
     *
     * @return RedirectResponse
     */
    public function empty(): RedirectResponse
    {
        User::onlyTrashed()->forceDelete();

        // Flash message:
        session()->flash('flash_message', __('User trash empty!'));
        session()->flash('flash_level', 'success');

        return redirect()->route('cms.users.trash');
    }
}
