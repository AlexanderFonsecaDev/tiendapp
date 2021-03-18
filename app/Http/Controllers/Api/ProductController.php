<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use http\Env\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        return ProductCollection::make(Product::all());
    }

    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->all());
        return ProductResource::make($product);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return ProductResource::make($product);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json("Producto eliminado con exito");
    }
}
