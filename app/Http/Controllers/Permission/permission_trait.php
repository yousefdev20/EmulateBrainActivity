<?php
use Illuminate\Support\Facades\Cache;
function can($role){
    try {

    $permission = collect(DB::table('users')
        ->where('users.id', auth()->user()->id)
        // i have permissions id
        ->join('permission_role', 'users.role_id', '=', 'permission_role.role_id')
        ->join('permissions', 'permission_role.permission_id', '=', 'permissions.id')
        ->select(['users.id', 'permission_id', 'key'])
        ->get());
        return (count($permission->where('key', '=', $role)->values()) > 0 ? 1: 0);
    }catch (\Exception $ex){
        return view('auth.login');
    }

    }
function permission_can(){
    try {

    $permission = collect(DB::table('users')
        ->where('users.id', auth()->user()->id)
        // i have permissions id
        ->join('permission_role', 'users.role_id', '=', 'permission_role.role_id')
        ->join('permissions', 'permission_role.permission_id', '=', 'permissions.id')
        ->select(['users.id', 'permission_id', 'key'])
        ->get());
        $col = collect();
        collect($permission)->map(function ($value, $key) use ($col){
            $col->add($value->key);
        });
        return $col;
    }catch (\Exception $ex){
        return view('auth.login');
    }

}
