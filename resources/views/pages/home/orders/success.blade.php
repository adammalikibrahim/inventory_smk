@extends('layouts.home')

@section('content')
    <section class="checkout" id="checkout">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="mb-5 text-center">
                                <i class='bx bx-check-circle text-success' style="font-size: 50px"></i>
                                <h4 class="text-dark fw-semibold mt-2">Terima kasih atas Pinjaman Anda</h4>
                                <p class="text-secondary mb-5">Pinjaman Anda akan segera kami proses.</p>
                            </div>

                            <div class="mb-3">
                                <p class="mb-1 text-dark fw-semibold">Tanggal Pinjam</p>
                                <p class="mb-0 text-secondary">{{ $item->created_at->format('l, d F Y, h:i:s') }}</p>
                            </div>
                            <div class="mb-3">
                                <p class="mb-1 text-dark fw-semibold">Pinjaman Anda</p>
                                @foreach ($item->details as $detail)
                                    <div class="row mb-2">
                                        <div class="col-2">
                                            <img src="{{ url('storage/' . $detail->product->image) }}"
                                                style="width: 100%; height: 100%; object-fit: cover" class="rounded"
                                                alt="{{ $detail->product->name }}">
                                        </div>
                                        <div class="col-7">
                                            {{ $detail->product->name }}
                                            <br> <span class="fs-7 text-secondary">x{{ $detail->quantity }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <hr class="mb-3" style="border-style: dashed">
                            <a class="py-2 w-100 btn btn-primary" href="{{ route('home.produk') }}">Pinjam Lainnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
