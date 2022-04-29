@extends('layouts.app')
@section('title') Edit Order @endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Edit Order</h1>
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
                    <form action="{{route('order.update',$order)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label for="name">Total Price</label>
                                    <input type="number" id="total_price"
                                           value="{{ $order->total_price }}" name="total_price"
                                           class="form-control @error('total_price') is-invalid @enderror">
                                    @error('total_price')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label for="category">Payment Type</label>
                                    <input type="text" id="payment_type"
                                           value="{{ $order->payment_type }}" name="payment_type"
                                           class="form-control @error('payment_type') is-invalid @enderror">
                                    @error('payment_type')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label for="price">Shipping</label>
                                    <input type="number" id="shipping"
                                           value="{{ $order->shipping }}" name="shipping"
                                           class="form-control @error('shipping') is-invalid @enderror">
                                    @error('shipping')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 mt-4">
                                <div class="form-group">
                                    <label for="price">Order Status</label><br>
                                    <select name="order_status" class="form-control @error('order_status') is-invalid @enderror">
                                        <option value="" selected hidden>Please Select</option>
                                        <option value="delivered" @if($order->order_status=="delivered") selected @endif>Delivered</option>
                                        <option value="confirmed @if($order->order_status=="confirmed") selected @endif">Confirmed</option>
                                        <option value="pending" @if($order->order_status=="pending") selected @endif>Pending</option>
                                        <option value="failed" @if($order->order_status=="failed") selected @endif>Failed</option>
                                    </select>
                                    @error('order_status')
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
