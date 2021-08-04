<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function getAllProducts()
    {
        $products = Product::all();
        foreach($products as $product){
            $product->category;
        }
        return response()->json([
            "message" => "success",
            "products" => $products
        ], 200);
    }
    function getProduct($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json(["message" => "Product not found!"], 404);
        }
        return response()->json([
            "message" => "success",
            "product" => $product
        ], 200);
    }
    function create(CreateProductRequest $request)
    {
        $category = Category::find($request->category_id);
        if (is_null($category)) {
            return response()->json(["message" => "Category not found!"], 404);
        }
        $product = Product::create($request->all());
        return response()->json([
            "message" => "success",
            "product" => $product
        ], 201);
    }
    function update($id, Request $request)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json(["message" => "Product not found!"], 404);
        }
        $product->update($request->all());
        return response()->json([
            "message" => "success",
            "product" => $product
        ], 200);
    }
    function delete($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json(["message" => "Product not found!"], 404);
        }
        $product->delete();
        return response()->json(["message" => "success"], 204);
    }
}
