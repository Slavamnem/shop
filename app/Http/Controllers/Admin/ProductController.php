<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Services\Admin\ProductService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['color', 'size', 'category'])->get();

        return view("admin.products.index", compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ProductService::getDataForProductEditPage($id);

        return view("admin.products.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->fill($request->only($product->getFillable()));
        ProductService::saveImages($request, $product->id);

        $product->save();

        return redirect()->route("admin-products-edit", ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route("admin-products");
    }

    public function storageLearn()
    {
        Storage::disk("public")->prepend('test-file.txt', 'Prepended Text');
        //Storage::disk("public")->put("test-file.txt", "data1111111");
        Storage::put("test-file2.txt", "data222");
        if (Storage::disk("public")->exists("test-file.txt")) {
            dump(Storage::disk("public")->get("test-file.txt"));
            dump(Storage::disk("public")->url("test-file.txt"));
            dump(Storage::disk("public")->size("test-file.txt"));
            dump(Storage::disk("public")->lastModified("test-file.txt"));
        }

//        Storage::copy('old/file1.jpg', 'new/file1.jpg');
//        Storage::move('old/file1.jpg', 'new/file1.jpg');
    }
}
