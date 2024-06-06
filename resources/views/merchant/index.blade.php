@extends('layouts.appuser')

@section('title', 'Merchant')

@section('content')

    <style>
        #statusPending {
            border: 1px solid #ffaa00;
            border-radius: 7px;
            color: #ffaa00;
        }

        #statusBatal {
            border: 1px solid #c60000;
            border-radius: 7px;
            color: #c60000;
        }

        #statusSuccess {
            border: 1px solid #00c617;
            border-radius: 7px;
            color: #00c617;
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

    <div class="d-flex container flex mx-5 mt-2 mb-4">
        <a type="button" class="me-3 btn btn-light" href="{{ route('merchant.dashboard') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 2 30 24" fill="none"
                stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-box">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                <path d="M12 12l8 -4.5" />
                <path d="M12 12l0 9" />
                <path d="M12 12l-8 -4.5" />
            </svg>Dashboard</a>

        <a type="button" class="me-3 active btn btn-light" href="{{ route('home.merchant') }}">
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

    <div class="container flex d-flex justify-content-evenly">
        <div class="flex-grow-1">
            <div class="card">
                <div class="card-header">
                    <h3>List Pesanan Masuk</h3>
                </div>
                <div class="card-body">
                    @if (count($transaction) == 0)
                        <div class="text-center">
                            <h4 class="text-secondary opacity-75">Belum ada pesanan baru!</h4>
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
                    @else
                        @foreach ($transaction as $t)
                            <div class="container my-3">
                                <div class="card">
                                    <div class="card-body flex d-flex justify-content-between mb-2">
                                        <img src="{{ asset($t->image) }}" alt="foto"
                                            style="object-fit: cover; width: 100px; height: 100px; border: 1px solid rgba(128, 128, 128, 0.155); border-radius: 6px;">
                                        <div class="d-flex flex-column w-50">
                                            <h5 class="mb-1">{{ $t->name }}</h5>
                                            <p class="mb-0"><span class="opacity-75">No Order : </span>
                                                {{ $t->no_transaction }}</p>
                                            <p class="mb-0"><span class="opacity-75">Jumlah pembelian :</span>
                                                {{ $t->quantity }}</p>
                                            <p class="mb-0"><span class="opacity-75">Tanggal pembelian :</span>
                                                {{ \Carbon\Carbon::parse($t->created_at)->format('j M Y, H:i:s') }}
                                            </p>
                                            <p class="mb-0"><span class="opacity-75">Status Bayar :</span>
                                                <span
                                                    class="badge {{ $t->pay_status == 'Success' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $t->pay_status }} </span>
                                            </p>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center align-middle w-25 me-4">
                                            <h4 class="mb-3 text-end">Rp.
                                                {{ number_format($t->total_price, 0, ',', '.') }}</h4>
                                            <div id="status" class="float-end">
                                                @if ($t->status == 'Pending')
                                                    <div id="statusPending" class="mb-3 float-end">
                                                        <h6 class="pt-2 px-3 text-center"> Order Status :
                                                            {{ $t->status }} </h6>
                                                    </div>
                                                @elseif ($t->status == 'Batal')
                                                    <div id="statusBatal" class="mb-3 float-end">
                                                        <h6 class="pt-2 px-3 text-center"> Order Status :
                                                            {{ $t->status }} </h6>
                                                    </div>
                                                @elseif ($t->status == 'Processed')
                                                    <div id="statusPending" class="mb-3 float-end">
                                                        <h6 class="pt-2 px-3 text-center"> Order Status :
                                                            {{ $t->status }} </h6>
                                                    </div>
                                                @elseif ($t->status == 'Success')
                                                    <div id="statusSuccess" class="mb-3 float-end">
                                                        <h6 class="pt-2 px-3 text-center"> Order Status :
                                                            Done </h6>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex d-flex justify-content-end">
                                                @if ($t->status !== 'Success')
                                                    <form id="form-batal"
                                                        action="{{ route('shopping-cart.batal', $t->no_transaction) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <button type="button" id="button-batal"
                                                            class="ms-2 btn btn-outline-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                style="translate: 0 -1px"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M18 6l-12 12" />
                                                                <path d="M6 6l12 12" />
                                                            </svg>
                                                            Batalkan</button>
                                                    </form>

                                                    <form id="form-approve"
                                                        action="{{ route('merchant.approve', $t->no_transaction) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <button type="button" id="button-approve"
                                                            class="ms-2 btn btn-outline-success">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                style="translate: 0 -1px"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M18 6l-12 12" />
                                                                <path d="M6 6l12 12" />
                                                            </svg>
                                                            Approve</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="card-footer">
                    {!! $transaction->links() !!}
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#button-batal').click(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Batalkan transaksi ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-batal').submit();
                    }
                });
            });

            $('#button-approve').click(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Selesaikan transaksi ini?",
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-approve').submit();
                    }
                });
            });
        });
    </script>

@endsection
