@extends('layouts.home')

@section('content')
    <section class="checkout" id="collection">
        <div class="container">
            <h2 class="section-title mb-5">Pesanan Saya</h2>

            <div class="table-responsive">
                <table class="table">
                    <thead class="fw-semibold text-uppercase fs-7">
                        <tr>
                            <th>Tanggal</th>
                            <th>kode pinjam</th>
                            <th>produk</th>
                            <th>data peminjam</th>
                            <th>status</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr style="vertical-align: middle">
                                <td>
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}
                                </td>
                                <td>#PESANAN000{{ $item->id }}</td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-light d-flex align-items-center gap-2" type="button"
                                            data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                            <i class="bx bx-file"></i> Lihat Produk
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-light d-flex align-items-center gap-2" type="button"
                                            data-bs-toggle="modal" data-bs-target="#detailPemesan{{ $item->id }}">
                                            <i class="bx bx-file"></i> Lihat Pemesan
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    @if ($item->status == 'in_progress')
                                        <span class="badge bg-warning py-2 d-flex align-items-center gap-2"
                                            style="width: max-content">
                                            <i class='bx bx-package'></i> Proses
                                        </span>
                                    @elseif($item->status == 'on_delivery')
                                        <span class="badge bg-info py-2 d-flex align-items-center gap-2"
                                            style="width: max-content">
                                            <i class='bx bx-car'></i> Dikirim
                                        </span>
                                    @elseif($item->status == 'success')
                                        <span class="badge bg-success py-2 d-flex align-items-center gap-2"
                                            style="width: max-content">
                                            <i class='bx bx-check'></i> Sukses / Diterima
                                        </span>
                                    @elseif($item->status == 'cancelled')
                                        <span class="badge bg-danger py-2 d-flex align-items-center gap-2"
                                            style="width: max-content">
                                            <i class='bx bx-error-circle'></i> Dibatalkan
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        @if ($item->status == 'on_delivery')
                                            <form action="{{ route('home.my-orders.update', $item->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="success">
                                                <button class="btn btn-primary btn-sm" type="submit">Terima
                                                    Pesanan</button>
                                            </form>
                                        @endif
                                        <a href="#"
                                            class="btn btn-success btn-sm px-3 d-flex align-items-center gap-2">
                                            <i class="bx bxl-whatsapp"></i> Hubungi Admin
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1"
                                aria-labelledby="detailModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="detailModalLabel">Detail Barang</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach ($item->details as $detail)
                                                <div class="row mb-1">
                                                    <div class="col-5">Produk</div>
                                                    <div class="col-7 fw-semibold">: {{ $detail->product->name }}</div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col-5">Quantity</div>
                                                    <div class="col-7 fw-semibold">: {{ number_format($detail->quantity) }}
                                                    </div>
                                                </div>
                                                <hr class="mb-3">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="detailPemesan{{ $item->id }}" tabindex="-1"
                                aria-labelledby="detailPemesanLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="detailPemesanLabel">
                                                Detail Peminjam
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-1">
                                                <div class="col-5">Nama Peminjam</div>
                                                <div class="col-7 fw-semibold">:
                                                    {{ $item->customer->name }}</div>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-5">Alamat</div>
                                                <div class="col-7 fw-semibold">:
                                                    {{ $item->shipping_address }}</div>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-5">Nomor Telepon</div>
                                                <div class="col-7 fw-semibold">:
                                                    {{ $item->customer->phone_number }}</div>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-5">Alamat Email</div>
                                                <div class="col-7 fw-semibold">:
                                                    {{ $item->customer->email }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
