@extends('layouts.cus_app')

@section('content')
    <div class="px-5 pt-2 font-weight-bolder my-5 text-capitalize">
        <h2>
            <i class="fas fa-users"></i> users
        </h2>
        @if(can('add_users'))
        <a class="btn-sm btn btn-success text-capitalize" href="{{ route('admin.user.create') }}">
            <i class="fas fa-plus"></i>
            add new
        </a>
        @endif
    </div>
    <div class="px-5">
        <reader data="{{ ($users) }}" schema="{{ ($schema) }}" uri="/admin/users" permission="{{ json_encode($permission) }} " object_type="users"></reader>
    </div>
@endsection
