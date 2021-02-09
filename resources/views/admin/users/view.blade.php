@extends('layouts.cus_app')

@section('content')
    <div class="px-5 pt-2 font-weight-bolder my-5 text-capitalize">
        <h3>
            <i class="fas fa-user"></i> Viewing User
        </h3>
        @if(can('delete_users'))
            <a href="/admin/users/delete/{{$user->id}}" class="btn btn-sm btn-danger text-capitalize">
                <i class="fas fa-trash-alt"></i>
                delete
            </a>
        @endif
        @if(can('edit_users'))
            <a href="/admin/users/edit/{{$user->id}}" class="btn btn-sm btn-primary text-capitalize">
                <i class="fas fa-pencil-alt"></i>
                edit
            </a>
        @endif
        @if(can('browse_users'))
            <a href="{{ route('admin.users') }}" class="btn btn-sm btn-warning text-capitalize">
                <i class="fas fa-list"></i>
                return to list
            </a>
        @endif
        <div class="px-5 py-4 my-5 border-0 shadow-sm card position-static">
            <div class="form-group">
                <label>
                    name
                </label>
                <h6>
                    {{ $user->name }}
                </h6>
                <hr>
                <label>
                    email
                </label>
                <h6>
                    {{ $user->email }}
                </h6>
                <hr>
                <label>
                    avatar
                </label>
                <br>
                <img src="{{ url($user->avatar) }}" width="100" height="100" id="img-logo" class="rounded-circle"><br>
                <hr>
                <label>
                    phone
                </label>
                <h6>
                    {{ $user->phone }}
                </h6>
                <hr>
                <label>
                    default role
                </label>
                <h6>
                    {{ $user->display_name }}
                </h6>
                <hr>
                <label>
                    additional roles
                </label>
                <h6>
                    @foreach($roles as $role)
                        @if(in_array($role->id, collect($additional_roles)->toArray()))
                            <h6>{{ $role->display_name }}</h6>
                        @endif
                    @endforeach
                </h6>
            </div>
        </div>
    </div>
@endsection
