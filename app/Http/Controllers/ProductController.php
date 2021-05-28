<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $countProduct = Product::all()->count();
        $countActiveProduct = $this->getActiveProduct();
        $countInactiveProduct = $this->getInactiveProduct();
        return view('product.index')->with('products', $products)->with('countActiveProduct', $countActiveProduct)->with('countInactiveProduct', $countInactiveProduct)->with('countProduct', $countProduct);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('product.create')->with('products', $products)->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->reference = $request->reference;
        $product->active = $request->active;
        $product->status = $request->status;
        
        $product->price = $request->price;
        $product->image = $request->image;
        $product->category_id = $request->category_id;
        $product->save();
        return redirect('/home/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $product = Product::find($id);
       
        return view('product.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $categories = Category::all();
        $product = Product::find($id);
        return view('product.edit')->with('product', $product)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->reference = $request->reference;
        $product->active = $request->active;
        $product->status = $request->status;
        $product->image = $request->image;
        $product->category_id = $request->category_id;
        $product->update();
        return redirect('/home/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/home/products');
    }

    public function getActiveProduct(){
        $product = Product::where('active', 1)->count();
        return $product;
    }
    public function getInactiveProduct(){
        $product = Product::where('active', 0)->count();
        return $product;
    }
}