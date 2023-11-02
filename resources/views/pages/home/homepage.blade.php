@extends('layouts.home')

@section('content')
    <section class="header-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <img src="{{url('assets/images/Logosmk.png')}}" alt="Ginan Marketplace" class="d-block mx-auto mb-4"
                        style="width: 200px">

                    <h1 class="header-title text-center text-dark fw-bold mb-2">
                        Selamat Datang di Inventory RPL
                    </h1>
                    <p class="mb-4 text-secondary text-center">

                    </p>
                    <a href="#collection" class="btn btn-dark px-3 py-2 d-block mx-auto" style="width: max-content">
                        Lihat Koleksi
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="collection-section" id="collection">
        <div class="container">
            <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-5">
                <h3 class="section-title mb-0">Koleksi Kami</h3>
                <a href="{{ route('home.produk') }}" class="btn btn-light px-3">Lihat Semua</a>
            </div>

            <div class="row">
                @foreach ($products as $item)
                    <div class="col-md-3">
                        @include('components.card-product')
                    </div>
                @endforeach
            </div>
        </div>
    </section>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimoniCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimoniCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>
@endsection
