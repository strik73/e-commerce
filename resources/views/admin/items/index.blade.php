@extends('layouts.app')

@section('title', 'Items')

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
            <h3>Item List</h3>
        </div>
    </div>

    <div class="card mt-3">
        @if (auth()->user()->can('CREATE ITEMS'))
            <div>
                <a class="float-end mt-3 me-4 btn btn-sm btn-primary pt-2 pe-3" href='{{ route('items.create') }}'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="pb-1">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 5l0 14" />
                        <path d="M5 12l14 0" />
                    </svg>
                    Add New</a>
            </div>
        @endif

        <div class="mt-1 p-4">
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
                                    @if (auth()->user()->can('EDIT ITEMS'))
                                    <a href="{{ route('items.edit', $item->no_item) }}" type="button"
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
                                    @endif
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
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
