<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        return Product::all();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'img_path' => 'required',
            'price' => 'required',
        ]);

        $request->request->add(['user_id' => auth()->user()->id]);



        return  Product::create($request->all());
    }


    public function show(Product $product)
    {
        return $product;
    }


    public function edit(Product $product)
    {
        //
    }


    public function update(Request $request, Product $product)
    {
        if ($request->user()->cannot('update', $product)) {
            abort(403);
        }
        $product->update($request->all());
        return $product;
    }


    public function destroy(Product $product)
    {
        if (auth()->user()->cannot('update', $product)) {
            abort(403);
        }
        Product::destroy($product);
    }

    public function search($name){
        return Product::where('name','like','%'.$name.'%')->get();
    }
}
