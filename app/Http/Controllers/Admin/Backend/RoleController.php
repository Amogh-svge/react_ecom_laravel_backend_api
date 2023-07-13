<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    protected Role $roleModel;
    protected Permission $permissionModel;

    public function __construct(Role $roleModel, Permission $permissionModel)
    {
        $this->roleModel = $roleModel;
        $this->permissionModel = $permissionModel;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $roles = $this->roleModel->paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $role = $this->roleModel->create($request->validated());

        $notification = $this->notification($role, 'Role Successfully Created', 'Failed To Create Role');
        return redirect(route('roles.index'))->with('notification', $notification);
    }

    /**
     * Display the specified resource.
     * @return View
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role): View
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $role_updated = $role->update($request->validated());

        $notification = $this->notification($role_updated, 'Role Updated Successfully', 'Failed To Update Role');
        return redirect(route('roles.index'))->with('notification', $notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): RedirectResponse
    {
        $role_deleted = $role->delete();

        $notification = $this->notification($role_deleted, 'Role Deleted Successfully', 'Failed To Delete Role');
        return back()->with('notification', $notification);
    }


    /**
     * All roles to permission methods
     */

    public function AddRolesPermission(): View
    {
        $roles = $this->roleModel->latest()->get();
        $permissions = $this->permissionModel->latest()->get();
        return view('admin.roles.add_roles_to_permission', compact('roles', 'permissions'));
    }
}
