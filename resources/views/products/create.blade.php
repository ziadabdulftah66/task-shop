@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Product</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical" action="{{route('products.store')}}"
                                      method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">Price </label>
                                                    <input type="text" id="first-name-vertical" class="form-control" name="price" >
                                                    @error('price')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>

                                            </div>


                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">Name </label>
                                                    <input type="text" id="first-name-vertical" class="form-control" name="name" >
                                                    @error('name')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>







                                        <div class="row">
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">Description </label>
                                                    <textarea id="first-name-vertical" class="form-control" name="description" > </textarea>

                                                    @error('description')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>

                                            </div>


                                        </div>




<div class="col-12" style="margin-top: 30px">
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Create </button>



    </div>
                                    </div>


                                </form>
                            </div>
                        </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
