<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Request('search');

        // $product = Product::where('name', 'like', '%' . request('search') . '%')->orderBy('id', 'desc')->paginate(5);
        

        // $product = Product::query();
        // if(request('search')){
        //     return $product->where('name', 'like', '%' . request('search') . '%')->orderBy('id', 'desc')->paginate(5);
        // }else {
        //     return $product->orderBy('id', 'desc')->paginate(5);
        // }
        
        return Product::when(request('search'), function($query){
            $query->where('name', 'like', '%' . request('search') . '%');
        })->orderBy('id', 'desc')->paginate(5);
    }

    public function store(ProductStoreRequest $request)
    {
        // $product = new Product();
        // $product->name = $request->name;
        // $product->price = $request->price;
        // $product->save();

        // Product::create([
        //     'name' => 'Gon',
        //     'price' => '123.00',
        // ]);
        
        
        // $request->validate([
        //     'name' => 'required|string',
        //     'price' => 'required|numeric'
        // ],[
        //     'name.required' => 'The Name is Required.',
        //     'name.string' => 'The Name must be String.',
        //     'price.required' => 'The Price is Required.',
        //     'name.numeric' => 'The Price must be Number.'
        // ]);
        return Product::create($request->only('name', 'price'));
        // return $post;
    }

    public function show(Product $product)
    {
        // return $product = Product::findOrFail($id);
        return $product;
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        // $product = Product::findOrFail($id);
        // $product->name = $request->name;
        // $product->price = $request->price;
        // $product->save();


        // $request->validate([
        //     'name' => 'nullable|string',
        //     'price' => 'nullable|numeric'
        // ],[
        //     'name.string' => 'The Name must be String',
        //     'price.numeric' => 'The Price must be Number'
        // ]);
        return $product->update($request->only('name', 'price'));
    }

    public function destroy(Product $product)
    {
        //
        return $product->delete();
    }
}
