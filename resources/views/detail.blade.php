@extends('layouts.appuser')

@section('title', 'Detail ' . $item->name)

@section('content')
    <style>
        .card-header {
            background-color: white;
        }

        #image-barang {
            width: 300px;
            height: 300px;
            object-fit: cover;
            border: 1px solid #51505020;
            border-radius: 6px;
            box-shadow: 1px 1px 6px rgba(0, 0, 0, 0.01);
        }

        .nav-item:hover {
            background-color: #51505020;
            border-radius: 5px 5px 0 0;
        }
    </style>

    @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <div class="container card">
            <div class="card-header flex d-flex justify-content-between">
                <h2 class="my-4 fw-semibold">{{ $item->name }}</h2>
                <a href="{{ route('home') }}" style="height: 40px; translate: 0 22px" class="btn btn-outline-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left mb-1">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l14 0" />
                        <path d="M5 12l6 6" />
                        <path d="M5 12l6 -6" />
                    </svg>
                    Kembali</a>
            </div>
            <div class="card-body">
                <div class="flex d-flex mt-3 justify-content-evenly">
                    <div id="container-gambar" class="">
                        <img id="image-barang" src="{{ asset($item->image) }}" alt="gambar barang">
                    </div>
                    <div class="p-4 shadow shadow-sm"
                        style="border: 1px solid #5150501d; border-radius: 2px; width: 500px;">
                        <h3 class="mb-2 fw-semibold">{{ $item->name }}</h3>
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="me-1 mb-1" style="color: rgb(84, 84, 84)">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 21l18 0" />
                                <path
                                    d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4" />
                                <path d="M5 21l0 -10.15" />
                                <path d="M19 21l0 -10.15" />
                                <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
                            </svg>
                            {{ $item->users->name }}
                        </p>
                        <h2 class="mb-5 fw-semibold">Rp. {{ number_format($item->price, 0, ',', '.') }}</h2>

                        <div class="container">
                            <div id="tab-barang" class="tab-content">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" id="tab-link" role="presentation">
                                        <button type="button" data-bs-target="#detail" data-bs-toggle="tab"
                                            class="nav-link active" aria-controls="detail"
                                            aria-selected="true">Detail</button>
                                    </li>
                                    <li class="nav-item" id="tab-link" role="presentation">
                                        <button type="button" data-bs-target="#deskripsi" data-bs-toggle="tab"
                                            class="nav-link" aria-controls="deskripsi"
                                            aria-selected="false">Deskripsi</button>
                                    </li>
                                </ul>

                                <div id="tab-content" class="tab-content px-2 pt-4">
                                    <div id="detail" class="tab-pane fade show active" aria-labelledby="detail-tab">
                                        <p> <span class="fw-semibold opacity-50">Stok : </span>{{ $item->stock }}</p>
                                        <p><span class="fw-semibold opacity-50">Kategori : </span>
                                            {{ $item->categories->category }}</p>
                                        <p><span class="fw-semibold opacity-50">Kondisi Barang : </span>
                                            {{ $item->condition }}</p>
                                    </div>
                                    <div id="deskripsi" class="tab-pane fade" role="tabpanel"
                                        aria-labelledby="deskripsi-tab">
                                        {!! $item->description ? $item->description : 'Belum ada deskripsi.' !!}
                                    </div>
                                </div>
                                <hr class="mt-5">

                                <div class="d-flex flex-row justify-content-evenly mt-3">
                                    <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addCart">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-plus pb-1">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                        Add to cart</a>

                                    <a type="button" class="btn btn-outline-success" href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
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
                                        Beli Langsung</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Create Modal --}}
    <div class="modal modal-blur fade" id="addCart" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body px-5">
                    <form id="form" action="{{ route('shopping-cart.store') }}" method="post">
                        @csrf
                        <input type="hidden" readonly class="form-control" id="item_no_item" name="item_no_item" value="{{ $item->no_item }}">

                        <div style="width: 300px" class="mb-3 col-md-12 col-sm-12">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                placeholder="Masukan jumlah pemesanan..." style="border: 1px solid #515050;" required>
                        </div>

                        <div style="width: 300px" class="mb-3 col-md-12 col-sm-12">
                            <label for="total_price" class="form-label">Jumlah Harga</label>
                            <input type="text" readonly class="form-control" id="total_price" name="total_price"
                                placeholder="Masukan jumlah pemesanan..." style="border: 1px solid #515050;" required>
                        </div>

                        <p class="text-secondary text-sm mt-4" style="font-size: 13px">
                            &#9432; Nomor transaksi akan dibuat setelah anda menekan tombol "Save"
                        </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn ms-auto btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // var price = new AutoNumeric('#total_price', {
            //     allowDecimalPadding: false,
            //     currencySymbol: "Rp. "
            // })

            var itemPrice = {{ $item->price }};
            var itemStock = {{ $item->stock }};

            $('#quantity').on('input', function() {
                var qty = $(this).val();
                var totalPrice = qty * itemPrice;
                $('#total_price').val(totalPrice.toLocaleString('id-ID', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }));
                if (itemStock < qty) {
                    Swal.fire({
                        title: "Stok tidak mencukupi",
                        text: "Silahkan masukkan jumlah yang sesuai dengan stok",
                        icon: "warning",
                    });
                    $('#quantity').val(itemStock);
                }
            })

            $('#quantity').trigger('input');

            $('#form').submit(function(e) {
                var totalPriceFormatted = $('#total_price').val();
                var plainValue = totalPriceFormatted.replace(/\./g, '');
                document.querySelector('#total_price').value = plainValue;
            });

        });
    </script>

@endsection
