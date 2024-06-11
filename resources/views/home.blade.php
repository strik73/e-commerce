@extends('layouts.appuser')

@section('title', 'Tokopedio')

@section('content')
    <style>
        .card-header {
            padding: 0;
        }

        .card-header img {
            height: 100%;
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px 5px 0 0;
        }

        .card {
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.1);
        }

        #etalase {
            margin: 40px 20px 0;
        }
    </style>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Success",
                text: "{{ session('success') }}",
                icon: "success",
            });
        </script>
    @endif

    <div class="mb-3">
        <div class="container flex d-flex justify-content-between">
            <h3>Belanja Apa Hari Ini?</h3>

            <div class="d-flex align-items-center">
                <a type="button" class="btn btn-light mx-3" href="{{ route('history') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" style="translate: 0 -1px" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-history me-2">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 8l0 4l2 2" />
                        <path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5" />
                    </svg>History Pembayaran
                </a>

                <a type="button" class="btn btn-light mx-3" href="{{ route('shopping-cart') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon text-dark mb-1 icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M17 17h-11v-14h-2" />
                        <path d="M6 5l14 1l-1 7h-13" />
                    </svg>
                </a>

                <form class="d-flex" action="{{ route('home.search') }}" method="get">
                    <input style="width: 300px" type="text" class="form-control" name="search" id="search"
                        placeholder="Cari di sini...">
                    <button type="submit" class="ms-2 btn btn-primary" style="width: 80px">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg>
                        Cari</button>
                </form>
            </div>
        </div>
    </div>
    <hr class="mx-3">

    <div id="etalase" class="container row">
        @foreach ($items as $i)
            <div class="col-md-3 col-sm-12 col-4">
                <div class="card">
                    <div class="card-header">
                        <img src="{{ asset($i->image) }}" alt="" class="img-fluid">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">{{ $i->name }}</h5>
                        <p class="card-text">
                            Rp. {{ number_format($i->price, 0, ',', '.') }}
                        </p>
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
                            {{ $i->users->name }}
                        </p>
                        <hr>
                        <div class="text-center">
                            <a type="button" class="btn btn-success"
                                href="{{ route('home.detail', $i->no_item) }}">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if ($items->count() == 0)
            <div class="container text-center">
                <p style="font-size: 40px;" class="card-title text-center text-secondary opacity-75">
                    <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-alert-triangle mb-2">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 9v4" />
                        <path
                            d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                        <path d="M12 16h.01" />
                    </svg>
                    Barang tidak ada!
                </p>
                <a style="width: 100px" type="button" class="btn mt-3 btn-secondary"
                    href="{{ route('home') }}">Kembali</a>
            </div>
        @endif
    </div>

    <div class="d-flex justify-content-center mt-5">
        {!! $items->links() !!}
    </div>
@endsection
