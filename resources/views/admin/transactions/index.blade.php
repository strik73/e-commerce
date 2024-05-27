@extends('layouts.app')

@section('title', 'Transactions')

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
            <h3>Transaction List</h3>
        </div>
    </div>

    <div class="card mt-3">
        {{-- <div>
            <a class="float-end mt-3 me-4 btn btn-sm btn-primary pt-2 pe-3" href='{{ route('items.create') }}'>
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="pb-1">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                </svg>
                Add New</a>
        </div> --}}

        <div class="mt-1 p-4">
            <div class="table-responsive">
                <table id='data' class="table table-bordered table-hover" width='100%'>
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Transaction ID</th>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Customer Name</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Order Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr>
                                <th class="text-center">{{ $transaction->no_transaction }}</th>
                                <th class="text-center">{{ $transaction->no_transaction }}</th>
                                <th>{{ $transaction->item_no_item }}</th>
                                <th>{{ $transaction->items->name }}</th>
                                <th>{{ $transaction->users->name }}</th>
                                <th>{{ $transaction->quantity }}</th>
                                <th>Rp. {{ number_format($transaction->total_price, 0, '.', ',') }}</th>
                                <th>{{ $transaction->status }}</th>
                                <th>{{ format($transaction->created_at, 'Hh:mm d-m-y') }}</th>
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
