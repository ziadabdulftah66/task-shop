@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="card-content">
                                        <div class="card-body">
                                            <form class="form form-vertical" action="{{route('roles.update',$role->id)}}"
                                                  method="POST"
                                                  enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="first-name-vertical"> Role Name</label>
                                                                <input type="text" id="first-name-vertical" class="form-control" name="name" value="{{$role->name}}" >
                                                            </div>
                                                            @error('name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>


                                                    </div>
                                                    <div class="row">

                                                            @foreach (config('global.permissions') as $name => $value)
                                                                <div class="form-group col-sm-4">
                                                                    <label class="checkbox-inline">
                                                                        <input type="checkbox" class="chk-box" name="permissions[]" value="{{ $name }}"  {{ in_array($name, $role->permissions)? 'checked' : '' }}>    {{ $value }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                                @error('permissions')
                                                                <span class="text-danger"> {{$message}}</span>
                                                                @enderror
                                                    </div>

                                                    <input type="hidden" value="{{URL::previous()}}" name="redirects_to">


                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Edit</button>

                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>



    </div>
    </div>

    </div>
    </div>

@endsection
