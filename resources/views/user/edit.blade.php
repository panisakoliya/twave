@extends('layouts.app')
@section('title') Edit User @endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Edit User</h1>
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
                    <form action="{{route('user.update',$user)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name"
                                           value="{{$user->name}}" name="name"
                                           class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email"
                                           value="{{$user->email}}" name="email"
                                           class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password"
                                           name="password" class="form-control @error('password') is-invalid @enderror">
                                    <div>Leave blank if you want to keep current password</div>
                                    @error('password')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" id="address"
                                           value="{{$user->address}}" name="address"
                                           class="form-control @error('address') is-invalid @enderror">
                                    @error('address')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" accept="image/*" id="image"
                                           name="image" class="form-control @error('image') is-invalid @enderror">
                                    @error('image')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                    <img src="{{asset($user->image_path)}}" alt="img" class="small-img mt-2">
                                </div>
                            </div>

                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" id="phone_number"
                                           name="phone_number"
                                           value="{{$user->phone_number}}"
                                           class="form-control @error('phone_number') is-invalid @enderror">
                                    @error('phone_number')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row mt-5">
                            <div class="col">
                                <button type="submit" class="btn btn-success">Update</button>
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
