<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public $failable = [0 => 'id',1 => 'name',2 => 'email',3 => 'role_id', 4 => 'phone'];
    public function index(Request $request){
        if (can('browse_users')) {
            $users = DB::table('users')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->select(['users.id', 'users.name', 'users.email', 'roles.display_name as role_id', 'users.phone'])
                ->get();
            $permission = collect(permission_can());
            return view('admin.users.browse')
                ->with('users', $users)
                ->with('schema', json_encode($this->failable))
                ->with('permission', $permission);
        }else{
            abort(404);
        }
    }
    public function delete(int $id)
    {
        if (can('delete_users')) {
            DB::table('users')->where('id', $id)->delete();
            return redirect()->route('admin.users');
        }else{
            abort(404);
        }
    }
    public function create(){
        if (can('add_users')) {
            $roles = DB::table('roles')
                ->select(['id', 'display_name'])
                ->get();
            return view('admin.users.create')->with('roles', $roles);
        }else{
            abort(404);
        }
    }
    public function save(Request $request){
        if (can('add_users')) {

            $request->validate([
                'name' => 'string|required|profane:en',
                'email' => 'unique:users|required|profane:en',
                'password' => 'string|required|profane:en',
                'phone' => 'required',
                'role' => 'required',
                'avatar' => 'required'
            ]);

            $avatar = "public/users/default.png";
            if ($request->hasFile('avatar')) {
                $Image = $request->file('avatar');
                $extension = $Image->getClientOriginalExtension();
                $avatar = '/users/' . $Image->getFilename() . '.' . $extension;
                $request->avatar->move(public_path('/users'), $avatar);
            }
            DB::transaction(function () use($request, $avatar){
                DB::table('users')
                    ->insert(
                        [
                            'name' => $request->name,
                            'email' => $request->email,
                            'phone' => $request->phone,
                            'password' => Hash::make($request->password),
                            'role_id' => $request->role,
                            'avatar' => $avatar
                        ]
                    );
                $lastUser = DB::table('users')
                    ->where('email', $request->email)
                    ->first();

                if ($request->has('additional_roles')) {
                    foreach ($request->additional_roles as $role)
                        DB::table('user_roles')->insert([
                            'user_id' => $lastUser->id,
                            'role_id' => $role,
                        ]);
                }
            });
            return redirect()->route('admin.users');
        }else{
            abort(404);
        }
    }
    public function edit(Request $request){
        if (can('edit_users')) {
            $roles = DB::table('roles')
                ->select(['id', 'display_name'])
                ->get();
            $user = DB::table('users')
                ->where('id', $request->id)
                ->first();
            $additional_roles = collect(DB::table('user_roles')
                ->where('user_id', $request->id)
                ->select(['role_id'])
                ->get());
            $col = collect();
            ($additional_roles)->map(function ($value, $key) use ($col){
                $col->add($value->role_id);
            });
            return view('admin.users.edit')->with('user', $user)->with('roles', $roles)->with('additional_roles', $col);
        }else{
            abort(404);
        }
    }
    public function update(Request $request){
        if (can('edit_users')) {
            $request->validate([
                'name' => 'string|required|profane:en',
                'email' => 'required|profane:en',
                'phone' => 'required',
                'role' => 'required',
            ]);
            $avatar = "public/users/default.png";
            if ($request->hasFile('avatar')) {
                $Image = $request->file('avatar');
                $extension = $Image->getClientOriginalExtension();
                $avatar = '/users/' . $Image->getFilename() . '.' . $extension;
                $request->avatar->move(public_path('/users'), $avatar);
            }

            if (isset($request->password)){
                $password = Hash::make($request->password);
            }else{
                $password = DB::table('users')
                    ->where('id', $request->id)
                    ->first()->password;
            }
            DB::transaction(function () use($request, $password, $avatar){
                DB::table('users')
                    ->where('id', $request->id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'password' => $password,
                        'role_id' => $request->role,
                        'avatar' => $avatar
                    ]);
                DB::table('user_roles')
                    ->where('user_id', $request->id)
                    ->delete();

                if ($request->has('additional_roles')) {
                    foreach ($request->additional_roles as $role)
                        DB::table('user_roles')->insert([
                            'user_id' => $request->id,
                            'role_id' => $role,
                        ]);
                }
            });
            return redirect()->route('admin.users');
        }else{
            abort(404);
        }
    }
    public function view(Request $request){
        if (can('browse_profile')) {
            $roles = DB::table('roles')
                ->select(['id', 'display_name'])
                ->get();
            $user = DB::table('users')
                ->where('users.id', $request->id)
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->select(['users.*', 'roles.display_name'])
                ->first();
            $col = collect();
            $additional_roles = collect(DB::table('user_roles')
                ->where('user_id', $request->id)
                ->select(['role_id'])
                ->get());
            $col = collect();
            ($additional_roles)->map(function ($value, $key) use ($col){
                $col->add($value->role_id);
            });
            return view('admin.users.view')->with('user', $user)->with('roles', $roles)->with('additional_roles', $col);
        }else{
            abort(404);
        }
    }
    public function profile(Request $request){
        if (can('browse_profile')) {
            $roles = DB::table('roles')
                ->select(['id', 'display_name'])
                ->get();
            $user = DB::table('users')
                ->where('users.id', auth()->user()->id)
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->select(['users.*', 'roles.display_name'])
                ->first();
            $col = collect();
            $additional_roles = collect(DB::table('user_roles')
                ->where('user_id', $request->id)
                ->select(['role_id'])
                ->get());
            $col = collect();
            ($additional_roles)->map(function ($value, $key) use ($col){
                $col->add($value->role_id);
            });
            return view('admin.users.view')->with('user', $user)->with('roles', $roles)->with('additional_roles', $col);
        }else{
            abort(404);
        }
    }
}

