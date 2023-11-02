@extends('layouts.home')

@section('content')
    <section class="checkout" id="collection">
        <div class="container">
            <h2 class="section-title mb-5">Isi Data Dibawah ini</h2>

            <form action="{{ route('home.checkout.store', $item->id) }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="card border-0 mb-5">
                            <div class="card-body">
                                <p class="mb-3 fs-5 text-dark fw-semibold">Alamat Pengiriman</p>
                                <div class="row mb-5">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="name">Nama Lengkap</label>
                                            <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" value="{{ Auth::user()->email }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone_number">Nomor Telepon</label>
                                            <input type="text" class="form-control"
                                                value="{{ Auth::user()->phone_number }}" >
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="shipping_address">Alamat Rumah</label>
                                            <textarea name="shipping_address" id="shipping_address" cols="30" rows="3" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0">
                            <div class="card-body">
                                <h5 class="text-dark fw-semibold mb-3">Pinjaman Anda</h5>
                                @foreach ($item->details as $detail)
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <img src="{{ url('storage/' . $detail->product->image) }}"
                                                style="width: 100%; height: 100%; object-fit: cover" class="rounded"
                                                alt="{{ $detail->product->name }}">
                                        </div>
                                        <div class="col-6">
                                            {{ $detail->product->name }}
                                            <br> <span class="fs-7 text-secondary">x{{ $detail->quantity }}</span>
                                        </div>
                                    </div>
                                @endforeach
                                <hr style="border-style: dashed" class="mt-5">
                                <button type="submit" class="btn btn-primary py-2 px-3 w-100 fw-bold">Pinjam</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('addon-style')
    <style>
        @media screen and (max-width: 768px) {

            .w-25,
            .w-50 {
                width: 100% !important;
            }
        }
    </style>
@endpush
