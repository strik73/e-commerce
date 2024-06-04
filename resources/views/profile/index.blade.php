@extends('layouts.appuser')

@section('title', 'My Profile')

@section('content')

@if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            })
        </script>
    @endif

    <div class="container card">
        <div class="card-body">
            <a type="button" class="btn btn-outline-secondary" href="{{route('home')}}">
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

            <div class="d-flex mt-3 justify-content-center align-items-center">
                <div class="table-fixed">
                    <table class="ms-5 table table-borderless">
                        <tr class="w-100">
                            <td class="w-25">Nama</td>
                            <td class="w-75">: {{ $user->name }}</td>
                        </tr>
                        <tr class="w-100">
                            <td class="w-25">Username</td>
                            <td class="w-75">: {{ $user->username }}</td>
                        </tr>
                        <tr class="w-100">
                            <td class="w-25">Email</td>
                            <td class="w-75">: {{ $user->email }}</td>
                        </tr>
                        <tr class="w-100">
                            <td class="w-25">Gender</td>
                            <td class="w-75">: {{ $user->gender }}</td>
                        </tr>
                        <tr class="w-100">
                            <td class="w-25">Phone</td>
                            <td class="w-75">: {{ $user->phone }}</td>
                        </tr>
                        <tr class="w-100">
                            <td class="w-25">City</td>
                            <td class="w-75">: {{ $user->city }}</td>
                        </tr>
                        <tr class="w-100">
                            <td class="w-25">Address</td>
                            <td class="w-75">: {{ $user->address }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center my-3">
                <a type="button" class="btn btn-primary" href="{{route('profile.edit', auth()->user()->id)}}">Edit Profile</a>
            </div>
        </div>
    </div>

@endsection
