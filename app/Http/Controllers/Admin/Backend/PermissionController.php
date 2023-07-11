<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    protected Permission $model;

    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $permissions = Permission::all();
        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        $name =  preg_replace('/\s+/', '.', $request->validated('name'));
        $permission_created = $this->model->create(['name' => $name]);

        $notification = $this->notification($permission_created, 'Permission Successfully Created', 'Failed To Create Permission');
        return redirect(route('permission.index'))->with('notification', $notification);
    }

    public function edit(Permission $permission): View
    {
        return view('admin.permission.edit', compact('permission'));
    }

    public function update(PermissionRequest $request, Permission $permissiont)
    {
        $name =  preg_replace('/\s+/', '.', $request->validated('name'));
        $permission_updated = $permissiont->update(['name' => $name]);

        $notification = $this->notification($permission_updated, 'Permission Update Created', 'Failed To Update Permission');
        return redirect(route('permission.index'))->with('notification', $notification);
    }

    public function destroy(Permission $permission)
    {
        //
    }
}
