@extends('layouts.app')
@section('title') Edit Product @endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Edit Product</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card widget">
                <div class="card-body">
                    <form action="{{route('product.update',$product)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name"
                                           value="{{$product->name}}" name="name"
                                           class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select id="category" class="form-control @error('category') is-invalid @enderror"
                                            name="category">
                                        <option value="" selected disabled="">Selct category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                    @if($product->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              name="description">{{ $product->description }}</textarea>
                                    @error('description')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" id="price"
                                           value="{{$product->price}}" name="price"
                                           class="form-control @error('price') is-invalid @enderror">
                                    @error('price')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" accept="image/*" id="image"
                                           name="image" class="form-control @error('image') is-invalid @enderror">
                                    <img src="{{asset($product->image_path)}}" alt=""
                                         class="small-img">
                                    @error('image')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if(session()->has('success'))
        <script>
            Toast.fire({
                icon: 'success',
                title: "{!! session()->get('success') !!}"
            });
        </script>
    @endif

    @if(session()->has('error'))
        <script>
            Toast.fire({
                icon: 'error',
                title: "{!! session()->get('error') !!}"
            });
        </script>
    @endif
@endpush
