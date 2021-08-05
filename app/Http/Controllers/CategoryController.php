<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function getAllCategories()
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            $category->products;
        }
        return response()->json([
            "message" => "success",
            "categories" => $categories
        ], 200);
    }
    function getCategory($id)
    {
        $category = Category::find($id);
        if (is_null($category)) {
            return response()->json(["message" => "Category not found!"], 404);
        }
        return response()->json([
            "message" => "success",
            "category" => $category
        ], 200);
    }
    function create(CreateCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return response()->json([
            "message" => "success",
            "category" => $category
        ], 201);
    }
    function update($id, Request $request)
    {
        $category = Category::find($id);
        if (is_null($category)) {
            return response()->json(["message" => "Category not found!"], 404);
        }
        $category->update($request->all());
        return response()->json([
            "message" => "success",
            "category" => $category
        ], 200);
    }
    function delete($id)
    {
        $category = Category::find($id);
        if (is_null($category)) {
            return response()->json(["message" => "Category not found!"], 404);
        }
        $category->delete();
        return response()->json(["message" => "success"], 204);
    }
}
