@extends('layouts.app')

@section('title', 'Create User')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container card">
        <div class="card-body">
            <h3>Create New User</h3>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body px-5">
            <form id="form" action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control input-field" id="name" name="name"
                                value="{{ old('name') }}" placeholder="Insert item name..."
                                style="border: 1px solid #515050;" required>
                        </div>

                        <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control input-field" id="username" name="username"
                                value="{{ old('username') }}" placeholder="Insert username..."
                                style="border: 1px solid #515050;" required>
                        </div>

                        <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control input-field" id="email" name="email"
                                value="{{ old('email') }}" placeholder="Insert email..." style="border: 1px solid #515050;"
                                required>
                        </div>

                        <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control input-field" id="password" name="password"
                                value="{{ old('password') }}" placeholder="Insert password..."
                                style="border: 1px solid #515050;" required>
                        </div>

                    </div>

                    <div class="col">
                        <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control input-field" id="city" name="city"
                                value="{{ old('city') }}" placeholder="Insert city name..."
                                style="border: 1px solid #515050;" required>
                        </div>
                        <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control input-field" id="address" name="address"
                                value="{{ old('address') }}" placeholder="Insert address..."
                                style="border: 1px solid #515050;" required>
                        </div>
                    </div>
                    <hr class="my-2" />

                    <div class="mt-4 mb-4">
                        <a type="button" class="btn btn-outline-secondary me-2" style="width: 80px"
                            href="{{ route('items.index') }}">Back</a>
                        <button style="width: 80px" class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#category_id').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
            });

            $('#condition').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                minimumResultsForSearch: -1,
            });

        });
    </script>
@endsection
