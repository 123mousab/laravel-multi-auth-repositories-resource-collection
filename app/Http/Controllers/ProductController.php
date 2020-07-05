<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function attachProduct()
    {
        $categories = Category::find([2,3]);
        $product = Product::find(1);
        $product->categories()->attach($categories);

        return mainResponse(true, __('ok'), compact('product', 'categories'), [], 200);
    }

    public function attachCategory()
    {
        $product = Product::find([1,2]);
        $categories = Category::find(1);
        $categories->products()->attach($product);

        return mainResponse(true, __('ok'), compact('product', 'categories'), [], 200);
    }


    public function detachProduct()
    {
        $categories = Category::find([3]);
        $product = Product::find(1);
        $product->categories()->detach($categories);

        return mainResponse(true, __('ok'), compact('product', 'categories'), [], 200);
    }


    public function detachCateogry()
    {
        $categories = Category::find(2);
        $product = Product::find(1);
        $categories->products()->detach($product);

        return mainResponse(true, __('ok'), compact('product', 'categories'), [], 200);
    }
}
