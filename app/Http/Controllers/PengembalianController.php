<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengembalians = Pengembalian::all();


        return view('pages.admin.returns.index',[
            'pengembalians' => $pengembalians,
            'title' =>  'Pengembalian'

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('pages.admin.returns.create',[
            'products' => $products,
            'title' =>  'Tambah Pengembalian Baru'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        $product = Product::findOrFail($request->product_id);
        if ($request->quantity > $product->stock) {
        ($product->stock);
        }

        // UNTUK MENGUPDATE STOCK\\
        $update_product['stock'] = $product->stock + $request->quantity;
        $product->update($update_product);

        Pengembalian::create($data);
        return redirect()->route('pengembalian.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Pengembalian::findOrFail($id)->delete();

        return redirect()->back();
    }
}
