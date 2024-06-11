@extends('layouts.appuser')

@section('title', 'My Shopping Cart')

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
            border: 1px solid #00c659;
            border-radius: 7px;
            color: #00c659;
        }

        #statusDelivery {
            border: 1px solid #003bc6;
            border-radius: 7px;
            color: #003bc6;
        }

        #item {
            padding: 7px;
            border-width: 3px;
            border-style: solid;
            border-image:
                linear-gradient(to bottom,
                    rgb(33, 60, 179),
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
                    <h3>Shopping Cart</h3>
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
                        <a type="button" class="btn btn-light @if (request()->routeIs('shopping-cart')) active @endif" href="{{ route('shopping-cart') }}">Show On Process</a>
                        <a type="button" class="btn btn-light @if (request()->routeIs('shopping-cart.done')) active @endif" href="{{ route('shopping-cart.done') }}">Show Done</a>
                    </div>
                    @if (count($transactions) == 0)
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
                    @else
                        @foreach ($transactions as $transaction)
                            <div class="container my-4 mb-5">
                                <div id="item" class="card">
                                    <div class="card-body flex d-flex justify-content-between mb-4">
                                        <img src="{{ asset($transaction->image) }}" alt="foto"
                                            style="object-fit: cover; width: 150px; height: 150px; border: 1px solid rgba(128, 128, 128, 0.155); border-radius: 6px;">
                                        <div class="d-flex flex-column w-50">
                                            <h4 class="mb-3">{{ $transaction->name }}</h5>
                                                <p class="mb-0"><span class="opacity-75">No Order : </span>
                                                    {{ $transaction->no_transaction }}</p>
                                                <p class="mb-0"><span class="opacity-75">Jumlah pembelian :</span>
                                                    {{ $transaction->quantity }}</p>
                                                <p class="mb-0"><span class="opacity-75">Tanggal pembelian :</span>
                                                    {{ \Carbon\Carbon::parse($transaction->created_at)->format('j M Y, H:i:s') }}
                                                </p>
                                                <p class="mb-0"><span class="opacity-75">Toko/Seller :</span>
                                                    {{ $transaction->seller_name }}</p>
                                                <p class="mb-0"><span class="opacity-75">Nama Pembeli :</span>
                                                    {{ $transaction->buyer_name }}</p>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center align-middle w-25 me-4">
                                            <h2 class="mb-3 text-end">Rp.
                                                {{ number_format($transaction->total_price, 0, ',', '.') }}</h2>
                                            <div id="status" class="float-end">
                                                @if ($transaction->status == 'Pending' || $transaction->status == 'Processed')
                                                    <div id="statusPending" class="mb-3 float-end">
                                                        <h6 class="pt-2 px-3 text-center"> Order Status :
                                                            {{ $transaction->status }} </h6>
                                                    </div>
                                                @elseif ($transaction->status == 'Batal')
                                                    <div id="statusBatal" class="mb-3 float-end">
                                                        <h6 class="pt-2 px-3 text-center"> Order Status :
                                                            {{ $transaction->status }} </h6>
                                                    </div>
                                                @elseif ($transaction->status == 'Success')
                                                    <div id="statusSuccess" class="mb-3 float-end">
                                                        <h6 class="pt-2 px-3 text-center"> Order Status :
                                                            {{ $transaction->status }} </h6>
                                                    </div>
                                                @elseif ($transaction->status == 'On Delivery')
                                                    <div id="statusDelivery" class="mb-3 float-end">
                                                        <h6 class="pt-2 px-3 text-center"> Order Status :
                                                            {{ $transaction->status }} </h6>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex d-flex justify-content-end">
                                                @if ($transaction->status === 'Pending')
                                                    <a type="button" class="btn btn-outline-success" style="width: 120px"
                                                        href="{{ route('payment.create', $transaction->no_transaction) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-coins pb-1">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z" />
                                                            <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4" />
                                                            <path
                                                                d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z" />
                                                            <path d="M3 6v10c0 .888 .772 1.45 2 2" />
                                                            <path d="M3 11c0 .888 .772 1.45 2 2" />
                                                        </svg>
                                                        Bayar</a>

                                                    <form id="form-batal"
                                                        action="{{ route('shopping-cart.batal', $transaction->no_transaction) }}"
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
                                                            Batal</button>
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
                    {!! $transactions->links() !!}
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
