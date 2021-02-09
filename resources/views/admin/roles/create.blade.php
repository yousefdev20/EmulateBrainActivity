@extends('layouts.cus_app')

@section('content')
    <div class="px-5 pt-2 font-weight-bolder my-5 text-capitalize">
        <h2>
            <i class="fas fa-lock"></i> add role
        </h2>
    <div class="px-5 py-4 my-5 border-0 shadow-sm card position-static">
        <form action="{{ route("admin.roles.save") }}" method="POST">
            @csrf()
            <div class="form-group">
                <label>
                    name
                </label>
                <input class="form-control" placeholder="Name" name="name">
                <p class="text-danger text-capitalize">
                    {{ $errors->first('name') }}
                </p>
                <label>
                    display name
                </label>
                <input class="form-control" placeholder="Display Name" type="text" name="display_name">
                <p class="text-danger text-capitalize">
                    {{ $errors->first('display_name') }}
                </p>
                <label>
                    permissions
                </label>
                @foreach($permissions as $key => $permission)
                    <h5>{{ $key }}</h5>
                    @foreach($permission as $item)
                        <h6>
                            <input type="checkbox" id="{{ $item->id }}" name="permissions[]" value="{{ $item->id }}">
                            <label for="{{ $item->id }}"> {{ str_replace('_', ' ', $item->key) }}</label>
                        </h6>
                    @endforeach
                    <br>
                @endforeach
            </div>
            <button class="btn btn-primary text-capitalize rounded-0 float-right mt-5" type="submit">save</button>
        </form>

    </div>
    </div>
@endsection
