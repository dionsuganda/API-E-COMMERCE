<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\Transaksi;

class CustomerController extends Controller
{
    public function index(Request $request){
        $customer = Customers::with('address')->get();
        return $customer;
    }

    public function product(Request $request){
        $product = Product::get();
        return $product;
    }

    public function transaksi(Request $request){
        $customer = Customers::with('address')->where('id',$request->customer_id)->first();
        $total_price = 0;
        foreach($request->product as $key => $value){
            $product = Product::where('id', $value)->first();
            $total_price += $product->price;
        }
        $payment = Payment::where('id', $request->payment_id)->first();
        $transaksi = new Transaksi;
        $transaksi->payment_id = $payment->id;
        $transaksi->payment_name = $payment->name;
        $transaksi->total_payment = $total_price;
        $transaksi->save();

        foreach($request->product as $key => $value){
            $product = Product::where('id', $value)->first();
            $cart = new Cart;
            $cart->transaksi_id = $transaksi->id;
            $cart->product_id = $value;
            $cart->product_name = $product->name;
            $cart->product_price = $product->price;
            $cart->save();
        }

        return $transaksi;
    }

    public function listTransaksi(Request $request){
        $transaksi = Transaksi::with('cart')->get();
        return $transaksi;
    }
}
