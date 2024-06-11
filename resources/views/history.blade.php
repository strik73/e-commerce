@extends('layouts.appuser')

@section('title', 'My Shopping Cart')

@section('content')

    <style>
        #statusWaiting {
            border: 1px solid #a1a1a1;
            border-radius: 7px;
            color: #a1a1a1;
        }

        #statusSuccess {
            border: 1px solid #00c659;
            border-radius: 7px;
            color: #00c659;
        }

        #item {
            padding: 7px;
            border-width: 3px;
            border-style: solid;
            border-image:
                linear-gradient(to bottom,
                    rgb(179, 33, 147),
                    rgba(0, 0, 0, 0)) 1 100%;
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


    <div class="container flex d-flex justify-content-evenly">
        <div class="flex-grow-1">
            <div class="card">
                <div class="card-header d-flex justify-content-between p-4">
                    <h3>Payment History</h3>
                    <a type="button" class="btn btn-outline-secondary" href="{{ route('home') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 1 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l14 0" />
                            <path d="M5 12l6 6" />
                            <path d="M5 12l6 -6" />
                        </svg>
                        Kembali</a>
                </div>
                <div class="card-body">
                    <div class="ms-2 ps-1 mb-4">
                        <a type="button" class="btn btn-light @if (request()->routeIs('history')) active @endif"
                            href="{{ route('history') }}">Show On Process</a>
                        <a type="button" class="btn btn-light @if (request()->routeIs('history.done')) active @endif"
                            href="{{ route('history.done') }}">Show Done</a>
                    </div>
                    @if (count($payments) == 0)
                        <div class="text-center">
                            <h4 class="text-secondary opacity-75">Belum ada pembayaran!</h4>
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
                        @foreach ($payments as $payment)
                            <div class="container my-3">
                                <div id="item" class="card">
                                    <div class="card-body flex d-flex justify-content-between mb-4">
                                        <div class="d-flex flex-column ms-4 w-50">
                                            <h4 class="mb-3">{{ $payment->name }}</h5>
                                                <p class="mb-0"><span class="opacity-75">No Order : </span>
                                                    {{ $payment->no_transaction }}</p>
                                                <p class="mb-0"><span class="opacity-75">Total bayar :</span>
                                                    Rp. {{ number_format($payment->amount, 2, ',', '.') }}</p>
                                                <p class="mb-0"><span class="opacity-75">Tanggal pembayaran :</span>
                                                    {{ \Carbon\Carbon::parse($payment->created_at)->format('j M Y, H:i:s') }}
                                                </p>
                                                <p class="mb-0"><span class="opacity-75">Alamat pengiriman :</span>
                                                    {{ $payment->city }}, {{ $payment->address }}</p>
                                                <p class="mb-0"><span class="opacity-75">Metode Pembayaran :</span>
                                                    {{ $payment->method }}</p>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center align-middle w-25 me-4">
                                            <div id="status" class="float-end">
                                                @if ($payment->status == 'Success')
                                                    <div class="mb-3 float-end">
                                                        <h6 id="statusSuccess" class="py-2 px-3 text-center"> Order Status :
                                                            {{ $payment->status }} </h6>
                                                        <p class="text-success">&#9432; Silahkan cek shopping cart untuk
                                                            melihat status pengiriman</p>
                                                    </div>
                                                @elseif ($payment->status == 'Waiting Approval')
                                                    <div id="statusWaiting" class="mb-3 float-end">
                                                        <h6 class="pt-2 px-3 text-center"> Order Status :
                                                            {{ $payment->status }} </h6>
                                                    </div>
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
                    {!! $payments->links() !!}
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
        });
    </script>

@endsection
