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
                   <a href="{{route('products.index')}}" class="btn btn-primary"> products</a>
                        @can('add_roles')   <a href="{{route('roles.index')}}" class="btn btn-primary"> roles</a>@endcan
                        @can('add_users')   <a href="{{route('users.Dashboard.index')}}" class="btn btn-primary"> users</a>@endcan

                     <div>
                         <h5 style="text-align: center">welcome to dashboard</h5>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
