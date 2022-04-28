@extends('layouts.app')
@section('title') Products @endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Products</h1>
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
                <div class="card-header">
                    <h5 class="card-title">
                        <a href="{{route('product.create')}}" class="btn btn-primary float-end">Add Product</a>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-4 mt-4 overflow-hidden">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}

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

    <script>
        function deleteRow(url, uuid) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: {
                            'uuid': uuid,
                            '_token': "{{csrf_token()}}",
                        },
                        success: function (response) {
                            if (response.status === true) {
                                Toast.fire({
                                    icon: 'success',
                                    title: response.message
                                });
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: response.message
                                });
                            }
                            $('#products-table').DataTable().draw();
                        }
                    });
                }
            })
        }
    </script>
@endpush
