@extends('layouts.appuser')

@section('title', 'Merchant')

@section('content')

    <style>
        .button-new {
            background-color: #576FDB;
            border: none;
            border-radius: 7px;
            color: white;
            padding: 7px 8px;
            text-decoration: none;
            font-weight: 300;
        }

        .button-new:hover {
            background-color: #8b9dea;
            border: none;
            border-radius: 7px;
            color: white;
            padding: 7px 8px;
            text-decoration: none;
            transition: all 0.2s ease;
        }
    </style>

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

    <div class="mt-0 mx-auto py-1 px-4">
        <h3>Merchant Dashboard</h3>
    </div>

    <div class="d-flex flex mx-4 my-3 mb-5">
        <a type="button" class="me-3 active btn btn-light" href="{{ route('merchant.dashboard') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 2 30 24" fill="none"
                stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-box">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                <path d="M12 12l8 -4.5" />
                <path d="M12 12l0 9" />
                <path d="M12 12l-8 -4.5" />
            </svg>Dashboard</a>

        <a type="button" class="me-3 btn btn-light" href="{{ route('home.merchant') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 2 30 24" fill="none"
                stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-layout-list">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                <path d="M4 14m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
            </svg>Orders</a>

        <a type="button" class="me-3 btn btn-light" href="{{ route('merchant.history') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 2 30 24" fill="none"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-history-toggle">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10 20.777a8.942 8.942 0 0 1 -2.48 -.969" />
                <path d="M14 3.223a9.003 9.003 0 0 1 0 17.554" />
                <path d="M4.579 17.093a8.961 8.961 0 0 1 -1.227 -2.592" />
                <path d="M3.124 10.5c.16 -.95 .468 -1.85 .9 -2.675l.169 -.305" />
                <path d="M6.907 4.579a8.954 8.954 0 0 1 3.093 -1.356" />
                <path d="M12 8v4l3 3" />
            </svg>History</a>
    </div>

    <div class="card m-4">
        <div class="card-header my-2">
            <h3 class="ms-3">Item List</h3>
        </div>
        <div class="card-body">
            <div class="mt-1 px-4">
                @if (count($items) !== 0)
                    <div class="text-end">
                        <a type="button" href="{{ route('merchant.items.create') }}" class="button-new mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                                stroke-linejoin="round" class="pb-1">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            New Item</a>
                    </div>
                    <div class="table-responsive">
                        <table id='data' class="table table-bordered table-hover" width='100%'>
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Item ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Condition</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</button></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr>
                                        <th class="text-center">{{ ltrim(substr($item->no_item, -5), '0') }}</th>
                                        <th class="text-center">{{ $item->no_item }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->categories->category }}</td>
                                        <td>{{ $item->stock }}</td>
                                        <td>Rp. {{ number_format($item->price, 0, '.', ',') }}</td>
                                        <td>{{ $item->condition }}</td>
                                        <td>
                                            @if ($item->status == true)
                                                <span class="badge bg-success text-white">Aktif</span>
                                            @else
                                                <span class="badge bg-danger text-white">Non-Aktif</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{-- @if (auth()->user()->can('UPDATE KATEGORI')) --}}
                                            <a href="{{ route('merchant.items.edit', $item->no_item) }}" type="button"
                                                class="btn btn-sm btn-primary">
                                                <span class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler-pencil"
                                                        width="18" height="18" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                        <path d="M13.5 6.5l4 4" />
                                                    </svg>
                                                </span> Edit
                                            </a>
                                            {{-- @endif --}}
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center">
                        <h4 class="text-secondary opacity-75">Belum ada item yang ditambahkan!</h4>
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-alert-circle opacity-50 mt-3">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                            <path d="M12 8v4" />
                            <path d="M12 16h.01" />
                        </svg>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#data').DataTable({
                scrollCollapse: true,
                paging: true,
                language: {
                    emptyTable: "Tidak ditemukan data item",
                    zeroRecords: "Tidak ada data item yang ditemukan"
                },
            });
        });
    </script>

@endsection
