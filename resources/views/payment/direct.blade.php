@extends('layouts.appuser')

@section('title', 'Pembayaran')

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

    <div class="card mx-5 my-2">
        <div class="card-header">
            <h3>Pembayaran</h3>
        </div>
        <div class="d-flex card-body">
            <div class="card justify-content-center w-50 h-50">
                <div class="d-flex justify-content-evenly align-items-center ">
                    <div class="fixed-size-img">
                        <img src="{{ asset($transactions->image) }}" style="object-fit: cover; width: 200px; height: 200px" alt="Foto">
                    </div>
                    <div>
                        <h3>{{ $transactions->name }}</h3>
                        <h4>Rp. {{ number_format($transactions->price, 2, ',', '.') }}</h4>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="my-3">
                        {{-- <h3>Total : Rp. {{ number_format($transactions->total_price, 2, ',', '.') }}</h3> --}}
                    </div>
                </div>
            </div>

            <form action="{{ route('payment.storeDirect', $transactions->no_item) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group mx-5 w-50">
                    <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control input-field" id="name" name="name"
                            value="{{ auth()->user()->name }}" placeholder="Insert name..."
                            style="border: 1px solid #515050;" readonly>
                    </div>

                    <input type="hidden" readonly class="form-control" id="item_no_item" name="item_no_item"
                        value="{{ $transactions->no_item }}">

                    <div style="width: 300px" class="mb-3 col-md-12 col-sm-12">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity"
                            placeholder="Masukan jumlah pemesanan..." style="border: 1px solid #515050;" required>
                    </div>

                    <div style="width: 300px" class="mb-3 col-md-12 col-sm-12">
                        <label for="total_price" class="form-label">Jumlah Harga</label>
                        <input type="number" readonly class="form-control" id="total_price" name="total_price"
                            placeholder="Rp..." style="border: 1px solid #515050;" required>
                    </div>

                    <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                        <label for="amount" class="form-label">Amounts to pay :</label>
                        <p id="textAmount" class="ms-1">Rp. </p>
                        <input type="hidden" class="form-control input-field" id="amount" name="amount"
                            placeholder="Insert amount..."
                            style="border: 1px solid #515050;" readonly>
                    </div>

                    <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                        <label for="method" class="form-label">Payment Method</label>
                        <select name="method" id="method">
                            <option value="Qris">Qris</option>
                            <option value="Transfer">Transfer Bank</option>
                            <option value="Dana">Dana</option>
                            <option value="Ovo">Ovo</option>
                        </select>
                    </div>

                    <div id="qris" class="mb-4 col-md-12 col-sm-12">
                        <img src="{{ asset('images/qrisdummy.jpeg') }}" alt="">
                    </div>

                    <div id="nomer" class="mb-4">
                        <h6 class="text-info">&#9432; Silahkan transfer ke nomer berikut : 08xx-xxxx-xxxx</h6>
                    </div>

                    <div id="rekening" class="mb-4">
                        <h6 class="text-info">&#9432; Silahkan transfer ke rekening berikut : 170xxxxxxxx</h6>
                    </div>

                    <div class="float-end">
                        <button type="submit" class="btn btn-outline-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-coins pb-1">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z" />
                                <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4" />
                                <path
                                    d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z" />
                                <path d="M3 6v10c0 .888 .772 1.45 2 2" />
                                <path d="M3 11c0 .888 .772 1.45 2 2" />
                            </svg>
                            Bayar</button>
                    </div>

                </div>
            </form>
        </div>
        <div class="card-footer">
            <p class="fw-semibold mt-2">Alamat Pengiriman :</p>
            <p class="text-secondary fw-semibold">{{ $transactions->city }}, {{ $transactions->address }}</p>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#method').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                minimumResultsForSearch: -1,
            });

            var harga = {{ $transactions->price }};
            var qty = {{ $transactions->stock }};

            $('#quantity').on("input", function() {
                if ($(this).val() <= qty) {
                    var total = harga * $(this).val();
                    $('#total_price').val(total);
                    $('#amount').val(total);
                    $('#textAmount').empty();
                    $('#textAmount').append("Rp. " + total);
                } else {
                    $(this).val(qty);
                    $('#total_price').val(qty * harga);
                    $('#amount').val(qty * harga);
                    $('#textAmount').empty();
                    $('#textAmount').append("Rp. " + qty * harga);
                }
            });

            $('#rekening').hide();
            $('#nomer').hide();

            $('#method').change(function() {
                var method = $(this).val();
                if (method == 'Qris') {
                    $('#qris').show();
                    $('#rekening').hide();
                    $('#nomer').hide();
                } else if (method == 'Transfer') {
                    $('#rekening').show();
                    $('#qris').hide();
                    $('#nomer').hide();
                } else {
                    $('#nomer').show();
                    $('#qris').hide();
                    $('#rekening').hide();
                }
            });
        });
    </script>
@endsection
