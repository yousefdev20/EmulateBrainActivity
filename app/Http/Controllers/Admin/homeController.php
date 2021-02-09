<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    protected $schema = [0 => 'id',1 => 'name'];
    public $failable = [0 => 'id',1 => 'name',2 => 'email',3 => 'role_id',4 => 'created_at',5 => 'updated_at'];
    public function index(){
        $users = DB::table('users')
            ->select($this->failable)
            ->get();
        return view('admin.home')->with('users', $users)->with('schema', json_encode($this->failable));
    }
}
