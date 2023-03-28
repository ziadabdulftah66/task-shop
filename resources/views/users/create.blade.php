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

                        <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add Users</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-vertical" action="{{route('users.Dashboard.store')}}" method="post">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Username
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{old('username')}}"
                                                                   name="name">
                                                            @error("username")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Email
                                                            </label>
                                                            <input type="email" id="email"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value=""
                                                                   name="email">
                                                            @error("email")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Role
                                                        </label>
                                                        <select name="role_id" class="select2 form-control" >
                                                            <optgroup label="Please Choice Role">
                                                                @if($roles && $roles -> count() > 0)
                                                                    @foreach($roles as $role)
                                                                        <option
                                                                            value="{{$role -> id }}">{{$role -> name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('role_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Password
                                                        </label>
                                                        <input type="password" id="password"
                                                               class="form-control"
                                                               placeholder="  "
                                                               name="password">
                                                        @error("password")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-6">
                                                    <div class="form-group">

                                                        <label for="projectinput1"> Confirm Password
                                                        </label>
                                                        <input type="password" id=""
                                                               class="form-control"
                                                               placeholder="  "
                                                               name="password_confirmation" >
                                                    </div>
                                                </div>
                                            </div>


                                                    <div class="col-12" style="margin-top: 30px">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Add</button>

                                                    </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>



            </div>
        </div>

    </div>
</div>

@endsection
