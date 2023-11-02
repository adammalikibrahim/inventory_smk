<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $item = Transaction::where('customer_id', Auth::user()->id)->where('status', 'in_cart')->with('details')->first();
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('pages.home.orders.checkout', [
            'title' => 'Checkout',
            'item' => $item,
            'categories' => $categories
        ]);
    }

    public function store(Request $request, $id)
    {
        $data = $request->all();
        Transaction::findOrFail($id)->update([
            'shipping_address' => $data['shipping_address'],
            'status' => 'in_progress'
        ]);

        // stock reduction
        $transaction = Transaction::findOrFail($id);
        foreach ($transaction->details as $item) {
            $product = Product::findOrFail($item->product_id);
            $product->update(['stock' => $product->stock - $item->quantity]);
        }

        return redirect()->route('home.success', $id);
    }

    public function checkout_now(Request $request)
    {
        Transaction::create([
            'shipping_address' => $request->shipping_address,
            'notes' => $request->notes,
            'status' => 'in_progress',
            'customer_id' => Auth::user()->id,
        ]);

        TransactionDetail::create([
            'transaction_id' => Transaction::where('customer_id', Auth::user()->id)->orderBy('id', 'DESC')->first()->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        $product = Product::findOrFail($request->product_id);
        $product->update(['stock' => $product->stock - $request->quantity]);

        $transaction = Transaction::where('customer_id', Auth::user()->id)->orderBy('id', 'DESC')->first();
        return redirect()->route('home.success', $transaction->id);
    }

    public function success($id)
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $transaction = Transaction::findOrFail($id);
        return view('pages.home.orders.success', [
            'title' => 'Sukses',
            'item' => $transaction,
            'categories' => $categories
        ]);
    }
}
