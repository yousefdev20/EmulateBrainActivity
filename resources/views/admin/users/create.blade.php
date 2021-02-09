@extends('layouts.cus_app')

@section('content')
    <div class="px-5 pt-2 font-weight-bolder my-5 text-capitalize">
        <h2>
            <i class="fas fa-user"></i> add user
        </h2>
    <div class="px-5 py-4 my-5 border-0 shadow-sm card position-static">
        <form action="{{ route("admin.users.save") }}" method="POST" enctype="multipart/form-data">
            @csrf()
            <div class="form-group">
                <label>
                    name
                </label>
                <input class="form-control" placeholder="Name" name="name" value="{{ old('name') }}">
                <p class="text-danger text-capitalize">
                    {{ $errors->first('name') }}
                </p>
                <label>
                    email
                </label>
                <input class="form-control" placeholder="Email" type="email" name="email" value="{{ old('email') }}">
                <p class="text-danger text-capitalize">
                    {{ $errors->first('email') }}
                </p>
                <label>
                    password
                </label>
                <input class="form-control" placeholder="Password" type="password" name="password">
                <p class="text-danger text-capitalize">
                    {{ $errors->first('password') }}
                </p>
                <label>
                    Photo
                </label>
                <input class="form-control" id="file-logo" type="file" placeholder="Photo" type="text" name="avatar" onchange="previewFile('logo')">
                <p class="text-danger text-capitalize">
                    {{ $errors->first('avatar') }}
                </p>
                <img width="100" height="100" id="img-logo" class="in-active rounded-circle"><br>
                <label>
                    phone
                </label>
                <input class="form-control" placeholder="Phone" type="text" name="phone" value="{{ old('phone') }}">
                <p class="text-danger text-capitalize">
                    {{ $errors->first('phone') }}
                </p>
                <label>
                    default role
                </label>
                <select class="form-control" placeholder="Default Role" name="role">
                    <optgroup label="Default Role"></optgroup>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                    @endforeach
                </select>
                <p class="text-danger text-capitalize">
                    {{ $errors->first('role') }}
                </p>
                <label>
                    additional roles
                </label>
                    <select multiple class="form-control" placeholder="Additional Roles" name="additional_roles[]">
                        <optgroup label="Additional Roles"></optgroup>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                        @endforeach
                    </select>
                <p class="text-danger text-capitalize">
                    {{ $errors->first('additional_roles') }}
                </p>
            </div>
            <button class="btn btn-primary text-capitalize rounded-0 float-right mt-5" type="submit">save</button>
        </form>

    </div>
    </div>
@endsection
