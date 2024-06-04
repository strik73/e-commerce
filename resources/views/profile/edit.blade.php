@extends('layouts.appuser')

@section('title', 'Edit My Profile')

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
            <a type="button" class="btn btn-outline-secondary" href="{{ route('home') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler mb-1 icons-tabler-outline icon-tabler-arrow-left">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l14 0" />
                    <path d="M5 12l6 6" />
                    <path d="M5 12l6 -6" />
                </svg> Kembali</a>

            <div class="d-flex justify-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="0.7" stroke-linecap="round" stroke-linejoin="round"
                    class="icon text-secondary icon-tabler icons-tabler-outline icon-tabler-user-circle">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                    <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                    <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                </svg>
            </div>

            <div class="d-flex mt-3 ms-5 justify-content-center align-items-center">
                <form method="post" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col">
                            <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control input-field" id="name" name="name"
                                    value="{{ $user->name }}" placeholder="Insert name..."
                                    style="border: 1px solid #515050;" required>
                            </div>

                            <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control input-field" id="username" name="username"
                                    value="{{ $user->username }}" placeholder="Insert username..."
                                    style="border: 1px solid #515050;" required>
                            </div>

                            <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control input-field" id="email" name="email"
                                    value="{{ $user->email }}" placeholder="Insert email..."
                                    style="border: 1px solid #515050;" required>
                            </div>

                            <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control input-field" id="password" name="password"
                                    value="{{ old('password') }}" placeholder="Insert password..."
                                    style="border: 1px solid #515050;">
                                <p class="mt-1"><span class="text-sm text-primary" style="font-size: 14px">&#9432;
                                        Kosongkan untuk tidak merubah password</span></p>
                            </div>

                        </div>

                        <div class="col">
                            <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control input-field" id="phone" name="phone"
                                    value="{{ $user->phone }}" placeholder="Insert phone number..."
                                    style="border: 1px solid #515050;" required>
                            </div>

                            <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" id="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control input-field" id="city" name="city"
                                    value="{{ $user->city }}" placeholder="Insert city name..."
                                    style="border: 1px solid #515050;" required>
                            </div>
                            <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control input-field" id="address" name="address"
                                    value="{{ $user->address }}" placeholder="Insert address..."
                                    style="border: 1px solid #515050;" required>
                            </div>
                        </div>
                        <hr class="my-2" />

                        <div class="mt-4 mb-4">
                            <a type="button" class="btn btn-outline-secondary me-2" style="width: 80px"
                                href="{{ route('profile.index', $user->id) }}">Back</a>
                            <button style="width: 80px" class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#gender').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                minimumResultsForSearch: -1,
            });
        });
    </script>

@endsection
