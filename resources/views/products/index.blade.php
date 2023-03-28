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
                        @can('add_product')  <a href="{{route('products.create')}}" class="btn btn-primary">create product</a>@endcan

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">price</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @isset($products)
                                <?php $i=1 ?>
                            @foreach($products as $product)
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                @can('edit_product')    <td><a href="{{route('products.edit',$product->id)}}" class="btn btn-primary">Edit </a></td>@endcan
                                @can('delete_product')  <td><a href="{{route('products.destroy',$product->id)}}" class="btn btn-primary">Delete </a></td>@endcan
                                @can('show_product')   <td><a href="{{route('products.show',$product->id)}}" class="btn btn-primary">View </a></td>@endcan
                            </tr>
                                <?php $i++ ?>
                            @endforeach
                            @endisset

                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
