<?php

namespace App\Http\Controllers\Api;

use App\Models\ProductType;
use App\Http\Resources\ProductTypeResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function index()
    {
        return ProductType::where('active', 1)->get();
    }

    public function indexBasic()
    {
        return ProductTypeResource::collection(
            ProductType::where('active', 1)->get()
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'productType' => 'required',
            'productDepth' => 'required'
        ]);

        ProductType::create([
            'productType' => $request['productType'],
            'productDepth' => $request['productDepth']
        ]);

        return response()->json([
            'message' => 'ProductType stored successfully'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'productType' => 'required',
            'productDepth' => 'required'
        ]);

        ProductType::findOrFail($id)->update($request->all());

        return response()->json([
            'message' => 'ProductType updated successfully'
        ]);
    }

    public function show($id)
    {
        return ProductType::findOrFail($id);
    }

    public function destroy($id)
    {
        $productType = ProductType::findOrFail($id);
        $productType->active = false;
        $productType->save();
        
        return response()->json([
            'message' => 'ProductType deleted successfully'
        ]);
    }
}
