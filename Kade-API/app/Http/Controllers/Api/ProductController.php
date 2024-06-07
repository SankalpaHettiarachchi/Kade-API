<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index()
    {
        return new ProductCollection(Product::all());
    }

    public function store(ProductCreateRequest $request)
    {
        $request->Validated($request->all());
        DB::table('products')->insert([
            'user_id' => Auth::id(),
            'image_url' => $request->image_url,
            'name' => $request->name,
            'description' => $request->description,
            'av_quantity' => $request->quantity,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'unit_price' => $request->unit_price,
        ]);
    }


    public function show(Request $request, Product $product)
    {
        //

    }


    public function update(Request $request, Product $product)
    {
        // $request->Validated($request->all());
        $product->update($request->only([
            'image_url','name','description','av_quantity','unit','unit_price'
        ]));

        // DB::table('products')->insert([
        //     'id' => $request->id,
        //     'image_url' => $request->image_url,
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'av_quantity' => $request->quantity,
        //     'unit' => $request->unit,
        //     'unit_price' => $request->unit_price,
        // ]);
    }


    public function destroy(Product $product)
    {
        //
    }
}
