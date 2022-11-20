<?php

namespace App\Http\Controllers\Cms;

use App\Http\Requests\Cms\CmsStoreRoleRequest;
use App\Http\Requests\Cms\CmsUpdateRoleRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CmsRoleController extends BaseCmsController
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
        // Add extra middleware
        $this->middleware(['can:manage users', 'can:manage roles']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $roles = Role::whereNotIn('name', ['super-admin'])->get();

        return view('cms.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $permissions = Permission::get(['id', 'name']);

        return view('cms.roles.create', compact('permissions'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CmsStoreRoleRequest $request
     * @return RedirectResponse
     */
    public function store(CmsStoreRoleRequest $request): RedirectResponse
    {
        $role = $request->actions();

        return redirect()->route('cms.roles.show', $role);
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return View
     */
    public function show(Role $role): View
    {
        $users = User::role($role->name)->orderBy('last_name')->get();

        return view('cms.roles.show', compact('role', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return View
     */
    public function edit(Role $role): View
    {
        $permissions = Permission::get(['id', 'name']);

        return view('cms.roles.edit', compact('role', "permissions"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CmsUpdateRoleRequest $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(CmsUpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $role = $request->actions($role);

        return redirect()->route('cms.roles.show', $role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return RedirectResponse
     */
    public function destroy(Role $role): RedirectResponse
    {
        // Delete Role, only when the deleted role is not super-admin
        if ($role->name != 'super-admin') {
            $role->delete();

            session()->flash('flash_message', __('Role deleted successfully!'));
            session()->flash('flash_level', 'warning');

        } else {
            session()->flash('flash_message', __('Unable to delete role!'));
            session()->flash('flash_level', 'danger');

            return redirect()->route('cms.roles.show', $role);
        }

        return redirect()->route('cms.roles.index');
    }
}
