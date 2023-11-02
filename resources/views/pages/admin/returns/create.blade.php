@extends('layouts.admin')

@section('content')
<div class="container">
    <h4 class="mb-2">Add New Pengembalian</h4>

    <form action="{{route('pengembalian.store')}}" method="post" enctype="multipart/form-data mt-5">
        @csrf
        <div class="mb-3">
            <label for="produk">Tanggal</label>
            <input type="date" name="tgl_kembali" class="form-control" id="tgl_kembali" value="{{old('tgl_kembali')}}">
        </div>
        <div class="mb-3">
            <label for="produk">Product</label>
            <select name="product_id" id="produk" class="form-control" required>
                @foreach ($products as $item)
                    <option value="{{$item->id}}">{{$item->name}} ({{$item->stock}})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" class="form-control" id="quantity" required>
        </div>
        @if (session('error'))
            <div class="alert alert-danger mb-3">
                {{session('error')}}
            </div>
        @endif
        <div class="d-flex align-items-center gap-2">
            <button type="submit" class="btn btn-success px-3">Save New</button>
            <a href="{{route('pengembalian.index')}}" class="btn btn-light px-3">Back</a>
        </div>
    </form>
</div>
@endsection
