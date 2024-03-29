@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Product</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <table class="table">
                            <thead>
                            <tr>

                                <th scope="col">name</th>
                                <th scope="col">price</th>
                                <th scope="col">Description</th>

                            </tr>
                            </thead>
                            <tbody>

                            <tr>

                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->description}}</td>
                            </tr>

                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
