<?php

namespace App\Http\Controllers\Admin\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class roleController extends Controller
{
    public $failable = [0 => 'id',1 => 'name',2 => 'display_name',3 => 'created_at'];
    public function index(){
        if (can('browse_roles')) {
            $roles = DB::table('roles')
                ->select($this->failable)
                ->get();
            $permission = collect(permission_can());
            return view('admin.roles.browse')
                ->with('roles', $roles)
                ->with('schema', $this->failable)
                ->with('permission', $permission);
        }else{
            abort(404);
        }
    }
    public function create(Request $request)
    {
        if (can('add_roles')) {
            $permissions = collect(DB::table('permissions')
                ->select(['id', 'key', 'table_name'])
                ->get())->groupBy('table_name');
            return view('admin/roles/create')
                ->with('permissions', $permissions);
        }else{
            abort(404);
        }
    }
    public function save(Request $request)
    {
        if (can('add_roles')) {
            $this->validate($request, [
                'name' => 'required|string|min:3|unique:roles|profane:en',
                'display_name' => 'required|string|min:3|unique:roles|profane:en'
            ]);
            DB::transaction(function () use ($request) {
                DB::table('roles')
                    ->insert([
                        'name' => $request->name,
                        'display_name' => $request->display_name
                    ]);
                $role_id = DB::table('roles')
                    ->where('name', $request->name)
                    ->where('display_name', $request->display_name)
                    ->select('id')
                    ->first()->id;
                foreach (collect($request->permissions)->toArray() as $item) {
                    DB::table('permission_role')
                        ->insert([
                            'permission_id' => (int)$item,
                            'role_id' => (int)$role_id
                        ]);
                }
            });
            return redirect()->route('admin.roles');
        }else{
            abort(404);
        }
    }
    public function edit($id)
    {
        if (can('edit_roles')) {
            if (DB::table('roles')->where('id', $id)->exists()) {
                $permissions_selected = DB::table('permission_role')
                    ->where('role_id', $id)
                    ->select('permission_id')
                    ->get();
                $arr = collect();
                foreach ($permissions_selected as $item) {
                    $arr->add($item->permission_id);
                }
                $role = DB::table('roles')
                    ->where('id', $id)
                    ->select(['id', 'name', 'display_name'])
                    ->first();
                $permissions = collect(DB::table('permissions')
                    ->select(['id', 'key', 'table_name'])
                    ->get())->groupBy('table_name');

                return view('admin.roles.edit')
                    ->with('permissions_selected', $arr)
                    ->with('permissions', $permissions)
                    ->with('role', $role);
            } else {
                abort(404);
            }
        }else{
            abort(404);
        }
    }
    public function update(Request $request)
    {
        if (can('edit_roles')) {
            DB::transaction(function () use ($request) {
                DB::table('roles')
                    ->where('id', $request->id)
                    ->update([
                        'name' => $request->name,
                        'display_name' => $request->display_name
                    ]);
                DB::table('permission_role')
                    ->where('role_id', $request->id)
                    ->delete();
                foreach (collect($request->permissions)->toArray() as $item) {
                    DB::table('permission_role')
                        ->insert([
                            'permission_id' => $item,
                            'role_id' => $request->id
                        ]);
                }
            });
            return redirect()->route('admin.roles');
        }else{
            abort(404);
        }
    }
    public function delete($id)
    {
        if (can('delete_roles')) {
            if (DB::table('roles')->where('id', $id)->exists()) {
                DB::transaction(function () use ($id) {
                    DB::table('roles')
                        ->where('id', $id)
                        ->delete();
                    DB::table('permission_role')
                        ->where('role_id', $id)
                        ->delete();
                });
            } else {
                abort(404);
            }
            return redirect()->route('admin.roles');
        }else{
            abort(404);
        }
    }
    public function view($id)
    {
        if (can('browse_roles')) {
            if (DB::table('roles')->where('id', $id)->exists()) {
                $role = DB::table('roles')
                    ->where('id', $id)
                    ->first();
                return view('admin.roles.view')->with('role', $role);
            } else {
                abort(404);
            }
        }else{
            abort(404);
        }
    }
}
