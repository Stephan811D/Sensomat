<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(
            Product::with('productType', 'automat')->where('active', 1)->get()
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'productName' => 'required',
            'productType_id' => 'required',
            'price' => 'required',
            'color' => 'required'
        ]);

        Product::create([
            'productName' => $request['productName'],
            'productType_id' => $request['productType_id'],
            'price' => $request['price'],
            'color' => $request['color'],
        ]);

        return response()->json([
            'message' => 'Product stored successfully'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'productName' => 'required',
            'productType_id' => 'required',
            'price' => 'required',
            'color' => 'required'
        ]);

        Product::findOrFail($id)->update($request->all());

        return response()->json([
            'message' => 'Product updated successfully'
        ]);
    }

    public function show($id)
    {
        return new ProductResource(Product::with('productType', 'automat')->findOrFail($id));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $automats = $product->automat->unique()->where('active', true)->isEmpty();

        if ($automats) {
            $product->active = false;
            $product->save();
            return response()->json([
                'message' => 'Product deleted successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'The request could not be completed due to a conflict with the current state of the target resource.',
            ],409);
        }
    }
}
