@extends('layouts.admin')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-5">
            <h4 class="text-dark fw-semibold">Pengembalian Barang</h4>
            <a href="{{ route('pengembalian.create') }}" class="btn btn-success d-flex align-items-center gap-2">
                <i class="bx bx-plus"></i> Add Product
            </a>
        </div>
        {{-- <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-5">
            <a href="{{ route('home') }}" class="btn btn-light d-flex align-items-center gap-2">
                <i class="bx bx-plus"></i> Back
            </a>
        </div> --}}

        <div class="card border-0">
            <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="fs-7 text-uppercase">no</th>
                                    <th class="fs-7 text-uppercase">tanggal kembali</th>
                                    <th class="fs-7 text-uppercase">nama barang</th>
                                    <th class="fs-7 text-uppercase">jumlah</th>
                                    <th class="fs-7 text-uppercase">akun</th>
                                    <th class="fs-7 text-uppercase"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengembalians as $key => $item)
                                    <tr style="vertical-align: middle">
                                        <td>{{ ++$key }}</td>
                                        <td>{{$item->tgl_kembali}}</td>
                                        <td>{{ $item->products->name}}</td>
                                        <td>{{ number_format($item->quantity) }}</td>
                                        <td>{{ $item ->users->name }}</td>

                                        <td>
                                            <div class="d-flex align-items-center justify-content-end gap-2">
                                                <form action="{{ route('pengembalian.destroy', $item->id) }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm d-flex align-items-center gap-2"
                                                        onclick="return confirm('Kamu yakin untuk menghapus produk ini? datanya bisa kehapus semua loh')">
                                                        <i class="bx bx-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
</section>
@endsection
