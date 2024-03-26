<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::latest()->get(); 
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    { 
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quatity' => 'required|numeric',
        ]);

        Products::create($data); 

        return redirect()->route('products.index')->withSuccess('Product added successfully');
    }

    public function edit($id)
    {
        $product = Products::findOrFail($id);
        return view('products.edit', compact('product'));
    }
    
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quatity' => 'required|numeric',
        ]);
    
        $product = Products::findOrFail($id); 
        $product->update($data);
    
        return redirect()->route('products.index')->withSuccess('Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Products::findOrFail($id); 
        $product->delete();

        return redirect()->route('products.index')->with('status', 'Product deleted successfully');
    }
}