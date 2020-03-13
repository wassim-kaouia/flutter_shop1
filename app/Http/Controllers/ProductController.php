<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with(['category','images'])->paginate(env('PAGINATION_COUNT'));
        $currency_code = env('CURRENCY_CODE',"$"); // by default choose $ if cuurency_code not existed in .env

        return view('admin.products.products')->with(
            [
                'products' => $products,
                'currency' => $currency_code,

                ]);
    }
}
