<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class AdminProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',   
            'category_id' => 'required',
            'price' => 'required',
            'stock' => 'required|integer',
            'image' => 'required',
            'description' => 'required'
        ]);

        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);

        $image = explode('.', $request->file('image')->getClientOriginalName())[0];
        $image = $image . '-' . time() . '.' . $request->file('image')->extension();
        $request->file('image')->storeAs('images/products/', $image);

        $price = explode('.', $request->price);
        $weightForSlug = $request->weight == '' ? '' : '-' . strtolower($request->weight);

        Product::create([
            'name' => $request->name,
            'weight' => $request->weight,
            'category_id' => $request->category_id,
            'slug' => $slug . $weightForSlug,
            'price' => join($price),
            'stock' => $request->stock,
            'image' => $image,
            'description' => $request->description
        ]);

        return redirect('/dashboard/products')->with('success', 'New product has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json([
            'category' => $product->category->name,
            'name' => $product->name,
            'slug' => $product->slug,
            'price' => $product->price = 'Rp' . number_format($product->price, 0, ',' , '.'),
            'image' => $product->image,
            'description' => $product->description
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'stock' => 'integer',
            'description' => 'required'
        ]);

        $price = explode('.', $request->price);
        $data['price'] = join($price);

        if($request->file('image')) {
            Storage::delete('images/products/' . $product->image);

            $image = explode('.', $request->file('image')->getClientOriginalName())[0];
            $image = $image . '-' . time() . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('images/products/', $image);

            $data['image'] = $image;
        };

        $product->update($data);

        return redirect('/dashboard/products')->with('success', 'Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Storage::delete('images/products/' . $product->image);
        $product->delete();

        return redirect('/dashboard/products')->with('success', 'Product has been deleted');
    }
