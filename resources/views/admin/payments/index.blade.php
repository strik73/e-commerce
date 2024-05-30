@extends('layouts.app')

@section('title', 'Payment History')

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
            <h3>Payment List</h3>
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
                            <th>Payment ID</th>
                            <th>Transaction ID</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                            <tr>
                                <th class="text-center">{{ $payment->id }}</th>
                                <th class="text-center">{{ $payment->transaction_no_transaction }}</th>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ $payment->method }}</td>
                                <td>{{ $payment->status }}</td>
                                <td>{{ format($payment->created_at, 'Hh:mm d-m-y') }}</td>
                                <td>{{ format($payment->updated_at, 'Hh:mm d-m-y') }}</td>
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
