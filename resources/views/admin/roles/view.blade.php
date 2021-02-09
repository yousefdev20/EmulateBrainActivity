@extends('layouts.cus_app')

@section('content')
    <div class="px-5 pt-2 font-weight-bolder my-5 text-capitalize">
        <h3>
            <i class="fas fa-lock"></i> Viewing Role
        </h3>
        @if(can('delete_roles'))
            <a href="/admin/roles/delete/{{$role->id}}" class="btn btn-sm btn-danger text-capitalize">
                <i class="fas fa-trash-alt"></i>
                delete
            </a>
        @endif
        @if(can('edit_roles'))
            <a href="/admin/roles/edit/{{$role->id}}" class="btn btn-sm btn-primary text-capitalize">
                <i class="fas fa-pencil-alt"></i>
                edit
            </a>
        @endif
        <a href="{{ route('admin.roles') }}" class="btn btn-sm btn-warning text-capitalize">
            <i class="fas fa-list"></i>
            return to list
        </a>
        <div class="px-5 py-4 my-5 border-0 shadow-sm card position-static">
            <div class="form-group">
                <label>
                    name
                </label>
                <h5>
                    {{ $role->name }}
                </h5>
                <hr>
                <label>
                    display name
                </label>
                <h5>
                    {{ $role->name }}
                </h5>
                <hr>
            </div>
        </div>
    </div>
@endsection
