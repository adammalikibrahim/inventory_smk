@extends('layouts.home')

@section('content')
    <section class="collection-section" id="collection">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ url('storage/' . $item->image) }}" class="rounded product-img" alt="{{ $item->name }}">
                </div>
                <div class="col-md-6">
                    <h3 class="text-dark fw-bold mb-2">{{ $item->name }}</h3>
                    <p class="text-secondary mb-5">{!! $item->description !!}</p>
                    <p class="text-secondary mb-4">Stok: {{ number_format($item->stock) }}</p>

                    <form action="{{ route('home.keranjang.store') }}" method="post">
                        @csrf

                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                        <input type="hidden" name="price" value="{{ $item->price }}">
                        <input type="number" name="quantity" id="quantity" class="form-control w-25" min="1"
                            value="1" onchange="checkInput()" required {{ $item->stock == 0 ? 'readonly' : '' }}>
                        <p class="text-danger" id="errorText"></p>

                        <div class="d-flex align-items-center gap-2 flex-column flex-md-row">
                            <button class="btn btn-primary py-3 px-5" type="submit" id="cartButton"
                                {{ $item->stock == 0 ? 'disabled' : '' }}>Tambah ke Keranjang</button>
                            @auth
                                <button class="btn btn-outline-dark py-3 px-5" type="button" data-bs-toggle="modal"
                                    data-bs-target="#checkoutModal" {{ $item->stock == 0 ? 'disabled' : '' }}>Pinjam
                                    Sekarang</button>
                            @else
                                <a class="btn btn-outline-dark py-3 px-5" href="{{ route('register') }}">
                                    Daftar untuk Pinjam
                                </a>
                            @endauth
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @auth
        <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="checkoutModalLabel">Checkout Pesanan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('home.checkout.now') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('post')

                        <input type="hidden" name="price" value="{{ $item->price }}">
                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                        <div class="modal-body">
                            <p class="mb-2 text-dark fw-bold">Detail Pesanan</p>
                            <div class="table-responsive mb-3">
                                <table class="table">
                                    <tr style="vertical-align: middle">
                                        <td style="width: 100px">
                                            <img src="{{ url('storage/' . $item->image) }}" alt="" class="rounded">
                                        </td>
                                        <td class="fw-semibold">{{ $item->name }}</td>
                                        <td>
                                            <input type="number" name="quantity" id="quantity2" class="form-control"
                                                min="1" value="1">
                                            <span class="text-danger fs-7" id="errorText2"></span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <hr class="mb-3">
                            <p class="mb-2 fs-5 text-dark fw-semibold">Alamat Pengiriman</p>
                            <div class="mb-5">
                                <div class="mb-3">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->email }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="phone_number">Nomor Telepon</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->phone_number }}"
                                        >
                                </div>
                                <div class="mb-3">
                                    <label for="shipping_address">Alamat Tujuan</label>
                                    <textarea name="shipping_address" id="shipping_address" cols="30" rows="3" class="form-control"
                                        required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="checkoutButton">Checkout Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endauth
@endsection

@push('addon-style')
    <style>
        .product-img {
            height: 450px;
        }

        @media screen and (max-width: 768px) {
            .product-img {
                height: auto;
            }

            .w-25 {
                width: 100%;
            }
        }
    </style>
@endpush

@push('addon-script')
    <script>
        function checkInput() {
            var quantity = parseInt($("#quantity").val());
            var cartButton = $("#cartButton");
            var errorText = $("#errorText");

            if (quantity > {{ $item->stock }}) {
                cartButton.prop("disabled", true);
                errorText.text("Input melebihi stok!");
            } else {
                cartButton.prop("disabled", false);
                errorText.text("");
            }
        }



        $(document).ready(function() {
            $('#quantity2').on('input', function() {
                const quantity = parseInt($(this).val());

                const price = {{ $item->price }};
                const total = quantity * price;

                $('#total').text(formatRupiah(total));

                const checkoutButton = $("#checkoutButton");
                const errorText = $("#errorText2");

                if (quantity > {{ $item->stock }}) {
                    checkoutButton.prop("disabled", true);
                    errorText.text("Input melebihi stok!");
                } else {
                    checkoutButton.prop("disabled", false);
                    errorText.text("");
                }
            });
        });
    </script>
@endpush
