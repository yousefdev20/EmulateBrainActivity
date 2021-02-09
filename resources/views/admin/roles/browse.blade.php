@extends('layouts.cus_app')

@section('content')
    <div class="px-5 pt-2 font-weight-bolder my-5 text-capitalize">
        <h2>
            <i class="fas fa-lock"></i> roles
        </h2>
        @if(can('add_roles'))
            <a class="btn-sm btn btn-success text-capitalize" href="{{ route('admin.role.create') }}">
                <i class="fas fa-plus"></i>
                add new
            </a>
        @endif
    </div>
    <div class="px-5">
        <reader data="{{ (json_encode($roles)) }}" schema="{{ json_encode($schema) }}" uri="/admin/roles" permission="{{ json_encode($permission) }} " object_type="roles"></reader>
    </div>
@endsection
