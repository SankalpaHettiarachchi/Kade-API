<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{

    public function index()
    {
        return new ProductCollection(Product::all());
    }

    public function store(ProductCreateRequest $request)
    {
        $request->Validated($request->all());
        $newProduct = DB::table('products')->insertGetId([
                'user_id' => Auth::id(),
                'image_url' => $request->image_url,
                'name' => $request->name,
                'description' => $request->description,
                'av_quantity' => $request->quantity,
                'quantity' => $request->quantity,
                'unit' => $request->unit,
                'unit_price' => $request->unit_price,
            ]);

        $product = Product::findOrFail($newProduct);
        return new ProductCollection(collect([$product]));

    }

    public function show(Product $product)
    {
        return new ProductCollection(collect([$product]));
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $request->Validated($request->all());
        Gate::authorize('update', $product);
        $product->update($request->only([
            'image_url','name','description','av_quantity','unit','unit_price'
        ]));

        $product = Product::findOrFail($product->id);
        return new ProductCollection(collect([$product]));
    }

    public function destroy(Product $product)
    {
        Gate::authorize('delete', $product);
        $product->delete();
        return response()->json(['message' => 'Product Removed.'], 204);
    }
}
